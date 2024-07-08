<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Poster;
use Illuminate\Http\Request;

class AdminDashboardController extends Controller
{
    public function index()
    {
        $numOfUsers = User::where('is_admin', false)->count();

        $mostPopularPosters = [
            'materials' => Poster::where('title', 'like', '%Material%')->orderBy('taken', 'desc')->take(5)->get(),
            'online tests' => Poster::where('title', 'like', '%Online Test%')->orderBy('taken', 'desc')->take(5)->get(),
        ];

        $recentPosters = [
            'materials' => Poster::where('title', 'like', '%Material%')->latest()->take(5)->get(),
            'online tests' => Poster::where('title', 'like', '%Online Test%')->latest()->take(5)->get(),
        ];

        return view('dashboard', compact('numOfUsers', 'mostPopularPosters', 'recentPosters'));
    }
}
