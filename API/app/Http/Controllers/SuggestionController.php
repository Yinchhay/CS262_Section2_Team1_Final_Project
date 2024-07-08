<?php

namespace App\Http\Controllers;

use App\Models\Suggestion;
use Illuminate\Http\Request;

use function Laravel\Prompts\suggest;

class SuggestionController extends Controller
{
    public function index()
    {
        $suggestions = Suggestion::all();
        return view('suggestions.index', compact('suggestions'));
    }

    public function show($id)
    {
        $suggestion = Suggestion::with('user')->find($id);
        return view('suggestions.show', compact('suggestion'));
    }
}
