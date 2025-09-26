<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Team OKR Dashboard</title>
    <!-- Tailwind CSS from node_modules (compiled output) -->
    <link href="{{ asset('dist/output.css') }}" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="{{ asset('assets/css/app.css') }}" rel="stylesheet">
</head>
<body>
    <!-- Sidebar -->
    <div class="sidebar d-flex flex-column">
        <div class="logo">
            <div class="user-info">
                @php
                    $user = Auth::user();
                    $avatar = $user && $user->avatar_url ? asset($user->avatar_url) : asset('images/default.png');
                    $name = $user && $user->full_name ? $user->full_name : 'User';
                @endphp
                <img src="{{ $avatar }}" alt="Avatar" class="rounded-circle" width="30" height="30">
                {{ $name }}
            </div>
            <div class="dropdown-menu">
                <a href="{{ route('dashboard') }}">Hồ sơ / Trang của tôi</a>
                <a href="{{ route('auth.logout') }}">Đăng xuất</a>
            </div>
        </div>
        <a href="#" class="nav-item"><i class="bi bi-house"></i> Home</a>
        <a href="#" class="nav-item"><i class="bi bi-people"></i> Team</a>
        <a href="#" class="nav-item"><i class="bi bi-bar-chart"></i> Reports</a>
        <a href="#" class="nav-item"><i class="bi bi-gear"></i> Settings</a>
        
        <div class="flex-grow-1"></div>
    </div>

    <!-- Main Content -->
    <div class="main-content">
        @yield('content')
    </div>

    <!-- Bootstrap JS and Popper -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        // Theme Toggle Functionality
        document.addEventListener('DOMContentLoaded', function () {
            const themeToggle = document.getElementById('themeToggle');
            const body = document.body;
            const themeIcon = themeToggle.querySelector('i');

            // Load saved theme from localStorage
            const savedTheme = localStorage.getItem('theme') || 'dark';
            body.setAttribute('data-theme', savedTheme);
            updateThemeIcon(savedTheme);

            // Toggle theme on button click
            themeToggle.addEventListener('click', function () {
                const currentTheme = body.getAttribute('data-theme') === 'dark' ? 'light' : 'dark';
                body.setAttribute('data-theme', currentTheme);
                localStorage.setItem('theme', currentTheme);
                updateThemeIcon(currentTheme);
            });

            // Update icon based on theme
            function updateThemeIcon(theme) {
                themeIcon.className = theme === 'dark' ? 'bi bi-moon-stars-fill' : 'bi bi-sun-fill';
            }

            // Chart.js Initialization
            const ctx = document.getElementById('progressChart')?.getContext('2d');
            if (ctx) {
                new Chart(ctx, {
                    type: 'bar',
                    data: {
                        labels: {!! json_encode($chartData['labels'] ?? []) !!},
                        datasets: [{
                            label: 'Tiến độ OKR (%)',
                            data: {!! json_encode($chartData['data'] ?? []) !!},
                            backgroundColor: ['#0d6efd', '#198754', '#dc3545', '#ffc107', '#6f42c1'],
                            borderColor: ['#0a58ca', '#146c43', '#bb2d3b', '#ffca2c', '#582cb8'],
                            borderWidth: 1
                        }]
                    },
                    options: {
                        scales: {
                            y: {
                                beginAtZero: true,
                                max: 100,
                                ticks: { color: 'var(--main-content-color)' }
                            },
                            x: { ticks: { color: 'var(--main-content-color)' } }
                        },
                        plugins: {
                            legend: {
                                labels: { color: 'var(--main-content-color)' }
                            }
                        }
                    }
                });
            }
        });
    </script>
</body>
</html>