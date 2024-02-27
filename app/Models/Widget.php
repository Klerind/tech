<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Widget extends Model
{
    use HasFactory;

    protected $table = 'widgets';

    protected $primaryKey = 'widget_id';

    protected $fillable = [
      'user_id', 'field_group_id', 'name'
    ];

    public function user()
    {
      return $this->belongsTo(User::class, 'user_id');
    }

}
