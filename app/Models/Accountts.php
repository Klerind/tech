<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Accountts extends Model
{
    use HasFactory;
    
    protected $table = 'accountts';

    protected $primaryKey = 'accountt_id';

    protected $fillable = [
      'accountts'
    ];
}
