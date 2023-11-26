<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Course;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $course = Course::all();
        return view('admin.course.index', compact('course'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.course.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string',
            'notes' => 'required|string',
            'desc' => 'required|string',
        ]);

        $course = Course::create($data);

        if ($course) {
            return redirect()->route('admin.course.index')->with('success', 'Berhasil Membuat Course');
        } else {
            return redirect()->route('admin.course.index')->with('error', 'Gagal Membuat Course');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $course = Course::find($id);

        return view('admin.course.edit', compact('course'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $data = $request->validate([
            'name' => 'required|string',
        ]);

        $course = Course::find($id);

        $course->update($data);

        if ($course) {
            return redirect()->route('admin.course.index')->with('success', 'Berhasil Mengupdate Course');
        } else {
            return redirect()->route('admin.course.index')->with('error', 'Gagal Mengupdate Course');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $course = Course::find($id);

        $course->delete();

        return redirect()->route('admin.course.index')->with('success', 'Berhasil menghapus');
    }
}
