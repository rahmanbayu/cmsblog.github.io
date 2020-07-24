<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function profile()
    {
        return view('profile.edit', ['user' => Auth::user()]);
    }

    public function update()
    {
        request()->validate([
            'name' => ['required', 'string'],
            'about' => ['nullable', 'string'],
            'image' => ['mimes:jpg,jpeg,png'],
        ]);

        $data = [
            'name' => request()->name,
            'about' => request()->about,
        ];

        if (request()->image) {
            Auth::user()->imageDelete();
            $data['image'] = request()->file('image')->store(
                'assets/users',
                'public'
            );
        }

        Auth::user()->update($data);

        session()->flash('success', 'Profile saved.');

        return back();
    }
}
