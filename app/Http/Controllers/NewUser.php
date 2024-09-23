<?php

namespace App\Http\Controllers;
use Illuminate\Http\JsonResponse;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Log;


class NewUser extends Controller
{
    public function usersTable(): JsonResponse
    {
        // $this->authorize('view users'); // Ensure this is in place
        $users = User::all(); 
        return response()->json($users);
        // return Logs::latest()->pagination(10);

    }
    public function store(Request $request)
{
    Log::info($request->all());
    $validated = $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|string|email|max:255|unique:users',
        'password' => 'required|string|min:8|confirmed',
        'profile_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', 
    ]);

    // Handle the file upload
    $profileImagePath = null;
    if ($request->hasFile('profile_image')) {
        $file = $request->file('profile_image');
        $profileImagePath = $file->store('profile_images', 'public');
    }

    User::create([
        'name' => $validated['name'],
        'email' => $validated['email'],
        'password' => bcrypt($validated['password']),
        'profile_image' => $profileImagePath,
    ]);

    return response()->json(['message' => 'User created successfully.']);
}

}
