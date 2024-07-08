<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Test extends Model
{
    use HasFactory;

    protected $fillable = [
        'order',
        'poster_id',
        'type',
    ];

    public function poster()
    {
        return $this->belongsTo(Poster::class);
    }

    public function testSkills()
    {
        return $this->hasMany(TestSkill::class);
    }

}
