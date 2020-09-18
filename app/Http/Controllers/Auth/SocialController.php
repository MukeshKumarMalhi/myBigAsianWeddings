<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Socialite;
use Validator, Hash, Redirect, Response;
use App\User;

class SocialController extends Controller
{
  public function redirect($provider)
  {
    return Socialite::driver($provider)->redirect();
  }

  public function callback($provider)
  {
    $getInfo = Socialite::driver($provider)->user();
    $user = $this->createUser($getInfo,$provider);
    $cr = array('email' => $user->email, 'password' => '123456');
    Auth::attempt($cr);
    return Redirect::to('/home');
  }

  function createUser($getInfo,$provider){
  $user = User::where('provider_id', $getInfo->id)->first();
  if (!$user) {
    $id = uniqid();
     $user = User::create([
        'id'       => $id,
        'name'     => $getInfo->name,
        'email'    => $getInfo->email,
        'password'    => Hash::make('123456'),
        'provider' => $provider,
        'provider_id' => $getInfo->id
    ]);
  }
  return $user;
  }
}
