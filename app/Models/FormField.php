<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FormField extends Model
{
    use HasFactory;

    protected $table = 'forms_fields';

    protected $primaryKey = 'field_id';

    protected $fillable = [
      'name'
    ];

    public function user()
    {
      return $this->belongsTo(User::class, 'user_id');
    }

    public function fieldType()
    {
      return $this->belongsTo(FieldsType::class, 'field_type');
    }

}
