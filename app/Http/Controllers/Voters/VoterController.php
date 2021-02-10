<?php

namespace App\Http\Controllers\Voters;
use App\Models\Area;
use App\Models\Voter;
use App\Models\Nominee;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class VoterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        // $this->middleware('auth');
    }

    public function postLoginVoter(Request $request)
    {
        $params = $request->all();
        $voter = null;
        $code = isset($params['code']) ? $params['code'] : null;
        if (!is_null($code)) {
            $voter = Voter::whereNull(Voter::TABLE_NAME . '.deleted_at')
                ->where(Voter::TABLE_NAME . '.flag_active', Voter::STATE_ACTIVE)
                ->where(Voter::TABLE_NAME . '.document_number', $code)
                ->first();
        }
        
        if (!is_null($voter)) {
            $error = false;
            $message = "DNI encontrado";
            $view = view('voters.validate-profile', compact('error', 'message', 'voter'));
            // vista votante encontrado
        } else {
            $error = true;
            $message = "El DNI ingresado no fue encontrado en nuestros registros. Por favor, inténtalo nuevamente...";
            $view = view('voters.login', compact('error', 'message', 'voter'));
            // vista votante no encontrado
        }

        return $view;
    }

    public function postInfoVoter(Request $request)
    {
        $params = $request->all();
        $voter = Voter::whereNull(Voter::TABLE_NAME . '.deleted_at')
            ->where(Voter::TABLE_NAME . '.flag_active', Voter::STATE_ACTIVE)
            ->where(Voter::TABLE_NAME . '.code', isset($params['code']) ? $params['code'] : null)
            ->where(Voter::TABLE_NAME . '.id', isset($params['id']) ? $params['id'] : null)
            ->first();
        
        if (!is_null($voter)) {
            $voter->fill($params);
            $voter->save();
            // traer candidatos
            $nominees = Nominee::whereNull('deleted_at')->get();
            $view = view('voters.create-vote', compact('voter', 'nominees'));
        } else {
            $error = true;
            $message = "Hubo un intento de vulnerabilidad. Por favor, inténtalo nuevamente...";
            $view = view('voters.login', compact('error', 'message', 'voter'));
        }

        return $view;
    }

    public function submitVote(Request $request)
    {
        $params = $request->all();
        // votante
        $voter = Voter::whereNull(Voter::TABLE_NAME . '.deleted_at')
            ->where(Voter::TABLE_NAME . '.code', isset($params['code']) ? $params['code'] : null)
            ->first();
        // candidato
        $nominee = Nominee::find(isset($params['nomineeId']) ? (int)$params['nomineeId'] : null);
        // validación
        if (!is_null($voter) && !is_null($nominee)) {
            // crear voto
            #codigo de crear voto
            // fin de crear voto
            $view = view('voters.thanks-for-vote', compact('voter'));
        } else {
            $view = view('voters.failed-vote', compact('voter'));
        }

        return $view;
    }

    public function getThanksforVote(Request $request)
    {
        $params = $request->all();
        $voter = Voter::whereNull(Voter::TABLE_NAME . '.deleted_at')
            ->where(Voter::TABLE_NAME . '.code', isset($params['code']) ? $params['code'] : null)
            ->first();
            
        return view('voters.thanks-for-vote', compact('voter'));
    }
}
