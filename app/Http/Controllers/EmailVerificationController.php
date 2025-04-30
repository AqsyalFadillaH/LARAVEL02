<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Otp;
use App\Mail\OtpMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Carbon\Carbon;

class EmailVerificationController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the email verification notice and generate OTP if none exists.
     *
     * @return \Illuminate\Http\Response
     */
    public function notice()
    {
        $user = Auth::user();

        // If user is already verified, redirect to dashboard
        if ($user->is_verified) {
            return redirect()->route('dashboard')->with('success', 'Your account is already verified.');
        }

        // Check if user already has an active OTP
        $activeOtp = Otp::where('user_id', $user->id)
            ->where('used', false)
            ->where('expires_at', '>', Carbon::now())
            ->first();

        // If no active OTP exists, generate and send one automatically
        if (!$activeOtp) {
            $this->generateAndSendOtp($user);
            // Add a flash message to let user know an OTP was sent
            session()->flash('status', 'A verification code has been sent to your email.');
        }

        // Display verification notice page
        return view('verify');
    }

    /**
     * Send OTP verification email.
     *
     * @return \Illuminate\Http\Response
     */
    public function send()
    {
        $user = Auth::user();

        if ($user->is_verified) {
            return redirect()->route('dashboard')->with('success', 'Your account is already verified.');
        }

        $this->generateAndSendOtp($user);

        return redirect()->route('verification.notice')
            ->with('status', 'Verification code has been sent to your email.');
    }

    /**
     * Verify email with OTP.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function verify(Request $request)
    {
        $request->validate([
            'otp' => 'required|string|size:6',
        ]);

        $user = Auth::user();
        $inputOtp = $request->otp;

        // Check if user is already verified
        if ($user->is_verified) {
            return redirect()->route('dashboard')->with('success', 'Your account is already verified.');
        }

        // Find the OTP in database
        $otpRecord = Otp::where('user_id', $user->id)
            ->where('otp', $inputOtp)
            ->where('used', false)
            ->where('expires_at', '>', Carbon::now())
            ->first();

        if (!$otpRecord) {
            return back()->withErrors(['otp' => 'Invalid or expired verification code.']);
        }

        // Mark OTP as used
        $otpRecord->update(['used' => true]);

        // Verify the user's account
        $user->is_verified = true;
        // Set email_verified_at for Laravel's default verification compatibility
        if (!$user->email_verified_at) {
            $user->email_verified_at = Carbon::now();
        }
        $user->save();

        return redirect()->route('dashboard')->with('success', 'Account verified successfully!');
    }

    /**
     * Helper method to generate and send OTP
     *
     * @param \App\Models\User $user
     * @return void
     */
    private function generateAndSendOtp($user)
    {
        try {
            // Generate 6-digit OTP
            $otp = str_pad(rand(0, 999999), 6, '0', STR_PAD_LEFT);

            // Delete any previous OTPs for this user
            Otp::where('user_id', $user->id)->delete();

            // Save new OTP to database
            Otp::create([
                'user_id' => $user->id,
                'otp' => $otp,
                'expires_at' => Carbon::now()->addMinutes(10),
                'used' => false
            ]);

            // Send OTP email
            Mail::to($user->email)->send(new OtpMail($user, $otp));

            \Log::info('OTP sent successfully', [
                'user_id' => $user->id,
                'email' => $user->email
            ]);

        } catch (\Exception $e) {
            \Log::error('Failed to send OTP email', [
                'user_id' => $user->id,
                'error' => $e->getMessage()
            ]);
        }
    }
}
