<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    public function user () {
        return $this->belongsTo(User::class);
    }
    // public function seat () {
    //     return $this->belongsTo(Seat::class);
    // }

    public function seats () {
        return $this->belongsToMany(Seat::class)->withTimestamps();
    }
}
