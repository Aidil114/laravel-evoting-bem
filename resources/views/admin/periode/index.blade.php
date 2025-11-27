@extends('layouts.app')

@section('title', 'Pengaturan Periode')

@section('content')
<div class="bg-white p-6 rounded-xl shadow-sm">
    <div class="flex justify-between items-center mb-6">
        <h3 class="text-lg font-bold text-gray-800">📅 Pengaturan Periode</h3>
        <a href="{{ route('admin.periode.create') }}" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition">
            ➕ Tambah Periode
        </a>
    </div>

    @if(session('success'))
        <div class="mb-4 p-4 bg-green-100 text-green-800 rounded-md">
            {{ session('success') }}
        </div>
    @endif

    <div class="overflow-x-auto">
        <table class="min-w-full bg-white rounded-lg shadow-sm">
            <thead>
                <tr class="bg-gray-100 text-left text-sm text-gray-600 uppercase tracking-wider">
                    <th class="px-6 py-4">No</th>
                    <th class="px-6 py-4">Tanggal Mulai</th>
                    <th class="px-6 py-4">Tanggal Selesai</th>
                    <th class="px-6 py-4 text-center">Aktif?</th>
                    <th class="px-6 py-4 text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($periodes as $periode)
                <tr class="border-b">
                    <td class="px-6 py-4 text-gray-800">{{ $loop->iteration }}</td>
                    <td class="px-6 py-4">{{ \Carbon\Carbon::parse($periode->start_time)->format('d M Y H:i') }}</td>
                    <td class="px-6 py-4">{{ \Carbon\Carbon::parse($periode->end_time)->format('d M Y H:i') }}</td>
                    <td class="px-6 py-4">
                        @if($periode->status === 'aktif')
                            <span class="px-3 py-1 rounded-full text-xs bg-green-100 text-green-700 font-semibold">
                                Aktif
                            </span>
                        @elseif($periode->status === 'belum')
                            <span class="px-3 py-1 rounded-full text-xs bg-gray-100 text-gray-600 font-semibold">
                                Belum Dimulai
                            </span>
                        @else
                            <span class="px-3 py-1 rounded-full text-xs bg-red-100 text-red-700 font-semibold">
                                Selesai
                            </span>
                        @endif
                    </td>

                    <td class="px-6 py-4 flex items-center justify-center gap-2">
                        <a href="{{ route('admin.periode.edit', $periode->id) }}" 
                           class="px-3 py-2 bg-yellow-500 text-white rounded-md hover:bg-yellow-600 transition">
                            ✏️ Edit
                        </a>
                        <form action="{{ route('admin.periode.destroy', $periode->id) }}" method="POST" class="delete-form">
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
                    <td colspan="5" class="text-center text-gray-500 py-4">Belum ada periode ditambahkan.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
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
