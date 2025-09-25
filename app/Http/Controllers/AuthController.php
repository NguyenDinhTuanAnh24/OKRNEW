<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Aws\CognitoIdentityProvider\CognitoIdentityProviderClient;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    protected $cognitoClient;

    public function __construct()
    {
        $this->cognitoClient = new CognitoIdentityProviderClient([
            'region' => env('AWS_DEFAULT_REGION', 'ap-southeast-2'),
            'version' => 'latest',
            'credentials' => [
                'key' => env('AWS_ACCESS_KEY_ID'),
                'secret' => env('AWS_SECRET_ACCESS_KEY'),
            ],
        ]);
    }

    // Redirect đến Hosted UI của Cognito
    public function redirectToCognito()
    {
        $authorizeUrl = rtrim(env('AWS_COGNITO_DOMAIN', 'https://ap-southeast-2rqig6bh9c.auth.ap-southeast-2.amazoncognito.com'), '/').'/oauth2/authorize?' . http_build_query([
            'client_id'     => config('services.cognito.client_id', '3ar8acocnqav49qof9qetdj2dj'),
            'response_type' => 'code',
            'scope'         => 'openid email phone',
            'redirect_uri'  => env('COGNITO_REDIRECT_URI', 'http://localhost:8000/auth/callback'),
        ]);

        \Log::info("Redirect URL: " . $authorizeUrl); // Ghi log để debug

        return redirect($authorizeUrl);
    }

    // Xử lý callback từ Cognito
    public function handleCallback(Request $request)
    {
        $code = $request->query('code');
        if (!$code) {
            return redirect('/dashboard')->with('error', 'Đăng nhập thất bại');
        }

        $tokenUrl = rtrim(env('AWS_COGNITO_DOMAIN', 'https://ap-southeast-2rqig6bh9c.auth.ap-southeast-2.amazoncognito.com'), '/').'/oauth2/token?' . http_build_query([
            'grant_type'    => 'authorization_code',
            'client_id'     => config('services.cognito.client_id', '3ar8acocnqav49qof9qetdj2dj'),
            'code'          => $code,
            'redirect_uri'  => env('COGNITO_REDIRECT_URI', 'http://localhost:8000/auth/callback'),
        ]);

        \Log::info("Token URL: " . $tokenUrl); // Ghi log để debug
        \Log::info("Request Data: " . json_encode([
            'grant_type'    => 'authorization_code',
            'client_id'     => config('services.cognito.client_id', '3ar8acocnqav49qof9qetdj2dj'),
            'code'          => $code,
            'redirect_uri'  => env('COGNITO_REDIRECT_URI', 'http://localhost:8000/auth/callback'),
        ]));

        $response = \Http::asForm()->post(rtrim(env('AWS_COGNITO_DOMAIN', 'https://ap-southeast-2rqig6bh9c.auth.ap-southeast-2.amazoncognito.com'), '/').'/oauth2/token', [
            'grant_type'    => 'authorization_code',
            'client_id'     => config('services.cognito.client_id', '3ar8acocnqav49qof9qetdj2dj'),
            'code'          => $code,
            'redirect_uri'  => env('COGNITO_REDIRECT_URI', 'http://localhost:8000/auth/callback'),
        ]);

        if ($response->failed()) {
            \Log::error("Token request failed: " . $response->body());
            return redirect('/dashboard')->with('error', 'Lỗi lấy token: ' . $response->body());
        }

        $tokens = $response->json();
        \Log::info("Tokens received: " . json_encode($tokens)); // Debug tokens

        $idToken = $tokens['id_token'];

        try {
            $userInfo = \Firebase\JWT\JWT::decode($idToken, null, false);
            \Log::info("User Info decoded: " . json_encode((array)$userInfo)); // Debug user info
        } catch (\Exception $e) {
            \Log::error("JWT decode failed: " . $e->getMessage());
            return redirect('/dashboard')->with('error', 'Lỗi giải mã token: ' . $e->getMessage());
        }

        // Lưu hoặc cập nhật user vào DB
        try {
            $user = User::updateOrCreate(
                ['email' => $userInfo->email],
                [
                    'sub' => $userInfo->sub,
                    'full_name' => $userInfo->name ?? $userInfo->username ?? null,
                    'phone' => $userInfo->phone_number ?? null,
                    'job_title' => null,
                    'avatar_url' => $userInfo->picture ?? null,
                    'department_id' => null,
                    'role_id' => null,
                    'google_id' => $userInfo->google_id ?? null,
                ]
            );
            \Log::info("User saved/updated: " . $user->email);
        } catch (\Exception $e) {
            \Log::error("Database error: " . $e->getMessage());
            return redirect('/dashboard')->with('error', 'Lỗi lưu user: ' . $e->getMessage());
        }

        Auth::login($user);

        return redirect('/dashboard')->with('success', 'Đăng nhập thành công');
    }

    // Quên mật khẩu
    public function forgotPassword()
    {
        $forgotUrl = rtrim(env('AWS_COGNITO_DOMAIN', 'https://ap-southeast-2rqig6bh9c.auth.ap-southeast-2.amazoncognito.com'), '/').'/forgotPassword?' . http_build_query([
            'client_id' => config('services.cognito.client_id', '3ar8acocnqav49qof9qetdj2dj'),
            'response_type' => 'code',
            'scope' => 'email+openid+profile',
            'redirect_uri' => env('COGNITO_REDIRECT_URI', 'http://localhost:8000/auth/callback'),
        ]);

        \Log::info("Forgot Password URL: " . $forgotUrl);

        return redirect($forgotUrl);
    }

    // Đăng xuất
    public function logout()
    {
        $logoutUrl = rtrim(env('AWS_COGNITO_DOMAIN', 'https://ap-southeast-2rqig6bh9c.auth.ap-southeast-2.amazoncognito.com'), '/').'/logout?' . http_build_query([
            'client_id' => config('services.cognito.client_id', '3ar8acocnqav49qof9qetdj2dj'),
            'logout_uri' => env('COGNITO_REDIRECT_URI', 'http://localhost:8000/auth/callback'),
        ]);

        Auth::logout();
        return redirect($logoutUrl);
    }
}