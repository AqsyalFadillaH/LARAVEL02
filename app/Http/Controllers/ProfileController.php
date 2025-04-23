<?php

namespace App\Http\Controllers;

use App\Models\Profile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class ProfileController extends Controller
{
    /**
     * Display the user's profile.
     *
     * @return \Illuminate\View\View
     */
    public function show()
    {
        $user = Auth::user();
        $profile = $user->profile ?? new Profile(); // Fallback if no profile exists
        return view('profile', compact('profile'));
    }

    /**
     * Update the user's profile information.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request)
    {
        $user = Auth::user();
        $profile = $user->profile;

        // Create a new profile if none exists
        if (!$profile) {
            $profile = new Profile();
            $profile->user_id = $user->id;
        }

        $validator = Validator::make($request->all(), [
            'username' => ['required', 'string', 'max:255'],
            'NIM' => [
                'required',
                'string',
                'max:255',
                Rule::unique('profile')->ignore($profile->id),
            ],
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                Rule::unique('profile')->ignore($profile->id),
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

        $profile->username = $request->username;
        $profile->NIM = $request->NIM;
        $profile->email = $request->email;
        $profile->birthdate = $request->birthdate;
        $profile->gender = $request->gender;
        $profile->faculty = $request->faculty;
        $profile->major = $request->major;

        if ($request->filled('password')) {
            $profile->password = Hash::make($request->password);
        }

        $profile->save();

        return response()->json([
            'status' => 'success',
            'message' => 'Profile updated successfully',
            'profile' => $profile->only([
                'username',
                'NIM',
                'email',
                'birthdate',
                'gender',
                'faculty',
                'major',
            ]),
        ]);
    }

    /**
     * Get current profile data (for AJAX requests).
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getCurrentProfile()
    {
        $user = Auth::user();
        $profile = $user->profile ?? new Profile();
        return response()->json([
            'status' => 'success',
            'profile' => $profile->only([
                'id',
                'username',
                'NIM',
                'email',
                'birthdate',
                'gender',
                'faculty',
                'major',
            ]),
        ]);
    }
}