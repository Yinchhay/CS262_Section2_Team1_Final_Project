<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UserScore;

class ScoreboardController extends Controller
{
    public function index()
    {

        // Fetch user scores and rank by correct answers
        $userScores = UserScore::with('user')
            ->orderBy('correct_answers', 'desc')
            ->get();

        return view('user.scoreboard', compact('userScores'));
    }

}
