<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Nominee;
use App\Models\Result;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        $params = $request->all();
        $results = Result::whereNull(Result::TABLE_NAME . '.deleted_at')
            ->select(DB::raw('count(*) as suma'), 'nominees_id')
            ->with('nominee')
            ->groupBy('nominees_id')
            ->orderBy('suma', 'DESC');
        if (isset($params['all']) && (int)$params['all']) {
            $results = $results->get();
        } else {
            $results = $results->take(30)->get();
        }
        return view('home', compact('results'));
    }

    public function detail(Request $request)
    {
        $params = $request->all();
        $results = Result::whereNull(Result::TABLE_NAME . '.deleted_at')
            ->with('voter')
            ->with('nominee')
            ->groupBy('nominees_id')
            ->orderBy('created_at', 'ASC');
        if (isset($params['electionId']) && (int)$params['electionId']) {
            $results = $results->where('elections_id', (int)$params['electionId'])->paginate(10);
        } else {
            $results = $results->paginate(10);
        }
        return view('home', compact('results'));
    }
}
