<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ViewController extends Controller
{
  public function login () { return view('guest.login'); }
  public function dashboard () { return view('auth.dashboard'); }
  public function register () { return view('guest.register'); }
  public function notifications () { return view('auth.notifications'); }
  public function books () { return view('auth.books'); }
  public function users () { return view('auth.admin.users'); }
  public function transactions () { return view('auth.admin.transactions'); }

}
