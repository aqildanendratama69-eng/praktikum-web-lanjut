@extends('app')

@section('content')
<div class="max-w-4xl mx-auto py-8 px-4">
    <h2 class="text-2xl font-bold mb-6 text-gray-800">Manajemen Dokumen</h2>

    <div class="bg-white p-6 rounded-lg shadow-md border border-gray-200 mb-8">
        <form action="{{ url('/documentation') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 mb-1">Nama Dokumen</label>
                <input type="text" name="title" required 
                    class="w-full border border-gray-300 rounded-md p-2 focus:ring-2 focus:ring-blue-400 outline-none">
            </div>
            <div class="mb-6">
                <label class="block text-sm font-medium text-gray-700 mb-1">Pilih File</label>
                <input type="file" name="attachment" required 
                    class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">
            </div>
            <button type="submit" 
                class="bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-6 rounded-md transition duration-200">
                Upload Dokumen
            </button>
        </form>
    </div>

    <h3 class="text-xl font-semibold mb-4 text-gray-700">Daftar File</h3>
    <div class="grid gap-6">
        @forelse($files as $file)
            <div class="bg-white p-4 rounded-lg shadow-sm border border-gray-100">
                <div class="flex justify-between items-center mb-3">
                    <span class="font-bold text-gray-800">{{ $file->title }}</span>
                    <a href="{{ asset('storage/' . $file->file_path) }}" target="_blank" 
                       class="text-blue-600 hover:text-blue-800 text-sm font-semibold">
                       Buka Ukuran Penuh &rarr;
                    </a>
                </div>
                
                <div class="mt-2 overflow-hidden">
                    <img src="{{ asset('storage/' . $file->file_path) }}" 
                         alt="{{ $file->title }}" 
                         class="max-h-64 w-auto rounded border border-gray-200 shadow-sm">
                </div>
            </div>
        @empty
            <p class="text-gray-500 italic">Belum ada dokumen yang diunggah.</p>
        @endforelse
    </div>
</div>
@endsection