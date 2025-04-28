<?php

namespace App\Http\Controllers;

use App\Models\Profiles;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class ProfilesController extends Controller
{
    public function show()
    {
        $user = Auth::user();
        $profiles = $user->profiles ?? new Profiles(['user_id' => $user->id]);
        return view('profiles', compact('user', 'profiles'));
    }

    public function update(Request $request)
    {
        $user = Auth::user();
        $profiles = $user->profiles ?? new Profiles(['user_id' => $user->id]);

        $validator = Validator::make($request->all(), [
            'username' => ['required', 'string', 'max:255'],
            'NIM' => [
                'required',
                'string',
                'max:255',
                Rule::unique('users')->ignore($user->id),
            ],
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                Rule::unique('users')->ignore($user->id),
            ],
            'birthdate' => ['nullable', 'date', 'date_format:Y-m-d'],
            'gender' => ['nullable', 'in:male,female,other'],
            'faculty' => ['nullable', 'string', 'max:255'],
            'major' => ['nullable', 'string', 'max:255'],
            'password' => ['nullable', 'string', 'min:8', 'confirmed'],
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'errors' => $validator->errors(),
            ], 422);
        }

        // Update user data
        $user->username = $request->username;
        $user->NIM = $request->NIM;
        $user->email = $request->email;
        if ($request->filled('password')) {
            $user->password = bcrypt($request->password);
        }
        $user->save();

        // Update or create profile data
        $profiles->birthdate = $request->birthdate;
        $profiles->gender = $request->gender;
        $profiles->faculty = $request->faculty;
        $profiles->major = $request->major;
        $profiles->save();

        return response()->json([
            'status' => 'success',
            'message' => 'Profiles updated successfully',
            'profiles' => [
                'username' => $user->username,
                'NIM' => $user->NIM,
                'email' => $user->email,
                'birthdate' => $profiles->birthdate ? $profiles->birthdate->format('Y-m-d') : null,
                'gender' => $profiles->gender,
                'faculty' => $profiles->faculty,
                'major' => $profiles->major,
            ],
        ]);
    }

    public function getCurrentProfiles()
    {
        $user = Auth::user();
        $profiles = $user->profiles ?? new Profiles(['user_id' => $user->id]);
        return response()->json([
            'status' => 'success',
            'profiles' => [
                'id' => $profiles->id,
                'username' => $user->username,
                'NIM' => $user->NIM,
                'email' => $user->email,
                'birthdate' => $profiles->birthdate ? $profiles->birthdate->format('Y-m-d') : null,
                'gender' => $profiles->gender,
                'faculty' => $profiles->faculty,
                'major' => $profiles->major,
            ],
        ]);
    }
}