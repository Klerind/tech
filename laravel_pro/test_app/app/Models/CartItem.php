<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CartItem extends Model
{
    use HasFactory;
    
    protected $table = 'cart_items';

    protected $primaryKey = 'cart_item_id';

    protected $fillable = [
      'user_id', 'content_link', 'quantity'
    ];
        
    public function account()
    {
      return $this->belongsTo(Accountts::class, 'account_id', 'accountt_id');
    }
}
