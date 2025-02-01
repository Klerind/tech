<?php
use Illuminate\Http\Request;
use App\Http\Requests\LoginRequest;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisterController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Auth\LoginController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('guest')->get('/user', function (Request $request)
{
    return $request->user();
});

Route::post('/', function (Request $request)
{
   $request = $request->input();
   $user = RegisterController::create($request);
   return redirect('/login');
});

Route::post('/login', function (LoginRequest $request)
{ 
    $credentials = $request->validated();

/*    $validatedData = $request->validateWithBag('post',
    [
    'email' => ['required', 'max:5'],
    'password' => ['required'],
     ]);
*/
      $request_input = $request->input();

      $credentials = [
           'email' => $request_input['email'],
           'password' => $request_input['password'],
       ];

       if (Auth::attempt($credentials))
       {
        //   $user = Auth::user();
      //     Auth::loginUsingId($user->id, $remember = true);
           $request->session()->regenerate();
           return redirect()->intended('profile');
       }

   return redirect('/');
});

Route::get('/forgotPassword', [ForgotPasswordController::class]);

Route::get('/logout', function (Request $request)
{
  auth()->logout();

  $request->session()->invalidate();
  $request->session()->regenerateToken();

  return redirect('/');
});//->middleware('auth')->name('logout');
