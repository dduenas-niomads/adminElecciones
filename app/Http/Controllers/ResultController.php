<?php

namespace App\Http\Controllers;
use App\Models\Result;
use App\Models\Position;
use App\Models\Election;
use App\Models\Nominee;
use Illuminate\Http\Request;

class ResultController extends Controller
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
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $positions = Position::all();
        $positions = $positions->whereNull('deleted_at');
        $elections = Election::all();
        $elections = $elections->whereNull('deleted_at');
        $nominees = Nominee::all();
        $nominees = $nominees->whereNull('deleted_at');
        return view('results.create', compact('positions', 'nominees', 'elections'));
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
            'positions_id'=>'required',
            'elections_id'=>'required',
            'nominees_id'=>'required'
        ]);
        $result = new Result([
            'elections_id' => $request->get('elections_id'),
            'positions_id' => $request->get('positions_id'),
            'nominees_id' => $request->get('nominees_id')
        ]);
        $result->save();
        return redirect('/elections')->with('success', 'Voto creada!');
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
        //      
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
