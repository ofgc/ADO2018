<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Yajra\Datatables\Datatables;

class DatatablesController extends Controller
{
    /**
	 * Displays datatables front end view
	 *
	 * @return \Illuminate\View\View
	 */

	public function index()
	{
		return view('datatable.userDatatable');
	}

	/**
	 * Process datatables ajax request.
	 *
	 * @return \Illuminate\Http\JsonResponse
	 */
	public function getDatos()
	{	
	    return Datatables::of(User::query())
			->addColumn('action', function ($user) {
				
			                return '
			                	<a  id-delete='.$user->id.' href="#delete-user" class="btn-delete alineado_imagen_centro"><i class="fa fa-trash"></i> </a>
			                	<a  id-edit='.$user->id.' href="#update-user"class=" alineado_imagen_centro" data-toggle="modal" data-target="#update"><i class="fa fa-edit"></i></a>
			                		';			                
			            })
	    	->make(true);
	}
	public function deleteRow(Request $request)
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

}