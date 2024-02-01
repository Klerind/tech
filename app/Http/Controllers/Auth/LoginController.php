<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\Http\Requests\LoginRequest;

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
      //  $this->middleware('guest')->except('logout');
    }

    public function authenticate(LoginRequest $request): RedirectResponse
    {
       $credentials = $request->validated();

        if (Auth::attempt($credentials))
        {
           $request->session()->regenerate();
 //return redirect()->intended('dashboard');
      //  return redirect()->intended('profile');
  //    return redirect('/profile');
         }

  // return redirect('/');
    /*return back()->withErrors([
        'email' => 'The provided credentials do not match our records.',
    ])->onlyInput('email');*/
       }

}
