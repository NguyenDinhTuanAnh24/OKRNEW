@extends('layouts.app')

@section('content')
<div class="container mx-auto flex flex-col items-center min-h-screen px-4">
    <div class="cycle-title flex justify-between items-center w-full max-w-4xl mb-12">
        <h1 class="text-4xl font-bold">Danh sách chu kỳ</h1>
        <a href="{{ route('cycles.create') }}" 
           class="btn btn-primary px-6 py-3 rounded-full text-lg font-semibold text-center">Tạo mới</a>
    </div>
    @if(session('success'))
        <div class="bg-green-100 text-green-700 p-4 rounded-lg mb-6 w-full max-w-4xl">
            {{ session('success') }}
        </div>
    @endif
    <div class="w-full gap-4 grid grid-temp">
        @foreach($cycles as $cycle)
        <a href="{{ route('cycles.show', $cycle) }}">
            <div class="bg-white rounded-sm flex justify-center items-center flex-col gap-4 border border-black w-200 h-200">
                <h3 class="">{{ $cycle->cycle_name }}</h3>
                <p class="">Trạng thái: {{ $cycle->status }}</p>
            </div>
        </a>
        @endforeach
    </div>
</div>
@endsection