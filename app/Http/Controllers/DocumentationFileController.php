<?php

namespace App\Http\Controllers;

use App\Models\DocumentationFile;
use Illuminate\Http\Request;

class DocumentationFileController extends Controller
{
    public function index()
    {
        $files = DocumentationFile::latest()->get();
        // Pastikan nama ini sesuai dengan nama file di folder resources/views
        return view('documentation_files', compact('files'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:100',
            'attachment' => 'required|file|max:5120',
        ]);

        $file = $request->file('attachment');
        $path = $file->store('uploads', 'public');

        DocumentationFile::create([
            'title' => $request->title,
            'file_path' => $path,
            'file_type' => $file->getClientOriginalExtension(),
        ]);
        
        return redirect()->back()->with('success', 'File berhasil diunggah!');
    }
}