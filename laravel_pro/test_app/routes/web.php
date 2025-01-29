<?php
use App\Http\Middleware\Login;
use App\Http\Middleware\Authenticate;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\PagesController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\ContentController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\WidgetController;
use App\Http\Controllers\TestController;
use App\Http\Controllers\MailController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Cookie;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
   
  $minutes = 60 * 24 * 30;
   
  //Cookie::queue('cart_items', 'test', $minutes);
   
  //dd(request()->cookie('cart_items', '[]', true));
  
  Route::get('/', [PagesController::class, 'getHome']);

  Route::get('/about', [PagesController::class, 'getAbout']);

  Route::get('/contact', [PagesController::class, 'getContact']);

  Route::get('/login', function ()
  {
      return view('pages/login');
  })->middleware('guest');

  Route::get('/register', function ()
  {
      return view('pages/register');
  })->middleware('guest');

  Route::get('/profile', [PagesController::class, 'getProfilePage']);

  Route::get('/test', [TestController::class, 'show'])->name('test');

  Route::get('/test/result', [TestController::class, 'add']);

  Route::post('/profile/create/content', [PagesController::class, 'createContent']);

  Route::post('/profile/createArticleForm', [PagesController::class, 'createArticleForm']);

  Route::post('/profile/imagesUpload', [PagesController::class, 'imagesUpload']);

  Route::get('/post/edit', [PostController::class, 'edit']);

  Route::get('/profile/createWidget', [WidgetController::class, 'create']);

  Route::get('/profile/deleteWidget', [WidgetController::class, 'delete']);

  Route::get('/post/delete', [PostController::class, 'delete']);

  Route::get('/show_user', [UserController::class, 'show']);

  Route::get('/article', [ContentController::class, 'showArticle']);

  Route::post('/post/create', [PostController::class, 'create']);

  Route::post('/comments/create', [CommentController::class, 'create']);

  Route::post('/comments/store', [CommentController::class, 'store']);

  Route::post('/product/create', [ProductController::class, 'create']);
  
  Route::post('/product/add', [ProductController::class, 'add']);
  
  Route::post('/product/buy', [ProductController::class, 'buy']);
  
  Route::get('/product/success', [ProductController::class, 'success'])->name('product.success');
  
  Route::get('/product/cancel', [ProductController::class, 'cancel'])->name('product.cancel');

  Route::post('/contact/sendMail', [MailController::class, 'send']);

  Route::post('/search', [ContentController::class, 'search']);
  
require 'auth.php';
