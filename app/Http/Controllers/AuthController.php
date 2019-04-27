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
      'username' => 'required',
      'password' => 'required'
    ]);

    if (!$validator->fails()) {
      if (Auth::attempt($request->only(['username', 'password']))) {
        return redirect('/')->withUser(Auth::user());
      } 
    }

    return redirect()->back()->withErrors(['Wrong username/password']);
  }

  public function register (Request $request)
  {
    $validator = Validator::make($request->all(), [
      'name' => 'required',
      'username' => 'required|unique:users',
      'password' => 'required|confirmed',
      'major' => 'required',
    ]);

    if (!$validator->fails()) {
      $user = new User;
      $user->name = $request->name;
      $user->username = $request->username;
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
