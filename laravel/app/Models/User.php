<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use App\Models\UserStatus;
use App\Models\UserRole;
use App\Models\Address;
use App\Models\UserDescription;
use App\Models\UserLikedAccounts;
use App\Models\UserLanguages; 
use App\Models\Content; 

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    
    
    public function address()
    {
      return $this->belongsTo(Address::class, 'id', 'user_id');
    }
    
    public function description()
    {
      return $this->belongsTo(UserDescription::class, 'id', 'user_id');
    }
    
    public function roles()
    {
      return $this->hasMany(UserRole::class, 'user_id', 'id');
    }
    
    public function status()
    {
      return $this->hasMany(UserStatus::class, 'user_id', 'id');
    }
     
    public function linkedAccounts()
    {
      return $this->hasMany(UserLikedAccounts::class, 'user_id', 'id');
    }
    
    public function languages()
    {
      return $this->hasMany(UserLanguages::class, 'user_id', 'id');
    }
    
    public function contents()
    { 
       return $this->hasMany(Content::class, 'user_id', 'id');
    }
    
}
