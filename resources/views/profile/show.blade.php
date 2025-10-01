@extends('layouts.app')

@section('content')

    <!-- Main Content -->
    <div class="max-w-4xl mx-auto py-8 px-4 sm:px-6 lg:px-8">
        <div class="bg-white rounded-lg shadow-sm border p-6">
            <!-- Header -->
            <!-- Success Message -->
            @if(session('success'))
                <div class="mb-6 bg-green-50 border border-green-200 rounded-md p-4">
                    <div class="flex">
                        <i class="fas fa-check-circle text-green-400"></i>
                        <div class="ml-3">
                            <p class="text-sm font-medium text-green-800">{{ session('success') }}</p>
                        </div>
                    </div>
                </div>
            @endif

            <!-- Section 1: Profile Update -->
            <div>
                <h2 class="section-title ">Hồ sơ cá nhân</h2>
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                    <!-- Profile Info -->
                    <div class="lg:col-span-1">
                        <div class="bg-white rounded-lg shadow-sm border p-6">
                            <div class="text-center  flex flex-col items-center justify-center">
                                @if($user->avatar_url)
                                    <img src="{{ $user->avatar_url }}" alt="Avatar" class="w-24 h-24 rounded-full mx-auto mb-4">
                                @else
                                    <div class="w-24 h-24 bg-blue-600 rounded-full mx-auto mb-4 flex items-center justify-center">
                                        <span class="text-white text-2xl font-medium">{{ substr($user->full_name ?? $user->email, 0, 1) }}</span>
                                    </div>
                                @endif
                                <h3 class="text-lg font-medium text-gray-900">{{ $user->full_name ?? 'Chưa cập nhật' }}</h3>
                                <p class="text-gray-500 w-150 flex items-center justify-center">{{ $user->email }}</p>
                                @if($user->job_title)
                                    <p class="text-sm text-gray-600 mt-1">{{ $user->job_title }}</p>
                                @endif
                            </div>
                        </div>
                    </div>

                    <!-- Edit Form -->
                    <div class="lg:col-span-2">
                        <div class="bg-white rounded-lg shadow-sm border">
                            <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data" class="p-6">
                                @csrf
                                
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                    <!-- Full Name -->
                                    <div>
                                        <label for="full_name" class="block text-sm font-medium text-gray-700 mb-2">Họ và tên</label>
                                        <input type="text" 
                                               id="full_name" 
                                               name="full_name" 
                                               value="{{ old('full_name', $user->full_name) }}"
                                               class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                               required>
                                        @error('full_name')
                                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <!-- Email -->
                                    <div>
                                        <label for="email" class="block text-sm font-medium text-gray-700 mb-2">Email</label>
                                        <input type="email" 
                                               id="email" 
                                               name="email" 
                                               value="{{ old('email', $user->email) }}"
                                               class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                               required>
                                        @error('email')
                                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <!-- Phone -->
                                    <div>
                                        <label for="phone" class="block text-sm font-medium text-gray-700 mb-2">Số điện thoại</label>
                                        <input type="text" 
                                               id="phone" 
                                               name="phone" 
                                               value="{{ old('phone', $user->phone) }}"
                                               class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                                        @error('phone')
                                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <!-- Job Title -->
                                    <div>
                                        <label for="job_title" class="block text-sm font-medium text-gray-700 mb-2">Chức vụ</label>
                                        <input type="text" 
                                               id="job_title" 
                                               name="job_title" 
                                               value="{{ old('job_title', $user->job_title) }}"
                                               class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                                        @error('job_title')
                                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>

                                <!-- Avatar Upload -->
                                <div class="mt-6">
                                    <label for="avatar" class="block text-sm font-medium text-gray-700 mb-2">Ảnh đại diện</label>
                                    <div class="flex items-center space-x-4">
                                        <input type="file" 
                                               id="avatar" 
                                               name="avatar" 
                                               accept="image/*"
                                               class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">
                                        <p class="text-sm text-gray-500">JPG, PNG, GIF tối đa 2MB</p>
                                    </div>
                                    @error('avatar')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- Submit Button -->
                                <div class="mt-8 flex justify-end space-x-3">
                                    <a href="{{ route('dashboard') }}" 
                                       class="px-4 py-2 border border-gray-300 rounded-md text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-blue-500">
                                        Hủy
                                    </a>
                                    <button type="submit" 
                                            class="px-4 py-2 bg-blue-600 border border-transparent rounded-md text-sm font-medium text-white hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500">
                                        <i class="fas fa-save mr-2"></i>Cập nhật
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Separator -->
            <div class="my-6 mx-6 text-center">
                <hr class="border-t border-gray-200">
                <hr class="border-t border-gray-200">
            </div>

            <!-- Section 2: Change Password -->
            <div>
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
                <form action="{{ route('change.password') }}" method="POST" class="space-y-6 p-6 bg-white rounded-lg shadow-sm border">
                    @csrf
                    <div>
                        <label for="old_password" class="block text-sm font-medium text-gray-700 mb-2">Mật khẩu cũ</label>
                        <input type="password" 
                               id="old_password" 
                               name="old_password" 
                               class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                               required>
                        @error('old_password')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label for="new_password" class="block text-sm font-medium text-gray-700 mb-2">Mật khẩu mới</label>
                        <input type="password" 
                               id="new_password" 
                               name="new_password" 
                               class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                               required>
                        @error('new_password')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label for="new_password_confirmation" class="block text-sm font-medium text-gray-700 mb-2">Xác nhận mật khẩu mới</label>
                        <input type="password" 
                               id="new_password_confirmation" 
                               name="new_password_confirmation" 
                               class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                               required>
                    </div>
                    <div class="flex justify-end space-x-3">
                        <button type="submit" 
                                class="px-4 py-2 bg-blue-600 border border-transparent rounded-md text-sm font-medium text-white hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500">
                            <i class="fas fa-lock mr-2"></i>Đổi mật khẩu
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        function toggleDropdown() {
            const dropdown = document.getElementById('userDropdown');
            dropdown.classList.toggle('hidden');
        }

        // Close dropdown when clicking outside
        document.addEventListener('click', function(event) {
            const dropdown = document.getElementById('userDropdown');
            const button = event.target.closest('button');
            
            if (!button || !button.onclick || button.onclick.toString().indexOf('toggleDropdown') === -1) {
                dropdown.classList.add('hidden');
            }
        });
    </script>

@endsection