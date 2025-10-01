@extends('layouts.app')

@section('content')
<style>
    body {
        background: #f7fafc;
        font-family: 'Inter', Arial, sans-serif;
    }
    .main-container {
        max-width: 1200px;
        margin: 40px auto 0 auto;
        padding: 0 32px;
        position: relative;
    }
    .forms-flex {
        display: flex;
        gap: 40px;
        justify-content: center;
        align-items: flex-start;
        /* margin-top: 48px; */
        width: 100%;
    }
    .profile-card, .form-section {
        background: #fff;
        border-radius: 12px;
        box-shadow: 0 1px 4px 0 rgba(0,0,0,0.06);
        border: 1px solid #e5e7eb;
        padding: 32px 28px;
        flex: 1 1 0;
        min-width: 0;
        max-width: none;
        box-sizing: border-box;
        width: 100%;
        /* Make both forms equal width */
        display: flex;
        flex-direction: column;
        justify-content: flex-start;
    }
    .section-title {
        font-size: 1.5rem;
        font-weight: 600;
        color: #22223b;
        margin-bottom: 24px;
        text-align: center;
    }
    .profile-info {
        text-align: center;
        margin-bottom: 24px;
    }
    .profile-info .avatar {
        width: 96px;
        height: 96px;
        border-radius: 50%;
        margin: 0 auto 16px auto;
        object-fit: cover;
        background: #2563eb;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 2.2rem;
        color: #fff;
    }
    .profile-info h3 {
        font-size: 1.15rem;
        font-weight: 600;
        color: #22223b;
        margin-bottom: 4px;
    }
    .profile-info p {
        color: #6b7280;
        margin-bottom: 2px;
        font-size: 0.97rem;
    }
    form label {
        font-size: 1rem;
        font-weight: 500;
        color: #374151;
        margin-bottom: 6px;
        display: block;
    }
    form input[type="text"],
    form input[type="email"],
    form input[type="password"] {
        width: 100%;
        padding: 10px 14px;
        border: 1px solid #d1d5db;
        border-radius: 6px;
        font-size: 1rem;
        margin-bottom: 18px;
        transition: border 0.2s, box-shadow 0.2s;
        box-sizing: border-box;
    }
    form input[type="text"]:focus,
    form input[type="email"]:focus,
    form input[type="password"]:focus {
        border-color: #2563eb;
        box-shadow: 0 0 0 2px #bfdbfe;
    }
    .form-row {
        display: flex;
        gap: 18px;
        flex-wrap: wrap;
    }
    .form-row > div {
        flex: 1 1 45%;
        min-width: 120px;
    }
    .form-actions {
        display: flex;
        justify-content: center;
        margin-top: 24px;
    }
    .btn-primary {
        background: #2563eb;
        color: #fff;
        border: none;
        border-radius: 6px;
        padding: 10px 32px;
        font-size: 1rem;
        font-weight: 600;
        cursor: pointer;
        transition: background 0.2s;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        white-space: nowrap;
        min-width: 140px;
        max-width: 200px;
    }
    .btn-primary:hover {
        background: #1d4ed8;
    }
    .file-note {
        color: #6b7280;
        font-size: 0.95rem;
        margin-left: 10px;
    }
    .space-y-6 > * + * {
        margin-top: 18px !important;
    }
    @media (max-width: 1200px) {
        .main-container {
            max-width: 100vw;
            padding: 0 8px;
        }
        .forms-flex {
            gap: 20px;
        }
    }
    @media (max-width: 900px) {
        .forms-flex {
            flex-direction: column;
            align-items: stretch;
            gap: 32px;
        }
        .profile-card, .form-section {
            max-width: 100%;
        }
        .main-container {
            padding: 0 2px;
        }
    }
    @media (max-width: 600px) {
        .profile-card, .form-section {
            padding: 18px 6px;
        }
        .main-container {
            padding: 0 2px;
        }
        .back-btn {
            top: -6px;
            left: 0;
            font-size: 0.95rem;
            padding: 7px 12px;
        }
    }
    /* Prevent back-btn from overlapping forms */
    .back-btn {
        margin-bottom: 0;
        margin-top: 0;
    }
    .main-container {
        padding-top: 40px;
    }
</style>

<div class="main-container">
    <div class="forms-flex">
        <div class="profile-card">
            <!-- Success Message -->
            @if(session('success'))
                <div class="mb-4 bg-green-50 border border-green-200 rounded-md p-4">
                    <div class="flex">
                        <i class="fas fa-check-circle text-green-400"></i>
                        <div class="ml-3">
                            <p class="text-sm font-medium text-green-800">{{ session('success') }}</p>
                        </div>
                    </div>
                </div>
            @endif

            <h2 class="section-title">Hồ sơ cá nhân</h2>
            <div class="profile-info">
                @if($user->avatar_url)
                    <img src="{{ $user->avatar_url }}" alt="Avatar" class="avatar">
                @else
                    <div class="avatar">{{ substr($user->full_name ?? $user->email, 0, 1) }}</div>
                @endif
                <h3>{{ $user->full_name ?? 'Chưa cập nhật' }}</h3>
                <p>{{ $user->email }}</p>
                @if($user->job_title)
                    <p>{{ $user->job_title }}</p>
                @endif
            </div>
            <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-row">
                    <div>
                        <label for="full_name">Họ và tên</label>
                        <input type="text" id="full_name" name="full_name" value="{{ old('full_name', $user->full_name) }}" required>
                        @error('full_name')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label for="email">Email</label>
                        <input type="email" id="email" name="email" value="{{ old('email', $user->email) }}" required>
                        @error('email')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
                <div class="form-row">
                    <div>
                        <label for="phone">Số điện thoại</label>
                        <input type="text" id="phone" name="phone" value="{{ old('phone', $user->phone) }}">
                        @error('phone')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label for="job_title">Chức vụ</label>
                        <input type="text" id="job_title" name="job_title" value="{{ old('job_title', $user->job_title) }}">
                        @error('job_title')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
                <div>
                    <label for="avatar">Ảnh đại diện</label>
                    <div style="display: flex; align-items: center;">
                        <input type="file" id="avatar" name="avatar" accept="image/*" style="margin-bottom:0;">
                        <span class="file-note">JPG, PNG, GIF tối đa 2MB</span>
                    </div>
                    @error('avatar')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
                <div class="form-actions">
                    <button type="submit" class="btn-primary">
                        <span>Cập nhật</span>
                    </button>
                </div>
            </form>
        </div>

        <div class="form-section">
            <h2 class="section-title">Đổi mật khẩu</h2>
            @if ($errors->any())
                <div class="mb-4 bg-red-50 border border-red-200 rounded-md p-4">
                    <div class="flex">
                        <i class="fas fa-exclamation-triangle text-red-400"></i>
                        <div class="ml-3">
                            <p class="text-sm font-medium text-red-800">{{ $errors->first() }}</p>
                        </div>
                    </div>
                </div>
            @endif
            <form action="{{ route('change.password') }}" method="POST" class="space-y-6">
                @csrf
                <div>
                    <label for="old_password">Mật khẩu cũ</label>
                    <input type="password" id="old_password" name="old_password" required>
                    @error('old_password')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <label for="new_password">Mật khẩu mới</label>
                    <input type="password" id="new_password" name="new_password" required>
                    @error('new_password')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <label for="new_password_confirmation">Xác nhận mật khẩu mới</label>
                    <input type="password" id="new_password_confirmation" name="new_password_confirmation" required>
                </div>
                <div class="form-actions">
                    <button type="submit" class="btn-primary">
                        <span>Đổi mật khẩu</span>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection