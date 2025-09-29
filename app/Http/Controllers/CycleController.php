<?php

namespace App\Http\Controllers;
use App\Models\Cycle;

use Illuminate\Http\Request;

class CycleController extends Controller
{
    //
    public function index() {
        $cycles = Cycle::all();
        return view('cycles.index', compact('cycles'));
    }

    public function create() {
        return view('cycles.create');
    }

    public function store(Request $request) {
        $request->validate([
            'cycle_name' => 'required|string|max:255',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'status' => 'required|in:active,inactive',
            'description' => 'nullable|string',
        ]);

        Cycle::create($request->all());
        return redirect()->route('cycles.index')->with('success', 'Tạo chu kỳ thành công!').set_time_limit(300);
    }

    public function show(Cycle $cycle) {
        return view('cycles.show', compact('cycle'));
    }

    public function edit(Cycle $cycle) {
        return view('cycles.edit', compact('cycle'));
    }

    public function update(Request $request, Cycle $cycle) {
        $request->validate([
            'cycle_name' => 'required|string|max:255',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'status' => 'required|in:active,inactive',
            'description' => 'nullable|string',
        ]);

        $cycle->update($request->all());
        return redirect()->route('cycles.index')->with('success', 'Cập nhật chu kỳ thành công!').set_time_limit(300);
    }

    public function destroy(Cycle $cycle) {
        $cycle->delete();
        return redirect()->route('cycles.index')->with('success', 'Xóa chu kỳ thành công!').set_time_limit(300);
    }
}
