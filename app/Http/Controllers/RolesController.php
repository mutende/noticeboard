<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Role;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;


class RolesController extends Controller
{
  public function __construct()
  {
      $this->middleware('auth');
  }

  public function addroles(){

    $roles = Role::all();
    return view('roles.add')->withRoles($roles);
  }

  public function store(Request $request){
    $this->validate($request,[
        'role' => 'required|string',
    ]);

      $role = new Role();
      $role->role = $request->role;

      // save notice
      if($role->save()){
      return redirect()->route('roles');
      }else{

      Session::flash('warning', 'Role was not created try again later');
      return redirect()->route('roles');

      }

  }
}
