<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserScore extends Model
{
    use HasFactory;

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function testSkill()
    {
        return $this->belongsTo(TestSkill::class);
    }

    // public function getUserScores(User $user, TestSkill $testSkill)
    // {
    //     return $this->where([
    //         'user_id' => $user->id,
    //         'test_skill_id' => $testSkill->id
    //     ])->get();
    // }

    public static function getUserScore($userId, $testSkillId)
    {
        return UserScore::where([
            'user_id' => $userId,
            'test_skill_id' => $testSkillId
        ])->first();
    }

    public static function getUserTakingTest()
    {
        return User::whereHas('userScores')->distinct('id')->count('id');
    }
}
