<?php

namespace App\Http\Controllers;

use App\Models\Test;
use App\Models\Skill;
use App\Models\Poster;
use App\Models\Question;
use App\Models\TestSkill;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Pagination\LengthAwarePaginator;

class TestController extends Controller
{
    public function index()
    {
        // return view('service-tests');
    }

    public function create(Poster $poster)
    {
        $prefix = $this->getPrefix();

        // $nextOrder = $poster->tests->max('order');
        // $nextOrder = $nextOrder ? $nextOrder + 1 : 1;

        $skills = Skill::all();
        // $questionTypes = Question::getQuestionTypes();

        return view('tests.create-testSkill', compact('prefix', 'poster', 'skills'));
    }

    // public function store(Poster $poster)
    // {
    //     $prefix = $this->getPrefix();

    //     // dd(request('audio_file'));

    //     $validated = request()->validate([
    //         'type' => 'required',
    //         'order' => 'required',
    //         'audio_file' => 'mimes:mp3,wav',
    //     ]);

    //     $audio_file = request()->file('audio_file');
    //     $audio_path = null;

    //     if (request()->has('audio_file')) {
    //         // $audioPath = request()->file('audio_file')->store('audio', 'public');
    //         // dd($validated);

    //         $audio_path = $audio_file->getClientOriginalName();
    //         $audio_file->move(storage_path('audio'), $audio_path);
    //     }

    //     $test = Test::create([
    //         'type' => request('type'),
    //         'order' => request('order'),
    //         'poster_id' => $poster->id,
    //     ]);

    //     $testSkills = json_decode(request()->get('testSkills'), true);

    //     if (is_array($testSkills)) {
    //         foreach ($testSkills as $testSkillData) {
    //             $testSkill = TestSkill::create([
    //                 'test_id' => $test->id,
    //                 'skill_id' => $testSkillData['skill'],
    //                 'instruction' => $testSkillData['instruction'],
    //                 'audio' => $audio_path,
    //                 'duration' => $testSkillData['duration'],
    //             ]);

    //             foreach ($testSkillData['questions'] as $questionData) {
    //                 $question = Question::create([
    //                     'question_text' => $questionData['question'],
    //                     'description' => $questionData['description'],
    //                     'type' => $questionData['type'],
    //                     'points' => $questionData['points'],
    //                     'test_skill_id' => $testSkill->id,
    //                 ]);

    //                 foreach ($questionData['options'] as $option) {
    //                     $question->options()->create([
    //                         'question_id' => $question->id,
    //                         'option_text' => $option['text'],
    //                         'is_correct' => $option['isCorrect'],
    //                     ]);
    //                 }
    //             }
    //         }
    //     }

    //     return redirect()->route($prefix . '.posters.show', $poster->id)->with('success', 'Test and Test Skill created successfully');
    // }

    public function store(Poster $poster)
    {
        $prefix = $this->getPrefix();

        $validated = request()->validate([
            'type' => 'required',
            'vocabulary-instruction' => 'nullable',
            'vocabulary-duration' => 'nullable',
            'grammar-instruction' => 'nullable',
            'grammar-duration' => 'nullable',
            'listening-instruction' => 'nullable',
            'listening-duration' => 'nullable',
            'audio_file' => 'required|mimes:mp3,wav',
        ]);

        $order = $poster->tests->max('order') + 1;

        if (request()->has('audio_file')) {
            $audioPath = request()->file('audio_file')->store('audio', 'public');
        }

        $test = Test::create([
            'type' => request('type'),
            'order' => $order,
            'poster_id' => $poster->id,
        ]);

        $testSkills = [
            [
                'skill_id' => Skill::where('name', 'vocabulary')->first()->id,
                'test_id' => $test->id,
                'instruction' => $validated['vocabulary-instruction'] ?? null,
                'duration' => $validated['vocabulary-duration'] ?? null,
                'audio' => 'null',
            ],
            [
                'skill_id' => Skill::where('name', 'grammar')->first()->id,
                'test_id' => $test->id,
                'instruction' => $validated['grammar-instruction'] ?? null,
                'duration' => $validated['grammar-duration'] ?? null,
                'audio' => 'null',
            ],
            [
                'skill_id' => Skill::where('name', 'listening')->first()->id,
                'test_id' => $test->id,
                'instruction' => $validated['listening-instruction'] ?? null,
                'duration' => $validated['listening-duration'] ?? null,
                'audio' => $audioPath,
            ],
        ];

        foreach ($testSkills as $testSkill) {
            $testSkill = TestSkill::create($testSkill);
        }

        return redirect()->route($prefix . '.posters.tests.questions.create', [$poster->id, $test->id])->with('success', 'Test and Test Skill created successfully');
    }

    public function show(Poster $poster, Test $test)
    {
        $prefix = $this->getPrefix();

        return view('tests.show1', compact('prefix', 'poster', 'test'));
    }

    public function destroy(Poster $poster, Test $test)
    {
        $prefix = $this->getPrefix() == 'materials' ? 'material' : 'test';

        if (Auth::check() && Auth::user()->is_admin != 1) {
            return back()->with('error', 'You are not authorized to perform this action');
        }

        DB::beginTransaction();

        if (!$test) {
            DB::rollBack();
            return back()->with('error', ucfirst($prefix) . ' not found');
        }

        if (!$test->delete()) {
            DB::rollBack();
            return back()->with('error', 'Failed to delete ' . $prefix);
        }

        DB::commit();

        return back()->with('success', ucfirst($prefix) . ' deleted successfully');
    }

    public function getPrefix()
    {
        $currentRouteName = Route::currentRouteName();
        $prefix = explode('.', $currentRouteName)[0];

        return $prefix;
    }
}
