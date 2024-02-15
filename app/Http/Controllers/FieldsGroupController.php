<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\FieldsGroup;

class FieldsGroupController extends Controller
{
  public static function show ()
  {
    return FieldsGroup::where([
      'user_id' => auth()->id()
      ])
      ->orderBy('field_id', 'asc')
      ->get();
  }

  public static function store($form_field)
  {
    FieldsGroup::create([
     'user_id' => auth()->id(),
     'field_id' => $form_field['field_id'],
     'field_group' => $form_field['field_group']
   ]);
  }

  public static function delete($field_group_id, $field_group)
  {
   $deleted = FieldsGroup::where([
     'user_id' => auth()->id(),
     'field_id' => $field_group_id,
     'field_group' => $field_group])->delete();
  }

}
