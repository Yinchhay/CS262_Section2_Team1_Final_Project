<?php

namespace App\Models;

use App\Models\QuestionOption;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

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

    public static function getQuestionTypes()
    {
        return [
            'multiple choice',
            'checkboxes',
        ];
    }

    public function testSkill()
    {
        return $this->belongsTo(TestSkill::class);
    }

    public function options()
    {
        return $this->hasMany(QuestionOption::class);
    }
}
