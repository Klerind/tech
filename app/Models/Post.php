<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Post extends Model
{
    use HasFactory;

    protected $table = 'posts';

    protected $primaryKey = 'post_id';

    protected $fillable = [
      'user_id', 'title', 'description'
    ];

    public function scopeFilter($query, array $filters)
    {
      if($filters['title'] ?? false)
      {
        $query->where('title', 'like', '%'. $filters['title'] .'%');
      }
    }

    public function user()
    {
      return $this->belongsTo(User::class, 'user_id');
    }

    public function comments()
    {
      return $this->hasMany(Comment::class, 'post_id');
    }

}
