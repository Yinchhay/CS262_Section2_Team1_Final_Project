<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Suggestion;

class SuggestionController extends Controller
{
    public function index()
    {
        return view('user.suggestion');
    }

    public function store(Request $request)
    {

        $request->validate([
            'subject' => 'required|string|max:255',
            'message' => 'required|string',
        ]);

        $suggestion = Suggestion::create([
            'subject' => $request->input('subject'),
            'message' => $request->input('message'),
            'user_id' => auth()->id(), // Assuming you have authentication set up
        ]);

        return redirect()->route('suggestion.index')->with('success', 'Suggestion sent successfully');
    }
}
