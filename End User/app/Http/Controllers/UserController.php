<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Poster;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    public function signup()
    {
        return view('sign-up');
    }

    public function store()
    {
        request()->validate(
            [
                'first_name' => 'required|min:3|max:50',
                'last_name' => 'required|min:3|max:50',
                'email' => 'required|email|unique:users,email',
                'password' => 'required|min:8|confirmed',
            ]
        );

        $user = User::create(
            [
                'first_name' => request()->get('first_name'),
                'last_name' => request()->get('last_name'),
                'email' => request()->get('email'),
                'password' => Hash::make(request()->get('password')),
                'is_admin' => 0,
            ]
        );

        return redirect()->route('user.dashboard')->with('success', 'Account created successfully');
    }

    public function login()
    {
        return view('log-in');
    }

    public function authenticate()
    {
        request()->validate(
            [
                'email' => 'required|email',
                'password' => 'required|min:8',
            ]
        );

        $credentials = request()->only('email', 'password');

        if (auth()->attempt($credentials)) {
            request()->session()->regenerate();

            return redirect()->route('user.dashboard')->with('success', 'Logged in successfully!');
        }

        return back()->withErrors(['email' => 'Invalid credentials']);
    }

    public function logout()
    {
        auth()->logout();

        request()->session()->invalidate();

        request()->session()->regenerateToken();

        return redirect('/')->with('success', 'Logged out successfully!');
    }

    public function dashboard()
    {
        $materialPosters = Poster::where('title', 'like', '%Material%')->orderBy('year', 'desc')->orderBy('month', 'desc')->get();
        $onlineTestPosters = Poster::where('title', 'like', '%Online Test%')->orderBy('year', 'desc')->orderBy('month', 'desc')->get();

        return view('user.user_dashboard', compact('materialPosters', 'onlineTestPosters'));
    }

    public function profile()
    {
        return view('user.user_profile');
    }

    public function edit()
    {
        return view('user.user_profile_edit');
    }

    public function update(Request $request)
    {
        $data = $request->validate(
            [
                'first_name' => 'required|min:3|max:50',
                'last_name' => 'required|min:3|max:50',
                'image' => 'nullable|image'
            ]
        );

        $user = User::where('id', auth()->user()->id)->first();

        $user->first_name = $request->get('first_name');
        $user->last_name = $request->get('last_name');


        if ($request->hasFile('image')) {


            // Store new image
            $image_path = $request->file('image')->store('profile', 'public');

            $request->image->move(public_path('profile'), $image_path);
            $data['image'] = $image_path;

        } else {
            // Keep the old image
            $data['image'] = $user->image;
        }


        $user->update($data);

        return redirect()->route('user.profile')->with('success', 'Profile updated successfully');
    }



}
