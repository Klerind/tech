<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FieldsType extends Model
{
    use HasFactory;

    protected $table = 'fields_type';

    protected $primaryKey = 'field_type_id';

    protected $fillable = [
        'field_id', 'type'
      ];

    public function user()
    {
      return $this->belongsTo(User::class, 'user_id');
    }

}
