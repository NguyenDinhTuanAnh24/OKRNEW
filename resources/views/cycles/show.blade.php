@extends('layouts.app')

@section('content')
<div class="container">
    <h1>{{ $cycle->cycle_name }}</h1>
    <p><strong>Ngày bắt đầu:</strong> {{ $cycle->start_date }}</p>
    <p><strong>Ngày kết thúc:</strong> {{ $cycle->end_date }}</p>
    <p><strong>Trạng thái:</strong> {{ $cycle->status }}</p>
    <p><strong>Mô tả:</strong> {{ $cycle->description ?? 'Không có mô tả' }}</p>
    <a href="{{ route('cycles.index') }}" class="btn btn-primary">Quay lại</a>
</div>
@endsection