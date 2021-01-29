<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Chat extends Model
{
//    use HasFactory;
    protected $fillable = ['user_id2'];

    public static function boot()
    {
        parent::boot();
        static::creating(function ($chat) {
            $chat->user_id1 = Auth::id();
        });
    }

    public function user1()
    {
        return $this->belongsTo('App\Models\User', 'user_id1');
    }

    public function user2()
    {
        return $this->belongsTo('App\Models\User', 'user_id2');
    }

    public function messages()
    {
        return $this->hasMany('App\Models\Message');
    }
}
