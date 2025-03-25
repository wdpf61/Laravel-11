<?php
namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Request;

class ProfileController extends Controller{

 // ================================
    // 1. REGISTER A NEW USER
    // ================================
    function registerUser($name, $email, $password)
    {
        $user = User::create([
            'name' => $name,
            'email' => $email,
            'password' => Hash::make($password), // Hash the password
        ]);

        Auth::login($user); // Automatically login after registration
        return "User registered and logged in!";
    }

    // ================================
    // 2. LOGIN USER
    // ================================
    function loginUser(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return "Login successful! Redirecting...";
        }

        return "Login failed! Invalid credentials.";
    }

    // ================================
    // 3. LOGOUT USER
    // ================================
    function logoutUser(Request $request)
    {
        Auth::logout(); // Log the user out

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return "User logged out successfully!";
    }

    // ================================
    // 4. CHECK IF USER IS AUTHENTICATED
    // ================================
    function checkAuth()
    {
        if (Auth::check()) {
            return "User is logged in as: " . Auth::user()->email;
        }
        return "User is not logged in.";
    }

    // ================================
    // 5. GET AUTHENTICATED USER DETAILS
    // ================================
    function getAuthenticatedUser()
    {
        if (Auth::check()) {
            return Auth::user(); // Returns the logged-in user
        }
        return "No authenticated user.";
    }

    // ================================
    // 6. LOGIN WITH REMEMBER ME
    // ================================
    function loginWithRememberMe(Request $request)
    {
        $credentials = $request->only('email', 'password');
        $remember = $request->has('remember'); // Checkbox for "Remember Me"

        if (Auth::attempt($credentials, $remember)) {
            return "User logged in with Remember Me!";
        }

        return "Login failed.";
    }

    // ================================
    // 7. FORCE LOGIN A USER
    // ================================
    function forceLogin($userId)
    {
        $user = User::find($userId);
        if ($user) {
            Auth::login($user);
            return "Forced login successful!";
        }
        return "User not found.";
    }

    // ================================
    // 8. LOGIN USING USER ID (Without Password)
    // ================================
    function loginWithId($userId)
    {
        Auth::loginUsingId($userId);
        return "User logged in using ID!";
    }

    // ================================
    // 9. LOGOUT OTHER DEVICES (On Password Change)
    // ================================
    function logoutOtherDevices($password)
    {
        if (Auth::check()) {
            Auth::logoutOtherDevices($password);
            return "Logged out from other devices!";
        }
        return "User not authenticated.";
    }

    // ================================
    // 10. PASSWORD RESET (Example Only)
    // ================================
    function resetPassword(User $user, $newPassword)
    {
        $user->password = Hash::make($newPassword);
        $user->save();
        return "Password changed successfully!";
    }

    // ================================
    // 11. CHECK USER ROLE
    // ================================
    function checkUserRole()
    {
        if (Auth::check() && Auth::user()->role === 'admin') {
            return "User is an admin!";
        }
        return "User is not an admin.";
    }

    // ================================
    // 12. LOGOUT IF INACTIVE (MANUAL CHECK)
    // ================================
    function logoutIfInactive()
    {
        if (Auth::check() && session()->get('last_activity') < now()->subMinutes(30)) {
            Auth::logout();
            return "User logged out due to inactivity!";
        }
        return "User is still active.";
    }

    // ================================
    // 13. LOGIN ATTEMPT LIMITER (Prevent Brute Force Attacks)
    // ================================
    function loginWithThrottle(Request $request)
    {
        $maxAttempts = 5; // Maximum login attempts
        $decayMinutes = 1; // Lockout time in minutes

        if (\Illuminate\Support\Facades\RateLimiter::tooManyAttempts('login:' . $request->ip(), $maxAttempts)) {
            return "Too many login attempts. Try again later.";
        }

        if (!Auth::attempt($request->only('email', 'password'))) {
            \Illuminate\Support\Facades\RateLimiter::hit('login:' . $request->ip(), $decayMinutes * 60);
            return "Invalid credentials.";
        }

        \Illuminate\Support\Facades\RateLimiter::clear('login:' . $request->ip());
        return "Login successful!";
    }

    // ================================
    // 14. AUTHENTICATE API USER (Sanctum or Passport)
    // ================================
    function apiAuthenticate(Request $request)
    {
        $user = Auth::user();
        return response()->json([
            'user' => $user,
            'message' => "Authenticated successfully!"
        ]);
    }
}




