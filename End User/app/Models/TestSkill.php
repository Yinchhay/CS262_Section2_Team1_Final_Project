<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TestSkill extends Model
{
    use HasFactory;

    protected $fillable = [
        'skill_id',
        'test_id',
        'instruction',
        'audio',
        'duration',
    ];

    public function skill() {
        return $this->belongsTo(Skill::class);
    }

    public function test() {
        return $this->belongsTo(Test::class);
    }

    public function questions() {
        return $this->hasMany(Question::class);
    }

    public function userScore() {
        return $this->hasMany(UserScore::class);
    }

}
