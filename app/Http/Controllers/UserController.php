<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
  public function index ()
  {
    return response()->json(User::whereIs_admin(0)->get());
  }

  public function show ($id)
  {
    $id = intval($id);
    $user = User::find($id);
    return response()->json($user);
  }
}
