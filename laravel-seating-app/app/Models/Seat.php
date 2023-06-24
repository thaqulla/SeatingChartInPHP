<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Seat extends Model
{
    use HasFactory;
    // public function comments() {
    //     return $this->hasMany(Comment::class);
    // }

    public function comments() {
        return  $this->belongsToMany(Comment::class)->withTimestamps();
    }
}
