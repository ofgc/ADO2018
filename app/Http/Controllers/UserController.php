<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\File;
use App\User;
use App\Role;
use App\DepartamentUser; 
use DB;
use Illuminate\Support\Facades\Storage;
use Yajra\Datatables\Datatables;

class UserController extends Controller
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

    public function index(request $request)
    {

        if($request->user()->authorizeRoles([1])){
            return view("usuarios.gestion");
        }else abort(401, 'Esta acción no está autorizada.');
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
        $user= $request->user();
        // $users = USER::with('departaments')->find($user->id);
        $users = USER::with('departaments')->find($user->id);
        // var_dump($users);die();


        //////


        $departamentos = DB::table('departaments')->get();
        $roles = DB::table('roles')->get();
        if($request->user()->authorizeRoles([1])){
         return view('datatable.userDatatable', ['roles'=> $roles, 'departamentos'=> $departamentos]);
        }else  abort(401, 'Esta acción no está autorizada.');
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
            ->addColumn('rol',function($user){
                $object = ($user->roles()->first()['name']);
                return $object;
            })
            ->addColumn('departament',function($user){
                $departamentos = "";
                $users = USER::with('departaments')->find($user);
                foreach($users as $user){
                    foreach($user->departaments as $departaments){
                        $departamentos = $departamentos." ".$departaments->name;
                    }   
                }
                return $departamentos;
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
            $password_update = $request-> input('password_update');
            $rol = $request->input('roles');
            $idUser = $request->input('id_user_update');
            $user = User::find($idUser);
            $user->name = $request->input('name_update');
            $user->username = $request->input('username_update');
            $user->email = $request->input('email_update');
            $user->roles()->detach();
            $user->roles()->attach(Role::where('name', $rol)->first());
            if($password_update != "" || $password_update != null ){
                $password_update = bcrypt($password_update);
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
        
            $idUser= $_POST['idProfile'];
            $username = $_POST['usernameProfile'];
            $nombre = $_POST['nombreProfile'];
            $email = $_POST['emailProfile'];
            $password = $_POST['passwordProfile'];
            $nombre_carpeta = "uploads/usuarios/".$username."/";


        if (!empty($_FILES['images'])) {
            $files = Storage::files($nombre_carpeta);
            Storage::delete($files);
            foreach($_FILES['images']['error'] as $key => $error){
                if($error == UPLOAD_ERR_OK){
                    $name = $_FILES['images']['name'][$key];
                    Storage::disk('public')->putFileAs($nombre_carpeta, new File($_FILES['images']['tmp_name'][$key]), 'imagenPerfil.png');
                }
            }
        }
            $user = User::find($idUser);
            if($nombre){
                $user->name = $nombre;
            }
            if($email){
                $user->email=$email;
            }
            if($password){
                $user->password = bcrypt($password);
            }
            $user->save();
            echo json_encode("Todos los cambios guardados");
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
