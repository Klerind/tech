<?php

namespace App\Http\Controllers;

use App\Models\FormField;
use App\Models\UserFormField;
use Illuminate\Http\Request;
use App\Http\Controllers\UserFormFieldController;
use App\Http\Controllers\FieldsGroupController;

class FormFieldController extends Controller
{
  public static function show()
  {
      return FormField::all();
  }

  public static function store($requests)
  {  
    unset($requests['_token']);
    unset($requests['field']);
    $add_fields = explode(",", $requests['add_fields']);
    $add_types = explode(",", $requests['add_types']);

    if ($requests['remove_fields'] != 0)
    {
      $user_form_field_ids = explode(",", $requests['remove_fields']);

      foreach ($user_form_field_ids as $user_form_field_id)
      {
        if (!in_array($user_form_field_id, $add_types))
        {
         UserFormFieldController::delete($user_form_field_id);
        }
      }
    }

    unset($requests['remove_fields']);
    $field_group = $requests['field_group'];
    unset($requests['field_group']);
    unset($requests['add_fields']);
    unset($requests['add_types']);

    $check_if_field_exists = null;

    foreach ($requests as $name => $type)
    {
      if (in_array($type, $add_types))
      {
        $check_if_field_exists = FormField::where([
          'name' => $name
        ])->get()->first();
        echo 'in array: '. $type;
      }else
      {
        return UserFormFieldController::show();
      }

          if (!$check_if_field_exists)
          { echo "create new field name<br>";
             $form_field = FormField::create(['name' => $name ]);
             $requests['field_id'] = $form_field->field_id;
             $requests['field_name'] = $form_field->name;
             $requests['field_group'] = $field_group;
          }
          else
          { echo "field name was in table<br>";
             $requests['field_id'] = $check_if_field_exists->field_id;
             $requests['field_name'] = $check_if_field_exists->name;
             $requests['field_group'] = $field_group;
          }
          $new_array[] = $requests;
          UserFormFieldController::store($requests);
    }
    return UserFormFieldController::show();
  }

  public static function delete($requests)
  {

  }

}
