<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    public function showRegistrationForm()
    {
        return view('register');
    }

    public function register(Request $request)
    {
        // Validasi input
        $validator = Validator::make($request->all(), [
            'username' => 'required|string|max:255',
            'NIM' => 'required|string|unique:users,NIM',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'birthdate' => 'nullable|date',
            'gender' => 'nullable|in:male,female,other',
            'faculty' => 'nullable|string',
            'major' => 'nullable|string',
            'terms' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput($request->except('password', 'password_confirmation'));
        }

        // Buat user baru
        $user = User::create([
            'username' => $request->username,
            'NIM' => $request->NIM,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'birthdate' => $request->birthdate,
            'gender' => $request->gender,
            'faculty' => $request->faculty,
            'major' => $request->major,
            'terms_agreed' => $request->has('terms'),
        ]);

{
    $user = User::create([
        'name' => $data['name'],
        'email' => $data['email'],
        'password' => Hash::make($data['password']),
    ]);

    Profile::create([
        'user_id' => $user->id,
        'username' => $data['name'],
        'NIM' => $data['NIM'], // Add NIM to registration form
        'email' => $data['email'],
        'password' => Hash::make($data['password']),
    ]);

    return $user;
}
        // Log user masuk setelah registrasi
        auth()->login($user);

        // Redirect ke dashboard
        return redirect()->route('dashboard')->with('success', 'Account registered successfully!');
    }
}
