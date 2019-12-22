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
        'phonenumber'=>'required|string|min:13|max:13',
    ]);

    $password = Hash::make('zalego123');

    //get duplicate Users
     $duplicateuserscount = User::where('email',$request->email)->count();

     if($duplicateuserscount > 0 ){
       Session::flash('warning', 'The email already exists, kindly use another email');
       return redirect()->route('add.users');
     }else{

       $user = new User();
       $user->name = $request->name;
       $user->email = $request->email;
       $user->phonenumber = $request->phonenumber;
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

  public function editprofile($id){
      $user = User::findorFail($id);
      return view('users.profile')->withUser($user);

  }

  public function updateprofile(Request $request, $id){

    $this->validate($request,[
        'name' => 'required|string|max:255|min:5',
        'email' => 'required|string|max:255|min:10',
        'phonenumber'=>'required|string|min:13|max:13',
    ]);


     $duplicateuserscount = User::where('email',$request->email)->count();

     if($duplicateuserscount > 1 ){
       Session::flash('warning', 'The new email you have set belongs to another account');
       return redirect()->route('user.edit.profile', $id);
     }else{

         $user = User::findorFail($id);
         $user->name = $request->name;
         $user->email = $request->email;
         $user->phonenumber = $request->phonenumber;
         $user->updated_at = date('Y-m-d H:i:s');

         if($user->save()){
           Session::flash('success', 'You have updated your profile');
           return redirect()->route('user.edit.profile', $id);
         }else{
           Session::flash('warning', 'Update Failed');
           return redirect()->route('user.edit.profile', $id);
         }

     }


  }
}
