<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Languages extends Model
{
    use HasFactory;
    
    protected $table = 'languages';

    protected $primaryKey = 'language_id';

    protected $fillable = [
         'language'
      ];

    public function user()
    {
      return $this->belongsTo(User::class, 'user_id');
    }
}
