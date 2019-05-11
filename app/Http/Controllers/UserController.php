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

  public function update (Request $request)
  {
    $id = intval($request->id);
    $user = User::find($id);
    if ($request->has('books_on_held')) {
      $user->books_on_held += $request->books_on_held;
    }
    $user->save();
    return response()->json([]);
  }
}
