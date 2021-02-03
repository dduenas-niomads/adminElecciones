<?php

namespace App\Http\Controllers;
use App\Models\Election;
use App\Models\ElectionDetail;
use App\Models\Area;
use App\Models\Position;
use App\Models\Nominee;
use Illuminate\Http\Request;
use Redirect;

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
        $details = ElectionDetail::all();
        $details = $details->where('elections_id', '=', $election->id);
        $details = $details->whereNull('deleted_at');
        $areas = Area::all();
        $areas = $areas->whereNull('deleted_at');
        $nominees = Nominee::all();
        $nominees = $nominees->whereNull('deleted_at');
        $positions = Position::all();
        $positions = $positions->whereNull('deleted_at');
        return view('elections.edit', compact('election', 'nominees', 'positions', 'areas', 'details'));        
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
            'nominees_id'=>'required',
            'areas_id'=>'required',
            'positions_id'=>'required'
        ]);
        $election = Election::find($id);
        $election->name =  $election->name;
        $election->updated_at =  date('Y-m-d H:i:s');
        $election->save();

        $detail = new ElectionDetail();
        $detail->elections_id = $election->id;
        $detail->nominees_id = $request->get('nominees_id');
        $detail->areas_id = $request->get('areas_id');
        $detail->positions_id = $request->get('positions_id');
        $detail->save();
        return Redirect::back()->with('success', 'DETALLE ACTUALIZADO!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $detail = ElectionDetail::find($id);
        $detail->deleted_at = date("Y-m-d H:i:s");
        $detail->save();
        return Redirect::back()->with('success', 'NOMINADO ELIMINADO CORRECTAMENTE!');
    }
}
