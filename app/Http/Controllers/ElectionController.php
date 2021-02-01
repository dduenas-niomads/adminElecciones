<?php

namespace App\Http\Controllers;
use App\Models\Election;
use Illuminate\Http\Request;

class ElectionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index()
    {
        $elections = Election::all();
        $elections = $elections->whereNull('deleted_at');
        return view('elections.index', compact('elections'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('elections.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'=>'nullable',
            'status'=>'default:1',
            'votes_number'=>'nullable',
            'date_start'=>'datetime',
            'date_end'=>'nullable',
            'flag_active'=>'default:1'
        ]);
        $election = new Election([
            'name' => $request->get('name'),
            'status' => 1,
            'votes_number' => $request->get('votes_number'),
            'date_start' =>date('Y-m-d H:i:s'),
            'date_end' => $request->get('date_end'),
            'flag_active' => 1
        ]);
        $election->save();
        return redirect('/elections')->with('success', 'Votación creada!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $election = Election::find($id);
        return view('elections.edit', compact('election'));        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name'=>'nullable',
            'status'=>'default:2',
            'date_end'=>'nullable',
            'flag_active'=>'default:1'
        ]);
        $election = Election::find($id);
        $election->status =  2;
        $election->date_end =  date('Y-m-d H:i:s');
        $election->flag_active =  1;
        $election->save();
        return redirect('/elections')->with('success', 'Votación actualizada!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $election = Election::find($id);
        $election->deleted_at = date("Y-m-d H:i:s");
        $election->save();
        return redirect('/elections')->with('success', 'Votación eliminada!');
    }
}
