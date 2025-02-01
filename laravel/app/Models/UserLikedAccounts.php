<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Accounts;

class UserLikedAccounts extends Model
{
    use HasFactory;
    
    protected $table = 'user_liked_accounts';

    protected $primaryKey = 'user_liked_account_id';

    protected $fillable = [
        'user_id', 'liked_account_id'
      ];

    public function accountName()
    {
      return $this->belongsTo(Accounts::class, 'liked_account_id', 'account_id');
    }
}
