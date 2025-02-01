<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Languages;

class UserLanguages extends Model
{
    use HasFactory;
    
    protected $table = 'user_languages';

    protected $primaryKey = 'user_language_id';

    protected $fillable = [
        'user_id', 'language_id'
      ];

    public function languageName()
    {
      return $this->belongsTo(Languages::class, 'language_id', 'language_id');
    }
}
