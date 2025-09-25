<!DOCTYPE html>
<html lang="vi">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Dashboard</title>
	<style>
		:root{
			/* màu chủ đạo theo ảnh (có thể đổi ở đây) */
			--brand:#ef6f70;          /* nền hero */
			--brand-dark:#e45f60;     /* hover/đậm hơn */
			--ink:#0b1320;           /* chữ đậm */
			--muted:#5b6474;         /* chữ phụ */
			--white:#ffffff;
			--nav-bg:#ffffff;
			--nav-border:#e7eaf0;
			--btn-primary:#ff7b7c;   /* nút nổi */
			--btn-primary-hover:#ff686a;
			--btn-ghost:#ffffff;
			--btn-ghost-text:#ef6f70;
			--btn-ghost-border:#ffd2d2;
			--card:#ffffff;
			--shadow:0 10px 30px rgba(0,0,0,.08);
		}
		*{box-sizing:border-box}
		html,body{margin:0;padding:0}
		body{
			font-family: ui-sans-serif,system-ui,-apple-system,Segoe UI,Roboto,Arial,sans-serif;
			background:#fafbff;color:var(--ink);
		}
		a{text-decoration:none}

		/* NAVBAR (full-width) */
		.nav-wrap{
			margin-left: calc(50% - 50vw);
			margin-right: calc(50% - 50vw);
			width: 100vw;
			background:var(--nav-bg);
			border-bottom:1px solid var(--nav-border);
		}
		.nav{
			max-width:1200px;margin:0 auto;display:flex;align-items:center;
			gap:22px;padding:14px 18px;
		}
		.brand{font-size:22px;font-weight:800;color:var(--ink)}
		.nav a.link{color:var(--ink);padding:10px 12px;border-radius:10px}
		.nav a.link:hover{background:#f5f7fb}
		.nav .right{margin-left:auto;display:flex;gap:10px}
		.btn{display:inline-flex;align-items:center;gap:8px;border-radius:10px;padding:10px 16px;font-weight:700}
		.btn-primary{background:var(--btn-primary);color:#fff;box-shadow:var(--shadow)}
		.btn-primary:hover{background:var(--btn-primary-hover)}
		.btn-ghost{background:var(--btn-ghost);color:var(--btn-ghost-text);border:1px solid var(--btn-ghost-border)}
		.btn-ghost:hover{background:#fff4f4}

		/* HERO */
		.hero{
			margin-left: calc(50% - 50vw);
			margin-right: calc(50% - 50vw);
			width: 100vw;
			background:var(--brand);
		}
		.hero-inner{
			max-width:1200px;margin:0 auto;padding:58px 18px 64px;display:grid;gap:32px;
			grid-template-columns:1.4fr 1fr;align-items:center;
		}
		@media (max-width:980px){ .hero-inner{grid-template-columns:1fr} }
		.kicker{color:#12336f;font-weight:800;letter-spacing:.2px;margin-bottom:14px}
		.h1{font-size:44px;line-height:1.15;margin:0 0 14px;color:#fff}
		.lead{color:#ffecec;max-width:60ch;margin:0 0 24px}
		.cta{display:flex;gap:14px;flex-wrap:wrap}
		.btn-invert{background:#fff;color:var(--brand);border:1px solid #ffd7d7;font-weight:800}
		.btn-invert:hover{background:#fff7f7}
		.btn-outline{background:transparent;color:#fff;border:2px solid #fff}
		.btn-outline:hover{background:rgba(255,255,255,.12)}
		.illus{
			background:var(--card);border-radius:18px;box-shadow:var(--shadow);
			min-height:360px;
			display:flex;align-items:center;justify-content:center;
		}
		.illus::after{
			content:"Hình minh hoạ";
			color:#a5adbb;font-weight:700;
		}

		/* CONTENT sau hero (logged in / more) */
		.container{max-width:1200px;margin:0 auto;padding:26px 18px}
		.card{
			background:var(--card);border-radius:16px;box-shadow:var(--shadow);padding:22px;
		}
		.row{display:grid;grid-template-columns:2fr 1fr;gap:24px}
		@media (max-width:980px){ .row{grid-template-columns:1fr} }

		.alert{margin-top:10px;font-weight:700}
		.alert.success{color:#16a34a}
		.alert.error{color:#dc2626}
		.info p{margin:8px 0}
	</style>
</head>
<body>

	<!-- NAV -->
	<div class="nav-wrap">
		<div class="nav">
			<div class="brand">OKR Platform</div>
			<a class="link" href="#">Về chúng tôi</a>
			<a class="link" href="#">Sản phẩm</a>
			<a class="link" href="#">Giải pháp</a>
			<a class="link" href="#">Kiến thức</a>
			<a class="link" href="#">Khách hàng</a>
			<div class="right">
				<a class="btn btn-ghost" href="#">Tư vấn 1:1</a>
				@auth
					<a class="btn btn-primary" href="{{ route('auth.logout') }}">Đăng xuất</a>
				@else
					<a class="btn btn-primary" href="{{ route('auth.redirect') }}">Đăng nhập</a>
				@endauth
			</div>
		</div>
	</div>

	@auth
		<!-- ĐÃ ĐĂNG NHẬP: hiển thị thông tin (chức năng giữ nguyên) -->
		<div class="container">
			<div class="card info">
				<div class="kicker">Đăng nhập thành công</div>
				<h2 style="margin:0 0 6px">Chào mừng đến Dashboard</h2>
				@if (session('success')) <div class="alert success">{{ session('success') }}</div> @endif
				@if (session('error'))   <div class="alert error">{{ session('error') }}</div>   @endif

				<p><strong>Email:</strong> {{ auth()->user()->email }}</p>
				<p><strong>Họ tên:</strong> {{ auth()->user()->full_name ?? 'Chưa cập nhật' }}</p>
				<p><strong>Số điện thoại:</strong> {{ auth()->user()->phone ?? 'Chưa cập nhật' }}</p>
				<p><strong>Chức vụ:</strong> {{ auth()->user()->job_title ?? 'Chưa cập nhật' }}</p>
				@if (auth()->user()->avatar_url)
					<p><img src="{{ auth()->user()->avatar_url }}" alt="Avatar" style="width:72px;height:72px;border-radius:50%;border:3px solid #ffe0e0"></p>
				@endif
				<div style="margin-top:12px">
					<a class="btn btn-primary" href="{{ route('auth.logout') }}">Đăng xuất</a>
				</div>
			</div>
		</div>
	@else
		<!-- CHƯA ĐĂNG NHẬP: hero theo ảnh -->
		<section class="hero">
			<div class="hero-inner">
				<div>
					<div class="kicker">CoDX > Không gian cộng tác số</div>
					<h1 class="h1">Phần mềm OKR quản lý mục tiêu – DEMO miễn phí cho doanh nghiệp</h1>
					<p class="lead">Thiết lập mục tiêu, theo dõi kết quả then chốt, phân bổ minh bạch và đo lường realtime. Đăng nhập Google qua AWS Cognito – an toàn, nhanh và chuẩn OAuth2.</p>
					<div class="cta">
						<a class="btn btn-invert" href="#">Yêu cầu DEMO</a>
						<a class="btn btn-outline" href="{{ route('auth.redirect') }}">Thuê ngay</a>
					</div>
				</div>
				<div class="illus"></div>
			</div>
		</section>

		<!-- Khối “More” + vùng nội dung thêm, vẫn giữ layout trang -->
		<div class="container">
			<div class="row">
				<div class="card">
					<h3 style="margin-top:0">Lợi ích nổi bật</h3>
					<ul style="margin:8px 0 0 18px;color:var(--muted)">
						<li>Liên kết mục tiêu công ty – phòng ban – cá nhân.</li>
						<li>Chu kỳ, check-in, bình luận, thông báo real-time.</li>
						<li>Báo cáo nâng cao và audit logs minh bạch.</li>
					</ul>
				</div>
				<div class="card">
					<h3 style="margin-top:0">More</h3>
					<p style="color:var(--muted)">Phân quyền, cộng tác, khuyến nghị OKR bằng AI…</p>
				</div>
			</div>

			@if (session('success')) <div class="alert success">{{ session('success') }}</div> @endif
			@if (session('error'))   <div class="alert error">{{ session('error') }}</div>   @endif
		</div>
	@endauth>

</body>
</html>
