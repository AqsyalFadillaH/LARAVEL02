<?php

namespace App\Services;

use App\Models\Otp;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;
use App\Mail\OtpMail;

class OtpService
{
    /**
     * Generate OTP for user
     *
     * @param User $user
     * @return string
     */
    public function generateOtp(User $user)
    {
        // Generate a random 6-digit OTP
        $otp = str_pad(rand(0, 999999), 6, '0', STR_PAD_LEFT);

        // Invalidate any existing OTPs
        $user->otps()->where('used', false)->update(['used' => true]);

        // Create new OTP record
        $otpRecord = $user->otps()->create([
            'otp' => $otp,
            'expires_at' => Carbon::now()->addMinutes(10), // OTP expires in 10 minutes
            'used' => false
        ]);

        return $otp;
    }

    /**
     * Validate OTP
     *
     * @param User $user
     * @param string $otp
     * @return bool
     */
    public function validateOtp(User $user, string $otp)
    {
        $otpRecord = $user->otps()
            ->where('otp', $otp)
            ->where('used', false)
            ->where('expires_at', '>', Carbon::now())
            ->first();

        if (!$otpRecord) {
            return false;
        }

        // Mark OTP as used
        $otpRecord->update(['used' => true]);

        // Mark user as verified if not already
        if (!$user->is_verified) {
            $user->update(['is_verified' => true]);
        }

        return true;
    }

    /**
     * Send OTP via email
     *
     * @param User $user
     * @param string $otp
     * @return bool
     */
    public function sendOtpEmail(User $user, string $otp)
    {
        try {
            \Log::info('Attempting to send OTP email', [
                'user_id' => $user->id,
                'email' => $user->email,
                'otp' => $otp,
            ]);

            // Verifikasi email pengguna
            if (empty($user->email)) {
                \Log::error('Cannot send OTP: User has no email address', ['user_id' => $user->id]);
                return false;
            }

            Mail::to($user->email)->send(new OtpMail($user, $otp));

            \Log::info('OTP email sent successfully', [
                'user_id' => $user->id,
                'email' => $user->email,
            ]);

            return true;
        } catch (\Exception $e) {
            \Log::error('Failed to send OTP email', [
                'user_id' => $user->id,
                'email' => $user->email,
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
            ]);

            // Jangan throw error, cukup kembalikan false
            return false;
        }
    }
}
