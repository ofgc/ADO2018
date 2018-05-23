<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Role;
use Yajra\Datatables\Datatables;

class RoleController extends Controller
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
    public function create(request $request)
    {
        if($request->user()->authorizeRoles([1])){
            return view('roles.create');
        }else abort(401, 'Esta acción no está autorizada.');
    } 

    public function createRol(Request $request){
        if($request->ajax()){
            $role = Role::create([
                'name' => $request->input('nombre'),
                'description' => $request->input('description'),
                'level'=> $request->input('level'),
            ]);
            return response()->json([
                    'message'=> $role->name. 'fue creado correctamente'
            ]);     
        }else return "esto no es ajax";
    

    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(request $request)
    {
        if($request->user()->authorizeRoles([1])){
            return view('datatable.rolDatatable');
        }else abort(401, 'Esta acción no está autorizada.');
        
    }

    public function getDatosRoles()
    {   
        return Datatables::of(Role::query())
            ->addColumn('action', function ($rol) {
                            return '<a  id-delete='.$rol->id.' href="#delete-rol" class="btn-delete alineado_imagen_centro"><i class="fa fa-trash"></i></a>
                            <a  id-edit='.$rol->id.' href="#update-rol"class="btn-update alineado_imagen_centro" data-toggle="modal" data-target="#update"><i class="fa fa-edit"></i></a>';
                        })
            ->make(true);
    }

    public function deleteRoles(Request $request)
    {
        if($request->ajax()){
            $idRol=$request->input('idRol');
            $rol = Role::find($idRol);
            $rol->delete();

            return response()->json([
                'message'=> $rol->name . '  fue eliminado correctamente'
            ]);
        }else return "esto no es ajax";
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
    public function update(Request $request)
    {
        if($request->ajax()){
            $idRol = $request->input('id_rol_update');
            $rol = Role::find($idRol);
            $rol->name = $request->input('name_update');
            $rol->description = $request->input('descripcion_update');
            $rol->level = $request->input('level_update');
            $rol->save();
            return response()->json([
                'message'=>'El rol fue actualizado correctamente'
            ]);
        }else return "esto no es ajax";
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
