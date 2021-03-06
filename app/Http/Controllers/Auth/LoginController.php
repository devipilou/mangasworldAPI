<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


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
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
    
    public function login(Request $request){

        $this->validateLogin($request);
        if ($this->attemptLogin($request)){
            $user = $this->guard()->user();
            $user->generateToken();
            return response()->json($user, 200);
        }
        return $this->sendFailedLoginResponse($request);
            
    }

    public function sendFailedLoginResponse($request){
        return response()->json('Login ou mot de passe inconnu', 401);
    }
  
    public function logout (Request $request){
        $user = Auth::guard('api')->user();
        if ($user){
            $user->api_token = null;
            $user->save();
            return response()->json(['Utilisateur déconnecté'], 200);
        }
        return response()->json(['Utilisateur inconnu'], 401);
    }
    
}
