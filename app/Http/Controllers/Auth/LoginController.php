<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Socialite;
use Validator;
use Hash;
use App\User;
use App\Role;
use DateTime;
use Redirect;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function login(Request $request)
    {
      $Input = $request->all();
      $credentials = $request->only('email', 'password');
      $rules = array(
        'email' => 'required|exists:users,email',
        'password' => 'required|min:6'
      );

      $validator = Validator::make($Input, $rules);

      if ($validator->fails()) {
        return Redirect::back()->withInput()->withErrors($validator);
      }
      else {
        $email      = $Input['email'];
        $password      = $Input['password'];
        $password      = Hash::make($password);

        $user_detail = User::where('email', $email)->first();
        if(!$user_detail){
          // return Redirect::back()->with('error','Invalid Email');
          $em = array('email' => 'Invalid Email');
          return Redirect::back()->withInput()->withErrors($em);
        }
        else
        {
          $hash1 = $user_detail->password; // A hash is generated
          $hash2 = Hash::make($Input['password']);
          $password_check = Hash::check($Input['password'], $hash1) && Hash::check($Input['password'], $hash2);
          if($password_check === false){
            $pass = array('password' => 'Invalid Password');
            return Redirect::back()->withInput()->withErrors($pass);
          }
          else {
            $user = User::where('email', $email)->where('status', 'activated')->first();
            if(!$user) {
              $ac = array('acc' => 'Invalid Account');
              return Redirect::back()->withInput()->withErrors($ac);
            }
            elseif($user->role_id == 1) {
              Auth::attempt($credentials);
              return Redirect::to('/view_business');
            }elseif ($user->role_id == 2) {
              Auth::attempt($credentials);
              // Auth::login($user);
              return Redirect::to('/home');
            }
          }
          $ace = array('acc' => 'Invalid Email / Password');
          return Redirect::back()->withInput()->withErrors($ace);
        }
      }
    }

    public function logout(Request $request) {
      Auth::logout();
      return redirect('/');
    }

    /**
* Send the response after the user was authenticated.
*
* @param  \Illuminate\Http\Request  $request
* @return \Illuminate\Http\Response
*/
}
