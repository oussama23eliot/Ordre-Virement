<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class LoginController extends Controller
{
  public function getLogin()
  {
    if (!auth()->user())
      return Inertia::render('Login');
    else {
      return to_route('virements.index');
    }
  }
  public function login(Request $request)
  {
    $credentials = $request->validate(
      [
        'email' => 'required|email',
        'password' => 'required|alphaNum|min:8'
      ]
    );
    if (Auth::attempt($credentials)) {
      $user = User::where("email", "=", $credentials["email"])->first();
      Auth::login($user);
      return to_route('virements.index')->with('message', 'Connexion passé avec succès!');
    } else {
      return to_route('getLogin')->with('error', 'email ou mot de passe incorrect!');
    }
  }
  public function Logout(Request $request)
  {
    if (!auth()->user()) {
      return to_route('getLogin');
    }
    Auth::logout();
    $request->session()->invalidate();
    $request->session()->regenerateToken();
    return
      to_route('getLogin')->with('message', 'Déconnexion avec succès!');
  }
}
