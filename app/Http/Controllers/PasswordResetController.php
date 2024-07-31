<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class PasswordResetController extends Controller
{
    public function showResetForm()
    {
        return view('auth.password'); // Assurez-vous que le nom du fichier est correct
    }

    public function reset(Request $request)
    {
        // Validation des données
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|exists:users,email',
            'password' => 'required|string|min:4|confirmed',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Recherche de l'utilisateur
        $user = User::where('name', $request->name)
                    ->where('email', $request->email)
                    ->first();

        if (!$user) {
            return redirect()->back()->withErrors([
                'email' => 'Aucun utilisateur trouvé avec ces informations.',
            ])->withInput();
        }

        // Mise à jour du mot de passe
        $user->password = Hash::make($request->password);
        $user->save();

        return redirect()->route('login')->with('status', 'Mot de passe mis à jour avec succès.');
    }
}

