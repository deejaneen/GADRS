<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

use function Laravel\Prompts\password;

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
            $validated['profile_image'] = $imagePath;

            Storage::disk('public')->delete($user->profile_image ?? '');
        }
        $user->update($validated);

        return redirect()->route('profile');
    }

    public function profile()
    {
        return $this->show(auth()->user());
    }

    public function updatePassword(Request $request)
    {
        // Validate the request data
        $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|min:8',
            'confirm_password' => 'required|same:new_password',
        ]);

        // Get the authenticated user
        $user = Auth::user();

        // Check if the current password matches the one provided
        if (!Hash::check($request->current_password, $user->password)) {
            return redirect()->back()->withErrors(['current_password' => 'The current password is incorrect.']);
        }

        $user->password = Hash::make($request->new_password);
        $user->save();


        return redirect()->route('passwordprofile')->with('success', 'Password updated successfully.');
    }
}
