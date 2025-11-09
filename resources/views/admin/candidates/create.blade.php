@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto bg-white p-6 rounded-lg shadow">
    <h2 class="text-xl font-bold mb-4">Tambah Kandidat</h2>

    <form action="{{ route('candidates.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="mb-4">
            <label class="block mb-2 font-medium">Nama Kandidat</label>
            <input type="text" name="name" class="w-full border p-2 rounded" required>
        </div>

        <fieldset class="mb-4">
            <div class="font-medium mb-2">Upload Foto Kandidat</div>
            <div class="border-2 border-dashed border-gray-300 rounded-lg p-6 text-center cursor-pointer relative hover:border-blue-500 transition"
                 id="drop-area">
                <label for="photo" class="cursor-pointer block">
                    <svg class="mx-auto w-12 h-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M7 16V4m10 0v12M5 20h14M3 20a2 2 0 002 2h14a2 2 0 002-2H3z" />
                    </svg>
                    <p class="text-sm text-gray-600 mt-2">Drag & Drop atau <span class="text-blue-600 font-semibold">klik untuk unggah</span></p>
                    <input type="file" name="photo" id="photo" class="hidden" accept="image/*" required>
                </label>
                <img id="preview" class="mx-auto mt-4 max-h-40 hidden rounded">
            </div>
            @error('photo')
                <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </fieldset>

        <div class="mb-4">
            <label class="block mb-2 font-medium">Visi</label>
            <textarea name="visi" class="w-full border p-2 rounded" rows="3"></textarea>
        </div>

        <div class="mb-4">
            <label class="block mb-2 font-medium">Misi</label>
            <textarea name="misi" class="w-full border p-2 rounded" rows="3"></textarea>
        </div>

        <button class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">Simpan</button>
    </form>
</div>

<script>
    const input = document.getElementById('photo');
    const preview = document.getElementById('preview');
    const dropArea = document.getElementById('drop-area');

    input.addEventListener('change', function(e) {
        const file = e.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = () => {
                preview.src = reader.result;
                preview.classList.remove('hidden');
            };
            reader.readAsDataURL(file);
        }
    });

    dropArea.addEventListener('dragover', (e) => {
        e.preventDefault();
        dropArea.classList.add('border-blue-500');
    });

    dropArea.addEventListener('dragleave', () => {
        dropArea.classList.remove('border-blue-500');
    });

    dropArea.addEventListener('drop', (e) => {
        e.preventDefault();
        dropArea.classList.remove('border-blue-500');
        input.files = e.dataTransfer.files;
        const event = new Event('change');
        input.dispatchEvent(event);
    });
</script>
@endsection
