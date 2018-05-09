<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\File;
use App\User;
use Illuminate\Support\Facades\Storage;
use Yajra\Datatables\Datatables;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(request $request)
    {
        $request->user()->authorizeRoles(['admin']);
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
    public function show(request $request)
    {
        $request->user()->authorizeRoles(['admin']);
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
            ->editColumn('updated_at', function ($user) {
                return $user->updated_at->format('m/d/Y');
            })
            ->editColumn('created_at', function ($user) {
                return $user->created_at->format('m/d/Y');
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
    public function updateUser(Request $request)
    {
        
        if($request->ajax()){
            $password_update = bcrypt($request-> input('password_update'));
            $idUser = $request->input('id_user_update');
            $user = User::find($idUser);
            $user->name = $request->input('name_update');
            $user->username = $request->input('username_update');
            $user->email = $request->input('email_update');
            if($password_update != "" || $password_update != null ){
                $user->password = $password_update;
            }
            $user->save();
            return response()->json([
                'message'=>'El Usuario fue actualizado correctamente'
            ]);
        }else return "esto no es ajax";
        
    }

    public function user_profile(){
        return view('user.profile');
    }

    public function user_profileUpdate(){ 
        if (empty($_FILES['images'])) {
        //     // Devolvemos un array asociativo con la clave error en formato JSON como respuesta 
            echo json_encode(['error'=>'ERROR, ha superado el tamaño maximo de ficheros, reduzca sus pdf o elimine algun fichero..']); 
        //     // Cancelamos el resto del script 
        }else{
        $idUser= $_POST['idProfile'];
        $username = $_POST['usernameProfile'];
        $nombre = $_POST['nombreProfile'];
        $password = $_POST['passwordProfile'];
        $nombre_carpeta = "uploads/usuarios/".$username."/";

        $files = Storage::files($nombre_carpeta);
        Storage::delete($files);

        foreach($_FILES['images']['error'] as $key => $error){
            if($error == UPLOAD_ERR_OK){
                $name = $_FILES['images']['name'][$key];
                Storage::disk('public')->putFileAs($nombre_carpeta, new File($_FILES['images']['tmp_name'][$key]), 'imagenPerfil.png');
            }
        }
        $user = User::find($idUser);
        $user->name = $nombre;
        $user->username = $username;
        $user->password = bcrypt($password);
        $user->save();
        echo json_encode("Todos los cambios guardados");
    }

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
