<x-app-layout>
    {{-- INJECT DEPENDENCIES --}}
    <script src="//unpkg.com/alpinejs" defer></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
        .glass-card {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }
        .gradient-header {
            background: linear-gradient(135deg, #0f172a 0%, #047857 100%); /* Slate to Emerald */
        }
    </style>

    {{-- HEADER EKSEKUTIF --}}
    <div class="gradient-header pb-32 pt-10 px-4 sm:px-8 relative overflow-hidden shadow-xl">
        {{-- Pattern Decoration --}}
        <svg class="absolute top-0 right-0 w-96 h-96 text-white opacity-5 transform translate-x-20 -translate-y-20" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2L2 7l10 5 10-5-10-5zm0 9l2.5-1.25L12 8.5l-2.5 1.25L12 11zm0 2.5l-5-2.5-5 2.5L12 22l10-8.5-5-2.5-5 2.5z"/></svg>
        
        <div class="max-w-7xl mx-auto relative z-10 flex flex-col md:flex-row justify-between items-center gap-6">
            <div class="text-center md:text-left">
                <span class="px-3 py-1 rounded-full bg-emerald-500/20 border border-emerald-400/30 text-emerald-100 text-xs font-bold uppercase tracking-widest mb-3 inline-block">
                    Executive Dashboard
                </span>
                <h2 class="text-3xl md:text-4xl font-extrabold text-white leading-tight">
                    Selamat Datang, <br>
                    <span class="text-emerald-300">{{ Auth::user()->name }}</span>
                </h2>
                <p class="text-slate-300 mt-2 text-sm md:text-base font-medium">
                    Pantau kinerja layanan konseling dan validasi pengajuan dengan mudah.
                </p>
            </div>

            {{-- Quick Actions --}}
            <div class="flex gap-3">
                <a href="{{ route('warek.konseling.index') }}" class="group px-5 py-3 bg-white text-emerald-800 hover:bg-emerald-50 rounded-xl text-sm font-bold shadow-lg flex items-center transition transform hover:-translate-y-1">
                    <div class="bg-emerald-100 p-1.5 rounded-lg mr-2 group-hover:bg-emerald-200 transition">
                        <svg class="w-5 h-5 text-emerald-700" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    </div>
                    Verifikasi Pengajuan
                    @if($perluTindakan > 0)
                        <span class="ml-2 bg-red-500 text-white text-xs px-2 py-0.5 rounded-full animate-pulse">{{ $perluTindakan }}</span>
                    @endif
                </a>
            </div>
        </div>
    </div>

    {{-- CONTENT CONTAINER --}}
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 -mt-24 pb-12 relative z-20">
        
        {{-- 1. STATS GRID --}}
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
            
            {{-- Card: Menunggu Verifikasi --}}
            <div class="bg-white rounded-2xl p-6 shadow-lg border border-gray-100 hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1 group">
                <div class="flex justify-between items-start">
                    <div>
                        <p class="text-xs font-bold text-gray-400 uppercase tracking-wider">Menunggu Validasi</p>
                        <h3 class="text-3xl font-black text-gray-800 mt-1 group-hover:text-amber-500 transition-colors">{{ $perluTindakan }}</h3>
                    </div>
                    <div class="p-3 bg-amber-50 rounded-xl text-amber-500 group-hover:bg-amber-500 group-hover:text-white transition-colors">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    </div>
                </div>
                <div class="mt-4 flex items-center text-xs text-amber-600 font-semibold bg-amber-50 px-2 py-1 rounded w-fit">
                    <span>Perlu tindakan segera</span>
                </div>
            </div>

            {{-- Card: Jadwal Aktif --}}
            <div class="bg-white rounded-2xl p-6 shadow-lg border border-gray-100 hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1 group">
                <div class="flex justify-between items-start">
                    <div>
                        <p class="text-xs font-bold text-gray-400 uppercase tracking-wider">Jadwal Sesi Aktif</p>
                        <h3 class="text-3xl font-black text-gray-800 mt-1 group-hover:text-blue-600 transition-colors">{{ $jadwalAktif }}</h3>
                    </div>
                    <div class="p-3 bg-blue-50 rounded-xl text-blue-600 group-hover:bg-blue-600 group-hover:text-white transition-colors">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                    </div>
                </div>
                <div class="mt-4 flex items-center text-xs text-blue-600 font-semibold bg-blue-50 px-2 py-1 rounded w-fit">
                    <span>Sedang berjalan</span>
                </div>
            </div>

            {{-- Card: Selesai Bulan Ini --}}
            <div class="bg-white rounded-2xl p-6 shadow-lg border border-gray-100 hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1 group">
                <div class="flex justify-between items-start">
                    <div>
                        <p class="text-xs font-bold text-gray-400 uppercase tracking-wider">Selesai (Bulan Ini)</p>
                        <h3 class="text-3xl font-black text-gray-800 mt-1 group-hover:text-emerald-600 transition-colors">{{ $selesaiBulanIni }}</h3>
                    </div>
                    <div class="p-3 bg-emerald-50 rounded-xl text-emerald-600 group-hover:bg-emerald-600 group-hover:text-white transition-colors">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    </div>
                </div>
                <div class="mt-4 flex items-center text-xs text-emerald-600 font-semibold bg-emerald-50 px-2 py-1 rounded w-fit">
                    <span>Kasus ditutup</span>
                </div>
            </div>

            {{-- Card: Total Masuk --}}
            <div class="bg-white rounded-2xl p-6 shadow-lg border border-gray-100 hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1 group">
                <div class="flex justify-between items-start">
                    <div>
                        <p class="text-xs font-bold text-gray-400 uppercase tracking-wider">Total Semua Kasus</p>
                        <h3 class="text-3xl font-black text-gray-800 mt-1 group-hover:text-purple-600 transition-colors">{{ $totalMasuk }}</h3>
                    </div>
                    <div class="p-3 bg-purple-50 rounded-xl text-purple-600 group-hover:bg-purple-600 group-hover:text-white transition-colors">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path></svg>
                    </div>
                </div>
                <div class="mt-4 flex items-center text-xs text-purple-600 font-semibold bg-purple-50 px-2 py-1 rounded w-fit">
                    <span>Akumulasi Total</span>
                </div>
            </div>
        </div>

        {{-- 2. MAIN LAYOUT: RECENT ACTIVITY --}}
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            
            {{-- KOLOM KIRI (Daftar Aktivitas) --}}
            <div class="lg:col-span-2">
                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
                    <div class="px-6 py-5 border-b border-gray-100 bg-gray-50/50 flex justify-between items-center">
                        <h3 class="font-bold text-gray-800 flex items-center gap-2">
                            <svg class="w-5 h-5 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            Aktivitas Pengajuan Terbaru
                        </h3>
                        <a href="{{ route('warek.konseling.index') }}" class="text-xs font-bold text-emerald-600 hover:text-emerald-800 hover:underline">Lihat Semua</a>
                    </div>
                    
                    <div class="divide-y divide-gray-100">
                        @forelse($terbaru as $item)
                            <div class="px-6 py-4 hover:bg-gray-50 transition duration-150 flex items-center justify-between group">
                                <div class="flex items-center gap-4">
                                    {{-- Avatar Initials --}}
                                    <div class="w-10 h-10 rounded-full bg-slate-100 flex items-center justify-center text-slate-600 font-bold border border-slate-200">
                                        {{ substr($item->user->name ?? 'D', 0, 1) }}
                                    </div>
                                    
                                    <div>
                                        <p class="text-sm font-bold text-gray-800 group-hover:text-emerald-700 transition">
                                            {{ $item->user->name ?? 'Dosen / Staf' }}
                                        </p>
                                        <div class="flex items-center gap-2 mt-0.5">
                                            @php
                                                $statusColor = match($item->status_konseling) {
                                                    'Menunggu Verifikasi' => 'text-amber-600 bg-amber-50 border-amber-100',
                                                    'Selesai' => 'text-emerald-600 bg-emerald-50 border-emerald-100',
                                                    'Disetujui' => 'text-blue-600 bg-blue-50 border-blue-100',
                                                    default => 'text-gray-600 bg-gray-50 border-gray-100'
                                                };
                                            @endphp
                                            <span class="text-[10px] px-2 py-0.5 rounded-full border {{ $statusColor }} font-bold uppercase">
                                                {{ $item->status_konseling }}
                                            </span>
                                            <span class="text-xs text-gray-400">&bull; {{ $item->updated_at->diffForHumans() }}</span>
                                        </div>
                                    </div>
                                </div>

                                <a href="{{ route('warek.konseling.show', $item->id_konseling_dosen) }}" 
                                   class="px-3 py-1.5 rounded-lg border border-gray-200 text-xs font-bold text-gray-600 hover:bg-emerald-50 hover:text-emerald-700 hover:border-emerald-200 transition">
                                    Detail
                                </a>
                            </div>
                        @empty
                            <div class="px-6 py-16 text-center">
                                <div class="w-16 h-16 bg-gray-50 rounded-full flex items-center justify-center mx-auto mb-3">
                                    <svg class="w-8 h-8 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"></path></svg>
                                </div>
                                <p class="text-gray-500 font-medium">Belum ada aktivitas terbaru.</p>
                                <p class="text-xs text-gray-400 mt-1">Data pengajuan akan muncul di sini.</p>
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>

            {{-- KOLOM KANAN (Info / Shortcut) --}}
            <div class="space-y-6">
                {{-- Quick Access Card --}}
                <div class="bg-gradient-to-br from-slate-800 to-slate-900 rounded-2xl p-6 text-white shadow-lg relative overflow-hidden">
                    <svg class="absolute top-0 right-0 w-32 h-32 text-white opacity-5 transform translate-x-8 -translate-y-8" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2L2 7l10 5 10-5-10-5zm0 9l2.5-1.25L12 8.5l-2.5 1.25L12 11zm0 2.5l-5-2.5-5 2.5L12 22l10-8.5-5-2.5-5 2.5z"/></svg>
                    
                    <h4 class="font-bold text-lg mb-2 relative z-10">Arsip & Laporan</h4>
                    <p class="text-slate-300 text-sm mb-6 relative z-10">Akses riwayat pengajuan yang sudah selesai atau ditolak.</p>
                    
                    <a href="{{ route('warek.konseling.riwayat') }}" class="block w-full text-center py-2.5 bg-white/10 hover:bg-white/20 backdrop-blur-sm border border-white/20 rounded-xl text-sm font-bold transition relative z-10">
                        Buka Arsip
                    </a>
                </div>

                {{-- System Info --}}
                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
                    <h4 class="font-bold text-gray-800 mb-4 text-sm uppercase tracking-wider">Informasi Sistem</h4>
                    <ul class="space-y-3">
                        <li class="flex justify-between text-sm">
                            <span class="text-gray-500">Versi Sistem</span>
                            <span class="font-bold text-gray-700">v2.0 (Emerald)</span>
                        </li>
                        <li class="flex justify-between text-sm">
                            <span class="text-gray-500">Terakhir Login</span>
                            <span class="font-bold text-gray-700">{{ Auth::user()->last_login_at ? \Carbon\Carbon::parse(Auth::user()->last_login_at)->diffForHumans() : 'Baru saja' }}</span>
                        </li>
                        <li class="pt-3 border-t border-gray-100">
                            <p class="text-xs text-gray-400 italic text-center">
                                &copy; {{ date('Y') }} UBBG Counseling System
                            </p>
                        </li>
                    </ul>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>