@extends('layouts.admin')

@section('title', 'Edit Hiburan')

@section('content')

    {{-- CDN SweetAlert2 --}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    {{-- ALERT SUKSES --}}
    @if(session('success'))
    <script>
        Swal.fire({
            icon: 'success',
            title: 'Berhasil!',
            text: '{{ session("success") }}',
            timer: 2000,
            showConfirmButton: false
        });
    </script>
    @endif

<div class="max-w-2xl mx-auto">
    {{-- Header --}}
    <div class="mb-6 flex items-center justify-between">
        <h1 class="text-2xl font-bold text-slate-800">Edit Data Hiburan</h1>
        <a href="{{ route('admin.entertainments.index') }}" class="text-sm font-semibold text-slate-500 hover:text-primary-600 transition-colors">
            <i class="bi bi-arrow-left me-1"></i> Kembali
        </a>
    </div>

    {{-- Form Card --}}
    <div class="bg-white rounded-2xl shadow-sm border border-slate-200 overflow-hidden">
        <form action="{{ route('admin.entertainments.update', $entertainment->id) }}" method="POST" enctype="multipart/form-data" class="p-8 space-y-6">
            @csrf
            @method('PUT') 

            {{-- Nama --}}
            <div>
                <label class="block text-sm font-bold text-slate-600 mb-2">Nama Pengisi Acara</label>
                <input type="text" name="name" value="{{ old('name', $entertainment->name) }}" class="w-full px-4 py-3 rounded-lg border border-slate-300 focus:ring-2 focus:ring-primary-200 focus:border-primary-500 transition-all" required>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                {{-- Jenis --}}
                <div>
                    <label class="block text-sm font-bold text-slate-600 mb-2">Jenis Hiburan</label>
                    <input type="text" name="type" value="{{ old('type', $entertainment->type) }}" class="w-full px-4 py-3 rounded-lg border border-slate-300 focus:ring-2 focus:ring-primary-200 focus:border-primary-500 transition-all" required>
                </div>

                {{-- Jam --}}
                <div>
                    <label class="block text-sm font-bold text-slate-600 mb-2">Waktu Tampil</label>
                    <input type="text" name="time" value="{{ old('time', $entertainment->time) }}" class="w-full px-4 py-3 rounded-lg border border-slate-300 focus:ring-2 focus:ring-primary-200 focus:border-primary-500 transition-all" required>
                </div>
            </div>

            {{-- Foto --}}
            <div class="bg-slate-50 p-4 rounded-xl border border-slate-200">
                <label class="block text-sm font-bold text-slate-600 mb-3">Foto / Poster</label>
                
                <div class="flex items-start gap-4">
                    {{-- Preview Gambar --}}
                    <div class="shrink-0 w-32 h-32 bg-slate-200 rounded-lg overflow-hidden border border-slate-300 relative">
                        <img id="img-preview" src="{{ $entertainment->image_url ?? asset('images/no-image.png') }}" class="w-full h-full object-cover">
                    </div>

                    <div class="flex-1">
                        <input type="file" name="image" id="image-input" onchange="previewImage()" 
                               class="block w-full text-sm text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-xs file:font-bold file:bg-primary-100 file:text-primary-700 hover:file:bg-primary-200 cursor-pointer"/>
                        <p class="text-xs text-slate-500 mt-2">
                            Biarkan kosong jika tidak ingin mengubah foto.<br>
                            Maksimal 2MB (JPG/PNG).
                        </p>
                    </div>
                </div>
            </div>

            {{-- Tombol Aksi --}}
            <div class="pt-4 flex items-center gap-3">
                <button type="submit" class="flex-1 py-3 rounded-xl bg-primary-600 text-white font-bold hover:bg-primary-700 shadow-lg shadow-primary-200 transition-all transform hover:-translate-y-0.5">
                    <i class="bi bi-save me-1"></i> Simpan Perubahan
                </button>
            </div>
        </form>
    </div>
</div>

<script>
    function previewImage() {
        const image = document.querySelector('#image-input');
        const imgPreview = document.querySelector('#img-preview');
        if(image.files && image.files[0]){
            const oFReader = new FileReader();
            oFReader.readAsDataURL(image.files[0]);
            oFReader.onload = function(oFREvent) {
                imgPreview.src = oFREvent.target.result;
            }
        }
    }
</script>
@endsection