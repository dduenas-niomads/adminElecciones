<?php

namespace App\Http\Controllers\Voters;
use App\Models\Area;
use App\Models\Voter;
use App\Models\Nominee;
use App\Models\Result;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Notifications\SendVoteResume;

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
            $firstTime = true;
            //validacion voto unica vez
            $result = Voter::join(Result::TABLE_NAME, Result::TABLE_NAME . '.voters_id', '=',
                Voter::TABLE_NAME . '.id')
                ->select(Result::TABLE_NAME . '.*')
                ->whereNull(Result::TABLE_NAME . '.deleted_at')
                ->where(Result::TABLE_NAME . '.voters_id', '=', $voter->id);
            if ($result->count('voters_id') < 1) {
                $view = view('voters.validate-profile', compact('error', 'message', 'voter', 'firstTime'));
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

    public static function sendEmail($result)
    {
        try {
            $result->notify(new SendVoteResume($result));
            $result->flag_mail_sended = Result::STATE_ACTIVE;
            $result->save();
        } catch (\Throwable $th) {
            return null;
        }
    }

    public static function sendEmailUsingVoter($voter)
    {
        try {
            $voter->notify(new SendVoteResume($voter));
        } catch (\Throwable $th) {
            throw $th;
        }
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
            $thanksForVote = true;
            $view = view('voters.validate-profile', compact('voter', 'thanksForVote'));
        } else {
            $view = view('voters.failed-vote', compact('voter'));
        }

        return $view;
    }

    public function getResultDetails(Request $request)
    {
        $params = $request->all();
        $results = Result::join(Voter::TABLE_NAME, Voter::TABLE_NAME . '.id', '=', Result::TABLE_NAME . '.voters_id')
            ->join(Nominee::TABLE_NAME, Nominee::TABLE_NAME . '.id', '=', Result::TABLE_NAME . '.nominees_id')
            ->select(Result::TABLE_NAME . '.created_at', 
                Voter::TABLE_NAME . '.name as voter_name', 
                Voter::TABLE_NAME . '.document_number as voter_document_number', 
                Nominee::TABLE_NAME . '.name as nominee_name', 
                Nominee::TABLE_NAME . '.code as nominee_code')
            ->whereNull(Result::TABLE_NAME . '.deleted_at');
        if (isset($params['search'])) {
            $key = $params['search']['value'];
            $results = $results->where(function($query) use ($key){
                $query->where(Voter::TABLE_NAME . '.name', 'LIKE', '%' . $key . '%');
                $query->orWhere(Voter::TABLE_NAME . '.document_number', 'LIKE', '%' . $key . '%');
                $query->orWhere(Nominee::TABLE_NAME . '.name', 'LIKE', '%' . $key . '%');
                $query->orWhere(Nominee::TABLE_NAME . '.code', 'LIKE', '%' . $key . '%');
            });
        }
        if (isset($params['electionId']) && (int)$params['electionId']) {
            $results = $results->where(Result::TABLE_NAME . '.elections_id', (int)$params['electionId']);
        }
        $results = $results->paginate(10);
        return $results;
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

    public function postThanksforVote(Request $request)
    {
        $params = $request->all();
        $voter = Voter::whereNull(Voter::TABLE_NAME . '.deleted_at')
            ->where(Voter::TABLE_NAME . '.code', isset($params['code']) ? $params['code'] : null)
            ->first();
        if (!is_null($voter)) {
            $voter->fill($params);
            $voter->save();
            // $result
            $result = Result::whereNull(Result::TABLE_NAME . '.deleted_at')
                ->where(Result::TABLE_NAME . '.voters_id', $voter->id)
                ->with('voter')
                ->with('nominee')
                ->first();
            // send email
            if (!is_null($voter->email) && !is_null($result)) {
                $result->email = $voter->email;
                $result->save();
                $this->sendEmail($result);
            }
        }  
        return view('voters.thanks-for-vote', compact('voter'));
    }
}
