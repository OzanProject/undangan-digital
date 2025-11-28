@extends('layouts.admin')

@section('title', 'Manajemen User Admin')

@section('content')

    {{-- 1. HEADER & TOMBOL AKSI --}}
    <div class="flex flex-col md:flex-row justify-between items-center gap-4 mb-6">
        <div>
            <h2 class="text-xl font-bold text-slate-800">Daftar Akun Admin</h2>
            <p class="text-sm text-slate-500">Kelola akun yang dapat mengakses panel ini.</p>
        </div>
        
        <a href="{{ route('admin.users.create') }}" class="inline-flex items-center gap-2 px-5 py-2.5 bg-primary-600 text-white text-sm font-bold rounded-xl hover:bg-primary-700 shadow-lg shadow-primary-200 transition-all transform hover:-translate-y-0.5">
            <i class="bi bi-person-plus-fill text-lg"></i> <span>Tambah User Baru</span>
        </a>
    </div>

    {{-- Alert sukses bawaan Laravel (Dihapus karena diganti SweetAlert) --}}

    {{-- 2. TABEL DATA --}}
    <div class="bg-white rounded-2xl shadow-sm border border-slate-200 overflow-hidden">
        
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-slate-50 border-b border-slate-200 text-xs uppercase tracking-wider text-slate-500 font-bold">
                        <th class="px-6 py-4 w-16 text-center">No</th>
                        <th class="px-6 py-4">Nama</th>
                        <th class="px-6 py-4">Email</th>
                        <th class="px-6 py-4">Status</th>
                        <th class="px-6 py-4 text-center">Aksi</th>
                    </tr>
                </thead>

                <tbody class="divide-y divide-slate-100 text-sm text-slate-600">
                    @forelse($users as $user)
                    <tr class="hover:bg-slate-50/80 transition-colors group">
                        
                        <td class="px-6 py-4 text-center font-medium text-slate-400">
                            {{ $loop->iteration }}
                        </td>

                        <td class="px-6 py-4">
                            <div class="font-bold text-slate-800 text-base">{{ $user->name }}</div>
                        </td>

                        <td class="px-6 py-4">{{ $user->email }}</td>
                        
                        <td class="px-6 py-4">
                            <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-bold bg-primary-50 text-primary-700 border border-primary-200">
                                Admin
                            </span>
                        </td>

                        <td class="px-6 py-4">
                            <div class="flex items-center justify-center gap-2">
                                
                                {{-- Tombol Edit --}}
                                <a href="{{ route('admin.users.edit', $user->id) }}" 
                                   class="p-2 rounded-lg bg-amber-50 text-amber-600 hover:bg-amber-100 transition-colors border border-amber-200" 
                                   title="Edit User">
                                    <i class="bi bi-pencil-square text-lg"></i>
                                </a>

                                {{-- Tombol Hapus (Hanya jika bukan akun sendiri) --}}
                                @if(Auth::id() != $user->id)
                                    <button type="button" 
                                            onclick="confirmDelete('{{ $user->id }}')"
                                            class="p-2 rounded-lg bg-red-50 text-red-600 hover:bg-red-100 transition-colors border border-red-200" 
                                            title="Hapus">
                                        <i class="bi bi-trash text-lg"></i>
                                    </button>
                                @endif
                                
                                <form id="delete-form-{{ $user->id }}" action="{{ route('admin.users.destroy', $user->id) }}" method="POST" style="display: none;">
                                    @csrf @method('DELETE')
                                </form>
                            </div>
                        </td>

                    </tr>
                    @empty
                    <tr><td colspan="5" class="px-6 py-12 text-center text-slate-400">Belum ada akun user terdaftar.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- Pagination --}}
        @if($users->hasPages())
            <div class="px-6 py-4 border-t border-slate-200 bg-slate-50">
                {{ $users->links() }}
            </div>
        @endif

    </div>

    {{-- 3. SWEETALERT INTEGRATION --}}
    
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    {{-- Script 1: Notifikasi Sukses (Untuk Create/Update/Delete) --}}
    @if(session('success'))
    <script>
        const Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true,
            didOpen: (toast) => {
                toast.addEventListener('mouseenter', Swal.stopTimer)
                toast.addEventListener('mouseleave', Swal.resumeTimer)
            }
        });

        Toast.fire({
            icon: 'success',
            title: '{{ session('success') }}'
        });
    </script>
    @endif
    
    {{-- Script 2: Konfirmasi Hapus --}}
    <script>
        function confirmDelete(id) {
            Swal.fire({
                title: 'Hapus Akun User?', 
                text: "Akun akan dihapus permanen!", 
                icon: 'warning',
                showCancelButton: true, 
                confirmButtonColor: '#ef4444', 
                cancelButtonColor: '#64748b',
                confirmButtonText: 'Ya, Hapus!', 
                cancelButtonText: 'Batal', 
                customClass: { popup: 'rounded-2xl' }
            }).then((result) => { 
                if (result.isConfirmed) { 
                    document.getElementById('delete-form-' + id).submit(); 
                } 
            })
        }
    </script>
@endsection