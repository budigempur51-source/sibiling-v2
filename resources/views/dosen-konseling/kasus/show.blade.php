<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Detail Kasus Konseling') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            
            {{-- TOMBOL KEMBALI --}}
            <a href="{{ route('dosen-konseling.kasus.index') }}" class="inline-flex items-center text-indigo-600 hover:text-indigo-900 font-medium mb-4">
                <svg class="w-5 h-5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                </svg>
                Kembali ke Daftar Kasus
            </a>

            {{-- 1. INFORMASI MAHASISWA & PERMASALAHAN --}}
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="flex justify-between items-start border-b pb-4 mb-4">
                        <div>
                            <h3 class="text-lg font-bold text-gray-800">
                                {{ $konseling->mahasiswa->nm_mhs ?? 'Nama Tidak Ditemukan' }}
                            </h3>
                            <p class="text-sm text-gray-500">NIM: {{ $konseling->nim_mahasiswa }} | Prodi: {{ $konseling->mahasiswa->prodi->nm_prodi ?? '-' }}</p>
                        </div>
                        <span class="px-3 py-1 rounded-full text-xs font-bold 
                            {{ $konseling->status_konseling == 'Selesai' ? 'bg-green-100 text-green-800' : 'bg-blue-100 text-blue-800' }}">
                            {{ $konseling->status_konseling }}
                        </span>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <p class="font-semibold text-gray-700">Keluhan / Permasalahan Awal:</p>
                            <div class="mt-2 p-3 bg-gray-50 rounded border border-gray-100 text-sm text-gray-600">
                                "{{ $konseling->deskripsi_masalah ?? $konseling->permasalahan }}"
                            </div>
                        </div>
                        <div>
                            <p class="font-semibold text-gray-700">Harapan Konseling:</p>
                            <p class="text-sm text-gray-600 mt-1">
                                {{ $konseling->tujuan_konseling ?? $konseling->harapan_konseling ?? '-' }}
                            </p>
                            
                            <p class="font-semibold text-gray-700 mt-4">Tanggal Pengajuan:</p>
                            <p class="text-sm text-gray-600">
                                {{ \Carbon\Carbon::parse($konseling->tgl_pengajuan)->translatedFormat('d F Y') }}
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            {{-- 2. RIWAYAT SESI & HASIL KONSELING (BAGIAN YANG HILANG) --}}
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <h3 class="text-lg font-bold text-gray-800 mb-4 flex items-center">
                        <svg class="w-5 h-5 mr-2 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path>
                        </svg>
                        Riwayat Sesi & Rekam Medis
                    </h3>

                    @if($konseling->jadwalSesi->isEmpty())
                        <div class="text-center py-8 text-gray-500">
                            Belum ada jadwal sesi yang dibuat.
                        </div>
                    @else
                        <div class="space-y-6">
                            @foreach($konseling->jadwalSesi as $index => $jadwal)
                                <div class="border rounded-lg overflow-hidden {{ $jadwal->hasilKonseling ? 'border-green-200 bg-green-50' : 'border-gray-200' }}">
                                    {{-- HEADER JADWAL --}}
                                    <div class="bg-white p-4 border-b flex justify-between items-center">
                                        <div>
                                            <span class="font-bold text-gray-800">Sesi Ke-{{ $index + 1 }}</span>
                                            <span class="text-sm text-gray-500 ml-2">
                                                {{ \Carbon\Carbon::parse($jadwal->tgl_sesi)->translatedFormat('l, d F Y') }}
                                                ({{ \Carbon\Carbon::parse($jadwal->waktu_mulai)->format('H:i') }} - {{ \Carbon\Carbon::parse($jadwal->waktu_selesai)->format('H:i') }})
                                            </span>
                                        </div>
                                        <div>
                                            @if($jadwal->hasilKonseling)
                                                <span class="px-2 py-1 bg-green-100 text-green-700 text-xs font-bold rounded">Selesai</span>
                                            @else
                                                <span class="px-2 py-1 bg-yellow-100 text-yellow-700 text-xs font-bold rounded">Terjadwal</span>
                                            @endif
                                        </div>
                                    </div>

                                    {{-- ISI HASIL / CATATAN --}}
                                    <div class="p-4">
                                        @if($jadwal->hasilKonseling)
                                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                                
                                                {{-- KOLOM DIAGNOSIS (Fix: Pakai ->diagnosis bukan ->hasil_konseling) --}}
                                                <div>
                                                    <h4 class="text-sm font-bold text-gray-700 uppercase mb-1">Catatan / Hasil Konseling</h4>
                                                    <div class="p-3 bg-white rounded border border-green-200 text-gray-800 text-sm leading-relaxed">
                                                        {{ $jadwal->hasilKonseling->diagnosis ?? 'Tidak ada catatan.' }}
                                                    </div>
                                                </div>

                                                {{-- KOLOM REKOMENDASI --}}
                                                <div>
                                                    <h4 class="text-sm font-bold text-gray-700 uppercase mb-1">Rekomendasi / Tindak Lanjut</h4>
                                                    <div class="p-3 bg-white rounded border border-green-200 text-gray-800 text-sm leading-relaxed">
                                                        {{ $jadwal->hasilKonseling->rekomendasi ?? '-' }}
                                                    </div>
                                                </div>
                                            </div>
                                            
                                            <div class="mt-2 text-xs text-gray-400 text-right">
                                                Disimpan pada: {{ $jadwal->hasilKonseling->created_at ?? $jadwal->hasilKonseling->tgl_konseling ?? '-' }}
                                            </div>
                                        @else
                                            <div class="flex justify-between items-center">
                                                <p class="text-gray-500 text-sm italic">Belum ada hasil sesi yang direkam.</p>
                                                
                                                {{-- Tombol Mulai Sesi (Hanya tampil jika belum ada hasil) --}}
                                                <a href="{{ route('dosen-konseling.jadwal.mulaiSesi', $jadwal->id_jadwal) }}" 
                                                   class="inline-flex items-center px-3 py-1 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700 focus:bg-indigo-700 active:bg-indigo-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                                    Mulai / Input Hasil
                                                </a>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>
            </div>

        </div>
    </div>
</x-app-layout>