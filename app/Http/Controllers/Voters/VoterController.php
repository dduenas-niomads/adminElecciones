<?php

namespace App\Http\Controllers\Voters;
use App\Models\Area;
use App\Models\Voter;
use App\Models\Nominee;
use App\Models\Result;
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
            //validacion voto unica vez
            $result = Voter::join(Result::TABLE_NAME, Result::TABLE_NAME . '.voters_id', '=',
                Voter::TABLE_NAME . '.id')
                ->select(Result::TABLE_NAME . '.*')
                ->whereNull(Result::TABLE_NAME . '.deleted_at')
                ->where(Result::TABLE_NAME . '.voters_id', '=', $voter->id);
            if ($result->count('voters_id') < 1) {
                $view = view('voters.validate-profile', compact('error', 'message', 'voter'));
            }
            else {
                $error = true;
                $message = "Estimado votante. La votación se realiza solo una vez.";
                $view = view('voters.login', compact('error', 'message', 'voter'));
            }
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
            ->where(Voter::TABLE_NAME . '.code', isset($params['voterCode']) ? $params['voterCode'] : null)
            ->first();
        // candidato
        $nominee = Nominee::find(isset($params['nomineeId']) ? (int)$params['nomineeId'] : null);
        // validación
        if (!is_null($voter) && !is_null($nominee)) {
            // crear voto
            $result = new Result();
            $result->voters_id = $voter->id;
            $result->nominees_id = $params['nomineeId'];
            try {
                $result->save();
            
            } catch(\Illuminate\Database\QueryException $e){
                $errorCode = $e->errorInfo[1];
                if($errorCode == '1062'){
                    $error = true;
                    $message = 'Estimado ' . $voter->name . '. La votación se realiza una sola vez.';
                    $view = view('voters.login', compact('error', 'message', 'voter'));
                }
                return $view;
            }
            // fin de crear voto
            // enviar correo
            if (!is_null($voter->email)) {
                # lógica de enviar correo
            }
            // fin de enviar correo
            // enviar sms
            if (!is_null($voter->phone)) {
                # lógica de enviar sms
            }
            // fin de enviar sms
            $view = view('voters.thanks-for-vote', compact('voter'));
        } else {
            $view = view('voters.failed-vote', compact('voter'));
        }

        return $view;
    }

    public function getVotersJson(Request $request)
    {
        $params = $request->all();
        $voters = Voter::whereNull('deleted_at');
        if (isset($params['search']['value'])) {
            $voters = $voters->where('name', 'like', '%' . $params['search']['value'] . '%');
        }
        $voters = $voters->paginate(10);
        return response($voters);
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
