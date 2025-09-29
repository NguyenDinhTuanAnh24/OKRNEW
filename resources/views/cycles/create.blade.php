@extends('layouts.app')

@section('content')
<div class="container mx-auto flex flex-col items-center justify-center min-h-screen">
    <h1 class="text-2xl font-bold mb-6">Tạo chu kỳ mới</h1>
    <form action="{{ route('cycles.store') }}" method="POST" class="main-form w-[500px]">
        @csrf
        <div class="mb-4 flex items-center gap-4">
            <label for="cycle_name" class="w-32 font-semibold">Tên chu kỳ</label>
            <input type="text" name="cycle_name" id="cycle_name" 
                   class="form-control flex-1 rounded-full px-4 py-2 border-none focus:ring-2 focus:ring-[var(--bg-primary)]" 
                   value="{{ old('cycle_name') }}">
            @error('cycle_name') 
                <div class="text-red-500 text-sm mt-1">{{ $message }}</div> 
            @enderror
        </div>
        <div class="mb-4 flex items-center gap-4">
            <label for="start_date" class="w-32 font-semibold">Ngày bắt đầu</label>
            <input type="date" name="start_date" id="start_date" 
                   class="form-control flex-1 rounded-full px-4 py-2 border-none focus:ring-2 focus:ring-[var(--bg-primary)]" 
                   value="{{ old('start_date') }}">
            @error('start_date') 
                <div class="text-red-500 text-sm mt-1">{{ $message }}</div> 
            @enderror
        </div>
        <div class="mb-4 flex items-center gap-4">
            <label for="end_date" class="w-32 font-semibold">Ngày kết thúc</label>
            <input type="date" name="end_date" id="end_date" 
                   class="form-control flex-1 rounded-full px-4 py-2 border-none focus:ring-2 focus:ring-[var(--bg-primary)]" 
                   value="{{ old('end_date') }}">
            @error('end_date') 
                <div class="text-red-500 text-sm mt-1">{{ $message }}</div> 
            @enderror
        </div>
        <div class="mb-4 flex items-center gap-4">
            <label for="status" class="w-32 font-semibold">Trạng thái</label>
            <select name="status" id="status" 
                    class="form-control flex-1 rounded-full px-4 py-2 border-none focus:ring-2 focus:ring-[var(--bg-primary)]">
                <option value="active" {{ old('status') == 'active' ? 'selected' : '' }}>Active</option>
                <option value="inactive" {{ old('status') == 'inactive' ? 'selected' : '' }}>Inactive</option>
            </select>
            @error('status') 
                <div class="text-red-500 text-sm mt-1">{{ $message }}</div> 
            @enderror
        </div>
        <div class="mb-4 flex items-start gap-4">
            <label for="description" class="w-32 font-semibold">Mô tả</label>
            <textarea name="description" id="description" 
                      class="form-control flex-1 rounded-2xl px-4 py-2 border-none focus:ring-2 focus:ring-[var(--bg-primary)] min-h-[100px]">{{ old('description') }}</textarea>
            @error('description') 
                <div class="text-red-500 text-sm mt-1">{{ $message }}</div> 
            @enderror
        </div>
        <div class="flex justify-end gap-4">
            <button type="submit" class="btn btn-primary px-6 py-2 rounded-full">Lưu</button>
            <a href="{{ route('cycles.index') }}" class="btn btn-secondary px-6 py-2 rounded-full">Hủy</a>
        </div>
    </form>
</div>
@endsection