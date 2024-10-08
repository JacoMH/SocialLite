<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class post extends Model
{
    use HasFactory;

    protected $table = 'user_post';
    
    protected $guarded = [];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function comments() {
        return $this->hasMany(comment::class);
    }

    public function likes() {
        return $this->hasMany(Like::class, 'post_id')->sum('id');
    }

    protected $dates = ['updated_at'];
}
