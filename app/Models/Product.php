<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\FormField;
use App\Models\User;

class Product extends Model
{
    use HasFactory;

    protected $table = 'products';

    protected $primaryKey = 'product_id';

    protected $fillable = [
      'product_link','user_id', 'field_id', 'content'
    ];

    public function field()
    {
      return $this->belongsTo(FormField::class, 'field_id');
    }

    public function user()
    {
      return $this->belongsTo(User::class, 'user_id');
    }

}
