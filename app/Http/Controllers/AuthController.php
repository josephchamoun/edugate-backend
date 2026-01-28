<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Student;
use App\Models\Teacher;
use App\Models\ParentModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;


class AuthController extends Controller
{
    public function login(Request $request)
    {
        $request->validate([
        'email' => 'required|email',
        'password' => 'required',
        ]);


        $user = User::where('email', $request->email)->first();


        if (! $user || ! Hash::check($request->password, $user->password)) {
        return response()->json(['message' => 'Invalid credentials'], 401);
        }


        // Delete old tokens (optional but recommended)
        $user->tokens()->delete();


        // Create token
        $token = $user->createToken('auth_token')->plainTextToken;


        // Load role-based relation
        $user->load(match ($user->role) {
        'student' => 'student',
        'teacher' => 'teacher',
        'parent' => 'parentProfile',
        default => [],
        });


        return response()
        ->json([
        'user' => $user, 
        ])
        ->cookie(
        'access_token',
        $token,
        60 * 24, // minutes (1 day)
        '/',
        null,
        false, // 🔴 false for local dev (true in production HTTPS)
        true // ✅ HttpOnly
        );
    }

    public function register(Request $request)
    {
        // Only Admin can register users in this system
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
            'role' => 'required|in:admin,teacher,student,parent',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
        ]);

        // Create associated profile
        if ($user->role === 'student') {
            Student::create(['user_id' => $user->id]);
        } elseif ($user->role === 'teacher') {
            Teacher::create(['user_id' => $user->id]);
        } elseif ($user->role === 'parent') {
            UserParent::create(['user_id' => $user->id]);
        }

        return response()->json(['user' => $user], 201);
    }

    public function logout(Request $request)
    {
        // Revoke current token
        $request->user()->currentAccessToken()->delete();


        // Remove the HttpOnly cookie
        return response()
        ->json(['message' => 'Logged out'])
        ->withoutCookie('access_token');
    }

public function me(Request $request)
{
    return response()->json([
        'user' => $request->user(),
        'guard' => Auth::getDefaultDriver(),
    ]);
}

    public function updateProfile(Request $request)
    {
        $user = $request->user();
        
        $request->validate([
            'name' => 'sometimes|required|string|max:255',
            'email' => 'sometimes|required|string|email|max:255|unique:users,email,' . $user->id,
            'password' => 'sometimes|nullable|string|min:8|confirmed',
            'settings' => 'sometimes|array',
        ]);

        if ($request->has('name')) {
            $user->name = $request->name;
        }
        
        if ($request->has('email')) {
            $user->email = $request->email;
        }

        if ($request->has('settings')) {
            $user->settings = $request->settings;
        }

        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        $user->save();

        return response()->json([
            'message' => 'Profile updated successfully',
            'user' => $user->load(['student', 'teacher', 'parent'])
        ]);
    }
}