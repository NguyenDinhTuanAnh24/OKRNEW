<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

class AuthController extends Controller
{
    // Redirect đến Hosted UI của Cognito
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

    // Redirect đến Google thông qua Cognito
    public function redirectToGoogle()
    {
        $base = rtrim(env('AWS_COGNITO_DOMAIN', 'https://ap-southeast-2rqig6bh9c.auth.ap-southeast-2.amazoncognito.com'), '/');
        $url = $base.'/login?'.http_build_query([
            'client_id'     => config('services.cognito.client_id', '3ar8acocnqav49qof9qetdj2dj'),
            'response_type' => 'code',
            'scope'         => 'email openid phone',
            'redirect_uri'  => env('COGNITO_REDIRECT_URI', 'http://localhost:8000/auth/callback'),
        ]);

        \Log::info("Google Redirect URL: " . $url);

        return redirect($url);
    }

    // Redirect đến trang đăng ký
    public function redirectToSignup()
    {
        $base = rtrim(env('AWS_COGNITO_DOMAIN', 'https://ap-southeast-2rqig6bh9c.auth.ap-southeast-2.amazoncognito.com'), '/');
        $url = $base.'/login?'.http_build_query([
            'client_id'     => config('services.cognito.client_id', '3ar8acocnqav49qof9qetdj2dj'),
            'response_type' => 'code',
            'scope'         => 'email openid phone',
            'redirect_uri'  => env('COGNITO_REDIRECT_URI', 'http://localhost:8000/auth/callback'),
        ]);

        \Log::info("Signup Redirect URL: " . $url);

        return redirect($url);
    }

    // Xử lý callback từ Cognito
    public function handleCallback(Request $request)
    {
        $code = $request->query('code');
        if (!$code) {
            return redirect('/dashboard')->with('error', 'Đăng nhập thất bại');
        }

        // Gửi yêu cầu lấy token
        $tokenUrl = rtrim(env('AWS_COGNITO_DOMAIN', 'https://ap-southeast-2rqig6bh9c.auth.ap-southeast-2.amazoncognito.com'), '/').'/oauth2/token';
        $requestData = [
            'grant_type'    => 'authorization_code',
            'client_id'     => config('services.cognito.client_id', '3ar8acocnqav49qof9qetdj2dj'),
            'code'          => $code,
            'redirect_uri'  => env('COGNITO_REDIRECT_URI', 'http://localhost:8000/auth/callback'),
        ];

        $clientSecret = env('AWS_COGNITO_CLIENT_SECRET');
        if ($clientSecret) {
            $requestData['client_secret'] = $clientSecret;
            \Log::info("Added client_secret to request");
        }

        $response = Http::asForm()->post($tokenUrl, $requestData);

        if ($response->failed()) {
            \Log::error("Token request failed: " . $response->body());
            return redirect('/dashboard')->with('error', 'Lỗi lấy token: ' . $response->body());
        }

        $tokens = $response->json();
        \Log::info("Tokens received: " . json_encode($tokens));

        // Lấy ID token (chứa thông tin người dùng)
        $idToken = $tokens['id_token'] ?? null;
        if (!$idToken) {
            return redirect('/dashboard')->with('error', 'Không tìm thấy ID token');
        }

        // Giải mã ID token để lấy thông tin
        $tokenParts = explode('.', $idToken);
        if (count($tokenParts) !== 3) {
            return redirect('/dashboard')->with('error', 'ID token không hợp lệ');
        }

        $payload = base64_decode(str_replace(['-', '_'], ['+', '/'], $tokenParts[1]));
        $userData = json_decode($payload, true);

        // Log toàn bộ thông tin từ token để debug
        \Log::info("Full user data from token: " . json_encode($userData, JSON_PRETTY_PRINT));

        $sub = $userData['sub'] ?? null;
        $email = $userData['email'] ?? null;
        $name = $userData['name'] ?? null;
        $picture = $userData['picture'] ?? null;

        if (!$sub || !$email) {
            return redirect('/dashboard')->with('error', 'Không thể lấy thông tin người dùng từ ID token');
        }

        // Xác định provider từ token data
        $provider = $this->detectProvider($userData);
        \Log::info("Detected provider: " . $provider);

        // Lưu vào database với thông tin đầy đủ
        $user = User::updateOrCreate(
            ['email' => $email],
            [
                'sub' => $sub,
                'email' => $email,
                'full_name' => $name,
                'phone' => null,
                'avatar_url' => $picture, // Lưu ảnh đại diện từ Google
                'google_id' => $provider === 'Google' ? $sub : null, // Lưu Google ID nếu đăng nhập từ Google
                'job_title' => null,
                'department_id' => null,
                'role_id' => null,
            ]
        );

        \Log::info("User saved/updated: " . $user->email . " via " . $provider);

        Auth::login($user);

        return redirect('/dashboard')->with('success', 'Đăng nhập thành công từ ' . $provider);
    }

    // Phát hiện provider từ token data
    private function detectProvider($userData)
    {
        // Kiểm tra các claim đặc trưng của từng provider
        if (isset($userData['identities'])) {
            foreach ($userData['identities'] as $identity) {
                if (isset($identity['providerName'])) {
                    return $identity['providerName'];
                }
            }
        }

        // Kiểm tra các claim khác để xác định provider
        if (isset($userData['aud']) && strpos($userData['aud'], 'google') !== false) {
            return 'Google';
        }

        if (isset($userData['aud']) && strpos($userData['aud'], 'facebook') !== false) {
            return 'Facebook';
        }

        // Kiểm tra nếu có thông tin từ Google trong token
        if (isset($userData['picture']) || isset($userData['given_name']) || isset($userData['family_name'])) {
            return 'Google';
        }

        return 'Cognito';
    }

    // Quên mật khẩu
    public function forgotPassword()
    {
        $forgotUrl = rtrim(env('AWS_COGNITO_DOMAIN', 'https://ap-southeast-2rqig6bh9c.auth.ap-southeast-2.amazoncognito.com'), '/').'/forgotPassword?' . http_build_query([
            'client_id' => config('services.cognito.client_id', '3ar8acocnqav49qof9qetdj2dj'),
            'response_type' => 'code',
            'scope' => 'email+openid',
            'redirect_uri' => env('COGNITO_REDIRECT_URI', 'http://localhost:8000/auth/callback'),
        ]);

        \Log::info("Forgot Password URL: " . $forgotUrl);

        return redirect($forgotUrl);
    }

    // Đăng xuất
    public function logout()
    {
        Auth::logout();
        return redirect('/dashboard')->with('success', 'Đăng xuất thành công!');
    }

    // Thêm method này vào AuthController
    public function redirectToGoogleDirect()
    {
        $url = 'https://accounts.google.com/o/oauth2/v2/auth/oauthchooseaccount?' . http_build_query([
            'client_id' => '291124312824-b9ud5185shpcist3fac89e18qoitkp0l.apps.googleusercontent.com',
            'redirect_uri' => 'https://ap-southeast-2rqig6bh9c.auth.ap-southeast-2.amazoncognito.com/oauth2/idpresponse',
            'scope' => 'profile email openid',
            'response_type' => 'code',
            'state' => 'H4sIAAAAAAAAAGWQW3ObMBCF_4uejS1sZC5vNG5i49hTjGJymUxGEgJkCwRCSWw6_e9Vpi_t9G3Pnm_O7pyfgIAIkM4Z1LupORmMM3_T6aZa0jpkYAKote-UqiS3glmxIDogTLG2Jx9e2Ksy7LkpTvPiZIHCArUxXTSbScWIrNVgogBCOCM2fmY3khJ2tiS3JFPFV2r594kKRC-AN0RIK1THW1HYoatVy8HrBJwtiy_DIxS73h_xY7wt1amP3aObBkEo6A6xe6y1yRpXmASzZJ331y5PxHHvbrYmHq-xwisfjU9Jp31xpO53ltwu5j7KBT4_OBDuN2_e8X07xEY7ux9Jtv72cMAy9-8P2YUHFH7iFK1vtTy0ebHCyN9zN73rno3h2cdYNTcZPq_c63N6qTsS29flf_3qXvypd_pVyvRfc0oaMqqWqaoVRk2ZamxGAyLXR0GAPLiAtg0QlUQOfAK0DS9C5jPCoENdVjqeh-xECuqUcxJ6JUXLZQjBr98Bno4M6QEAAA.H4sIAAAAAAAAAAEgAN__4MvsSU9bU6cYXlhnQJACcnG2_Y14tMRTtM5BE86S-8Cjj8l-IAAAAA.3',
            'access_type' => 'offline',
            'service' => 'lso',
            'o2v' => '2',
            'flowName' => 'GeneralOAuthFlow'
        ]);
        
        return redirect($url);
    }
}
