<?php

namespace App\Http\Controllers;

use App\Models\Skill;
use App\Models\Poster;
use App\Models\Question;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\Typography\FontFactory;

class MaterialController extends Controller
{
    public function index()
    {
        $posters = Poster::orderBy('year', 'desc')->orderBy('month', 'desc')->get();
        $levels = Poster::getLevels();

        if (request()->has('search')) {
            $posters = Poster::where('title', 'like', '%' . request()->get('search', '') . '%')->orderBy('year', 'desc')->orderBy('month', 'desc')->get();
        }

        // dd($posters);

        return view('materials.index', compact('posters', 'levels'));
    }

    public function create()
    {
        $levels = Poster::getLevels();
        $months = Poster::getMonths();

        $skills = Skill::all();
        $questionTypes = Question::getQuestionTypes();

        return view('materials.create', compact('levels', 'months', 'skills', 'questionTypes'));
    }

    public function show(Poster $poster)
    {
        return view('poster-show', compact('poster')); // wrong view
    }

    public function store()
    {
        $validated = request()->validate(
            [
                'type' => 'required|string|in:poster,question',
                'level' => 'required_if:type,poster',
                'year' => 'required_if:type,poster|integer|min:2022|max:2072',
                'month' => 'required_if:type,poster',
                'question_text' => 'required_if:type,question',
                'description' => 'required_if:type,question',
                'question_type' => 'required_if:type,question',
                'point' => 'required_if:type,question|integer|min:1',
                'skills' => 'required_if:type,question|exists:skills,id',
            ]
        );

        if ($validated['type'] === 'poster') {
            return $this->storePoster($validated);
        } else if ($validated['type'] === 'question') {
            return $this->storeQuestion($validated);
        }
    }

    private function storePoster(array $validated)
    {
        $manager = new ImageManager(new Driver());
        $image = $manager->read('images/Material_Poster_Sample.png');

        $elements = ['level', 'year', 'month'];

        $properties = [
            'textWidth' => [],
            'textYOffset' => [],
            'text' => [],
            'color' => [],
            'fontsize' => [],
            'font' => []
        ];

        $staticProperties = [
            'textYOffset' => [
                'level' => $image->height() * 0.485,
                'year' => $image->height() * 0.595,
                'month' => $image->height() * 0.77
            ],
            'text' => [
                'level' => $validated['level'],
                'year' => $validated['year'],
                'month' => $validated['month']
            ],
            'color' => [
                'level' => 'fff',
                'year' => 'fff',
                'month' => '9B5BDC'
            ],
            'fontsize' => [
                'level' => 120,
                'year' => 211,
                'month' => 80
            ],
            'font' => [
                'level' => public_path('fonts/Poppins/Poppins-Medium.ttf'),
                'year' => public_path('fonts/Poppins/Poppins-Bold.ttf'),
                'month' => public_path('fonts/Poppins/Poppins-Bold.ttf')
            ]
        ];

        foreach ($elements as $element) {
            $properties['textWidth'][$element] = ($image->width() - strlen($validated[$element]) + 10) / 2;
        }

        $properties['textYOffset']['level'] = $image->height() * 0.485;
        $properties['textYOffset']['year'] = $image->height() * 0.595;
        $properties['textYOffset']['month'] = $image->height() * 0.77;

        foreach ($staticProperties as $property => $values) {
            foreach ($elements as $element) {
                $properties[$property][$element] = $values[$element];
            }
        }

        foreach ($elements as $element) {
            $image->text(ucwords($properties['text'][$element]), $properties['textWidth'][$element], $properties['textYOffset'][$element], function (FontFactory $font) use ($properties, $element) {
                $font->filename($properties['font'][$element]);
                $font->size($properties['fontsize'][$element]);
                $font->color($properties['color'][$element]);
                $font->align('center');
                $font->valign('middle');
            });
        }

        $filename = uniqid() . '.png';
        $relativePath = 'posters/' . $filename;
        $fullPath = storage_path('app/public/' . $relativePath);
        $image->save($fullPath, 'png');

        Poster::create([
            'title' => 'Engish Material ' . $validated['level'] . ' ' . $validated['year'] . ' ' . $validated['month'],
            'level' => $validated['level'],
            'year' => $validated['year'],
            'month' => $validated['month'],
            'image' => $relativePath,
            'publish_date' => now(),
            'taken' => 0
        ]);

        return redirect()->route('posters.show', Poster::latest()->first())->with('success', 'Poster created successfully!'); // wrong route
    }

    private function storeQuestion(array $validated)
    {
        Question::create([
            'question_text' => $validated['question_text'],
            'description' => $validated['description'],
            'question_type' => $validated['question_type'],
            'point' => $validated['point'],
            'test_skill_id' => 1,
        ]);

        return redirect()->route('posters.show')->with('success', 'Question created successfully!'); // wrong route
    }
}
