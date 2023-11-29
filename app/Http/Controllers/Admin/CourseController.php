<?php

namespace App\Http\Controllers\Admin;

use App\Models\Link;
use App\Models\Mapels;
use App\Models\Course;
use App\Models\TahunAjaran;
use Illuminate\Http\Request;
use App\Models\Administrasi;
use App\Models\DescProgramBelajar;
use App\Http\Controllers\Controller;

class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $course = Course::all();
        $tahun_ajaran = TahunAjaran::get();
        return view('admin.course.index', compact('course', 'tahun_ajaran'));
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
            'notes.*' => 'nullable|string',
            'desc' => 'required',
        ]);

        $data['notes'] = $request->notes;

        $course = Course::create($data);

        if ($course) {
            $key = strtoupper(str_replace(' ', '', $course->name));
            $desc = DescProgramBelajar::create([
                'course_id' => $course->id,
                'title'     => $course->name,
                'keyword'   => $key,
                'desc'      => $request->desc,
            ]);

            $admin = Administrasi::create([
                'program_belajar' => 'Kursus',
                'amount'          => $request->amount,
                'course_id'       => $course->id,
                'id_tahunAjaran'  => TahunAjaran::latest()->where('status', 'Active')->first()->id,
            ]);

            if ($desc) {
                return redirect()->route('admin.course.index')->with('success', 'Berhasil Membuat Course');
            } else {
                dump($course);
                dd($desc);
            }
        } else {
            return redirect()->route('admin.course.index')->with('error', 'Gagal Membuat Course');
        }
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $course = Course::find($id);
        $mapels = Mapels::where('id_courses', $course->id)->latest()->get();
        $links = Link::where('id_courses', $course->id)->latest()->get();

        return view('admin.course.detail', compact('course', 'links', 'mapels'));
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
        $course = Course::find($id);

        $data = $request->validate([
            'name' => 'required|string',
            'notes.*' => 'nullable|string',
            'desc' => 'required',
        ]);

        $data['notes'] = $request->notes;

        $course->update($data);

        if ($course) {
            // dd($course);

            $descProgram = DescProgramBelajar::where('course_id', $course->id)->first();
            $key = strtoupper(str_replace(' ', '', $course->name));
            
            $desc = $descProgram->update([
                'title'     => $course->name,
                'keyword'   => $key,
                'desc'      => $request->desc,
            ]);

            $administrasi = Administrasi::where('course_id', $course->id)->first();

            $admin = $administrasi->update([
                'program_belajar' => 'Kursus',
                'amount'          => $request->amount,
                'id_tahunAjaran'  => TahunAjaran::latest()->where('status', 'Active')->first()->id,
            ]);

            if ($desc) {
                return redirect()->route('admin.course.index')->with('success', 'Berhasil Mengubah Course');
            } else {
                dump($course);
                dd($desc);
            }
        } else {
            return redirect()->route('admin.course.index')->with('error', 'Gagal Mengubah Course');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $course = Course::find($id);

        if ($course->descProgram) {
            $course->descProgram->delete();
        }

        if ($course->administrasi) {
            $course->administrasi->delete();
        }
        
        $course->delete();

        return redirect()->route('admin.course.index')->with('success', 'Berhasil menghapus');
    }
}
