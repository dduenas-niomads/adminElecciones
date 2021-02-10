<?php

namespace App\Http\Controllers\Admin;
use App\Models\Area;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AreaController extends Controller
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
        $areas = Area::all();
        $areas = $areas->whereNull('deleted_at');
        return view('areas.index', compact('areas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('areas.create');
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
            'code'=>'nullable'
        ]);
        $area = new Area([
            'name' => $request->get('name'),
            'code' => $request->get('code')
        ]);
        $area->save();
        return redirect('/areas')->with('success', 'Área creada!');
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
        $area = Area::find($id);
        return view('areas.edit', compact('area'));        
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
            'code'=>'nullable'
        ]);
        $area = Area::find($id);
        $area->name =  $request->get('name');
        $area->code =  $request->get('code');
        $area->save();
        return redirect('/areas')->with('success', 'Área actualizada!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $area = Area::find($id);
        $area->deleted_at = date("Y-m-d H:i:s");
        $area->flag_active = Area::STATE_INACTIVE;
        $area->save();
        return redirect('/areas')->with('success', 'Área eliminada!');
    }
}
