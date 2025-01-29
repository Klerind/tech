<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Answers;
use App\Models\Questions;
use App\Models\Test;

class TestController extends Controller
{

  public function show(Request $request)
  { dd(9);
    $questions = Questions::all()->random(9);

    $new_format_of_questions = [];

    foreach ($questions as $question)
    {
      $new_answers = [];
      $answers = Answers::all()->random(3);
      foreach ($answers as $answer)
      {
        $new_answers[$answer->answere_id] = $answer->answere;
      }

      $new_answers[$question->right_answer->right_answere_id] = $question->right_answer->right_answere;

      $question->new_answers = $new_answers;
      $new_format_of_questions[] = $question;
    }
    //dd($new_format_of_questions);
    return view('pages/test', ['questions' => $new_format_of_questions]);
  }

  public function add(Request $request)
  {
    $requests = $request->input();
    $questions = $answers = [];

    $random_number = mt_rand(1, 1000);

    $check_if_test_grup_id_exists = Test::where(
       ['test_grup_id' => $random_number
    ])->get()->first();


    if (empty($check_if_test_grup_id_exists))
    {
     foreach ($requests as $key => $value)
     {
      if (str_starts_with($key,'question'))
      {
        Test::create([
           'test_grup_id' => $random_number,
           'user_id' => auth()->id(),
           'question_id' => preg_replace("/[^0-9]/", '', $key),
           'answer_id' => $value,
           'right_answer_id' => $value
        ]);
      }else
      {
        $answers_id = explode(",",$value);
        foreach ($answers_id as $answer_id)
        {
         if (!empty($answer_id))
         {
           Test::create([
                 'test_grup_id' => $random_number,
                 'user_id' => auth()->id(),
                 'question_id' => preg_replace("/[^0-9]/", '', $key),
                 'answer_id' => $answer_id
              ]);
         }
        }
      }
     }
    }

      //  return redirect('/profile');
    return view('pages/test', ['questions' => self::showTestResult($random_number)]);
  }

  public static function showTestResult($random_number)
  {
    $tests = Test::where(
      [
        'test_grup_id' => $random_number,
        'user_id' => auth()->id()
   ])->get();

   $questions = [];

   foreach ($tests as $key => $value)
   {
     $questions[$value['question_id']][$key] = $value;
   }

   $new_format_of_questions = [];

   foreach ($questions as $tests)
   {
     $new_answers = [];

     foreach ($tests as $test)
     {
       if ($test->right_answer_id == $test->question->right_answere_id)
       {
         $new_answers[$test->answer_id] = [$test->answer->answere,'blue'];
       }
       else
       {
         $new_answers[$test->answer_id] = $test->answer->answere;
       }

       if ($test->right_answer_id == $test->answer_id)
       {
        // $new_answers[$test->answer_id] = [$test->answer->answere, 'red'];
       }
       $test = $test->question;
       //$test->question->right_answer_id = $test->right_answer_id;
     }

     $test->new_answers = $new_answers;
     $new_format_of_questions[] = $test;
   }
   
    return $new_format_of_questions;
  }

}
