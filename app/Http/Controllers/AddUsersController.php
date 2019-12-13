<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Role;

class AddUsersController extends Controller
{
  public function __construct()
  {
      $this->middleware('auth');
  }

  public function addusers(){

     $roles = Role::all();
    return view('users.add')->withRoles($roles);
  }
}
