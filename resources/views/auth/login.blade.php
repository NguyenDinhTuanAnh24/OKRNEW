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

		/* Left Panel - Login Form */
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

		.form-group {
			margin-bottom: 1.5rem;
		}

		.form-label {
			display: block;
			font-weight: 600;
			color: var(--text-primary);
			margin-bottom: 0.5rem;
		}

		.form-input {
			width: 100%;
			padding: 0.875rem 1rem;
			border: 2px solid var(--border-light);
			border-radius: 8px;
			font-size: 1rem;
			transition: border-color 0.2s;
		}

		.form-input:focus {
			outline: none;
			border-color: var(--primary-blue);
		}

		.form-input::placeholder {
			color: var(--text-muted);
		}

		.forgot-password {
			text-align: right;
			margin-top: 0.5rem;
		}

		.forgot-password a {
			color: var(--primary-blue);
			text-decoration: none;
			font-size: 0.9rem;
		}

		.forgot-password a:hover {
			text-decoration: underline;
		}

		.checkbox-group {
			display: flex;
			align-items: center;
			margin-bottom: 2rem;
		}

		.checkbox {
			width: 18px;
			height: 18px;
			margin-right: 0.75rem;
			accent-color: var(--primary-blue);
		}

		.checkbox-label {
			color: var(--text-secondary);
			font-size: 0.95rem;
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
			margin-bottom: 1.5rem;
		}

		.btn-primary:hover {
			background: var(--primary-blue-dark);
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
			gap: 0.5rem;
			text-decoration: none;
		}

		.google-btn:hover {
			background: #f9fafb;
			border-color: var(--text-muted);
		}

		.google-icon {
			width: 20px;
			height: 20px;
			background: #4285f4;
			color: white;
			border-radius: 4px;
			display: flex;
			align-items: center;
			justify-content: center;
			font-weight: bold;
			font-size: 14px;
		}

		/* Right Panel - Background */
		.right-panel {
			width: 60%;
			background: linear-gradient(135deg, var(--dark-blue) 0%, var(--dark-blue-light) 100%);
			position: relative;
			overflow: hidden;
		}

		.right-panel::before {
			content: '';
			position: absolute;
			top: 0;
			left: 0;
			right: 0;
			bottom: 0;
			background-image:
				radial-gradient(circle at 20% 20%, rgba(255,255,255,0.1) 0%, transparent 50%),
				radial-gradient(circle at 80% 80%, rgba(255,255,255,0.1) 0%, transparent 50%),
				radial-gradient(circle at 40% 60%, rgba(255,255,255,0.05) 0%, transparent 50%);
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

		/* Responsive */
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

		/* Alert messages */
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
		<!-- Left Panel - Login Form -->
		<div class="left-panel">
			<div class="logo"></div>

			<h1 class="form-title">Đăng nhập</h1>
			<p class="form-subtitle">Chào mừng trở lại. Đăng nhập để bắt đầu làm việc.</p>

			@if (session('success'))
				<div class="alert alert-success">{{ session('success') }}</div>
			@endif

			@if (session('error'))
				<div class="alert alert-error">{{ session('error') }}</div>
			@endif

			<form method="POST" action="{{ route('auth.redirect') }}">
				@csrf
				<div class="form-group">
					<label class="form-label" for="email">Email</label>
					<input type="email" id="email" name="email" class="form-input" placeholder="Email của bạn" required>
				</div>

				<div class="form-group">
					<label class="form-label" for="password">Mật khẩu</label>
					<input type="password" id="password" name="password" class="form-input" placeholder="Mật khẩu của bạn" required>
					<div class="forgot-password">
						<a href="{{ route('auth.forgot') }}">Quên mật khẩu?</a>
					</div>
				</div>

				<div class="checkbox-group">
					<input type="checkbox" id="remember" name="remember" class="checkbox" checked>
					<label for="remember" class="checkbox-label">Giữ tôi luôn đăng nhập</label>
				</div>

				<button type="submit" class="btn-primary">Đăng nhập</button>
			</form>

			<div class="divider">
				<span class="divider-text">Hoặc, đăng nhập thông qua Google</span>
			</div>

			<a href="{{ route('auth.google') }}" class="google-btn">
				<div class="google-icon">G</div>
				Đăng nhập bằng Google
			</a>
		</div>

		<!-- Right Panel - Background -->
		<div class="right-panel">
			<div class="main-logo"></div>

			<div class="floating-icons">
				<div class="floating-icon">��</div>
				<div class="floating-icon">��</div>
				<div class="floating-icon">��</div>
				<div class="floating-icon">📍</div>
				<div class="floating-icon">W</div>
				<div class="floating-icon">⚡</div>
			</div>

			<div class="cloud-bottom"></div>
		</div>
	</div>

</body>
</html>
