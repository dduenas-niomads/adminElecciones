<?php

namespace App\Http\Controllers\Admin;
use App\Models\Area;
use App\Models\Voter;
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
        $this->middleware('auth');
    }

    public function index()
    {
        $voters = Voter::all();
        $areas = Area::all();
        $voters = $voters->whereNull('deleted_at');
        return view('voters.index', compact('voters', 'areas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $voters = Voter::all();
        $areas = Area::all();
        $areas = $areas->whereNull('deleted_at');
        return view('voters.create', compact('voters', 'areas'));
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
            'name'=>'required',
            'code'=>'required',
            'areas_id'=>'required'
        ]);
        $voter = new Voter([
            'name' => $request->get('name'),
            'code' => $request->get('code'),
            'areas_id' => $request->get('areas_id')
        ]);
        $voter->save();
        return redirect('/voters')->with('success', 'Votante creado!');
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
        $voter = Voter::find($id);
        $areas = Area::all();
        $areas = $areas->whereNull('deleted_at');
        return view('voters.edit', compact('voter', 'areas'));        
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
            'name'=>'required',
            'code'=>'required',
            'areas_id'=>'required'
        ]);
        $voter = Voter::find($id);
        $voter->name =  $request->get('name');
        $voter->code =  $request->get('code');
        $voter->areas_id =  $request->get('areas_id');
        $voter->save();
        return redirect('/voters')->with('success', 'Votante actualizado!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $voter = Voter::find($id);
        $voter->deleted_at = date("Y-m-d H:i:s");
        $voter->flag_active = Voter::STATE_INACTIVE;
        $voter->save();
        return redirect('/voters')->with('success', 'Votante eliminado!');
    }
}
