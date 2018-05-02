<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Yajra\Datatables\Datatables;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view("usuarios.gestion");
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
         return view('datatable.userDatatable');
    }

    public function getDatosUser()
    {   
        return Datatables::of(User::query())
            ->addColumn('action', function ($user) {
                
                            return '
                                <a  id-delete='.$user->id.' href="#delete-user" class="btn-delete alineado_imagen_centro"><i class="fa fa-trash"></i> </a>
                                <a  id-edit='.$user->id.' href="#update-user"class="btn-update alineado_imagen_centro" data-toggle="modal" data-target="#update"><i class="fa fa-edit"></i></a>
                                    ';                          
                        })
            ->make(true);
    }

    public function deleteUser(Request $request)
    {
        if($request->ajax()){
            $idUser=$request->input('idUser');
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
