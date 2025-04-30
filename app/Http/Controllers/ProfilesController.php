<?php

namespace App\Http\Controllers;

use App\Models\Profiles;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

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

        Log::info('Updating profile for user: ' . $user->id, [
            'request' => $request->all(),
            'user_exists' => $user->exists,
            'profiles_exists' => $profiles->exists,
        ]);

        $validator = Validator::make($request->all(), [
            'username' => ['required', 'string', 'max:255', 'unique:users,username,' . $user->id],
            'NIM' => ['required', 'string', 'max:255', 'unique:users,NIM,' . $user->id],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,' . $user->id],
            'birthdate' => ['nullable', 'date', 'date_format:Y-m-d'],
            'gender' => ['nullable', 'in:male,female,other'],
            'faculty' => ['nullable', 'string', 'max:255'],
            'major' => ['nullable', 'string', 'max:255'],
        ]);

        if ($validator->fails()) {
            Log::error('Validation failed', ['errors' => $validator->errors()->toArray()]);
            return response()->json([
                'status' => 'error',
                'errors' => $validator->errors(),
            ], 422);
        }

        try {
            DB::beginTransaction();

            // Update user data
            $user->username = $request->username;
            $user->NIM = $request->NIM;
            $user->email = $request->email;
            Log::debug('Attempting to save user', ['user' => $user->toArray()]);
            if (!$user->save()) {
                throw new \Exception('Failed to save user data');
            }

            // Update or create profile data
            $profiles->birthdate = $request->birthdate ?: null;
            $profiles->gender = $request->gender ?: null;
            $profiles->faculty = $request->faculty ?: null;
            $profiles->major = $request->major ?: null;
            $profiles->user_id = $user->id;
            Log::debug('Attempting to save profile', ['profiles' => $profiles->toArray()]);
            if (!$profiles->save()) {
                throw new \Exception('Failed to save profile data');
            }

            DB::commit();

            Log::info('Profile updated successfully', [
                'user' => $user->toArray(),
                'profiles' => $profiles->toArray(),
            ]);

            return response()->json([
                'status' => 'success',
                'message' => 'Profile updated successfully',
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
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Profile update failed: ' . $e->getMessage(), [
                'exception' => $e->getTraceAsString(),
                'request' => $request->all(),
                'user_id' => $user->id,
                'user_data' => $user->toArray(),
                'profiles_data' => $profiles->toArray(),
            ]);
            return response()->json([
                'status' => 'error',
                'message' => 'An error occurred while updating your profile.',
                'error_details' => env('APP_DEBUG', false) ? $e->getMessage() : null,
            ], 500);
        }
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
