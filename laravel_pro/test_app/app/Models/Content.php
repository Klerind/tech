<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Content extends Model
{
    use HasFactory;

    protected $table = 'contents';

    protected $primaryKey = 'content_id';

    protected $fillable = [
        'user_id', 'field_id', 'field_group', 'content_link', 'content'
      ];

    public function user()
    {
      return $this->belongsTo(User::class, 'user_id');
    }

    public function field()
    {
      return $this->belongsTo(FormField::class, 'field_id');
    }

    public function comment()
    {
      return $this->hasMany(Comment::class, 'content_link', 'content_link');
    }

}
