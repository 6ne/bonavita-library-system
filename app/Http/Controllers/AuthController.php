<?php

namespace App\Http\Controllers;

use Auth;
use Validator;
use App\Models\User;
use Illuminate\Http\Request;

class AuthController extends Controller
{
  public function login (Request $request)
  {
    $validator = Validator::make($request->all(), [
      'nis' => 'required',
      'password' => 'required'
    ]);

    if (!$validator->fails()) {
      if (Auth::attempt($request->only(['nis', 'password']))) {
        return redirect('/')->withUser(Auth::user());
      } 
    }

    return redirect()->back()->withErrors(['Wrong nis/password']);
  }

  public function register (Request $request)
  {
    $validator = Validator::make($request->all(), [
      'name' => 'required',
      'nis' => 'required|unique:users',
      'password' => 'required|confirmed'
    ]);

    if ($request->major === "null") {
      return redirect()->back()->withErrors("The major field is required");
    }

    if ($request->grade === "null") {
      return redirect()->back()->withErrors("The grade field is required");
    }

    if ($request->class === "null") {
      return redirect()->back()->withErrors("The class field is required");
    }

    if (!$validator->fails()) {
      $user = new User;
      $user->name = $request->name;
      $user->nis = $request->nis;
      $user->password = bcrypt($request->password);
      $user->major = $request->major;

      if ( $user->major == 'Teacher' ) {
        $user->grade = 0;
        $user->class = 0;
      }

      $user->save();
      return redirect()->back()->withSuccess('Register Success');
    }

    return redirect()->back()->withErrors($validator);
  }

  public function logout ()
  {
    Auth::logout();
    return redirect('/');
  }
}
