<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    use HasFactory;


    protected $fillable = [
        'question_text',
        'description',
        'type',
        'points',
        'test_skill_id',
    ];

    public function testSkill()
    {
        return $this->belongsTo(TestSkill::class);
    }

    public function questionOption() {
        return $this->hasMany(QuestionOption::class);
    }

    public function userAnswers() {
        return $this->hasMany(UserAnswer::class);
    }

}
