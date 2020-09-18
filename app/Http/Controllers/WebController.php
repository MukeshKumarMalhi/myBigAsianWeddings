<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use DateTime;

class WebController extends Controller
{
  public function __construct()
  {
    $this->middleware('guest')->except('logout');
  }

  public function index()
  {
    return view('auth.index');
  }
  public function signup()
  {
    return view('auth.register');
  }
  public function login()
  {
    return view('auth.login');
  }
}
