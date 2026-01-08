<x-app-layout>
    {{-- INJECT GOOGLE FONTS & ALPINE.JS --}}
    <script src="//unpkg.com/alpinejs" defer></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
        .glass-header {
            background: linear-gradient(135deg, #047857 0%, #0d9488 100%);
            position: relative;
        }
        /* Pola background halus */
        .pattern-grid {
            background-image: radial-gradient(rgba(255, 255, 255, 0.1) 1px, transparent 1px);
            background-size: 20px 20px;
        }
        /* Custom Scrollbar */
        textarea::-webkit-scrollbar {
            width: 8px;
        }
        textarea::-webkit-scrollbar-track {
            background: #f1f1f1; 
        }
        textarea::-webkit-scrollbar-thumb {
            background: #d1d5db; 
            border-radius: 4px;
        }
        textarea::-webkit-scrollbar-thumb:hover {
            background: #9ca3af; 
        }
        /* Hide default radio */
        input[type="radio"].peer {
            position: absolute;
            opacity: 0;
        }
    </style>

    {{-- HEADER SECTION --}}
    <div class="glass-header pb-36 pt-12 px-4 sm:px-8 overflow-hidden shadow-xl">
        <div class="absolute inset-0 pattern-grid"></div>
        
        {{-- Decorative Circles --}}
        <div class="absolute top-0 right-0 -mr-20 -mt-20 w-96 h-96 rounded-full bg-white opacity-5 blur-3xl"></div>
        <div class="absolute bottom-0 left-0 -ml-20 -mb-20 w-64 h-64 rounded-full bg-teal-400 opacity-10 blur-2xl"></div>

        <div class="max-w-5xl mx-auto text-center relative z-10">
            <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-white/10 backdrop-blur-md border border-white/20 text-emerald-50 text-xs font-bold uppercase tracking-wider mb-4 shadow-lg">
                <span class="w-2 h-2 rounded-full bg-emerald-300 animate-pulse"></span>
                Layanan Mahasiswa
            </div>
            <h1 class="text-3xl md:text-5xl font-extrabold text-white tracking-tight leading-tight mb-4 drop-shadow-sm">
                Formulir Pengajuan Konseling
            </h1>
            <p class="text-emerald-50 text-lg md:text-xl font-medium max-w-2xl mx-auto leading-relaxed opacity-90">
                Ruang aman bagi Anda untuk bercerita. Privasi terjaga, solusi tepercaya.
            </p>
        </div>
    </div>

    {{-- MAIN FORM CONTAINER --}}
    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 -mt-24 pb-24 relative z-20">
        
        <form method="POST" action="{{ route('mahasiswa.pengajuan.store') }}" class="space-y-10">
            @csrf

            {{-- 1. IDENTITAS DIRI (CARD) --}}
            <div class="bg-white rounded-3xl shadow-2xl shadow-emerald-900/10 border border-white overflow-hidden backdrop-blur-xl">
                <div class="bg-gradient-to-r from-gray-50 to-white px-8 py-6 border-b border-gray-100 flex items-center gap-4">
                    <div class="w-12 h-12 rounded-2xl bg-emerald-100 text-emerald-600 flex items-center justify-center shadow-sm ring-4 ring-white">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                    </div>
                    <div>
                        <h2 class="text-xl font-bold text-gray-800">Identitas Diri</h2>
                        <p class="text-sm text-gray-500 font-medium">Data akademik Anda terisi otomatis.</p>
                    </div>
                </div>
                
                <div class="p-8 bg-white">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        
                        {{-- Nama Lengkap --}}
                        <div class="group relative">
                            <label class="block text-xs font-bold text-gray-400 uppercase tracking-wider mb-2 ml-1">Nama Lengkap</label>
                            <div class="flex items-center px-4 py-3.5 bg-gray-50 border border-gray-200 rounded-xl text-gray-700 font-bold shadow-sm group-hover:border-emerald-200 transition-colors cursor-default">
                                <svg class="w-5 h-5 mr-3 text-emerald-500/50" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5.121 17.804A13.937 13.937 0 0112 16c2.5 0 4.847.655 6.879 1.804M15 10a3 3 0 11-6 0 3 3 0 016 0zm6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                {{ $mahasiswa->user->name }}
                            </div>
                        </div>

                        {{-- NIM --}}
                        <div class="group relative">
                            <label class="block text-xs font-bold text-gray-400 uppercase tracking-wider mb-2 ml-1">NIM</label>
                            <div class="flex items-center px-4 py-3.5 bg-gray-50 border border-gray-200 rounded-xl text-gray-700 font-bold shadow-sm group-hover:border-emerald-200 transition-colors cursor-default">
                                <svg class="w-5 h-5 mr-3 text-emerald-500/50" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V8a2 2 0 00-2-2h-5m-4 0V5a2 2 0 114 0v1m-4 0a2 2 0 104 0m-5 8a2 2 0 100-4 2 2 0 000 4zm0 0c1.306 0 2.417.835 2.83 2M9 14a3.001 3.001 0 00-2.83 2M15 11h3m-3 4h2"></path></svg>
                                {{ $mahasiswa->nim }}
                            </div>
                        </div>

                        {{-- Program Studi (DATA YANG HILANG SEBELUMNYA) --}}
                        <div class="group relative md:col-span-2">
                            <label class="block text-xs font-bold text-gray-400 uppercase tracking-wider mb-2 ml-1">Program Studi (Prodi)</label>
                            <div class="flex items-center px-4 py-3.5 bg-emerald-50/50 border border-emerald-100 rounded-xl text-emerald-800 font-bold shadow-sm group-hover:border-emerald-300 transition-colors cursor-default">
                                <svg class="w-5 h-5 mr-3 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path></svg>
                                {{ $mahasiswa->prodi->nama_prodi ?? 'Prodi Tidak Terdaftar' }}
                            </div>
                        </div>

                        {{-- Email --}}
                        <div class="group relative">
                            <label class="block text-xs font-bold text-gray-400 uppercase tracking-wider mb-2 ml-1">Email Kampus</label>
                            <div class="flex items-center px-4 py-3.5 bg-gray-50 border border-gray-200 rounded-xl text-gray-600 font-medium shadow-sm cursor-default">
                                <svg class="w-5 h-5 mr-3 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207"></path></svg>
                                {{ $mahasiswa->email }}
                            </div>
                        </div>

                        {{-- Editable Field: WhatsApp --}}
                        <div class="md:col-span-1">
                            <label for="no_hp_mahasiswa" class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-2 ml-1">
                                No. WhatsApp Aktif <span class="text-red-500">*</span>
                            </label>
                            <div class="relative group">
                                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                    <svg class="h-5 w-5 text-emerald-500 group-hover:text-emerald-600 transition-colors" fill="currentColor" viewBox="0 0 24 24"><path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-.999 3.648 3.742-.981zm11.387-5.464c-.074-.124-.272-.198-.57-.347-.297-.149-1.758-.868-2.031-.967-.272-.099-.47-.149-.669.149-.198.297-.768.967-.941 1.165-.173.198-.347.223-.644.074-.297-.149-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.297-.347.446-.521.151-.172.2-.296.3-.495.099-.198.05-.372-.025-.521-.075-.148-.669-1.611-.916-2.206-.242-.579-.487-.501-.669-.51l-.57-.01c-.198 0-.52.074-.792.372s-1.04 1.016-1.04 2.479 1.065 2.876 1.213 3.074c.149.198 2.095 3.2 5.076 4.487.709.306 1.263.489 1.694.626.712.226 1.36.194 1.872.118.571-.085 1.758-.719 2.006-1.413.248-.695.248-1.29.173-1.414z"/></svg>
                                </div>
                                <input type="text" name="no_hp_mahasiswa" id="no_hp_mahasiswa" 
                                    class="w-full pl-12 pr-4 py-3.5 border-2 border-gray-200 rounded-xl focus:border-emerald-500 focus:ring-emerald-500 transition-all shadow-sm placeholder-gray-300 font-semibold text-gray-800"
                                    value="{{ old('no_hp_mahasiswa', $mahasiswa->no_hp) }}" placeholder="Contoh: 081234567890" required>
                            </div>
                            <x-input-error :messages="$errors->get('no_hp_mahasiswa')" class="mt-2" />
                        </div>
                    </div>
                </div>
            </div>

            {{-- 2. KLASIFIKASI (INTERACTIVE CARDS) --}}
            <div class="bg-white rounded-3xl shadow-xl border border-gray-100 overflow-hidden" x-data="{ tipe: '{{ old('tipe_konseli') }}' }">
                <div class="bg-gradient-to-r from-gray-50 to-white px-8 py-6 border-b border-gray-100 flex items-center gap-4">
                    <div class="w-12 h-12 rounded-2xl bg-blue-100 text-blue-600 flex items-center justify-center shadow-sm ring-4 ring-white">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path></svg>
                    </div>
                    <div>
                        <h2 class="text-xl font-bold text-gray-800">Klasifikasi Masalah</h2>
                        <p class="text-sm text-gray-500 font-medium">Bantu kami memahami latar belakang Anda.</p>
                    </div>
                </div>

                <div class="p-8 bg-white space-y-8">
                    {{-- Tipe Konseli (Big Cards) --}}
                    <div>
                        <label class="block text-sm font-bold text-gray-800 mb-4 ml-1">Apakah Anda pernah melakukan konseling sebelumnya?</label>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            {{-- Option 1 --}}
                            <label class="relative cursor-pointer group">
                                <input type="radio" name="tipe_konseli" value="Konseli Baru (belum pernah)" class="peer" x-model="tipe">
                                <div class="p-5 rounded-2xl border-2 border-gray-200 hover:border-emerald-300 bg-white transition-all duration-300 peer-checked:border-emerald-500 peer-checked:bg-emerald-50 peer-checked:shadow-lg peer-checked:-translate-y-1 flex items-center gap-4 h-full">
                                    <div class="w-12 h-12 rounded-full bg-gray-100 text-gray-400 flex items-center justify-center peer-checked:bg-emerald-500 peer-checked:text-white transition-colors flex-shrink-0">
                                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"></path></svg>
                                    </div>
                                    <div>
                                        <span class="block font-bold text-lg text-gray-700 peer-checked:text-emerald-800">Konseli Baru</span>
                                        <span class="text-sm text-gray-500 peer-checked:text-emerald-600 font-medium">Saya belum pernah konseling.</span>
                                    </div>
                                    {{-- Checkmark --}}
                                    <div class="absolute top-5 right-5 opacity-0 peer-checked:opacity-100 text-emerald-500 transition-opacity scale-0 peer-checked:scale-100 transform duration-300">
                                        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg>
                                    </div>
                                </div>
                            </label>

                            {{-- Option 2 --}}
                            <label class="relative cursor-pointer group">
                                <input type="radio" name="tipe_konseli" value="Konseli Lama (sudah pernah)" class="peer" x-model="tipe">
                                <div class="p-5 rounded-2xl border-2 border-gray-200 hover:border-emerald-300 bg-white transition-all duration-300 peer-checked:border-emerald-500 peer-checked:bg-emerald-50 peer-checked:shadow-lg peer-checked:-translate-y-1 flex items-center gap-4 h-full">
                                    <div class="w-12 h-12 rounded-full bg-gray-100 text-gray-400 flex items-center justify-center peer-checked:bg-emerald-500 peer-checked:text-white transition-colors flex-shrink-0">
                                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                    </div>
                                    <div>
                                        <span class="block font-bold text-lg text-gray-700 peer-checked:text-emerald-800">Konseli Lama</span>
                                        <span class="text-sm text-gray-500 peer-checked:text-emerald-600 font-medium">Saya sudah pernah konseling.</span>
                                    </div>
                                     <div class="absolute top-5 right-5 opacity-0 peer-checked:opacity-100 text-emerald-500 transition-opacity scale-0 peer-checked:scale-100 transform duration-300">
                                        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg>
                                    </div>
                                </div>
                            </label>
                        </div>
                         <x-input-error :messages="$errors->get('tipe_konseli')" class="mt-2" />
                    </div>

                    {{-- Jenis Permasalahan (Pills/Tags) --}}
                    <div>
                        <label class="block text-sm font-bold text-gray-800 mb-4 ml-1">Kategori Permasalahan (Boleh lebih dari satu)</label>
                        <div class="flex flex-wrap gap-3">
                            @php $old_jenis = old('jenis_permasalahan', []); @endphp
                            @foreach(['Akademik / Belajar', 'Karir & Masa Depan', 'Sosial & Teman', 'Keluarga', 'Pribadi / Diri Sendiri', 'Percintaan'] as $jenis)
                                <label class="cursor-pointer select-none">
                                    <input type="checkbox" name="jenis_permasalahan[]" value="{{ $jenis }}" class="peer" {{ in_array($jenis, $old_jenis) ? 'checked' : '' }}>
                                    <div class="px-6 py-3 rounded-full border border-gray-200 bg-white text-gray-600 text-sm font-bold transition-all duration-200 hover:bg-gray-50 peer-checked:bg-emerald-600 peer-checked:text-white peer-checked:border-emerald-600 peer-checked:shadow-lg peer-checked:shadow-emerald-200 transform active:scale-95">
                                        {{ $jenis }}
                                    </div>
                                </label>
                            @endforeach
                        </div>
                         <x-input-error :messages="$errors->get('jenis_permasalahan')" class="mt-2" />
                    </div>
                </div>
            </div>

            {{-- 3. DETAIL CERITA (FOCUS MODE) --}}
            <div class="bg-white rounded-3xl shadow-xl border border-gray-100 overflow-hidden">
                 <div class="bg-gradient-to-r from-gray-50 to-white px-8 py-6 border-b border-gray-100 flex items-center gap-4">
                    <div class="w-12 h-12 rounded-2xl bg-purple-100 text-purple-600 flex items-center justify-center shadow-sm ring-4 ring-white">
                       <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                    </div>
                    <div>
                        <h2 class="text-xl font-bold text-gray-800">Cerita Anda</h2>
                        <p class="text-sm text-gray-500 font-medium">Ruang aman untuk berkeluh kesah.</p>
                    </div>
                </div>

                <div class="p-8 bg-white space-y-8">
                    <div>
                        <label for="deskripsi_masalah" class="block text-sm font-bold text-gray-800 mb-3 ml-1">Ceritakan apa yang sedang Anda rasakan saat ini:</label>
                        <div class="relative group">
                            <textarea name="deskripsi_masalah" id="deskripsi_masalah" rows="6" 
                                class="w-full rounded-2xl border-gray-200 bg-gray-50 p-5 shadow-sm focus:bg-white focus:border-emerald-500 focus:ring-emerald-500 transition-all text-gray-700 leading-relaxed placeholder-gray-400 focus:shadow-md"
                                placeholder="Tuliskan keluhan Anda di sini... Jangan ragu, cerita Anda aman bersama kami."
                            >{{ old('deskripsi_masalah') }}</textarea>
                            <div class="absolute bottom-4 right-4 text-xs font-semibold text-emerald-600 bg-emerald-50 px-2 py-1 rounded-md opacity-0 group-focus-within:opacity-100 transition-opacity">Rahasia Dijamin</div>
                        </div>
                        <x-input-error :messages="$errors->get('deskripsi_masalah')" class="mt-2" />
                    </div>

                    <div>
                        <label for="tujuan_konseling" class="block text-sm font-bold text-gray-800 mb-3 ml-1">Apa harapan Anda setelah sesi konseling?</label>
                        <textarea name="tujuan_konseling" id="tujuan_konseling" rows="3" 
                            class="w-full rounded-2xl border-gray-200 bg-gray-50 p-5 shadow-sm focus:bg-white focus:border-emerald-500 focus:ring-emerald-500 transition-all text-gray-700 leading-relaxed placeholder-gray-400 focus:shadow-md"
                            placeholder="Contoh: Saya ingin merasa lebih tenang dan menemukan solusi belajar..."
                        >{{ old('tujuan_konseling') }}</textarea>
                         <x-input-error :messages="$errors->get('tujuan_konseling')" class="mt-2" />
                    </div>
                </div>
            </div>

            {{-- 4. ASESMEN K10 (QUIZ STYLE) --}}
            <div class="bg-white rounded-3xl shadow-xl border border-gray-100 overflow-hidden">
                <div class="bg-gradient-to-r from-emerald-600 to-teal-600 px-8 py-10 text-white relative overflow-hidden">
                    <svg class="absolute right-0 bottom-0 opacity-10 w-40 h-40 transform translate-x-10 translate-y-10" fill="currentColor" viewBox="0 0 24 24"><path d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path></svg>
                    <h2 class="text-2xl font-bold mb-2 relative z-10">Asesmen Awal (K10)</h2>
                    <p class="text-emerald-100 text-sm font-medium opacity-90 relative z-10 max-w-2xl">
                        Jawablah pertanyaan berikut sesuai dengan kondisi Anda dalam <span class="bg-white/20 px-1 rounded text-white font-bold">30 hari terakhir</span>. Tidak ada jawaban benar atau salah.
                    </p>
                </div>

                <div class="p-8 bg-gray-50/50">
                     @php
                        $k10_questions = [
                            1 => 'Seberapa sering Anda merasa lelah tanpa sebab yang jelas?',
                            2 => 'Seberapa sering Anda merasa cemas atau khawatir?',
                            3 => 'Seberapa sering Anda merasa sangat gugup?',
                            4 => 'Seberapa sering Anda merasa putus asa?',
                            5 => 'Seberapa sering Anda merasa gelisah atau tidak tenang?',
                            6 => 'Seberapa sering Anda merasa tidak bisa duduk tenang?',
                            7 => 'Seberapa sering Anda merasa tertekan?',
                            8 => 'Seberapa sering merasa segala sesuatu butuh usaha besar?',
                            9 => 'Seberapa sering Anda merasa sangat sedih?',
                            10 => 'Seberapa sering Anda merasa tidak berharga?',
                        ];
                        $k10_options = [
                            'Tidak pernah', 
                            'Jarang', 
                            'Kadang-kadang', 
                            'Hampir Sepanjang waktu', 
                            'Sepanjang waktu'
                        ];
                        $old_k10 = old('asesmen_k10', []);
                    @endphp

                    <div class="space-y-6">
                        @foreach ($k10_questions as $index => $question)
                            <div class="bg-white p-6 rounded-2xl border border-gray-200 shadow-sm hover:shadow-md transition-shadow">
                                <p class="text-gray-800 font-bold mb-4 flex items-start gap-3">
                                    <span class="bg-emerald-100 text-emerald-700 text-xs font-extrabold w-6 h-6 rounded-full flex items-center justify-center flex-shrink-0 mt-0.5 shadow-sm">{{ $index }}</span>
                                    {{ $question }}
                                </p>
                                
                                <div class="grid grid-cols-2 md:grid-cols-5 gap-3">
                                     @foreach ($k10_options as $optIndex => $option)
                                        <label class="cursor-pointer relative group h-full">
                                            {{-- Gunakan $index - 1 agar index array dimulai dari 0 --}}
                                            <input type="radio" name="asesmen_k10[{{ $index - 1 }}]" value="{{ $option }}" 
                                                class="peer"
                                                {{ (isset($old_k10[$index - 1]) && $old_k10[$index - 1] == $option) ? 'checked' : '' }}>
                                            
                                            <div class="h-full px-2 py-3 rounded-xl border border-gray-200 text-center text-xs font-bold text-gray-500 bg-gray-50 transition-all duration-200
                                                hover:border-emerald-300 hover:bg-emerald-50 
                                                peer-checked:bg-emerald-600 peer-checked:text-white peer-checked:border-emerald-600 peer-checked:shadow-lg peer-checked:scale-[1.03] flex items-center justify-center">
                                                {{ $option }}
                                            </div>
                                        </label>
                                     @endforeach
                                </div>
                                <x-input-error :messages="$errors->get('asesmen_k10.' . ($index - 1))" class="mt-2" />
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

            {{-- 5. PERSETUJUAN & SUBMIT --}}
            <div class="bg-amber-50 rounded-3xl border border-amber-200 p-8 shadow-sm">
                <div class="flex items-start gap-4">
                    <div class="bg-amber-100 p-3 rounded-2xl text-amber-600">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path></svg>
                    </div>
                    <div>
                        <h3 class="text-lg font-bold text-amber-900">Persetujuan Layanan (Informed Consent)</h3>
                        <p class="text-sm text-amber-800 mt-2 leading-relaxed font-medium">
                            Dengan mengirimkan formulir ini, saya menyatakan bahwa data yang saya isi adalah benar. Saya bersedia mengikuti proses konseling dan memahami bahwa identitas serta cerita saya dijamin <strong>RAHASIA</strong> oleh Konselor UBBG.
                        </p>
                    </div>
                </div>
                
                <div class="mt-6 pt-6 border-t border-amber-200">
                    <label class="flex items-center cursor-pointer group select-none">
                        <div class="relative flex items-center">
                            <input type="checkbox" name="persetujuan" value="1" class="peer h-6 w-6 cursor-pointer appearance-none rounded-lg border-2 border-amber-400 transition-all checked:border-amber-600 checked:bg-amber-600 hover:border-amber-600">
                            <svg class="pointer-events-none absolute left-1/2 top-1/2 -translate-x-1/2 -translate-y-1/2 text-white opacity-0 transition-opacity peer-checked:opacity-100" width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M12 5L6.5 10.5L4 8" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
                        </div>
                        <span class="ml-3 text-sm font-bold text-gray-700 group-hover:text-amber-800 transition-colors">
                            Ya, saya telah membaca dan menyetujui pernyataan di atas.
                        </span>
                    </label>
                    <x-input-error :messages="$errors->get('persetujuan')" class="mt-2" />
                </div>
            </div>

            {{-- ACTION BUTTONS --}}
            <div class="flex items-center justify-between pt-4">
                <a href="{{ route('mahasiswa.riwayat.index') }}" class="group flex items-center px-6 py-4 text-gray-500 font-bold hover:text-gray-800 transition rounded-xl hover:bg-gray-100">
                    <svg class="w-5 h-5 mr-2 transform group-hover:-translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                    Batalkan
                </a>
                
                <button type="submit" class="relative inline-flex items-center justify-center px-10 py-4 overflow-hidden font-bold text-white transition duration-300 ease-out bg-emerald-600 rounded-2xl shadow-xl shadow-emerald-200 group hover:scale-[1.02]">
                    <span class="absolute inset-0 w-full h-full bg-gradient-to-br from-teal-400 to-emerald-600 opacity-0 group-hover:opacity-100 transition-opacity duration-300"></span>
                    <span class="relative flex items-center gap-3 text-lg tracking-wide">
                        Kirim Pengajuan
                        <svg class="w-5 h-5 transform group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"></path></svg>
                    </span>
                </button>
            </div>

        </form>
    </div>
</x-app-layout>