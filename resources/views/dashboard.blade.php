<!DOCTYPE html>
<html lang="vi">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>OKR | FOCUS</title>
	<style>
		:root {
			/* Color scheme đồng bộ với auth pages */
			--primary-blue: #3b82f6;
			--primary-blue-dark: #2563eb;
			--primary-blue-light: #dbeafe;
			--text-primary: #1f2937;
			--text-secondary: #6b7280;
			--text-muted: #9ca3af;
			--white: #ffffff;
			--dark-blue: #1e3a8a;
			--dark-blue-light: #1e40af;

			/* Dashboard specific colors */
			--bg-primary: #f8fafc;
			--bg-secondary: #ffffff;
			--bg-card: #ffffff;
			--accent-green: #10b981;
			--accent-orange: #f59e0b;
			--accent-red: #ef4444;
			--border-light: #e5e7eb;
			--border-medium: #d1d5db;
			--shadow: 0 1px 3px rgba(0, 0, 0, 0.1), 0 1px 2px rgba(0, 0, 0, 0.06);
			--shadow-lg: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
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
			background: var(--white);
			border-bottom: 1px solid var(--border-light);
			padding: 1rem 2rem;
			display: flex;
			align-items: center;
			justify-content: space-between;
			box-shadow: var(--shadow);
		}

		.logo {
			font-size: 1.5rem;
			font-weight: 800;
			color: var(--primary-blue);
			display: flex;
			align-items: center;
			gap: 0.5rem;
		}

		.logo::before {
			content: '|||';
			color: var(--white);
			background: var(--primary-blue);
			padding: 0.5rem;
			border-radius: 8px;
			font-size: 1rem;
			letter-spacing: 2px;
		}

		.search-bar {
			display: flex;
			align-items: center;
			background: var(--bg-primary);
			border: 1px solid var(--border-light);
			border-radius: 8px;
			padding: 0.5rem 1rem;
			width: 300px;
		}

		.search-bar input {
			border: none;
			background: transparent;
			outline: none;
			flex: 1;
			color: var(--text-primary);
		}

		.search-bar input::placeholder {
			color: var(--text-muted);
		}

		.header-actions {
			display: flex;
			align-items: center;
			gap: 1rem;
		}

		.icon-btn {
			width: 40px;
			height: 40px;
			border: none;
			background: var(--bg-primary);
			border-radius: 8px;
			display: flex;
			align-items: center;
			justify-content: center;
			cursor: pointer;
			transition: all 0.2s;
			color: var(--text-secondary);
		}

		.icon-btn:hover {
			background: var(--primary-blue-light);
			color: var(--primary-blue);
		}

		.user-menu {
			position: relative;
		}

		.user-avatar {
			width: 40px;
			height: 40px;
			border-radius: 50%;
			background: var(--primary-blue);
			display: flex;
			align-items: center;
			justify-content: center;
			color: var(--white);
			font-weight: 600;
			cursor: pointer;
			transition: all 0.2s;
		}

		.user-avatar:hover {
			background: var(--primary-blue-dark);
		}

		.dropdown {
			position: absolute;
			top: 100%;
			right: 0;
			background: var(--white);
			border: 1px solid var(--border-light);
			border-radius: 8px;
			box-shadow: var(--shadow-lg);
			min-width: 200px;
			z-index: 1000;
			display: none;
		}

		.dropdown.show {
			display: block;
		}

		.dropdown-item {
			padding: 0.75rem 1rem;
			color: var(--text-primary);
			text-decoration: none;
			display: block;
			transition: background-color 0.2s;
		}

		.dropdown-item:hover {
			background: var(--bg-primary);
		}

		.dropdown-divider {
			height: 1px;
			background: var(--border-light);
			margin: 0.5rem 0;
		}

		/* Main Content */
		.main-content {
			padding: 2rem;
			max-width: 1400px;
			margin: 0 auto;
		}

		.grid {
			display: grid;
			grid-template-columns: 2fr 1fr 1fr;
			gap: 2rem;
		}

		/* Cards */
		.card {
			background: var(--bg-card);
			border: 1px solid var(--border-light);
			border-radius: 12px;
			padding: 1.5rem;
			box-shadow: var(--shadow);
			transition: all 0.2s;
		}

		.card:hover {
			box-shadow: var(--shadow-lg);
		}

		.card-header {
			display: flex;
			align-items: center;
			justify-content: space-between;
			margin-bottom: 1.5rem;
		}

		.card-title {
			font-size: 1.25rem;
			font-weight: 700;
			color: var(--text-primary);
		}

		.card-icon {
			width: 24px;
			height: 24px;
			color: var(--text-muted);
		}

		/* Objective Cards */
		.objective-card {
			background: var(--bg-card);
			border: 1px solid var(--border-light);
			border-radius: 12px;
			padding: 1.5rem;
			margin-bottom: 1rem;
			box-shadow: var(--shadow);
			transition: all 0.2s;
		}

		.objective-card:hover {
			box-shadow: var(--shadow-lg);
			transform: translateY(-2px);
		}

		.objective-title {
			font-size: 1.1rem;
			font-weight: 600;
			color: var(--text-primary);
			margin-bottom: 1rem;
		}

		.progress-bar {
			width: 100%;
			height: 8px;
			background: var(--border-light);
			border-radius: 4px;
			overflow: hidden;
			margin-bottom: 0.5rem;
		}

		.progress-fill {
			height: 100%;
			background: var(--accent-green);
			border-radius: 4px;
			transition: width 0.3s ease;
		}

		.progress-text {
			font-size: 0.875rem;
			color: var(--text-secondary);
			font-weight: 500;
		}

		/* Milestone Items */
		.milestone-item {
			display: flex;
			align-items: center;
			justify-content: space-between;
			padding: 0.75rem 0;
			border-bottom: 1px solid var(--border-light);
		}

		.milestone-item:last-child {
			border-bottom: none;
		}

		.milestone-title {
			font-weight: 500;
			color: var(--text-primary);
		}

		.milestone-btn {
			background: var(--primary-blue);
			color: var(--white);
			border: none;
			padding: 0.5rem 1rem;
			border-radius: 6px;
			font-size: 0.875rem;
			font-weight: 500;
			cursor: pointer;
			transition: all 0.2s;
		}

		.milestone-btn:hover {
			background: var(--primary-blue-dark);
		}

		/* Activity Feed */
		.activity-item {
			display: flex;
			align-items: center;
			gap: 0.75rem;
			padding: 0.75rem 0;
			border-bottom: 1px solid var(--border-light);
		}

		.activity-item:last-child {
			border-bottom: none;
		}

		.activity-avatar {
			width: 32px;
			height: 32px;
			border-radius: 50%;
			background: var(--primary-blue);
			display: flex;
			align-items: center;
			justify-content: center;
			color: var(--white);
			font-size: 0.75rem;
			font-weight: 600;
		}

		.activity-content {
			flex: 1;
		}

		.activity-name {
			font-weight: 600;
			color: var(--text-primary);
			font-size: 0.875rem;
		}

		.activity-text {
			color: var(--text-secondary);
			font-size: 0.875rem;
		}

		/* Chart */
		.chart-container {
			height: 200px;
			display: flex;
			align-items: end;
			justify-content: space-between;
			padding: 1rem 0;
		}

		.chart-bar {
			background: var(--primary-blue);
			border-radius: 4px 4px 0 0;
			width: 20px;
			transition: all 0.3s ease;
		}

		.chart-bar:hover {
			background: var(--primary-blue-dark);
		}

		/* Quick Actions */
		.quick-input {
			width: 100%;
			padding: 0.75rem;
			border: 1px solid var(--border-light);
			border-radius: 8px;
			margin-bottom: 1rem;
			font-size: 0.875rem;
		}

		.quick-input:focus {
			outline: none;
			border-color: var(--primary-blue);
			box-shadow: 0 0 0 3px var(--primary-blue-light);
		}

		.action-btn {
			width: 100%;
			padding: 0.75rem;
			border: none;
			border-radius: 8px;
			font-weight: 600;
			cursor: pointer;
			transition: all 0.2s;
			margin-bottom: 0.5rem;
		}

		.btn-primary {
			background: var(--accent-green);
			color: var(--white);
		}

		.btn-primary:hover {
			background: #059669;
		}

		.btn-secondary {
			background: var(--primary-blue);
			color: var(--white);
		}

		.btn-secondary:hover {
			background: var(--primary-blue-dark);
		}

		/* Responsive */
		@media (max-width: 1024px) {
			.grid {
				grid-template-columns: 1fr;
			}
		}

		@media (max-width: 768px) {
			.header {
				padding: 1rem;
			}

			.search-bar {
				width: 200px;
			}

			.main-content {
				padding: 1rem;
			}

			.grid {
				gap: 1rem;
			}
		}

		/* Auth Section */
		.auth-section {
			text-align: center;
			padding: 4rem 2rem;
		}

		.auth-title {
			font-size: 2.5rem;
			font-weight: 800;
			color: var(--text-primary);
			margin-bottom: 1rem;
		}

		.auth-subtitle {
			font-size: 1.25rem;
			color: var(--text-secondary);
			margin-bottom: 2rem;
		}

		.auth-btn {
			display: inline-block;
			background: var(--primary-blue);
			color: var(--white);
			padding: 1rem 2rem;
			border-radius: 8px;
			text-decoration: none;
			font-weight: 600;
			transition: all 0.2s;
		}

		.auth-btn:hover {
			background: var(--primary-blue-dark);
			transform: translateY(-2px);
		}
	</style>
</head>
<body>
	@auth
		<!-- Header -->
		<header class="header">
			<div class="logo">OKR | FOCUS</div>

			<div class="search-bar">
				<svg class="card-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
					<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
				</svg>
				<input type="text" placeholder="Search">
			</div>

			<div class="header-actions">
				<button class="icon-btn">
					<svg width="20" height="20" fill="none" stroke="currentColor" viewBox="0 0 24 24">
						<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-5 5v-5zM4.5 19.5a2.5 2.5 0 01-2.5-2.5V6a2.5 2.5 0 012.5-2.5h15a2.5 2.5 0 012.5 2.5v11a2.5 2.5 0 01-2.5 2.5h-15z"></path>
					</svg>
				</button>
				<button class="icon-btn">
					<svg width="20" height="20" fill="none" stroke="currentColor" viewBox="0 0 24 24">
						<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path>
						<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
					</svg>
				</button>
				<button class="icon-btn">
					<svg width="20" height="20" fill="none" stroke="currentColor" viewBox="0 0 24 24">
						<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"></path>
					</svg>
				</button>

				<div class="user-menu">
					<div class="user-avatar" onclick="toggleDropdown()">
						{{ substr(Auth::user()->full_name ?? Auth::user()->email, 0, 1) }}
					</div>
					<div class="dropdown" id="userDropdown">
						<div class="dropdown-item">
							<strong>{{ Auth::user()->full_name ?? 'User' }}</strong><br>
							<small>{{ Auth::user()->email }}</small>
						</div>
						<div class="dropdown-divider"></div>
						<a href="#" class="dropdown-item">Hồ sơ / Trang của tôi</a>
						<a href="{{ route('auth.logout') }}" class="dropdown-item">Đăng xuất</a>
					</div>
				</div>
			</div>
		</header>

		<!-- Main Content -->
		<main class="main-content">
			<div class="grid">
				<!-- Left Column - My Objectives -->
				<div class="column">
					<div class="card">
						<div class="card-header">
							<h2 class="card-title">My Objectives</h2>
						</div>

						<div class="objective-card">
							<h3 class="objective-title">Increase Q4 Revenue</h3>
							<div class="progress-bar">
								<div class="progress-fill" style="width: 75%"></div>
							</div>
							<div class="progress-text">75% Complete</div>
						</div>

						<div class="objective-card">
							<h3 class="objective-title">Launch New Product Feature</h3>
							<div class="progress-bar">
								<div class="progress-fill" style="width: 55%"></div>
							</div>
							<div class="progress-text">55% Complete</div>
						</div>

						<div class="objective-card">
							<h3 class="objective-title">Improve Customer Satisfaction</h3>
							<div class="progress-bar">
								<div class="progress-fill" style="width: 99%"></div>
							</div>
							<div class="progress-text">99% Complete</div>
						</div>
					</div>
				</div>

				<!-- Middle Column -->
				<div class="column">
					<!-- Your Objectives -->
					<div class="card">
						<div class="card-header">
							<h2 class="card-title">Your Objectives</h2>
							<svg class="card-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
								<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
							</svg>
						</div>

						<div class="milestone-item">
							<span class="milestone-title">Upcoming Key Milestones</span>
							<button class="milestone-btn">View All</button>
						</div>

						<div class="milestone-item">
							<span class="milestone-title">Upcoming Milestones</span>
							<button class="milestone-btn">Review Code</button>
						</div>

						<div class="milestone-item">
							<span class="milestone-title">Design System Updates</span>
							<button class="milestone-btn">More Info</button>
						</div>
					</div>

					<!-- Team Activity Feed -->
					<div class="card">
						<div class="card-header">
							<h2 class="card-title">Team Activity Feed</h2>
							<svg class="card-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
								<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
							</svg>
						</div>

						<div class="activity-item">
							<div class="activity-avatar">AC</div>
							<div class="activity-content">
								<div class="activity-name">Alex Chen</div>
								<div class="activity-text">Completed Q4 Revenue objective</div>
							</div>
						</div>

						<div class="activity-item">
							<div class="activity-avatar">SM</div>
							<div class="activity-content">
								<div class="activity-name">Sarah Miller</div>
								<div class="activity-text">Added new milestone</div>
							</div>
						</div>

						<div class="activity-item">
							<div class="activity-avatar">JD</div>
							<div class="activity-content">
								<div class="activity-name">John Doe</div>
								<div class="activity-text">Updated progress report</div>
							</div>
						</div>
					</div>
				</div>

				<!-- Right Column -->
				<div class="column">
					<!-- Performance Chart -->
					<div class="card">
						<div class="card-header">
							<h2 class="card-title">Performance Chart</h2>
						</div>
						<div class="chart-container">
							<div class="chart-bar" style="height: 60%"></div>
							<div class="chart-bar" style="height: 80%"></div>
							<div class="chart-bar" style="height: 45%"></div>
							<div class="chart-bar" style="height: 90%"></div>
							<div class="chart-bar" style="height: 70%"></div>
						</div>
					</div>

					<!-- Quick Actions -->
					<div class="card">
						<div class="card-header">
							<h2 class="card-title">Quick Actions</h2>
						</div>
						<input type="text" class="quick-input" placeholder="Add new objective">
						<button class="action-btn btn-primary">Add New OKR</button>
						<button class="action-btn btn-secondary">View Chat</button>
					</div>
				</div>
			</div>
		</main>
	@else
		<!-- Landing Page for non-authenticated users -->
		<div class="auth-section">
			<h1 class="auth-title">OKR | FOCUS</h1>
			<p class="auth-subtitle">Quản lý mục tiêu và kết quả chính của bạn một cách hiệu quả</p>
			<a href="{{ route('auth.login') }}" class="auth-btn">Đăng nhập để bắt đầu</a>
		</div>
	@endauth

	<script>
		function toggleDropdown() {
			const dropdown = document.getElementById('userDropdown');
			dropdown.classList.toggle('show');
		}

		// Close dropdown when clicking outside
		document.addEventListener('click', function(event) {
			const dropdown = document.getElementById('userDropdown');
			const userAvatar = document.querySelector('.user-avatar');

			if (!userAvatar.contains(event.target)) {
				dropdown.classList.remove('show');
			}
		});
	</script>
</body>
</html>
