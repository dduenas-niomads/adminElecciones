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
                ->where(Voter::TABLE_NAME . '.code', $code)
                ->first();
        }
        
        if (!is_null($voter)) {
            $error = false;
            $message = "Código encontrado";
            $view = view('voters.validate-profile', compact('error', 'message', 'voter'));
            // vista votante encontrado
        } else {
            $error = true;
            $message = "El código ingresado no fue encontrado en nuestros registros. Por favor, inténtalo nuevamente...";
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
}
