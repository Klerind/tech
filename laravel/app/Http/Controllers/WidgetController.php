<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Widget;

class WidgetController extends Controller
{
  public function create(Request $request)
  {
      $requests = $request->input();

      $check_if_widget_exists = Widget::where([
        'name' => $requests['widget_name']
      ])->get()->first();

      if (!is_null($check_if_widget_exists))
      {
        Widget::create([
          'user_id' => auth()->id(),
          'field_group_id' => $check_if_widget_exists->field_group_id,
          'name' => $check_if_widget_exists->name
        ]);
      }else
      {
        $check_if_widget_field_group_id_exists = Widget::where([
          'field_group_id' => $random_number = mt_rand(1, 1000)
        ])->get()->first();

        if (is_null($check_if_widget_field_group_id_exists))
        {
         Widget::create([
          'user_id' => auth()->id(),
          'field_group_id' => $random_number,
          'name' => $requests['widget_name']
        ]);
        }
      }

      return redirect('/profile')->with('status', 'Your widget was created. Add fields for  created widgit by clicking the button below.');  
  }

  public static function show()
  {
    return Widget::where([
      'user_id' => auth()->id()
      ])->get();
  }

  public function delete(Request $request)
  {
    $requests = $request->input();

    Widget::where([
      'widget_id' => $requests['widget_id']
      ])->delete();

    return redirect('/profile');
  }

}
