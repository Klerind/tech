<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Questions extends Model
{
    use HasFactory;

    protected $table = 'questions';

    protected $primaryKey = 'question_id';

    protected $fillable = [
        'right_answere_id', 'question'
      ];

      public function right_answer()
      {
        return $this->belongsTo(RightAnswers::class, 'right_answere_id', 'right_answere_id');
      }

}
