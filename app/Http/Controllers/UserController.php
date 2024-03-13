<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        return view('profile.profile', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        $editing = true;
        return view('profile.edit_profile', compact('user', 'editing'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(User $user)
    {
        //validate
        $validated = request()->validate([
            'first_name' => 'required|min:3|max:40',
            'middle_name' => 'required|min:1|max:255',
            'last_name' => 'required|min:1|max:255',
            'contact_number' => 'nullable|min:1|max:255',
            'profile_image' => 'image',
        ]);

        if (request()->has('profile_image')) {
            $imagePath = request()->file('profile_image')->store('profile', 'public');
            $validated['image'] = $imagePath;

            Storage::disk('public')->delete($user->image ?? '');
        }
        $user->update($validated);

        return redirect()->route('profile');
    }

    public function profile()
    {
        return $this->show(auth()->user());
    }
}
