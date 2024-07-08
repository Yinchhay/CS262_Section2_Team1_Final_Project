<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Certificate;
use App\Models\Poster;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Ramsey\Uuid\Type\Integer;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $query = User::query()->where('is_admin', false);

        // Search functionality
        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where('first_name', 'like', "%{$search}%")
                ->orWhere('last_name', 'like', "%{$search}%");
        }

        // Sorting functionality
        $sortField = $request->input('sort', 'first_name'); // default sorting by first_name
        $sortOrder = $request->input('order', 'asc'); // default order is ascending

        $users = $query->orderBy($sortField, $sortOrder)->paginate(10);

        return view('users.index', compact('users'));
    }

    public function manage()
    {
        return view('user-management');
    }

    public function profile(User $user)
    {
        return view('users.profile', compact('user'));
    }

    public function activities(Request $request, User $user)
    {
        $userId = $user->id;
        $search = $request->input('search');

        // Retrieve posters with related tests, test skills, and user scores based on search criteria
        $query = Poster::with(['tests.testSkills.userScores' => function ($query) use ($userId) {
            $query->where('user_id', $userId);
        }]);

        if ($search) {
            $query->where('title', 'like', '%' . $search . '%');
        }

        $posters = $query->get();

        // Filter posters based on the presence of user scores and categorize them
        $materials = collect();
        $onlineTests = collect();

        foreach ($posters as $poster) {
            $hasUserScore = false;
            foreach ($poster->tests as $test) {
                foreach ($test->testSkills as $testSkill) {
                    if ($testSkill->userScores->isNotEmpty()) {
                        $hasUserScore = true;
                        break 2; // Break out of both loops
                    }
                }
            }

            if ($hasUserScore) {
                if ($poster->tests->first()->type === 'material') { // Assuming all tests of the poster have the same type
                    $materials->push($poster);
                } else {
                    $onlineTests->push($poster);
                }
            }
        }

        $categorizedPosters = [
            'materials' => $materials->unique('id'),
            'online tests' => $onlineTests->unique('id')
        ];

        return view('users.activities', compact('user', 'categorizedPosters', 'search'));
    }

    public function activitiesShow(User $user, string $prefix, Poster $poster)
    {
        $tests = $poster->tests->load('testSkills.userScores');

        return view('users.activities-show', compact('tests', 'user', 'prefix', 'poster'));
    }

    public function certificates($id)
    {
        $user = User::findOrFail($id);
        $certificatesQuery = Certificate::where('user_id', $id);

        if (request()->has('search')) {
            $searchTerm = request()->get('search');
            $certificatesQuery = $certificatesQuery->where('title', 'like', '%' . $searchTerm . '%');
        }

        $certificates = $certificatesQuery->get();

        return view('users.certificates', compact('user', 'certificates'));
    }
    // {
    //     $user = User::findOrFail($id);
    //     $certificatesQuery = Certificate::where('user_id', $id);

    //     dd($certificatesQuery);
    //     if (request()->has('search')) {
    //         $searchTerm = request()->get('search');
    //         $certificatesQuery = $certificatesQuery->where('title', 'like', '%' . $searchTerm . '%');
    //     }

    //     $certificates = $certificatesQuery->get();

    //     return view('users.certificates', compact('user', 'certificates'));
    // }

    public function certificatesShow(User $user, Certificate $certificate)
    {
        return view('users.certificates-show', compact('user', 'certificate'));
    }

    public function display()
    {
        return view('user-management-activities-display');
    }

    public function certificate()
    {
        return view('user-management-certificate');
    }
}
