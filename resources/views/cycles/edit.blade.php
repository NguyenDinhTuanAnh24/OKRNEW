@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Chỉnh sửa chu kỳ</h1>
    <form action="{{ route('cycles.update', $cycle) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label>Tên chu kỳ</label>
            <input type="text" name="cycle_name" class="form-control" value="{{ $cycle->cycle_name }}">
            @error('cycle_name') <div class="text-danger">{{ $message }}</div> @enderror
        </div>
        <div class="mb-3">
            <label>Ngày bắt đầu</label>
            <input type="date" name="start_date" class="form-control" value="{{ $cycle->start_date }}">
            @error('start_date') <div class="text-danger">{{ $message }}</div> @enderror
        </div>
        <div class="mb-3">
            <label>Ngày kết thúc</label>
            <input type="date" name="end_date" class="form-control" value="{{ $cycle->end_date }}">
            @error('end_date') <div class="text-danger">{{ $message }}</div> @enderror
        </div>
        <div class="mb-3">
            <label>Trạng thái</label>
            <select name="status" class="form-control">
                <option value="active" {{ $cycle->status == 'active' ? 'selected' : '' }}>Active</option>
                <option value="inactive" {{ $cycle->status == 'inactive' ? 'selected' : '' }}>Inactive</option>
            </select>
            @error('status') <div class="text-danger">{{ $message }}</div> @enderror
        </div>
        <div class="mb-3">
            <label>Mô tả</label>
            <textarea name="description" class="form-control">{{ $cycle->description }}</textarea>
            @error('description') <div class="text-danger">{{ $message }}</div> @enderror
        </div>
        <button type="submit" class="btn btn-success">Cập nhật</button>
        <a href="{{ route('cycles.index') }}" class="btn btn-secondary">Hủy</a>
    </form>
</div>
@endsection