<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class comment extends Model
{
    use HasFactory;

    protected $table = 'post_comments';

    protected $guarded = [];

    public function post() {
        return $this->belongsTo(post::class);
    }
}
