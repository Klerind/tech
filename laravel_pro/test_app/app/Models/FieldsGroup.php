<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FieldsGroup extends Model
{
    use HasFactory;

    protected $table = 'fields_group';

    protected $primaryKey = 'field_group_id';

    protected $fillable = [
      'user_id', 'field_id', 'field_group'
    ];

    public function field()
    {
      return $this->belongsTo(FormField::class, 'field_id');
    }
}
