<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Accounts extends Model
{
    use HasFactory;
    
    protected $table = 'accounts';

    protected $primaryKey = 'account_id';

    protected $fillable = [
      'Accountts'
    ];
        
    public function account()
    {
      return $this->belongsTo(Accountts::class, 'account_id', 'accountt_id');
    }
}
