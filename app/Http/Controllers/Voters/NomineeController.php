<?php

namespace App\Http\Controllers\Voters;
use App\Models\Area;
use App\Models\Voter;
use App\Models\Nominee;
use App\Models\Result;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class NomineeController extends Controller
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

    public function getNomineesJson(Request $request)
    {
        $params = $request->all();
        $nominees = Nominee::whereNull('deleted_at');
        if (isset($params['search']['value'])) {
            $nominees = $nominees->where('name', 'like', '%' . $params['search']['value'] . '%');
        }
        $nominees = $nominees->paginate(22);
        return response($nominees);
    }
}
