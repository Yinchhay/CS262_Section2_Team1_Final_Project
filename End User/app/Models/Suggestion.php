<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Suggestion extends Model
{
    use HasFactory;

    protected $fillable = [
        'subject',
        'message',
        'user_id',
    ];


    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
