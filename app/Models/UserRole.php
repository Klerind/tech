<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Roles;

class UserRole extends Model
{
    use HasFactory;
    
    protected $table = 'user_roles';

    protected $primaryKey = 'user_role_id';

    protected $fillable = [
      'user_id', 'role_id'
    ];
    
    public function roleName()
    {
      return $this->belongsTo(Roles::class, 'role_id', 'role_id');
    }
    
}
