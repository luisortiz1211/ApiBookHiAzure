<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Message extends Model
{
//    use HasFactory;
    protected $fillable = ['message'];
    public static function boot()
    {
        parent::boot();
        static::creating(function ($message) {
            $message->user_id = Auth::id();
        });
    }

    public function chat()
    {
        return $this->belongsTo('App\Models\Chat');
    }

}
