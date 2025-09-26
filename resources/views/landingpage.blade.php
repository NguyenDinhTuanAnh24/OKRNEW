<!DOCTYPE html>
<html lang="vi">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>OKR | FOCUS - Welcome</title>
	<style>
		:root {
			--bg-primary: #ffffff;
			--bg-secondary: #2563eb;
			--bg-card: #333333;
			--text-primary: #ffffff;
			--text-secondary: #000000;
			--text-muted: #999999;
			--accent-green: #4ade80;
			--accent-blue: #3b82f6;
			--accent-orange: #f59e0b;
			--border: #404040;
			--shadow: 0 4px 6px rgba(0, 0, 0, 0.3);
		}

		* {
			box-sizing: border-box;
			margin: 0;
			padding: 0;
		}

		body {
			font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
			background: var(--bg-primary);
			color: var(--text-primary);
			line-height: 1.6;
		}

		/* Header */
		.header {
			background: var(--bg-secondary);
			border-bottom: 1px solid var(--border);
			padding: 1rem 2rem;
			display: flex;
			align-items: center;
			justify-content: space-between;
		}

		.logo {
			font-size: 1.5rem;
			font-weight: 800;
			color: var(--text-primary);
		}

		/* Login/Register buttons */
		.auth-buttons {
			display: flex;
			gap: 1rem;
		}

		.btn-login {
			background: var(--accent-green);
			color: white;
			padding: 0.75rem 1.5rem;
			border-radius: 8px;
			text-decoration: none;
			font-weight: 600;
			transition: background 0.2s;
		}

		.btn-login:hover {
			background: #22c55e;
		}

		.btn-register {
			background: transparent;
			background-color: #fb6e6e;
			color: var(--text-primary);
			border: 1px solid var(--border);
			padding: 0.75rem 1.5rem;
			border: none;
			border-radius: 8px;
			text-decoration: none;
			font-weight: 600;
			transition: background 0.2s;
		}

		.btn-register:hover {
			background: var(--bg-secondary);
			background-color: #f93f3f;
		}

		/* Responsive */
		@media (max-width: 768px) {
			.header {
				flex-direction: column;
				gap: 1rem;
			}
		}
	</style>
</head>
<body>
	<!-- Header -->
	<div class="header">
		<div class="logo">OKR | FOCUS</div>
		<div class="auth-buttons">
			<a href="{{ route('auth.login') }}" class="btn-login">Đăng nhập</a>
			<a href="{{ route('auth.register') }}" class="btn-register">Đăng ký</a>
		</div>
	</div>

	<!-- Landing page content -->
	<div style="text-align: center; padding: 4rem 2rem;">
		<h1 style="font-size: 3rem; margin-bottom: 1rem; color: var(--text-secondary);">OKR | FOCUS</h1>
		<p style="font-size: 1.2rem; color: var(--text-secondary); margin-bottom: 3rem; max-width: 600px; margin-left: auto; margin-right: auto;">
			Quản lý mục tiêu và kết quả then chốt một cách hiệu quả. Đăng nhập để bắt đầu sử dụng dashboard.
		</p>
		<div class="auth-buttons" style="justify-content: center;">
			<a href="{{ route('auth.login') }}" class="btn-login">Đăng nhập</a>
			<a href="{{ route('auth.register') }}" class="btn-register">Đăng ký</a>
		</div>
	</div>
</body>
</html>