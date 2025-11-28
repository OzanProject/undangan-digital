@extends('layouts.admin')

@section('title', 'Pengaturan Website')

@section('content')

    {{-- Container Utama dengan State Alpine untuk Tabs --}}
    <div x-data="{ activeTab: 'umum' }" class="max-w-5xl mx-auto pb-20">

        <form action="{{ route('admin.settings.update') }}" method="POST" enctype="multipart/form-data">
            @csrf

            {{-- 1. NAVIGATION TABS --}}
            <div class="mb-6 overflow-x-auto">
                <div class="flex space-x-2 bg-white p-1.5 rounded-2xl shadow-sm border border-slate-200 w-fit md:w-full md:justify-center min-w-max">
                    
                    {{-- Tab 1: Umum --}}
                    <button type="button" @click="activeTab = 'umum'"
                            class="flex items-center gap-2 px-5 py-2.5 rounded-xl text-sm font-bold transition-all duration-300 whitespace-nowrap"
                            :class="activeTab === 'umum' ? 'bg-primary-600 text-white shadow-md' : 'text-slate-500 hover:bg-slate-100'">
                        <i class="bi bi-sliders"></i> <span>1. Data Acara</span>
                    </button>

                    {{-- Tab 2: Foto & Audio --}}
                    <button type="button" @click="activeTab = 'foto'"
                            class="flex items-center gap-2 px-5 py-2.5 rounded-xl text-sm font-bold transition-all duration-300 whitespace-nowrap"
                            :class="activeTab === 'foto' ? 'bg-primary-600 text-white shadow-md' : 'text-slate-500 hover:bg-slate-100'">
                        <i class="bi bi-images"></i> <span>2. Media</span>
                    </button>

                    {{-- Tab 3: Bank --}}
                    <button type="button" @click="activeTab = 'bank'"
                            class="flex items-center gap-2 px-5 py-2.5 rounded-xl text-sm font-bold transition-all duration-300 whitespace-nowrap"
                            :class="activeTab === 'bank' ? 'bg-primary-600 text-white shadow-md' : 'text-slate-500 hover:bg-slate-100'">
                        <i class="bi bi-credit-card-2-front"></i> <span>3. Rekening</span>
                    </button>

                    {{-- Tab 4: Keluarga --}}
                    <button type="button" @click="activeTab = 'keluarga'"
                            class="flex items-center gap-2 px-5 py-2.5 rounded-xl text-sm font-bold transition-all duration-300 whitespace-nowrap"
                            :class="activeTab === 'keluarga' ? 'bg-primary-600 text-white shadow-md' : 'text-slate-500 hover:bg-slate-100'">
                        <i class="bi bi-people-fill"></i> <span>4. Keluarga</span>
                    </button>

                </div>
            </div>

            {{-- 2. CONTENT SECTIONS --}}
            <div class="bg-white rounded-3xl shadow-sm border border-slate-200 overflow-hidden min-h-[400px]">
                
                {{-- TAB 1: UMUM --}}
                <div x-show="activeTab === 'umum'" x-transition.opacity class="p-8">
                    <h3 class="text-lg font-bold text-slate-800 mb-6 border-b border-slate-100 pb-2">
                        Informasi Dasar Acara
                    </h3>

                    {{-- DROPDOWN TEMA UNDANGAN (TAMBAHAN) --}}
                    <div class="mb-6">
                        <label class="block text-sm font-bold text-slate-700 mb-2">
                            Tema Undangan
                        </label>
                        <div class="relative">
                            <i class="bi bi-palette-fill absolute left-4 top-3.5 text-slate-400 text-lg"></i>
                            <select 
                                name="theme"
                                class="w-full pl-11 pr-4 py-3 rounded-xl border border-slate-300 
                                       focus:ring-2 focus:ring-primary-200 focus:border-primary-500 
                                       transition-all text-sm bg-white text-slate-700"
                            >
                                @foreach($themes as $value => $label)
                                    <option 
                                        value="{{ $value }}"
                                        {{ old('theme', $settings->theme ?? 'tema1') == $value ? 'selected' : '' }}
                                    >
                                        {{ $label }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <p class="text-xs text-slate-400 mt-1 ml-1">
                            <i class="bi bi-info-circle"></i>
                            Ubah tampilan desain undangan tanpa mengubah data acara & tamu.
                        </p>
                    </div>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        {{-- Nama Anak --}}
                        <div class="col-span-1">
                            <label class="block text-sm font-bold text-slate-700 mb-2">Nama Anak</label>
                            <div class="relative">
                                <i class="bi bi-person-fill absolute left-4 top-3.5 text-slate-400 text-lg"></i>
                                <input type="text" name="child_name" class="w-full pl-11 pr-4 py-3 rounded-xl border border-slate-300 focus:ring-2 focus:ring-primary-200 focus:border-primary-500 transition-all" value="{{ $settings->child_name ?? '' }}" placeholder="Nama lengkap anak">
                            </div>
                        </div>

                        {{-- Nama Orang Tua --}}
                        <div class="col-span-1">
                            <label class="block text-sm font-bold text-slate-700 mb-2">Nama Orang Tua</label>
                            <div class="relative">
                                <i class="bi bi-people-fill absolute left-4 top-3.5 text-slate-400 text-lg"></i>
                                <input type="text" name="parent_names" class="w-full pl-11 pr-4 py-3 rounded-xl border border-slate-300 focus:ring-2 focus:ring-primary-200 focus:border-primary-500 transition-all" value="{{ $settings->parent_names ?? '' }}" placeholder="Bpk... & Ibu...">
                            </div>
                        </div>

                        {{-- Waktu Acara --}}
                        <div class="col-span-1">
                            <label class="block text-sm font-bold text-slate-700 mb-2">Waktu Acara</label>
                            <div class="relative">
                                <i class="bi bi-calendar-event-fill absolute left-4 top-3.5 text-slate-400 text-lg"></i>
                                <input type="datetime-local" name="event_date" class="w-full pl-11 pr-4 py-3 rounded-xl border border-slate-300 focus:ring-2 focus:ring-primary-200 focus:border-primary-500 transition-all" value="{{ $settings->event_date ? $settings->event_date->format('Y-m-d\TH:i') : '' }}">
                            </div>
                        </div>

                        {{-- Nama Lokasi --}}
                        <div class="col-span-1">
                            <label class="block text-sm font-bold text-slate-700 mb-2">Nama Lokasi / Gedung</label>
                            <div class="relative">
                                <i class="bi bi-geo-alt-fill absolute left-4 top-3.5 text-slate-400 text-lg"></i>
                                <input type="text" name="location_name" class="w-full pl-11 pr-4 py-3 rounded-xl border border-slate-300 focus:ring-2 focus:ring-primary-200 focus:border-primary-500 transition-all" value="{{ $settings->location_name ?? '' }}" placeholder="Rumah / Gedung...">
                            </div>
                        </div>

                        {{-- Alamat Lengkap --}}
                        <div class="col-span-1 md:col-span-2">
                            <label class="block text-sm font-bold text-slate-700 mb-2">Alamat Lengkap</label>
                            <textarea name="location_address" rows="2" class="w-full px-4 py-3 rounded-xl border border-slate-300 focus:ring-2 focus:ring-primary-200 focus:border-primary-500 transition-all" placeholder="Jalan, RT/RW, Kelurahan, Kecamatan...">{{ $settings->location_address ?? '' }}</textarea>
                        </div>

                        {{-- Maps Iframe --}}
                        <div class="col-span-1 md:col-span-2">
                            <label class="block text-sm font-bold text-slate-700 mb-2">Link Google Maps (Embed / Iframe SRC)</label>
                            <div class="relative">
                                <i class="bi bi-map-fill absolute left-4 top-3.5 text-slate-400 text-lg"></i>
                                <input type="text" name="maps_iframe" class="w-full pl-11 pr-4 py-3 rounded-xl border border-slate-300 focus:ring-2 focus:ring-primary-200 focus:border-primary-500 transition-all font-mono text-xs text-slate-600" value="{{ $settings->maps_iframe ?? '' }}" placeholder="https://www.google.com/maps/embed?pb=...">
                            </div>
                            <p class="text-xs text-slate-400 mt-1 ml-1">
                                <i class="bi bi-info-circle"></i> Copy link dari Google Maps -> Share -> Embed a map -> Copy HTML (ambil bagian <code>src="..."</code> nya saja).
                            </p>
                        </div>
                    </div>
                </div>

                {{-- TAB 2: FOTO & AUDIO --}}
                <div x-show="activeTab === 'foto'" x-transition.opacity class="p-8" style="display: none;">
                    <h3 class="text-lg font-bold text-slate-800 mb-6 border-b border-slate-100 pb-2">Media & Visualisasi</h3>

                    <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                        {{-- Hero Image --}}
                        <div class="bg-slate-50 p-6 rounded-2xl border border-slate-200">
                            <label class="block text-sm font-bold text-slate-700 mb-3">Background Utama (Hero)</label>
                            
                            @if(!empty($settings->hero_image))
                                <div class="relative w-full h-40 rounded-xl overflow-hidden mb-4 shadow-sm group bg-slate-200">
                                    <img src="{{ asset('storage/'.$settings->hero_image) }}" class="w-full h-full object-cover transition-transform group-hover:scale-105">
                                    <div class="absolute inset-0 bg-black/30 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity">
                                        <span class="text-white text-xs font-bold border border-white px-2 py-1 rounded">Gambar Saat Ini</span>
                                    </div>
                                </div>
                            @endif

                            <input type="file" name="hero_image" class="w-full text-sm text-slate-500 
                                file:mr-4 file:py-2 file:px-4
                                file:rounded-full file:border-0
                                file:text-sm file:font-semibold
                                file:bg-primary-50 file:text-primary-700
                                hover:file:bg-primary-100
                            "/>
                            <p class="text-xs text-slate-400 mt-2">Disarankan format Landscape, Max 2MB.</p>
                        </div>

                        {{-- Foto Anak --}}
                        <div class="bg-slate-50 p-6 rounded-2xl border border-slate-200">
                            <label class="block text-sm font-bold text-slate-700 mb-3">Foto Profil Anak</label>
                            
                            @if(!empty($settings->child_photo))
                                <div class="relative w-32 h-32 rounded-full overflow-hidden mb-4 shadow-sm mx-auto border-4 border-white bg-slate-200">
                                    <img src="{{ asset('storage/'.$settings->child_photo) }}" class="w-full h-full object-cover">
                                </div>
                            @endif

                            <input type="file" name="child_photo" class="w-full text-sm text-slate-500 
                                file:mr-4 file:py-2 file:px-4
                                file:rounded-full file:border-0
                                file:text-sm file:font-semibold
                                file:bg-primary-50 file:text-primary-700
                                hover:file:bg-primary-100
                            "/>
                            <p class="text-xs text-slate-400 mt-2">Disarankan format Portrait/Square, Max 2MB.</p>
                        </div>
                        
                        {{-- LOGO PERUSAHAAN/APLIKASI (BARU) --}}
                        <div class="bg-slate-50 p-6 rounded-2xl border border-slate-200">
                            <label class="block text-sm font-bold text-slate-700 mb-3">Logo Perusahaan/Admin</label>
                            @if(!empty($settings->logo_path))
                                <div class="relative w-20 h-20 mb-4 shadow-sm mx-auto border-4 border-white bg-white rounded-lg p-1 flex items-center justify-center">
                                    <img src="{{ asset('storage/'.$settings->logo_path) }}" class="w-full h-full object-contain">
                                </div>
                            @endif
                            <input type="file" name="logo_path" class="w-full text-sm text-slate-500 
                                file:mr-4 file:py-2 file:px-4
                                file:rounded-full file:border-0
                                file:text-sm file:font-semibold
                                file:bg-primary-50 file:text-primary-700
                                hover:file:bg-primary-100
                            "/>
                            <p class="text-xs text-slate-400 mt-2">Logo Admin Panel (Disarankan PNG Transparan).</p>
                        </div>

                        {{-- Input Musik / Backsound (Full Width) --}}
                        <div class="col-span-1 md:col-span-3 bg-indigo-50 p-6 rounded-2xl border border-indigo-100 mt-2">
                            <label class="text-sm font-bold text-slate-700 mb-3 flex items-center gap-2">
                                <i class="bi bi-music-note-beamed text-indigo-600"></i> Musik Latar (Backsound)
                            </label>
                            
                            <div class="flex flex-col md:flex-row items-center gap-6">
                                <div class="w-full md:w-1/2">
                                    @if(!empty($settings->audio_path))
                                        <div class="bg-white p-3 rounded-xl border border-indigo-200 shadow-sm">
                                            <p class="text-[10px] text-slate-400 mb-1 uppercase font-bold tracking-wider">Lagu Terpasang:</p>
                                            <audio controls class="w-full h-8 mt-1">
                                                <source src="{{ asset('storage/'.$settings->audio_path) }}" type="audio/mpeg">
                                                Browser Anda tidak mendukung audio player.
                                            </audio>
                                        </div>
                                    @else
                                        <div class="bg-slate-200/50 border border-dashed border-slate-300 p-3 rounded-xl text-center text-slate-500 text-xs py-4">
                                            Belum ada lagu diupload. <br> (Akan menggunakan lagu default sistem).
                                        </div>
                                    @endif
                                </div>

                                <div class="w-full md:w-1/2">
                                    <input type="file" name="audio_path" class="w-full text-sm text-slate-500 
                                        file:mr-4 file:py-2 file:px-4
                                        file:rounded-full file:border-0
                                        file:text-sm file:font-semibold
                                        file:bg-indigo-100 file:text-indigo-700
                                        hover:file:bg-indigo-200
                                    " accept=".mp3,.wav"/>
                                    <p class="text-xs text-slate-400 mt-2">
                                        Format: MP3/WAV. Max Ukuran: 5MB.
                                    </p>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

                {{-- TAB 3: BANK --}}
                <div x-show="activeTab === 'bank'" x-transition.opacity class="p-8" style="display: none;">
                    <h3 class="text-lg font-bold text-slate-800 mb-6 border-b border-slate-100 pb-2">Rekening & Amplop Digital</h3>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                        <div class="bg-blue-50 p-6 rounded-2xl border border-blue-100 relative overflow-hidden">
                            <div class="absolute top-0 right-0 bg-blue-200 text-blue-800 text-[10px] font-bold px-3 py-1 rounded-bl-xl uppercase">Rekening Utama</div>
                            <div class="space-y-4 mt-2">
                                <div><label class="text-xs font-bold text-blue-800 uppercase">Nama Bank</label><input type="text" name="bank_name_1" class="w-full mt-1 px-3 py-2 rounded-lg border border-blue-200 focus:border-blue-500 focus:ring-1 focus:ring-blue-500 outline-none" value="{{ $settings->bank_name_1 ?? '' }}" placeholder="Contoh: BCA"></div>
                                <div><label class="text-xs font-bold text-blue-800 uppercase">Nomor Rekening</label><input type="number" name="bank_acc_1" class="w-full mt-1 px-3 py-2 rounded-lg border border-blue-200 focus:border-blue-500 focus:ring-1 focus:ring-blue-500 outline-none font-mono" value="{{ $settings->bank_acc_1 ?? '' }}"></div>
                                <div><label class="text-xs font-bold text-blue-800 uppercase">Atas Nama</label><input type="text" name="bank_holder_1" class="w-full mt-1 px-3 py-2 rounded-lg border border-blue-200 focus:border-blue-500 focus:ring-1 focus:ring-blue-500 outline-none" value="{{ $settings->bank_holder_1 ?? '' }}"></div>
                            </div>
                        </div>

                        <div class="bg-purple-50 p-6 rounded-2xl border border-purple-100 relative overflow-hidden">
                            <div class="absolute top-0 right-0 bg-purple-200 text-purple-800 text-[10px] font-bold px-3 py-1 rounded-bl-xl uppercase">Rekening Kedua (Opsional)</div>
                            <div class="space-y-4 mt-2">
                                <div><label class="text-xs font-bold text-purple-800 uppercase">Nama Bank</label><input type="text" name="bank_name_2" class="w-full mt-1 px-3 py-2 rounded-lg border border-purple-200 focus:border-purple-500 focus:ring-1 focus:ring-purple-500 outline-none" value="{{ $settings->bank_name_2 ?? '' }}" placeholder="Contoh: E-Wallet / Mandiri"></div>
                                <div><label class="text-xs font-bold text-purple-800 uppercase">Nomor Rekening</label><input type="number" name="bank_acc_2" class="w-full mt-1 px-3 py-2 rounded-lg border border-purple-200 focus:border-purple-500 focus:ring-1 focus:ring-purple-500 outline-none font-mono" value="{{ $settings->bank_acc_2 ?? '' }}"></div>
                                <div><label class="text-xs font-bold text-purple-800 uppercase">Atas Nama</label><input type="text" name="bank_holder_2" class="w-full mt-1 px-3 py-2 rounded-lg border border-purple-200 focus:border-purple-500 focus:ring-1 focus:ring-purple-500 outline-none" value="{{ $settings->bank_holder_2 ?? '' }}"></div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- TAB 4: KELUARGA BESAR --}}
                <div x-show="activeTab === 'keluarga'" x-transition.opacity class="p-8" style="display: none;">
                    <h3 class="text-lg font-bold text-slate-800 mb-6 border-b border-slate-100 pb-2">Keluarga Besar (Turut Mengundang)</h3>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                        
                        {{-- PIHAK AYAH --}}
                        <div class="bg-emerald-50 p-6 rounded-2xl border border-emerald-100">
                            <label class="text-sm font-bold text-emerald-800 mb-2 flex items-center gap-2">
                                <i class="bi bi-gender-male"></i> Keluarga Pihak Ayah
                            </label>
                            <div class="relative">
                                <textarea name="turut_mengundang_ayah" rows="6" 
                                          class="w-full p-4 rounded-xl border border-emerald-200 focus:ring-2 focus:ring-emerald-200 focus:border-emerald-500 transition-all bg-white text-sm" 
                                          placeholder="Contoh:
Kakek Fulan
Paman Ahmad
Kel. Besar Bani Adam">{{ $settings->turut_mengundang_ayah ?? '' }}</textarea>
                            </div>
                        </div>

                        {{-- PIHAK IBU --}}
                        <div class="bg-pink-50 p-6 rounded-2xl border border-pink-100">
                            <label class="text-sm font-bold text-pink-800 mb-2 flex items-center gap-2">
                                <i class="bi bi-gender-female"></i> Keluarga Pihak Ibu
                            </label>
                            <div class="relative">
                                <textarea name="turut_mengundang_ibu" rows="6" 
                                          class="w-full p-4 rounded-xl border border-pink-200 focus:ring-2 focus:ring-pink-200 focus:border-pink-500 transition-all bg-white text-sm" 
                                          placeholder="Contoh:
Nenek Fulanah
Bibi Siti
Kel. Besar Bani Hawa">{{ $settings->turut_mengundang_ibu ?? '' }}</textarea>
                            </div>
                        </div>

                    </div>

                    <div class="mt-4 flex items-start gap-2 text-xs text-slate-500 bg-slate-50 p-3 rounded-lg border border-slate-200">
                        <i class="bi bi-info-circle-fill text-lg"></i>
                        <span>
                            <b>Tips:</b> Pisahkan setiap nama dengan menekan tombol <b>ENTER</b> (Baris Baru).
                        </span>
                    </div>
                </div>

                {{-- FOOTER ACTION --}}
                <div class="bg-slate-50 px-8 py-6 border-t border-slate-200 flex flex-col md:flex-row items-center justify-between gap-4">
                    <p class="text-xs text-slate-500 italic">
                        * Pastikan semua data sudah benar sebelum menyimpan.
                    </p>
                    <button type="submit" class="w-full md:w-auto inline-flex items-center justify-center gap-2 px-8 py-3 bg-primary-600 text-white font-bold rounded-xl hover:bg-primary-700 shadow-lg shadow-primary-200 transition-all transform hover:-translate-y-1">
                        <i class="bi bi-save2-fill"></i>
                        <span>Simpan Perubahan</span>
                    </button>
                </div>

            </div>
        </form>

    </div>

    {{-- SWEETALERT --}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    @if(session('success'))
    <script>
        Swal.fire({
            icon: 'success', title: 'Berhasil Disimpan!', text: '{{ session('success') }}',
            confirmButtonColor: '#0EA5E9', confirmButtonText: 'Oke, Mantap!',
            customClass: { popup: 'rounded-3xl' }
        });
    </script>
    @endif

@endsection
