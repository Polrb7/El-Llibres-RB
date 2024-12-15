<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    public function index($id)
    {
        $user = User::find($id);
        return view('user.details', compact('user'));
    }

    public function toggleAdmin($id)
    {
        $user = User::findOrFail($id);

        // Inverteix l'estat del camp `admin`
        $user->admin = !$user->admin;
        $user->save();

        return redirect()->back();
    }

    public function delete($id)
    {
        $user = User::findOrFail($id);

        // Assegura't de no permetre eliminar l'administrador principal
        if ($user->id === Auth::id()) {
            return redirect()->back()->with('error', __('You cannot delete your own account.'));
        }

        // Eliminar l'usuari i la imatge de perfil si existeix
        if ($user->profile_img) {
            Storage::delete($user->profile_img);
        }

        $user->delete();

        return redirect()->back();
    }
}
