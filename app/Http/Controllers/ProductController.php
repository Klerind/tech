<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\UserFormFieldController;
use App\Models\Content;

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

}
