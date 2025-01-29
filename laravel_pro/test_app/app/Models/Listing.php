<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Listing extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;


    public static function sall() {

        return [
            [
            'id' => 0,
            'title' => 'Post Title ',
            'content' => 'First content ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus.'
    ],
            [
            'id' => 1,
            'title' => 'Post Title ',
            'content' => 'Second content ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus.'
    ],
            [
            'id' => 2,
            'title' => 'Post Title ',
            'content' => 'Third content ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus.'
    ]];
    }

    public static function dfind($id)
    {
        $listings = self::all();
        return $listings[$id];
    }

    public function scopeFilter($query, array $filters)
    {
      if($filters['title'] ?? false)
      {
        $query->where('title', 'like', '%'. $filters['title'] .'%');
      }
    }

}
