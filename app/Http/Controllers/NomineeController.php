<?php

namespace App\Http\Controllers;
use App\Models\Area;
use App\Models\Position;
use App\Models\Nominee;
use Illuminate\Http\Request;

class NomineeController extends Controller
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
        $nominees = Nominee::all();
        $nominees = $nominees->whereNull('deleted_at');
        $areas = Area::all();
        $positions = Position::all();
        return view('nominees.index', compact('nominees', 'areas','positions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $nominees = Nominee::all();
        $areas = Area::all();
        $positions = Position::all();
        $areas = $areas->whereNull('deleted_at');
        $positions = $positions->whereNull('deleted_at');
        return view('nominees.create', compact('nominees', 'areas', 'positions'));
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
            'description'=>'nullable',
            'email'=>'required',
            'document_number'=>'required',
            'document_type'=>'required'
        ]);
        $nominee = new Nominee([
            'name' => $request->get('name'),
            'code' => $request->get('code'),
            'description' => $request->get('description'),
            'email' => $request->get('email'),
            'document_number' => $request->get('document_number'),
            'document_type' => $request->get('document_type')
            
        ]);
        $nominee->save();
        return redirect('/nominees')->with('success', 'Nominado creado!');
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
        $nominee = Nominee::find($id);
        $areas = Area::all();
        $positions = Position::all();
        $areas = $areas->whereNull('deleted_at');
        $positions = $positions->whereNull('deleted_at');
        return view('nominees.edit', compact('nominee', 'areas', 'positions'));        
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
            'description'=>'nullable',
            'email'=>'required',
            'document_number'=>'required',
            'document_type'=>'required'
        ]);
        $nominee = Nominee::find($id);
        $nominee->name =  $request->get('name');
        $nominee->code =  $request->get('code');
        $nominee->description =  $request->get('description');
        $nominee->email =  $request->get('email');
        $nominee->document_number =  $request->get('document_number');
        $nominee->document_type =  $request->get('document_type');
        $nominee->save();
        return redirect('/nominees')->with('success', 'Nominado actualizado!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $nominee = Nominee::find($id);
        $nominee->deleted_at = date("Y-m-d H:i:s");
        $nominee->save();
        return redirect('/nominees')->with('success', 'Nominado eliminado!');
    }
}
