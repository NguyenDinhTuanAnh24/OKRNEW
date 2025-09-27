<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Team OKR Dashboard</title>
    <!-- Tailwind CSS -->
    <link href="{{ asset('dist/output.css') }}" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets/css/app.css') }}">
</head>
<body class="bg-body-bg text-body-color dark:bg-dark-body-bg dark:text-dark-body-color transition-colors duration-300">
    <!-- Sidebar -->
    <div class="sidebar flex flex-col w-[250px] h-screen bg-sidebar-bg fixed top-0 left-0 p-[20px_0] border-r border-sidebar-border z-[1000] dark:bg-dark-sidebar-bg md:w-[60px] md:p-2">
        <div class="logo relative">
            <div class="user-info flex items-center mt-2.5">
                @php
                    $user = Auth::user();
                    $avatar = $user && $user->avatar_url ? asset($user->avatar_url) : asset('images/default.png');
                    $name = $user && $user->full_name ? $user->full_name : 'User';
                @endphp
                <img src="{{ $avatar }}" alt="Avatar" class="rounded-full w-[30px] h-[30px] mr-2.5 md:mr-0">
                <span class="text-sm font-medium text-sidebar-color md:hidden">{{ $name }}</span>
            </div>
            <div class="dropdown-menu absolute top-full left-2.5 hidden min-w-[160px] bg-white shadow-lg md:hidden">
                <a href="{{ route('dashboard') }}" class="block text-black p-2 no-underline hover:bg-body-bg">Hồ sơ / Trang của tôi</a>
                <a href="{{ route('auth.logout') }}" class="block text-black p-2 no-underline hover:bg-body-bg">Đăng xuất</a>
            </div>
        </div>
        <nav class="mt-5 flex-1">
            <a href="#" class="nav-item flex items-center p-[10px_20px] text-sidebar-color no-underline hover:bg-sidebar-hover-bg hover:text-body-color rounded md:p-1 md:justify-center">
                <i class="bi bi-house mr-2.5 md:mr-0"></i>
                <span class="text-sm md:hidden">Home</span>
            </a>
            <a href="#" class="nav-item flex items-center p-[10px_20px] text-sidebar-color no-underline hover:bg-sidebar-hover-bg hover:text-body-color rounded md:p-1 md:justify-center">
                <i class="bi bi-people mr-2.5 md:mr-0"></i>
                <span class="text-sm md:hidden">Team</span>
            </a>
            <a href="#" class="nav-item flex items-center p-[10px_20px] text-sidebar-color no-underline hover:bg-sidebar-hover-bg hover:text-body-color rounded md:p-1 md:justify-center">
                <i class="bi bi-bar-chart mr-2.5 md:mr-0"></i>
                <span class="text-sm md:hidden">Reports</span>
            </a>
            <a href="#" class="nav-item flex items-center p-[10px_20px] text-sidebar-color no-underline hover:bg-sidebar-hover-bg hover:text-body-color rounded md:p-1 md:justify-center">
                <i class="bi bi-gear mr-2.5 md:mr-0"></i>
                <span class="text-sm md:hidden">Settings</span>
            </a>
        </nav>
    </div>
</body>
</html>