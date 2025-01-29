<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UserFormField;
use App\Http\Controllers\FieldsGroupController;
use App\Http\Controllers\FieldsTypeController;

class UserFormFieldController extends Controller
{
  public static function show()
  {
    $fields_group = UserFormField::where([
      'user_id' => auth()->id()
    ])->get();
//dd($fields_group);
    $fields = $field_group_post = $field_group_product = [];
    foreach ($fields_group as $field_group)
    {
        if ($field_group['field_group_id'] === 1)
        {
          $field_group_post[] =  $field_group;
        }elseif ($field_group['field_group_id'] === 2)
        {
          $field_group_product[] =  $field_group;
        }
    }
    $fields['fields'] = $fields_group;
    $fields['field_group_post'] = $field_group_post;
    $fields['field_group_product'] = $field_group_product;
    $fields['fields_type'] = FieldsTypeController::show();

    return $fields;
  }

  public static function store($form_field)
  {//dd($form_field);
   $check_if_field_exists = UserFormField::where([
    'user_id' => auth()->id(),
    'field_id' => $form_field['field_id'],
    'field_group_id' => $form_field['field_group'],
    'field_type' => $form_field[strtolower($form_field['field_name'])]
    ])->get()->first();

   if (!$check_if_field_exists)
   { echo "user field not in table<br>";
    UserFormField::create([
     'user_id' => auth()->id(),
     'field_id' => $form_field['field_id'],
     'field_group_id' => $form_field['field_group'],
     'field_type' => $form_field[$form_field['field_name']]
    ]);
    }
  }

  public static function delete($user_form_field_id)
  {
   $deleted = UserFormField::where([
     'user_form_field_id' => $user_form_field_id
     ])->delete();
  }

}
