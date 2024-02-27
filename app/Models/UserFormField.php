<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\FormField;

class UserFormField extends Model
{
    use HasFactory;

    protected $table = 'users_forms_fields';

    protected $primaryKey = 'user_form_field_id';

    protected $fillable = [
      'user_id', 'field_id', 'field_type', 'field_group_id'
    ];

    public function user()
    {
      return $this->hasOne(User::class, 'user_id');
    }

    public function field()
    {
      return $this->belongsTo(FormField::class, 'field_id');
    }

    public function fieldType()
    {
      return $this->belongsTo(FieldsType::class, 'field_type');
    }

}
