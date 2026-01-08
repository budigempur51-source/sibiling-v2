<x-app-layout>
    {{-- INJECT FONTS & STYLE --}}
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
        .glass-header {
            background: linear-gradient(135deg, #047857 0%, #0d9488 100%);
        }
    </style>

    {{-- HEADER MODERN --}}
    <div class="glass-header pb-24 pt-12 px-4 sm:px-8 shadow-lg relative overflow-hidden">
        {{-- Pattern Decoration --}}
        <svg class="absolute top-0 right-0 w-64 h-64 text-white opacity-5 transform translate-x-10 -translate-y-10" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2L2 7l10 5 10-5-10-5zm0 9l2.5-1.25L12 8.5l-2.5 1.25L12 11zm0 2.5l-5-2.5-5 2.5L12 22l10-8.5-5-2.5-5 2.5z"/></svg>

        <div class="max-w-7xl mx-auto relative z-10">
            <div class="flex flex-col md:flex-row justify-between items-start md:items-center text-white">
                <div>
                    <h2 class="font-extrabold text-3xl tracking-tight leading-tight">
                        Riwayat Konseling
                    </h2>
                    <p class="text-emerald-100 mt-2 text-sm font-medium opacity-90">
                        Pantau status pengajuan dan perjalanan konseling Anda di sini.
                    </p>
                </div>
                
                <div class="mt-6 md:mt-0">
                    <a href="{{ route('mahasiswa.pengajuan.create') }}" 
                       class="group px-5 py-3 bg-white text-emerald-800 hover:bg-emerald-50 rounded-xl text-sm font-bold transition shadow-xl flex items-center gap-2 transform hover:-translate-y-0.5">
                        <svg class="w-5 h-5 transition-transform group-hover:rotate-90" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                        Buat Pengajuan Baru
                    </a>
                </div>
            </div>
        </div>
    </div>

    {{-- MAIN CONTENT --}}
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 -mt-16 pb-20 relative z-20">
        
        {{-- ALERT NOTIFIKASI --}}
        @if (session('success'))
            <div class="mb-6 p-4 bg-emerald-50 border-l-4 border-emerald-500 rounded-r-lg shadow-md flex items-start gap-3">
                <svg class="w-6 h-6 text-emerald-500 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                <div>
                    <h4 class="font-bold text-emerald-800 text-sm">Berhasil!</h4>
                    <p class="text-emerald-700 text-sm">{{ session('success') }}</p>
                </div>
            </div>
        @endif
        
        @if (session('error'))
            <div class="mb-6 p-4 bg-red-50 border-l-4 border-red-500 rounded-r-lg shadow-md flex items-start gap-3">
                <svg class="w-6 h-6 text-red-500 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                <div>
                    <h4 class="font-bold text-red-800 text-sm">Terjadi Kesalahan!</h4>
                    <p class="text-red-700 text-sm">{{ session('error') }}</p>
                </div>
            </div>
        @endif

        {{-- LIST KARTU RIWAYAT --}}
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @forelse ($riwayat as $konseling)
                @php
                    // Logika Warna & Icon berdasarkan Status
                    $status = $konseling->status_konseling;
                    $config = match($status) {
                        'Selesai' => [
                            'border' => 'border-emerald-500', 
                            'bg_badge' => 'bg-emerald-100 text-emerald-700', 
                            'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>',
                            'btn' => 'text-emerald-600 hover:bg-emerald-50',
                            'label' => 'Selesai'
                        ],
                        'Disetujui' => [
                            'border' => 'border-blue-500', 
                            'bg_badge' => 'bg-blue-100 text-blue-700', 
                            'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"></path>',
                            'btn' => 'text-blue-600 hover:bg-blue-50',
                            'label' => 'Disetujui'
                        ],
                        'Menunggu Kelengkapan Mahasiswa' => [
                            'border' => 'border-amber-500', 
                            'bg_badge' => 'bg-amber-100 text-amber-700', 
                            'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>',
                            'btn' => 'bg-amber-500 text-white hover:bg-amber-600 shadow-md', // Tombol Special
                            'label' => 'Lengkapi Data'
                        ],
                         'Perlu Revisi' => [
                            'border' => 'border-red-500', 
                            'bg_badge' => 'bg-red-100 text-red-700', 
                            'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>',
                            'btn' => 'bg-red-500 text-white hover:bg-red-600 shadow-md', // Tombol Special
                            'label' => 'Revisi Pengajuan'
                        ],
                        default => [
                            'border' => 'border-indigo-400', 
                            'bg_badge' => 'bg-indigo-100 text-indigo-700', 
                            'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>',
                            'btn' => 'text-gray-600 hover:bg-gray-50',
                            'label' => $status
                        ]
                    };
                @endphp

                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 hover:shadow-xl hover:-translate-y-1 transition-all duration-300 relative overflow-hidden group">
                    {{-- Status Bar Kiri --}}
                    <div class="absolute left-0 top-0 bottom-0 w-1.5 {{ $config['border'] }}"></div>
                    
                    <div class="p-6">
                        {{-- Header Card --}}
                        <div class="flex justify-between items-start mb-4">
                            <span class="px-3 py-1 rounded-full text-[10px] font-bold uppercase tracking-wider {{ $config['bg_badge'] }}">
                                {{ $config['label'] == 'Lengkapi Data' ? 'Butuh Tindakan' : $config['label'] }}
                            </span>
                            <span class="text-xs text-gray-400 font-medium">
                                {{ $konseling->tgl_pengajuan->diffForHumans() }}
                            </span>
                        </div>

                        {{-- Content Card --}}
                        <h3 class="text-lg font-bold text-gray-800 mb-2 line-clamp-2 leading-tight group-hover:text-emerald-700 transition-colors">
                            {{ $konseling->deskripsi_masalah ?? $konseling->permasalahan ?? 'Judul Tidak Tersedia' }}
                        </h3>

                        <div class="flex items-center gap-2 mb-6">
                            @if ($konseling->sumber_pengajuan == 'dosen_pa')
                                <span class="flex items-center gap-1 text-[11px] font-bold text-purple-600 bg-purple-50 px-2 py-0.5 rounded border border-purple-100">
                                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                                    Dari Dosen PA
                                </span>
                            @else
                                <span class="flex items-center gap-1 text-[11px] font-bold text-blue-600 bg-blue-50 px-2 py-0.5 rounded border border-blue-100">
                                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                                    Mandiri
                                </span>
                            @endif
                            <span class="text-xs text-gray-400">•</span>
                            <span class="text-xs text-gray-500 font-medium">#{{ $konseling->id_konseling }}</span>
                        </div>

                        {{-- Footer Action --}}
                        <div class="pt-4 border-t border-gray-100 flex justify-between items-center">
                             {{-- Tombol Aksi Dinamis --}}
                            @if ($status == 'Menunggu Kelengkapan Mahasiswa')
                                <a href="{{ route('mahasiswa.pengajuan.lengkapi', $konseling) }}" class="w-full text-center py-2 rounded-lg text-sm font-bold transition {{ $config['btn'] }}">
                                    Lengkapi Data Sekarang
                                </a>
                            @elseif ($status == 'Perlu Revisi')
                                <a href="{{ route('mahasiswa.pengajuan.edit', $konseling) }}" class="w-full text-center py-2 rounded-lg text-sm font-bold transition {{ $config['btn'] }}">
                                    Perbaiki Pengajuan
                                </a>
                            @else
                                <a href="{{ route('mahasiswa.riwayat.show', $konseling) }}" class="flex items-center text-sm font-bold text-gray-600 hover:text-emerald-600 transition group-hover:translate-x-1">
                                    Lihat Detail Perjalanan
                                    <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path></svg>
                                </a>
                                {{-- Icon Status di Kanan Bawah --}}
                                <div class="text-gray-300 group-hover:text-emerald-200 transition-colors">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        {!! $config['icon'] !!}
                                    </svg>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            @empty
                {{-- EMPTY STATE --}}
                <div class="col-span-1 md:col-span-2 lg:col-span-3 text-center py-16">
                    <div class="w-24 h-24 bg-emerald-50 rounded-full flex items-center justify-center mx-auto mb-6">
                        <svg class="w-12 h-12 text-emerald-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-800">Belum Ada Riwayat</h3>
                    <p class="text-gray-500 mt-2 mb-6 max-w-md mx-auto">
                        Anda belum pernah mengajukan konseling. Jangan ragu untuk bercerita, privasi Anda aman bersama kami.
                    </p>
                    <a href="{{ route('mahasiswa.pengajuan.create') }}" class="inline-flex items-center px-6 py-3 bg-emerald-600 hover:bg-emerald-700 text-white rounded-xl font-bold shadow-lg shadow-emerald-200 transition transform hover:-translate-y-1">
                        Mulai Konseling Pertama
                    </a>
                </div>
            @endforelse
        </div>

    </div>
</x-app-layout>