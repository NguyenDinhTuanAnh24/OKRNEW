<!DOCTYPE html>
<html lang="vi">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Đăng nhập - OKR Platform</title>
	<style>
		:root {
			--primary-blue: #3b82f6;
			--primary-blue-dark: #2563eb;
			--text-primary: #1f2937;
			--text-secondary: #6b7280;
			--text-muted: #9ca3af;
			--border-light: #e5e7eb;
			--border-medium: #d1d5db;
			--white: #ffffff;
			--dark-blue: #1e3a8a;
			--dark-blue-light: #1e40af;
		}

		* {
			box-sizing: border-box;
			margin: 0;
			padding: 0;
		}

		body {
			font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
			background: #f8fafc;
			color: var(--text-primary);
			height: 100vh;
			overflow: hidden;
		}

		.container {
			display: flex;
			height: 100vh;
		}

		.left-panel {
			width: 40%;
			background: var(--white);
			display: flex;
			flex-direction: column;
			justify-content: center;
			padding: 3rem;
			position: relative;
		}

		.logo {
			width: 48px;
			height: 48px;
			background: var(--primary-blue);
			border-radius: 8px;
			display: flex;
			align-items: center;
			justify-content: center;
			margin-bottom: 2rem;
		}

		.logo::before {
			content: '|||';
			color: white;
			font-weight: bold;
			font-size: 18px;
			letter-spacing: 2px;
		}

		.form-title {
			font-size: 2.5rem;
			font-weight: 800;
			color: var(--text-primary);
			margin-bottom: 0.5rem;
		}

		.form-subtitle {
			font-size: 1.1rem;
			color: var(--text-secondary);
			margin-bottom: 2.5rem;
		}

		.btn-primary {
			width: 100%;
			background: var(--primary-blue);
			color: white;
			border: none;
			padding: 1rem;
			border-radius: 8px;
			font-size: 1rem;
			font-weight: 600;
			cursor: pointer;
			transition: background-color 0.2s;
			margin-bottom: 1rem;
			text-decoration: none;
			display: block;
			text-align: center;
		}

		.btn-primary:hover {
			background: var(--primary-blue-dark);
		}

		.btn-secondary {
			width: 100%;
			background: transparent;
			color: var(--primary-blue);
			border: 2px solid var(--primary-blue);
			padding: 1rem;
			border-radius: 8px;
			font-size: 1rem;
			font-weight: 600;
			cursor: pointer;
			transition: all 0.2s;
			margin-bottom: 1.5rem;
			text-decoration: none;
			display: block;
			text-align: center;
		}

		.btn-secondary:hover {
			background: var(--primary-blue);
			color: white;
		}

		.divider {
			display: flex;
			align-items: center;
			margin: 2rem 0;
		}

		.divider::before,
		.divider::after {
			content: '';
			flex: 1;
			height: 1px;
			background: var(--border-light);
		}

		.divider-text {
			padding: 0 1rem;
			color: var(--text-secondary);
			font-size: 0.9rem;
		}

		.google-btn {
			width: 100%;
			background: var(--white);
			color: var(--text-primary);
			border: 2px solid var(--border-medium);
			padding: 0.875rem;
			border-radius: 8px;
			font-size: 0.9rem;
			font-weight: 600;
			cursor: pointer;
			transition: all 0.2s;
			display: flex;
			align-items: center;
			justify-content: center;
			gap: 0.75rem;
			text-decoration: none;
		}

		.google-btn:hover {
			background: #f9fafb;
			border-color: var(--text-muted);
		}

		.register-link {
			text-align: center;
			margin-top: 2rem;
			color: var(--text-secondary);
		}

		.register-link a {
			color: var(--primary-blue);
			text-decoration: none;
			font-weight: 600;
		}

		.register-link a:hover {
			text-decoration: underline;
		}

		.right-panel {
			width: 60%;
			background: linear-gradient(135deg, var(--dark-blue) 0%, var(--dark-blue-light) 100%);
			position: relative;
			overflow: hidden;
		}

		.main-logo {
			position: absolute;
			top: 4rem;
			left: 50%;
			transform: translateX(-50%);
			width: 120px;
			height: 120px;
			background: rgba(255, 255, 255, 0.1);
			border-radius: 20px;
			display: flex;
			align-items: center;
			justify-content: center;
			backdrop-filter: blur(10px);
		}

		.main-logo::before {
			content: '|||';
			color: white;
			font-weight: bold;
			font-size: 48px;
			letter-spacing: 4px;
		}

		.floating-icons {
			position: absolute;
			top: 0;
			left: 0;
			right: 0;
			bottom: 0;
		}

		.floating-icon {
			position: absolute;
			width: 40px;
			height: 40px;
			background: rgba(255, 255, 255, 0.1);
			border-radius: 8px;
			display: flex;
			align-items: center;
			justify-content: center;
			color: white;
			font-size: 18px;
			backdrop-filter: blur(5px);
		}

		.floating-icon:nth-child(1) { top: 15%; left: 10%; }
		.floating-icon:nth-child(2) { top: 25%; right: 15%; }
		.floating-icon:nth-child(3) { top: 45%; left: 8%; }
		.floating-icon:nth-child(4) { top: 60%; right: 12%; }
		.floating-icon:nth-child(5) { top: 75%; left: 20%; }
		.floating-icon:nth-child(6) { top: 35%; right: 25%; }

		.cloud-bottom {
			position: absolute;
			bottom: 0;
			left: 0;
			right: 0;
			height: 100px;
			background: white;
			border-radius: 50% 50% 0 0 / 100% 100% 0 0;
		}

		@media (max-width: 768px) {
			.container {
				flex-direction: column;
			}
			.left-panel {
				width: 100%;
				height: 60%;
			}
			.right-panel {
				width: 100%;
				height: 40%;
			}
		}

		.alert {
			padding: 1rem;
			border-radius: 8px;
			margin-bottom: 1rem;
		}

		.alert-success {
			background: #d1fae5;
			color: #065f46;
			border: 1px solid #a7f3d0;
		}

		.alert-error {
			background: #fee2e2;
			color: #991b1b;
			border: 1px solid #fca5a5;
		}
	</style>
</head>
<body>
	<div class="container">
		<div class="left-panel">
			<div class="logo"></div>

			<h1 class="form-title">Đăng nhập</h1>
			<p class="form-subtitle">Chào mừng bạn. Đăng nhập để bắt đầu làm việc.</p>

			@if (session('success'))
				<div class="alert alert-success">{{ session('success') }}</div>
			@endif

			@if (session('error'))
				<div class="alert alert-error">{{ session('error') }}</div>
			@endif

			<a href="{{ route('auth.redirect') }}" class="btn-primary">
				Đăng nhập
			</a>

			<a href="{{ route('auth.register') }}" class="btn-secondary">
				Tạo tài khoản mới
			</a>

			<div class="divider">
				<span class="divider-text">Hoặc, đăng nhập thông qua Google</span>
			</div>

			<a href="{{ route('auth.google') }}" class="google-btn">
				<svg width="20" height="20" viewBox="0 0 24 24">
					<path fill="#4285F4" d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z"/>
					<path fill="#34A853" d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z"/>
					<path fill="#FBBC05" d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l2.85-2.22.81-.62z"/>
					<path fill="#EA4335" d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z"/>
				</svg>
				Đăng nhập với Google
			</a>

			<div class="register-link">
				Chưa có tài khoản? <a href="{{ route('auth.register') }}">Đăng ký ngay</a>
			</div>
		</div>

		<div class="right-panel">
			<div class="main-logo"></div>
			<div class="floating-icons">
				<div class="floating-icon">📊</div>
				<div class="floating-icon">📍</div>
				<div class="floating-icon">🎯</div>
				<div class="floating-icon">💼</div>
				<div class="floating-icon">W</div>
				<div class="floating-icon">⚡</div>
			</div>
			<div class="cloud-bottom"></div>
		</div>
	</div>
</body>
</html>
