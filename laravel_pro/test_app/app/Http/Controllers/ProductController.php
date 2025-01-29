<?php

namespace App\Http\Controllers;

use Stripe\Stripe; 
use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\UserFormFieldController;
use App\Models\Content;  
use App\Models\CartItem;
use Illuminate\Support\Facades\Cookie;

class ProductController extends Controller
{
  public function create(Request $request)
  {
    $inputs = $request->input();
    ContentController::create($request);

    return redirect('/profile');
  }

  public static function getProducts ()
  {
    $products = Product::latest()->limit(18)->get();

    foreach ($products as $product)
    {
      if (!empty($product->field))
      {
        $product->field_name = $product->field->name;
      }
      else {
          $product->field_name = 'product test name';
      }
       $product->user = $product->user;
    }

    $products = $products->toArray();

    $products_list = array();
    foreach ($products as $key => $item)
    {
      $products_list[$item['product_link']][$key] = $item;
    }
    ksort($products_list, SORT_NUMERIC);

    return $products_list;
  }

  public static function getProductsByUserId ($fields)
  {
    $field_id = array();
    foreach ($fields as $field)
    {
       $field_id[] = $field->field_id;
    }

    $products = Product::select('*')
        ->where(['user_id' => auth()->id()])
        ->whereIn('field_id', $field_id)
        ->orderBy('field_id', 'desc')
        ->get();

    $products_list = array();
    foreach ($products as $key => $item)
    {
     $products_list[$item['product_link']][$key] = $item;
    }
    ksort($products_list, SORT_NUMERIC);

    return $products_list;
  }

  public function update (Request $request)
  {
    $request = json_decode($request->input()['data']);

    foreach ($request as $key => $value)
    {
     if (!is_null($value))
     {
       $inputs['content_id'] = $key;
       $inputs['content'] =  $value;
       ContentController::update($inputs);
      }
     }
  }
  
  public function add (Request $request)
  { 

// Create a new cookie and queue it for sending

      $cart_item[] = [
        'user_id' => 9,
        'content_link' => $request->content_link,
        'quantity' => 3
      ];
      
     // dd(Cookie::get('cart_items'));
      
      $minutes = 60 * 24 * 30;
      
      Cookie::queue('cart_items', json_encode($cart_item), $minutes);

      //Cookie::queue('cart_items', 'test', $minutes);
      
      
      //Cookie::queue(Cookie::forget('cart_items'));

     // dd(9);
      
      //setcookie('cart_items', json_encode($cart_item));
      
      //cookie('cart_items',  json_encode($cart_item), 60 * 24 * 30);
      
      //dd(Cookie::get('cart_items'));
      
      //dd($request->cookie('cart_items', '[]', true));
      
    //  dd($request->user());
      
     // CartItem::create($cart_item);
      
      return redirect('/')->with('status', 'Product added to Cart');    
  }
  
  public function buy (Request $request)
  {    

    $stripe = new \Stripe\StripeClient('sk_test_DBvLlaEJr8EoxH0gBClT88KK'); 
    
    $checkout_session = $stripe->checkout->sessions->create([
      'line_items' => [
                [
                'price_data' => [
                               'currency' => 'usd',
                               'product_data' => [
                                                  'name' => 'T-shirt',
                                                 ],
                                'unit_amount' => 2000,
                                ],
                    'quantity' => 3,
                ],
                [
                'price_data' => [
                               'currency' => 'usd',
                               'product_data' => [
                                                  'name' => 'T-shirt3',
                                                 ],
                                'unit_amount' => 6000,
                                ],
                    'quantity' => 3,
                ],
          ],
        
                    'customer_creation' => 'always',
                    'mode' => 'payment',
                    'success_url' => route('product.success').'?session_id={CHECKOUT_SESSION_ID}', 
                    'cancel_url' => route('product.cancel'), 
                     ]);  
    
    return redirect($checkout_session->url);     
       
  }
  
  public function success (Request $request)
  {    
      
      
      
      $stripe = new \Stripe\StripeClient('sk_test_DBvLlaEJr8EoxH0gBClT88KK'); 
      
      try {
           $checkout_session = $stripe->checkout->sessions->retrieve($request->get('session_id'));
           
           $customer = $stripe->customers->retrieve($checkout_session->customer); 
           
           return redirect('/')->with('status', '<h1>Thanks for your order,'. $customer->name. '!</h1>');       
           
      } catch (Error $e) {
           http_response_code(500);
           echo json_encode(['error' => $e->getMessage()]);
      }  
  }
   
  public function cancel (Request $request)
  {
      
      return redirect('/')->with('status', '<h1>Your order has been Canceled!</h1>');
      
  } 
  

}
