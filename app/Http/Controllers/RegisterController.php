<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Otp;
use App\Mail\OtpMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Mail;
use Carbon\Carbon;
use App\Services\OtpService;

class RegisterController extends Controller
{
    protected $otpService;

    /**
     * Create a new controller instance.
     *
     * @param OtpService $otpService
     */
    public function __construct(OtpService $otpService = null)
    {
        $this->middleware('guest');
        // If OtpService is not injected, create a new instance
        $this->otpService = $otpService ?: app(OtpService::class);
    }

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
            'is_verified' => false, // User belum terverifikasi
        ]);

        // Generate and send OTP immediately after registration
        $this->sendVerificationOtp($user);

        // Log user masuk setelah registrasi
        auth()->login($user);

        // Alihkan ke halaman verifikasi email, bukan langsung ke dashboard
        return redirect()->route('verification.notice')
            ->with('status', 'Akun Anda berhasil dibuat! Silakan periksa email Anda untuk kode verifikasi.');
    }

    /**
     * Generate and send OTP for email verification
     *
     * @param User $user
     * @return void
     */
    private function sendVerificationOtp($user)
    {
        try {
            // Gunakan OtpService jika tersedia
            if ($this->otpService) {
                $otp = $this->otpService->generateOtp($user);
                $this->otpService->sendOtpEmail($user, $otp);

                \Log::info('OTP verifikasi berhasil dikirim', [
                    'user_id' => $user->id,
                    'email' => $user->email
                ]);

                return;
            }

            // Fallback implementation jika OtpService tidak tersedia
            // Generate 6-digit OTP
            $otp = str_pad(rand(0, 999999), 6, '0', STR_PAD_LEFT);

            // Hapus OTP lama jika ada
            Otp::where('user_id', $user->id)->delete();

            // Simpan OTP baru ke database
            Otp::create([
                'user_id' => $user->id,
                'otp' => $otp,
                'expires_at' => Carbon::now()->addMinutes(10),
                'used' => false
            ]);

            // Kirim email OTP
            Mail::to($user->email)->send(new OtpMail($user, $otp));

            \Log::info('OTP verifikasi berhasil dikirim', [
                'user_id' => $user->id,
                'email' => $user->email
            ]);

        } catch (\Exception $e) {
            \Log::error('Gagal mengirim OTP verifikasi', [
                'user_id' => $user->id,
                'email' => $user->email,
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
        }
    }
}
