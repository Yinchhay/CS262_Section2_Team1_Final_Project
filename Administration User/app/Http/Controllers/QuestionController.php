<?php

namespace App\Http\Controllers;

use App\Models\Test;
use App\Models\Skill;
use App\Models\Poster;
use App\Models\Question;
use Illuminate\Http\Request;
use App\Models\QuestionOption;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

class QuestionController extends Controller
{
    public function create(Request $request, Poster $poster, Test $test)
    {
        $prefix = $this->getPrefix();

        $skills = Skill::all();
        $questionTypes = Question::getQuestionTypes();

        // dynamic route parameter
        $params = $request->route()->parameters();

        return view('tests.create-question', compact('prefix', 'poster', 'test', 'skills', 'questionTypes'));
    }

    public function edit(Request $request, Poster $poster, Test $test, Question $question)
    {
        $prefix = $this->getPrefix();

        $skills = Skill::all();
        $questionTypes = Question::getQuestionTypes();
        // $questions = Question::with('options', 'testSkill.skill')->where('id', $question->id)->get()->first();

        // dynamic route parameter
        $params = $request->route()->parameters();

        return view('tests.edit-question', compact('prefix', 'poster', 'test', 'skills', 'questionTypes', 'question'));
    }

    public function store(Poster $poster, Test $test)
    {
        if (Auth::check() && Auth::user()->is_admin != 1) {
            return back()->with('error', 'You are not authorized to perform this action');
        }

        $data = request()->validate([
            'type' => 'required',
            'skill_id' => 'required',
            'qtnType' => 'required',
            'desc' => 'nullable',
            'question' => 'required',
            'point' => 'required',
            'option' => 'required',
            'answer' => 'required',
        ]);

        $testSkillId = $test->testSkills()->where('skill_id', $data['skill_id'])->first()->id;

        if (is_array($data['answer'])) {
            if (count($data['answer']) == 0) {
                return back()->with('error', 'Please select the correct answer');
            }

            if (count($data['answer']) > 1 && $data['qtnType'] == 'multiple choice') {
                return back()->with('error', 'Multiple choice question can only have one correct answer');
            }
        }

        if (is_array(($data['option']))) {
            if (count($data['option']) < 2) {
                return back()->with('error', 'Please provide at least two options');
            }
        }

        DB::beginTransaction();

        $savedQuestion = Question::create([
            'question_text' => $data['question'],
            'description' => $data['desc'] ?? null,
            'type' => $data['qtnType'],
            'points' => $data['point'],
            // 'test_skill_id' => $data['skill_id'],
            'test_skill_id' => $testSkillId,
        ]);

        if (!$savedQuestion) {
            DB::rollBack();
            return back()->with('error', 'Failed to save question');
        }

        $lastQuestionOrder = QuestionOption::where('question_id', $savedQuestion->id)->orderBy('id', 'desc')->first();

        if (!$lastQuestionOrder) {
            $lastQuestionOrder = 0;
        }

        foreach ($data['option'] as $key => $option) {
            $isCorrect = 0;

            foreach ($data['answer'] as $answerIndex => $answer) {
                if ($key == (int)$answer - 1) {
                    $isCorrect = 1;
                }
            }

            $savedOption = QuestionOption::create([
                'question_id' => $savedQuestion->id,
                'option_text' => $option,
                'is_correct' => $isCorrect,
                'order' => ++$lastQuestionOrder,
            ]);

            if (!$savedOption) {
                DB::rollBack();
                return back()->with('error', 'Failed to save question options');
            }
        }

        DB::commit();
        return back()->with('success', 'Question saved successfully');
    }

    public function update(Poster $poster, Test $test, Question $question)
    {
        if (Auth::check() && Auth::user()->is_admin != 1) {
            return back()->with('error', 'You are not authorized to perform this action');
        }

        $data = request()->validate([
            'type' => 'required',
            'skill_id' => 'required',
            'qtnType' => 'required',
            'desc' => 'nullable',
            'question' => 'required',
            'point' => 'required',
            'option' => 'required',
            'answer' => 'required',
        ]);

        $testSkillId = $test->testSkills()->where('skill_id', $data['skill_id'])->first()->id;

        if (is_array($data['answer'])) {
            if (count($data['answer']) == 0) {
                return back()->with('error', 'Please select the correct answer');
            }

            if (count($data['answer']) > 1 && $data['qtnType'] == 'multiple choice') {
                return back()->with('error', 'Multiple choice question can only have one correct answer');
            }
        }

        if (is_array(($data['option']))) {
            if (count($data['option']) < 2) {
                return back()->with('error', 'Please provide at least two options');
            }
        }

        DB::beginTransaction();

        if (!$question) {
            DB::rollBack();
            return back()->with('error', 'Question not found');
        }

        $question->question_text = $data['question'];
        $question->description = $data['desc'] ?? null;
        $question->type = $data['qtnType'];
        $question->points = $data['point'];
        $question->test_skill_id = $testSkillId;

        if (!$question->save()) {
            DB::rollBack();
            return back()->with('error', 'Failed to update question');
        }

        $question->options()->delete();

        $lastQuestionOrder = QuestionOption::where('question_id', $question->id)->orderBy('id', 'desc')->first();

        if (!$lastQuestionOrder) {
            $lastQuestionOrder = 0;
        }

        foreach ($data['option'] as $key => $option) {
            $isCorrect = 0;

            foreach ($data['answer'] as $answerIndex => $answer) {
                if ($key == (int)$answer - 1) {
                    $isCorrect = 1;
                }
            }

            $savedOption = QuestionOption::create([
                'question_id' => $question->id,
                'option_text' => $option,
                'is_correct' => $isCorrect,
                'order' => ++$lastQuestionOrder,
            ]);

            if (!$savedOption) {
                DB::rollBack();
                return back()->with('error', 'Failed to save question options');
            }
        }

        DB::commit();

        return back()->with('success', 'Question updated successfully');
    }

    public function destroy(Poster $poster, Test $test, Question $question)
    {
        if (Auth::check() && Auth::user()->is_admin != 1) {
            return back()->with('error', 'You are not authorized to perform this action');
        }

        DB::beginTransaction();

        if (!$question) {
            DB::rollBack();
            return back()->with('error', 'Question not found');
        }

        if (!$question->delete()) {
            DB::rollBack();
            return back()->with('error', 'Failed to delete question');
        }

        DB::commit();

        return back()->with('success', 'Question deleted successfully');
    }


    public function getPrefix()
    {
        $currentRouteName = Route::currentRouteName();
        $prefix = explode('.', $currentRouteName)[0];

        return $prefix;
    }
}
