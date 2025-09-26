<!DOCTYPE html>
<html lang="vi">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>OKR | FOCUS</title>
	<style>
		:root {
			/* Dark theme colors based on the image */
			--bg-primary: #1a1a1a;
			--bg-secondary: #2a2a2a;
			--bg-card: #333333;
			--text-primary: #ffffff;
			--text-secondary: #cccccc;
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

		.search-bar {
			display: flex;
			align-items: center;
			background: var(--bg-card);
			border: 1px solid var(--border);
			border-radius: 8px;
			padding: 0.5rem 1rem;
			width: 300px;
		}

		.search-bar input {
			background: transparent;
			border: none;
			color: var(--text-primary);
			outline: none;
			width: 100%;
			margin-left: 0.5rem;
		}

		.search-bar input::placeholder {
			color: var(--text-muted);
		}

		.header-right {
			display: flex;
			align-items: center;
			gap: 1rem;
		}

		.user-info {
			display: flex;
			align-items: center;
			gap: 0.5rem;
		}

		.icon {
			width: 24px;
			height: 24px;
			cursor: pointer;
			opacity: 0.7;
			transition: opacity 0.2s;
		}

		.icon:hover {
			opacity: 1;
		}

		/* Main Layout */
		.main-container {
			display: grid;
			grid-template-columns: 1fr 1fr 1fr;
			gap: 2rem;
			padding: 2rem;
			max-width: 1400px;
			margin: 0 auto;
		}

		/* Cards */
		.card {
			background: var(--bg-card);
			border-radius: 12px;
			padding: 1.5rem;
			border: 1px solid var(--border);
			box-shadow: var(--shadow);
		}

		.card-header {
			display: flex;
			align-items: center;
			justify-content: space-between;
			margin-bottom: 1.5rem;
		}

		.card-title {
			font-size: 1.1rem;
			font-weight: 600;
			color: var(--text-primary);
		}

		/* Left Column - My Objectives */
		.objective-item {
			margin-bottom: 1.5rem;
			padding: 1rem;
			background: var(--bg-secondary);
			border-radius: 8px;
			border: 1px solid var(--border);
		}

		.objective-title {
			font-weight: 600;
			margin-bottom: 0.5rem;
			color: var(--text-primary);
		}

		.progress-bar {
			width: 100%;
			height: 8px;
			background: var(--bg-primary);
			border-radius: 4px;
			overflow: hidden;
			margin: 0.5rem 0;
		}

		.progress-fill {
			height: 100%;
			background: var(--accent-green);
			transition: width 0.3s ease;
		}

		.progress-text {
			font-size: 0.9rem;
			color: var(--text-secondary);
			margin-top: 0.25rem;
		}

		/* Middle Column */
		.objective-card {
			background: var(--bg-secondary);
			border: 1px solid var(--border);
			border-radius: 8px;
			padding: 1rem;
			margin-bottom: 1rem;
		}

		.objective-card-title {
			font-weight: 600;
			margin-bottom: 0.5rem;
			color: var(--text-primary);
		}

		.btn {
			background: var(--accent-blue);
			color: white;
			border: none;
			padding: 0.5rem 1rem;
			border-radius: 6px;
			cursor: pointer;
			font-size: 0.9rem;
			transition: background 0.2s;
		}

		.btn:hover {
			background: #2563eb;
		}

		.btn-green {
			background: var(--accent-green);
		}

		.btn-green:hover {
			background: #22c55e;
		}

		/* Team Activity */
		.activity-item {
			display: flex;
			align-items: center;
			gap: 0.75rem;
			padding: 0.75rem 0;
			border-bottom: 1px solid var(--border);
		}

		.activity-item:last-child {
			border-bottom: none;
		}

		.activity-avatar {
			width: 32px;
			height: 32px;
			border-radius: 50%;
			background: var(--accent-blue);
			display: flex;
			align-items: center;
			justify-content: center;
			color: white;
			font-weight: 600;
			font-size: 0.8rem;
		}

		.activity-content {
			flex: 1;
		}

		.activity-name {
			font-weight: 600;
			color: var(--text-primary);
		}

		.activity-text {
			font-size: 0.9rem;
			color: var(--text-secondary);
		}

		.activity-time {
			font-size: 0.8rem;
			color: var(--text-muted);
		}

		/* Right Column - Chart */
		.chart-container {
			height: 200px;
			background: var(--bg-secondary);
			border-radius: 8px;
			display: flex;
			align-items: center;
			justify-content: center;
			margin-bottom: 1.5rem;
			position: relative;
		}

		.chart-line {
			position: absolute;
			bottom: 20px;
			left: 20px;
			right: 20px;
			height: 2px;
			background: linear-gradient(90deg, var(--accent-green) 0%, var(--accent-green) 75%, transparent 75%);
		}

		.chart-line::before {
			content: '';
			position: absolute;
			top: -4px;
			right: 0;
			width: 8px;
			height: 8px;
			background: var(--accent-green);
			border-radius: 50%;
		}

		/* Quick Actions */
		.quick-actions {
			display: flex;
			flex-direction: column;
			gap: 0.75rem;
		}

		.input-field {
			background: var(--bg-secondary);
			border: 1px solid var(--border);
			border-radius: 6px;
			padding: 0.75rem;
			color: var(--text-primary);
			outline: none;
		}

		.input-field::placeholder {
			color: var(--text-muted);
		}

		/* Responsive */
		@media (max-width: 1200px) {
			.main-container {
				grid-template-columns: 1fr 1fr;
			}
		}

		@media (max-width: 768px) {
			.main-container {
				grid-template-columns: 1fr;
			}

			.header {
				flex-direction: column;
				gap: 1rem;
			}

			.search-bar {
				width: 100%;
			}
		}

		/* Login/Register buttons for non-authenticated users */
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
			color: var(--text-primary);
			border: 1px solid var(--border);
			padding: 0.75rem 1.5rem;
			border-radius: 8px;
			text-decoration: none;
			font-weight: 600;
			transition: background 0.2s;
		}

		.btn-register:hover {
			background: var(--bg-secondary);
		}

		/* Profile dropdown */
		.profile {
			position: relative;
		}

		.profile summary {
			list-style: none;
			cursor: pointer;
			display: inline-flex;
			align-items: center;
			gap: 0.5rem;
		}

		.profile summary::-webkit-details-marker {
			display: none;
		}

		.avatar {
			width: 32px;
			height: 32px;
			border-radius: 50%;
			object-fit: cover;
		}

		.menu {
			position: absolute;
			right: 0;
			top: 48px;
			min-width: 200px;
			background: var(--bg-card);
			border: 1px solid var(--border);
			border-radius: 8px;
			box-shadow: var(--shadow);
			padding: 1rem;
			z-index: 50;
		}

		.menu .user-info {
			margin-bottom: 1rem;
		}

		.menu .name {
			font-weight: 600;
			color: var(--text-primary);
		}

		.menu .email {
			font-size: 0.9rem;
			color: var(--text-muted);
		}

		.menu .line {
			height: 1px;
			background: var(--border);
			margin: 0.75rem 0;
		}

		.menu a {
			display: block;
			padding: 0.5rem 0;
			color: var(--text-primary);
			text-decoration: none;
			transition: color 0.2s;
		}

		.menu a:hover {
			color: var(--accent-blue);
		}
	</style>
</head>
<body>

	<!-- Header -->
	<div class="header">
		<div class="logo">OKR | FOCUS</div>

		<div class="search-bar">
			<svg class="icon" fill="currentColor" viewBox="0 0 20 20">
				<path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd"></path>
			</svg>
			<input type="text" placeholder="Search">
		</div>

		<div class="header-right">
			@auth
				@php
					$avatar = auth()->user()->avatar_url ?: 'https://www.gravatar.com/avatar/'.md5(strtolower(trim(auth()->user()->email))).'?s=200&d=identicon';
				@endphp

				<svg class="icon" fill="currentColor" viewBox="0 0 20 20">
					<path d="M10 2a6 6 0 00-6 6v3.586l-.707.707A1 1 0 004 14h12a1 1 0 00.707-1.707L16 11.586V8a6 6 0 00-6-6zM10 18a3 3 0 01-3-3h6a3 3 0 01-3 3z"></path>
				</svg>

				<svg class="icon" fill="currentColor" viewBox="0 0 20 20">
					<path fill-rule="evenodd" d="M11.49 3.17c-.38-1.56-2.6-1.56-2.98 0a1.532 1.532 0 01-2.286.948c-1.372-.836-2.942.734-2.106 2.106.54.886.061 2.042-.947 2.287-1.561.379-1.561 2.6 0 2.978a1.532 1.532 0 01.947 2.287c-.836 1.372.734 2.942 2.106 2.106a1.532 1.532 0 012.287.947c.379 1.561 2.6 1.561 2.978 0a1.533 1.533 0 012.287-.947c1.372.836 2.942-.734 2.106-2.106a1.533 1.533 0 01.947-2.287c1.561-.379 1.561-2.6 0-2.978a1.532 1.532 0 01-.947-2.287c.836-1.372-.734-2.942-2.106-2.106a1.532 1.532 0 01-2.287-.947zM10 13a3 3 0 100-6 3 3 0 000 6z" clip-rule="evenodd"></path>
				</svg>

				<details class="profile">
					<summary>
						<img class="avatar" src="{{ $avatar }}" alt="avatar">
						<span>{{ auth()->user()->full_name ?? 'User' }}</span>
					</summary>
					<div class="menu">
						<div class="user-info">
							<img class="avatar" src="{{ $avatar }}" alt="avatar">
							<div>
								<div class="name">{{ auth()->user()->full_name ?? 'Chưa cập nhật' }}</div>
								<div class="email">{{ auth()->user()->email }}</div>
							</div>
						</div>
						<div class="line"></div>
						<a href="{{ route('dashboard') }}">Hồ sơ / Trang của tôi</a>
						<a href="{{ route('auth.logout') }}">Đăng xuất</a>
					</div>
				</details>
			@else
				<div class="auth-buttons">
					<a href="{{ route('auth.redirect') }}" class="btn-login">Đăng nhập</a>
					<a href="{{ route('auth.redirect') }}" class="btn-register">Đăng ký</a>
				</div>
			@endauth
		</div>
	</div>

	@auth
		<!-- Main Dashboard Content -->
		<div class="main-container">
			<!-- Left Column - My Objectives -->
			<div class="card">
				<div class="card-header">
					<h2 class="card-title">My Objectives</h2>
				</div>

				<div class="objective-item">
					<div class="objective-title">Increase Q4 Revenue</div>
					<div class="progress-bar">
						<div class="progress-fill" style="width: 75%"></div>
					</div>
					<div class="progress-text">75% Complete</div>
					<div style="font-size: 0.9rem; color: var(--text-muted); margin-top: 0.5rem;">
						Aclone SSM er ades (12112)<br>
						(LONG)219) - 3%
					</div>
				</div>

				<div class="objective-item">
					<div class="objective-title">Launch New Product Feature</div>
					<div class="progress-bar">
						<div class="progress-fill" style="width: 55%"></div>
					</div>
					<div class="progress-text">55% Complete</div>
					<div style="font-size: 0.9rem; color: var(--text-muted); margin-top: 0.5rem;">
						Releases SEM ar sales Etisan 38M/200)<br>
						(228) - 3%
					</div>
				</div>

				<div class="objective-item">
					<div class="objective-title">Improve Customer Satisfaction</div>
					<div class="progress-bar">
						<div class="progress-fill" style="width: 99%"></div>
					</div>
					<div class="progress-text">99% Complete</div>
					<div style="font-size: 0.9rem; color: var(--text-muted); margin-top: 0.5rem;">
						Refecse sopioot ladees by 20%)<br>
						(Abw288) - 65% ✓
					</div>
				</div>
			</div>

			<!-- Middle Column -->
			<div>
				<!-- Your Objectives -->
				<div class="card" style="margin-bottom: 2rem;">
					<div class="card-header">
						<h2 class="card-title">Your Objectives</h2>
						<svg class="icon" fill="currentColor" viewBox="0 0 20 20">
							<path d="M3 4a1 1 0 011-1h12a1 1 0 011 1v2a1 1 0 01-1 1H4a1 1 0 01-1-1V4zM3 10a1 1 0 011-1h6a1 1 0 011 1v6a1 1 0 01-1 1H4a1 1 0 01-1-1v-6zM14 9a1 1 0 00-1 1v6a1 1 0 001 1h2a1 1 0 001-1v-6a1 1 0 00-1-1h-2z"></path>
						</svg>
					</div>

					<div class="objective-card">
						<div class="objective-card-title">Upcoming Key Milestones</div>
						<button class="btn">View All</button>
					</div>

					<div class="objective-card">
						<div class="objective-card-title">Upcoming Milestones</div>
						<button class="btn">Review Code</button>
					</div>

					<div class="objective-card">
						<div class="objective-card-title">Design System Updates</div>
						<button class="btn">More Info</button>
					</div>
				</div>

				<!-- Team Activity Feed -->
				<div class="card">
					<div class="card-header">
						<h2 class="card-title">Team Activity Feed</h2>
						<svg class="icon" fill="currentColor" viewBox="0 0 20 20">
							<path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
						</svg>
					</div>

					<div class="activity-item">
						<div class="activity-avatar">AC</div>
						<div class="activity-content">
							<div class="activity-name">Alex Chen</div>
							<div class="activity-text">Completed Q4 Revenue objective</div>
							<div class="activity-time">2028 pen 3</div>
						</div>
					</div>

					<div class="activity-item">
						<div class="activity-avatar">SM</div>
						<div class="activity-content">
							<div class="activity-name">Sarah Miller</div>
							<div class="activity-text">Added new milestone</div>
							<div class="activity-time">$ new 8</div>
						</div>
					</div>

					<div class="activity-item">
						<div class="activity-avatar">JD</div>
						<div class="activity-content">
							<div class="activity-name">John Doe</div>
							<div class="activity-text">Updated progress report</div>
							<div class="activity-time">220 000 8</div>
						</div>
					</div>

					<div class="activity-item">
						<div class="activity-avatar">EM</div>
						<div class="activity-content">
							<div class="activity-name">Emma Wilson</div>
							<div class="activity-text">Reviewed team objectives</div>
							<div class="activity-time">3.00m 8</div>
						</div>
					</div>
				</div>
			</div>

			<!-- Right Column -->
			<div>
				<!-- Performance Chart -->
				<div class="card" style="margin-bottom: 2rem;">
					<div class="card-header">
						<h2 class="card-title">Performance Chart</h2>
					</div>
					<div class="chart-container">
						<div class="chart-line"></div>
						<div style="position: absolute; bottom: 10px; left: 10px; font-size: 0.8rem; color: var(--text-muted);">
							11 13 15 17 19
						</div>
						<div style="position: absolute; left: 10px; top: 10px; font-size: 0.8rem; color: var(--text-muted);">
							22<br>23<br>24<br>25
						</div>
					</div>
				</div>

				<!-- Quick Actions -->
				<div class="card">
					<div class="card-header">
						<h2 class="card-title">Quick Actions</h2>
					</div>

					<div class="quick-actions">
						<input type="text" class="input-field" placeholder="Add new objective">
						<button class="btn btn-green">Add New OKR</button>
						<button class="btn">View Chat</button>
					</div>
				</div>
			</div>
		</div>

		@if (session('success'))
			<div style="position: fixed; top: 20px; right: 20px; background: var(--accent-green); color: white; padding: 1rem; border-radius: 8px; z-index: 1000;">
				{{ session('success') }}
			</div>
		@endif

		@if (session('error'))
			<div style="position: fixed; top: 20px; right: 20px; background: #ef4444; color: white; padding: 1rem; border-radius: 8px; z-index: 1000;">
				{{ session('error') }}
			</div>
		@endif

	@else
		<!-- Landing page for non-authenticated users -->
		<div style="text-align: center; padding: 4rem 2rem;">
			<h1 style="font-size: 3rem; margin-bottom: 1rem; color: var(--text-primary);">OKR | FOCUS</h1>
			<p style="font-size: 1.2rem; color: var(--text-secondary); margin-bottom: 3rem; max-width: 600px; margin-left: auto; margin-right: auto;">
				Quản lý mục tiêu và kết quả then chốt một cách hiệu quả. Đăng nhập để bắt đầu sử dụng dashboard.
			</p>
			<div class="auth-buttons" style="justify-content: center;">
				<a href="{{ route('auth.redirect') }}" class="btn-login">Đăng nhập</a>
				<a href="{{ route('auth.redirect') }}" class="btn-register">Đăng ký</a>
			</div>
		</div>
	@endauth

</body>
</html>
