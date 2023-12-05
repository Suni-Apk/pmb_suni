<?php

namespace App\Http\Controllers;

use App\Models\Document;
use App\Models\User;
use Illuminate\Http\Request;

class DocumentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $documents = Document::get();
        $users = User::get();
        return view('admin.dokumen.index', compact('documents', 'users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.dokumen.create');
    }

    public function verify(string $id)
    {
        $document = Document::find($id);
        return view('admin.dokumen.verify', compact('document'));
    }

    public function verify_process(Request $request, string $id)
    {
        $document = Document::find($id);
        $data = $request->status;

        if ($data == 'accept') {
            $document->update([
                'status' => $data
            ]);

            return redirect()->route('admin.document.verify');
        } else {
            return redirect()->back();
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
