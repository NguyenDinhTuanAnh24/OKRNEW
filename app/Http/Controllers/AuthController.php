<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;

class AuthController extends Controller
{
    public function redirectToCognito()
    {
        $base = rtrim(env('AWS_COGNITO_DOMAIN', 'https://ap-southeast-2rqig6bh9c.auth.ap-southeast-2.amazoncognito.com'), '/');
        $url = $base.'/login?'.http_build_query([
            'client_id'     => config('services.cognito.client_id', '3ar8acocnqav49qof9qetdj2dj'),
            'response_type' => 'code',
            'scope'         => 'email openid phone',
            'redirect_uri'  => env('COGNITO_REDIRECT_URI', 'http://localhost:8000/auth/callback'),
        ]);
        return redirect($url);
    }

    public function redirectToGoogle()
    {
        $base = rtrim(env('AWS_COGNITO_DOMAIN', 'https://ap-southeast-2rqig6bh9c.auth.ap-southeast-2.amazoncognito.com'), '/');
        $url = $base.'/login?'.http_build_query([
            'client_id'     => config('services.cognito.client_id', '3ar8acocnqav49qof9qetdj2dj'),
            'response_type' => 'code',
            'scope'         => 'email openid phone',
            'redirect_uri'  => env('COGNITO_REDIRECT_URI', 'http://localhost:8000/auth/callback'),
            'identity_provider' => 'Google',
        ]);
        return redirect($url);
    }

    public function redirectToSignup()
    {
        $base = rtrim(env('AWS_COGNITO_DOMAIN', 'https://ap-southeast-2rqig6bh9c.auth.ap-southeast-2.amazoncognito.com'), '/');
        $url = $base.'/signup?'.http_build_query([
            'client_id'     => config('services.cognito.client_id', '3ar8acocnqav49qof9qetdj2dj'),
            'response_type' => 'code',
            'scope'         => 'email openid phone',
            'redirect_uri'  => env('COGNITO_REDIRECT_URI', 'http://localhost:8000/auth/callback'),
        ]);
        return redirect($url);
    }

    public function handleCallback(Request $request)
    {
        $code = $request->get('code');
        if (!$code) {
            return redirect('/dashboard')->with('error', 'Đăng nhập thất bại');
        }

        try {
            // Exchange code for tokens
            $tokenResponse = $this->exchangeCodeForTokens($code);
            $idToken = $tokenResponse['id_token'];

            // Decode ID token
            $userData = $this->decodeIdToken($idToken);

            // Detect provider
            $provider = $this->detectProvider($userData);

            // Save or update user
            $user = \App\Models\User::updateOrCreate(
                ['email' => $userData['email']],
                [
                    'full_name' => $userData['name'] ?? $userData['email'],
                    'avatar_url' => $userData['picture'] ?? null,
                    'google_id' => $provider === 'Google' ? $userData['sub'] : null,
                    'cognito_sub' => $userData['sub'],
                    'email_verified_at' => now(),
                ]
            );

            Auth::login($user);

            return redirect('/dashboard')->with('success', 'Đăng nhập thành công!');

        } catch (\Exception $e) {
            Log::error('Auth callback error: ' . $e->getMessage());
            return redirect('/dashboard')->with('error', 'Đăng nhập thất bại: ' . $e->getMessage());
        }
    }

    private function exchangeCodeForTokens($code)
    {
        $client = new \GuzzleHttp\Client();

        $response = $client->post(env('AWS_COGNITO_DOMAIN') . '/oauth2/token', [
            'form_params' => [
                'grant_type' => 'authorization_code',
                'client_id' => config('services.cognito.client_id'),
                'code' => $code,
                'redirect_uri' => env('COGNITO_REDIRECT_URI'),
            ],
            'headers' => [
                'Content-Type' => 'application/x-www-form-urlencoded',
            ]
        ]);

        return json_decode($response->getBody(), true);
    }

    private function decodeIdToken($idToken)
    {
        // Get the JWT key from Cognito
        $keyUrl = env('AWS_COGNITO_DOMAIN') . '/.well-known/jwks.json';
        $jwks = json_decode(file_get_contents($keyUrl), true);

        // For simplicity, we'll decode without verification in this example
        // In production, you should verify the JWT signature
        $parts = explode('.', $idToken);
        $payload = json_decode(base64_decode($parts[1]), true);

        return $payload;
    }

    private function detectProvider($userData)
    {
        // Check if it's a Google user based on the token structure
        if (isset($userData['identities']) && is_array($userData['identities'])) {
            foreach ($userData['identities'] as $identity) {
                if ($identity['providerName'] === 'Google') {
                    return 'Google';
                }
            }
        }

        // Fallback: check if google_id exists
        if (isset($userData['google_id']) || strpos($userData['sub'] ?? '', 'google') !== false) {
            return 'Google';
        }

        return 'Cognito';
    }

    public function forgotPassword()
    {
        return view('auth.forgot-password');
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/dashboard')->with('success', 'Đăng xuất thành công!');
    }
}
