<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class ForgotPasswordController extends Controller
{
    protected $staticOtp = '123456'; // OTP statique

    public function showLinkRequestForm()
    {
        return view('auth.password.email');
    }

    public function sendOtp(Request $request) 
    {
        $request->validate(['email' => 'required|email']);

        // Vérifier que l'email existe dans la base de données
        $emailExists = User::where('email', $request->email)->exists();

        if (!$emailExists) {
            return back()->withErrors(['email' => 'L\'email saisi n\'existe pas dans notre base de données.'])->withInput();
        }

        // Stocker l'email et l'OTP dans la session
        session(['otp_email' => $request->email, 'otp' => $this->staticOtp]);

        // Rediriger vers le formulaire de vérification OTP avec un message de confirmation
        return redirect()->route('otp.verifyOtpForm')->with('status', 'Le code OTP a été généré. Utilisez le code: ' . $this->staticOtp);
    }

    public function showOtpForm()
    {
        return view('auth.password.verifyOtp');
    }

    public function verifyOtp(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'otp' => 'required|numeric',
        ]);

        // Vérifier l'OTP et l'email stockés dans la session
        if ($request->email === session('otp_email') && $request->otp === session('otp')) {
            // Rediriger vers l'interface de réinitialisation du mot de passe
            return redirect()->route('password.request', ['email' => $request->email]);
        }

        return back()->withErrors(['otp' => 'Le code OTP est incorrect.']);
    }
}
