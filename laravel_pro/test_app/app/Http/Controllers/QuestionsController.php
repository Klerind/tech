<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Answers;
use App\Models\Questions;

class QuestionsController extends Controller
{

  public function show(Request $request)
  {
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
    foreach ($requests as $key => $value)
    {
      if (str_starts_with($key,'question'))
      {
        $question = Questions::where([
          'question_id' => preg_replace("/[^0-9]/", '', $key)
        ])->get()->first();
        if (!is_null($question))
        {
          if ($question->right_answere_id == $value)
          {
            $question->right_answer = $value;
            $questions[] = $question;
          }else
          {
            $questions[] = $question;
          }
        }
      }else
      {
        $answers[$key] = $value;
      }
      //dump(preg_replace("/[^0-9]/", '', $key));
      $question = Questions::where([
        'question_id' => preg_replace("/[^0-9]/", '', $key)
      ])->get()->first();
      if ($question->right_answere_id == $value)
      {
        //dump(true);
      }else
      {
        //dump(false);
      }
    }

    dd($questions);
  //  dd($answers);
    $questions = Questions::all()->random(10);

    $new_format_of_questions = [];
    foreach ($questions as $question)
    {
      $answers = Answers::all()->random(3);
      foreach ($answers as $answer)
      {
        $question->answers .= $answer->answere;
      }

      $question->answers .= $question->right_answer->right_answere;
      $new_format_of_questions[] = $question;
    }
    dd($new_format_of_questions);
      //  return redirect('/profile');
      return view('pages/test', ['questions' => $new_format_of_questions]);

  }

}
