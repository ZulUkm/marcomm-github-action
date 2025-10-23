<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Services\ApiAuthService;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class ApiLoginController extends Controller
{
    protected $apiAuthService;

    public function __construct(ApiAuthService $apiAuthService)
    {
        $this->apiAuthService = $apiAuthService;
    }

    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'ukmper' => 'required',
            'password' => 'required',
        ]);

        // Authenticate with external API
        $apiResponse = $this->apiAuthService->authenticate($credentials['ukmper'], $credentials['password']);

        if (!$apiResponse) {
            return back()->withErrors([
                'email' => 'The provided credentials do not match our records.',
            ]);
        }

        // Find or create a user record
        $user = User::updateOrCreate(
            ['ukmper' => $credentials['ukmper']],
            [
                'ukmper' => $credentials['ukmper'],
                'user_type' => $apiResponse['user_type'] ?? 'user',
                'name' => $apiResponse['name'],
                'email' => $apiResponse['email'] ?? null,
                'telephone' => $apiResponse['no_telefon'] ?? null,
                'ptj_code' => $apiResponse['department_code'] ?? null,
                'staff_picture' => $apiResponse['staff_picture'] ?? null,
                'is_active' => $apiResponse['active_status'] ?? 1,
                'position_code' => $apiResponse['position_code'] ?? null,
                'position_name' => $apiResponse['position_name'] ?? null,
                'last_login_ip' => $request->ip(),
                'last_login_at' => now(),
                'password' => Hash::make($credentials['password']), // Save the input password, hashed
                // Add any other fields you want to sync from the API
                //'api_token' => $apiResponse['token'] ?? null,
            ],
        );

        // Log the user in
        Auth::login($user);

        return redirect()->intended('/dashboard');
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }
}
