<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Poster;
use App\Models\TestSkill;
use App\Models\Question;
use App\Models\Test;
use App\Models\QuestionOption;
use App\Models\UserAnswer;
use App\Models\UserScore;
use Illuminate\Support\Facades\Auth;

class TestController extends Controller
{
    public function index()
    {
        $posters = Poster::where('title', 'like', '%Online Test%')->orderBy('year', 'desc')->orderBy('month', 'desc');
        $levels = Poster::getLevels();

        if (request()->has('search')) {
            $posters = $posters->where('title', 'like', '%' . request()->get('search') . '%');
        }

        $posters = $posters->get();

        return view('online.main_online_test', compact('posters', 'levels'));
    }

    public function select(Poster $poster)
    {
        return view('online.select_online_test', compact('poster'));
    }

    public function testSkillForm(TestSkill $testSkill)
    {
        $questions = $testSkill->questions()->paginate(5);
        $questionPage = Question::orderBy('id', 'DESC')->paginate(5);
        $duration = $testSkill->duration * 60;

        return view('online.testSkillForm_online_test', compact('questions','testSkill', 'questionPage', 'duration'));
    }

    public function testform()
    {
        return view('online.form_online_test');
    }

    public function store(Request $request, TestSkill $testSkill)
    {
        $user = Auth::user();

        foreach ($request->questions as $question_id => $answer) {

            // Handle multiple choice and checkboxes
            $selectedOptionId = $answer['selected_option_id'] ?? 0;

            // Fetch the selected option to check if it's correct
            $selectedOption = QuestionOption::find($selectedOptionId);
            $isCorrect = $selectedOption ? $selectedOption->is_correct : false;

            // Assign score based on correctness
            $score = $isCorrect ? $answer['score'] : 0;


            UserAnswer::create([
                'user_id' => $user->id,
                'question_id' => $question_id,
                'selected_option_id' => $selectedOptionId,
                'score' => $score,
            ]);
        }

        $poster = $testSkill->test->poster;

        return redirect()->route('test.result', compact('poster', 'testSkill'));
    }

    public function result(Poster $poster, TestSkill $testSkill)
    {

        // Get the user id
        $userId = Auth::id();

        // Get user answers
        // $userAnswers = UserAnswer::with(['question', 'selectedOption'])->where('user_id', '=', Auth::id(), 'AND', 'test_skill_id', ' =', $testSkill->id)->get();
        $userAnswers = UserAnswer::with(['question', 'selectedOption'])
        ->where('user_id', $userId)
        ->whereHas('question', function ($query) use ($testSkill) {
            $query->where('test_skill_id', $testSkill->id);
        })
        ->get();

        // Calculate total questions and correct answers
        $totalQuestions = $userAnswers->count();
        $correctAnswers = $userAnswers->where('score', '>', 0)->count();

        // Check if a UserScore record already exists
        $userScore = UserScore::where('user_id', $userId)
                              ->where('test_skill_id', $testSkill->id)
                              ->first();

        // If no record exists, create a new one
        if (!$userScore) {
            UserScore::create([
                'user_id' => $userId,
                'test_skill_id' => $testSkill->id,
                'total_score' => $userAnswers->sum('score'),
                'total_questions' => $totalQuestions,
                'correct_answers' => $correctAnswers,
            ]);
        }

        return view('online.result_online_test', compact('userAnswers', 'totalQuestions', 'correctAnswers', 'poster', 'testSkill'));
    }
}
