<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {

        $user = User::find($id);

        if (!$user) {
            return redirect()->route('home')->with('error', 'Utilisateur non trouvé.');
        } else {
            return view("home", [
                "user" => $user
            ]);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $user = User::find($id);

        if (!$user) {
            return redirect()->route('home')->with('error', 'Utilisateur non trouvé.');
        }

        return view('profiles.edit', [
            'user' => $user
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $user = User::find($id);

        if (!$user) {
            return redirect()->route('home')->with('error', 'Utilisateur non trouvé.');
        }
        // 'name' => 'required|string|max:255',
        // 'email' => 'required|string|email|max:255|unique:users,email,'
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,

        ]);
        // Mettre à jour les champs si nécessaire
        $user->name = $request->name;
        $user->email = $request->email;


        $user->save();

        return redirect()->route('home')->with('success', 'Profil mis à jour avec succès.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
