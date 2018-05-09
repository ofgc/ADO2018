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
        $request->user()->authorizeRoles(['admin']);
        return view('roles.create');
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
    public function show()
    {
        $request->user()->authorizeRoles(['admin']);
        return view('datatable.rolDatatable');
    }

    public function getDatosRoles()
    {   
        return Datatables::of(Role::query())
            ->addColumn('action', function ($rol) {
                            return '<a  id-delete='.$rol->id.' href="#delete-rol" class="btn-delete alineado_imagen_centro"><i class="fa fa-trash"></i></a>';
                        })
            ->make(true);
    }

    public function deleteRoles(Request $request)
    {
        if($request->ajax()){
            $idUser=$request->input('idRol');
            $user = User::find($idUser);
            $user->delete();
            $user_total = User::all()->count();

            return response()->json([
                'total'=> $user_total,
                'message'=> $user->name . '  fue eliminado correctamente'
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
