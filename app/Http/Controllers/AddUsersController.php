<?php

namespace App\Http\Controllers;

use App\Model\User;
use App\Model\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class AddUsersController extends Controller
{
  public function __construct()
  {
      $this->middleware('auth');
  }

  public function addusers(){

     $roles = Role::all();
     $users = User::all();
    return view('users.add', compact('roles','users'));
  }

  public function store(Request $request){

    $this->validate($request,[
        'name' => 'required|string|max:255|min:5',
        'email' => 'required|string|max:255|min:10',
        'role_id' => 'required',
    ]);

    $password = Hash::make('zalego123');

    $user = new User();
    $user->name = $request->name;
    $user->email = $request->email;
    $user->role_id = $request->role_id;
    $user->password = $password;
    $user->created_at = date('Y-m-d H:i:s');

    if($user->save()){
        return redirect()->route('add.users');
    }else{
      Session::flash('warning', 'Unable to create user');
      return redirect()->route('add.users');
    }
  }

  public function destroy($id){
    $user = User::findorFail($id);
    if($user->delete($id)){
      return redirect()->route('add.users');
    }

  }


  public function suspend($id)
  {
    $user = User::findorFail($id);
    $user->status=false;
    if($user->save()){
        return redirect()->route('add.users');
    }else{
      Session::flash('warning', 'Update Failed');
      return redirect()->route('add.users');
    }
  }

  public function update(Request $request, $id ){
    $user = User::findorFail($id);
    $user->role_id = $request->role_id;
    if($request->status == 0){
      $user->status = false;
    }else{
      $user->status =true;
    }
    if($user->save()){
        return redirect()->route('add.users');
    }else{
      Session::flash('warning', 'Update Failed');
      return redirect()->route('add.users');
    }
  }
}
