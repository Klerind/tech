<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Test extends Model
{
    use HasFactory;

    protected $table = 'tests';

    protected $primaryKey = 'test_id';

    protected $fillable = [
        'test_grup_id', 'user_id', 'question_id', 'answer_id','right_answer_id'
      ];

    public function question()
    {
      return $this->belongsTo(Questions::class, 'question_id');
    }

    public function answer()
    {
      return $this->belongsTo(Answers::class, 'answer_id', 'answere_id');
    }

}
