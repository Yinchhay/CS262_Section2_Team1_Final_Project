<?php

namespace App\Http\Controllers;

use App\Models\Poster;
use Illuminate\Http\Request;
use Intervention\Image\Image;
use Intervention\Image\ImageManager;
use Illuminate\Support\Facades\Route;
use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\Typography\FontFactory;

class PosterController extends Controller
{
    public function index()
    {
        $prefix = $this->getPrefix();
        $text = $prefix == 'materials' ? 'material' : 'online test';

        $posters = Poster::where('title', 'like', '%' . $text . '%')->orderBy('year', 'desc')->orderBy('month', 'desc');
        $levels = Poster::getLevels();

        if (request()->has('search')) {
            $posters = $posters->where('title', 'like', '%' . request()->get('search', '') . '%');
        }

        $posters = $posters->get();

        return view('posters.index', compact('prefix', 'posters', 'levels'));
    }

    public function create()
    {
        $prefix = $this->getPrefix();

        $levels = Poster::getLevels();
        $months = Poster::getMonths();

        return view('posters.create', compact('prefix', 'levels', 'months'));
    }

    public function store()
    {
        $prefix = $this->getPrefix();

        $validated = request()->validate([
            'level' => 'required',
            'year' => 'required|integer|min:2022|max:2072',
            'month' => 'required',
        ]);

        $existingPoster = Poster::where('level', $validated['level'])
            ->where('year', $validated['year'])
            ->where('month', $validated['month'])
            ->first();

        if ($existingPoster) {
            return redirect()->back()->withErrors(['error' => 'A poster with the same level, year, and month already exists.']);
        }

        $manager = new ImageManager(new Driver());
        $image = $manager->read('images/' .  ($prefix == 'materials' ? 'Material_Poster_Sample.png' : 'Online_Test_Poster_Sample.png'));

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
                'level' => request()->get('level'),
                'year' => request()->get('year'),
                'month' => request()->get('month')
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
            'title' => ucwords('Engish ' . ($prefix == 'materials' ? 'Materials' : 'Online Tests') . ' ' . $validated['level'] . ' ' . $validated['year'] . ' ' . $validated['month']),
            'level' => $validated['level'],
            'year' => $validated['year'],
            'month' => $validated['month'],
            'image' => $relativePath,
            'publish_date' => now(),
            'taken' => 0
        ]);

        return redirect()->route($prefix . '.posters.index')->with('success', 'Poster created successfully!');
    }

    public function show(Poster $poster)
    {
        $prefix = $this->getPrefix();

        $tests = $poster->tests->sortBy('order');

        return view('posters.show', compact('prefix', 'poster', 'tests'));
    }

    public function edit(Poster $poster)
    {
        $prefix = $this->getPrefix();
        $editing = true;

        $levels = Poster::getLevels();
        $months = Poster::getMonths();

        return view('posters.create', compact('prefix', 'poster', 'levels', 'months', 'editing'));
    }

    public function update(Poster $poster)
    {
        $prefix = $this->getPrefix();

        $validated = request()->validate([
            'level' => 'required',
            'year' => 'required|integer|min:2022|max:2072',
            'month' => 'required',
        ]);

        $manager = new ImageManager(new Driver());
        $image = $manager->read('images/' . (($prefix == 'materials') ? 'Material_Poster_Sample.png' : 'Online_Test_Poster_Sample.png'));

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
                'level' => request()->get('level'),
                'year' => request()->get('year'),
                'month' => request()->get('month')
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

        $poster->title = ucwords('Engish ' . ($prefix == 'materials' ? 'Materials ' : 'Online Tests') . $validated['level'] . ' ' . $validated['year'] . ' ' . $validated['month']);
        $poster->level = $validated['level'];
        $poster->year = $validated['year'];
        $poster->month = $validated['month'];
        $poster->image = $relativePath;
        $poster->save();

        return redirect()->route($prefix . '.posters.show', $poster->id)->with('success', 'Poster updated successfully!');
    }

    public function destroy(Poster $poster)
    {
        $prefix = $this->getPrefix();

        $poster->delete();

        return redirect()->route($prefix . '.posters.index')->with('success', 'Poster deleted successfully');
    }

    public function getPrefix()
    {
        $currentRouteName = Route::currentRouteName();
        $prefix = explode('.', $currentRouteName)[0];

        return $prefix;
    }
}
