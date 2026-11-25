<?php
namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
class AuthController extends Controller {
    /**
     * Show the login form
     */
    public function showLogin(): View {
        return view('auth.login');
    }
    /**
     * Handle login request
     */
    public function login(Request $request): RedirectResponse {
        $credentials = $request->validate(['email' => 'required|email', 'password' => 'required']);
        if (Auth::attempt($credentials, $request->boolean('remember'))) {
            $request->session()->regenerate();
            $destination = $request->user()->is_admin ? '/dashboard' : route('requests.mine');
            return redirect()->intended($destination)->with('success', 'Welcome back!');
        }
        return back()->withErrors(['email' => 'The provided credentials do not match our records.'])->onlyInput('email');
    }
    /**
     * Show the registration form
     */
    public function showRegister(): View {
        return view('auth.register');
    }
    /**
     * Handle registration request
     */
    public function register(Request $request): RedirectResponse {
        $request->validate(['name' => 'required|string|max:255', 'email' => 'required|string|email|max:255|unique:users', 'password' => ['required', 'confirmed', Password::defaults()]]);
        $user = User::create(['name' => $request->name, 'email' => $request->email, 'password' => Hash::make($request->password)]);
        Auth::login($user);
        return redirect()->route('requests.mine')->with('success', 'Registration successful! Welcome to your requests.');
    }
    /**
     * Handle logout request
     */
    public function logout(Request $request): RedirectResponse {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/')->with('success', 'You have been logged out successfully.');
    }
}