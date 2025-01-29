<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\FieldsType;

class FieldsTypeController extends Controller
{
  public static function create($form_field)
  {
    FieldsType::create([
     'field_id' => $form_field['field_id'],
     'type' => 'test'
   ]);
  }

  public static function show()
  {
    return FieldsType::all();
  }

}
