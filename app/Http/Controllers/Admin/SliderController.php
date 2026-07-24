<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Slider;

class SliderController extends Controller
{
    public function index()
    {
        $sliders = Slider::orderBy('sort_order')->get();
        return view('admin.sliders.index', compact('sliders'));
    }

    public function create()
    {
        return view('admin.sliders.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'image' => 'required|image'
        ]);

        $imagePath = $request->file('image')->store('sliders', 'public');

        Slider::create([
            'title' => $request->title,
            'image' => $imagePath,
            'link' => $request->link,
            'status' => $request->status ? true : false,
            'sort_order' => $request->sort_order ?? 0
        ]);

        return redirect()->route('admin.sliders.index')
            ->with('success', 'اسلاید ایجاد شد ✅');
    }

    public function edit(Slider $slider)
    {
        return view('admin.sliders.edit', compact('slider'));
    }

    public function update(Request $request, Slider $slider)
    {
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('sliders', 'public');
            $slider->image = $imagePath;
        }

        $slider->update([
            'title' => $request->title,
            'link' => $request->link,
            'status' => $request->status ? true : false,
            'sort_order' => $request->sort_order ?? 0
        ]);

        return redirect()->route('admin.sliders.index')
            ->with('success', 'اسلاید بروزرسانی شد ✅');
    }

    public function destroy(Slider $slider)
    {
        $slider->delete();
        return back()->with('success', 'اسلاید حذف شد ✅');
    }
}