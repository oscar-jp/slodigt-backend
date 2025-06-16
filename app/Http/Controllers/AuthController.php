<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use App\Models\User;

class AuthController extends Controller
{
    /**
     * Registrar nuevo usuario con consentimientos legales.
     */
    public function register(Request $request)
    {
        $fields = $request->validate([
            'username' => 'required|string|max:50|unique:users,username',
            'fullname' => 'required|string|max:100',
            'lastname' => 'nullable|string|max:100',
            'email' => 'nullable|email|unique:users,email',
            'password' => 'required|confirmed|min:8',
            'phone' => 'nullable|string|max:20',
            'role' => 'in:user,business,delivery',

            // Consentimientos legales
            'terms_accepted' => 'accepted',
            'privacy_accepted' => 'accepted',
            'age_verified' => 'required|boolean',
            'consent_data_usage' => 'accepted',
            'consent_marketing' => 'nullable|boolean',
        ]);

        $user = User::create([
            'username' => $fields['username'],
            'fullname' => $fields['fullname'],
            'lastname' => $fields['lastname'] ?? '',
            'email' => $fields['email'] ?? null,
            'password' => Hash::make($fields['password']),
            'phone' => $fields['phone'] ?? null,
            'role' => $fields['role'] ?? 'user',

            // Consentimientos legales
            'terms_accepted_at' => now(),
            'privacy_accepted_at' => now(),
            'age_verified' => $fields['age_verified'],
            'consent_data_usage' => true,
            'consent_marketing' => $fields['consent_marketing'] ?? false,
        ]);

        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'user' => $user,
            'token' => $token,
        ], 201);
    }

    /**
     * Login de usuario por email o username.
     */
    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ]);

        $user = User::where('username', $request->username)
                    ->orWhere('email', $request->username)
                    ->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            throw ValidationException::withMessages([
                'username' => ['Credenciales incorrectas.'],
            ]);
        }

        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'user' => $user,
            'token' => $token,
        ]);
    }

    /**
     * Logout (revoca token actual).
     */
    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();

        return response()->json([
            'message' => 'Sesión cerrada exitosamente.',
        ]);
    }

    /**
     * Obtener perfil del usuario autenticado.
     */
    public function me(Request $request)
    {
        return response()->json([
            'user' => $request->user(),
        ]);
    }
}
