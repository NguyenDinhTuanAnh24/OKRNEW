@extends('layouts.app')

@section('content')
<div class="container">
    <h1>{{ $cycle->cycle_name }}</h1>
    <p><strong>Ngày bắt đầu:</strong> {{ $cycle->start_date }}</p>
    <p><strong>Ngày kết thúc:</strong> {{ $cycle->end_date }}</p>
    <p><strong>Trạng thái:</strong> {{ $cycle->status }}</p>
    <p><strong>Mô tả:</strong> {{ $cycle->description ?? 'Không có mô tả' }}</p>
    <a href="{{ route('objectives.create', ['cycle_id' => $cycle->cycle_id]) }}" 
        class="btn btn-action btn-action-edit px-4 py-2 rounded-lg text-sm font-semibold">Thêm Obj</a>

    <!-- Danh sách Objectives -->
    <div id="objectives-list" class="mt-6">
        @if($objectives->count() > 0)
            @foreach($objectives as $objective)
                <div class="bg-white dark:bg-[#161615] rounded-xl shadow p-6 mb-4">
                    <h2 class="text-xl font-semibold">{{ $objective->obj_title }}</h2>
                    <a href="{{ route('objectives.show', $objective->objective_id) }}" class="text-blue-500">View Details</a>
                </div>
            @endforeach
        @else
            <p class="text-center text-gray-500">No objectives found for this cycle.</p>
        @endif
    </div>
</div>
@endsection