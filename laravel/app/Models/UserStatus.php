<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Status;

class UserStatus extends Model
{
    use HasFactory;
    
    protected $table = 'user_statuses';

    protected $primaryKey = 'status_id';

    protected $fillable = [
      'user_id','status_id'
    ];
    
    public function statusName()
    {
      return $this->belongsTo(Status::class, 'status_id', 'status_id');
    }
    
}
