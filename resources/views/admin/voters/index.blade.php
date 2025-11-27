@extends('layouts.app')

@section('content')
<div class="p-6 bg-white shadow rounded-lg">
    <div class="flex justify-between items-center mb-4">
        <h2 class="text-xl font-bold">Daftar Pemilih</h2>
        <a href="{{ route('data-pemilih.create') }}" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
            + Tambah Pemilih
        </a>
    </div>

    @if(session('success'))
        <div class="bg-green-100 text-green-700 p-3 rounded mb-4">{{ session('success') }}</div>
    @endif

    <table class="min-w-full border text-sm text-gray-700">
        <thead class="bg-gray-100">
            <tr>
                <th class="py-2 px-3 text-left">Nama Lengkap</th>
                <th class="py-2 px-3 text-left">NIM</th>
                <th class="py-2 px-3 text-left">Email</th>
                <th class="py-2 px-3 text-left">Fakultas</th>
                <th class="py-2 px-3 text-left">Jurusan</th>
                <th class="py-2 px-3 text-center">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($voters as $voter)
                <tr class="border-b hover:bg-gray-50">
                    <td class="py-2 px-3 font-semibold">{{ $voter->name }}</td>
                    <td class="py-2 px-3">{{ $voter->nim }}</td>
                    <td class="py-2 px-3">{{ $voter->email }}</td>
                    <td class="py-2 px-3">{{ $voter->faculty ?? '-' }}</td>
                    <td class="py-2 px-3">{{ $voter->major ?? '-' }}</td>
                    <td class="py-2 px-3 text-center">
                        <a href="{{ route('data-pemilih.edit', $voter) }}" class="px-3 py-2 bg-yellow-500 text-white rounded-md hover:bg-yellow-600 transition">Edit</a> 
                        <form action="{{ route('data-pemilih.destroy', $voter) }}" method="POST" class="inline" onsubmit="return confirm('Hapus pemilih ini?')">
                            @csrf
                            @method('DELETE')
                            <button type="button" class="btn-delete px-3 py-2 bg-red-600 text-white rounded-md hover:bg-red-700">
                                🗑️ Hapus
                            </button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="py-4 text-center text-gray-500">Belum ada data pemilih.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const deleteButtons = document.querySelectorAll('.btn-delete');
        
        deleteButtons.forEach(button => {
            button.addEventListener('click', function () {
                const form = this.closest('form');
                
                Swal.fire({
                    title: 'Yakin ingin menghapus?',
                    text: "Data ini tidak bisa dikembalikan!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#e3342f',
                    cancelButtonColor: '#6c757d',
                    confirmButtonText: 'Ya, hapus!',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit();
                    }
                });
            });
        });
    });
</script>
@endpush