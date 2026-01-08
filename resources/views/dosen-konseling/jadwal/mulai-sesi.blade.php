<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Mulai Sesi Konseling') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            {{-- ================= ALERT SYSTEM (WAJIB ADA) ================= --}}
            {{-- Menangkap error dari Controller (Try-Catch Exception) --}}
            @if (session('error'))
                <div class="mb-4 bg-red-100 border-l-4 border-red-500 text-red-700 p-4 shadow-md rounded-md" role="alert">
                    <p class="font-bold">Terjadi Kesalahan Sistem:</p>
                    <p>{{ session('error') }}</p>
                </div>
            @endif

            {{-- Menangkap pesan sukses --}}
            @if (session('success'))
                <div class="mb-4 bg-green-100 border-l-4 border-green-500 text-green-700 p-4 shadow-md rounded-md" role="alert">
                    <p class="font-bold">Berhasil!</p>
                    <p>{{ session('success') }}</p>
                </div>
            @endif

            {{-- Menangkap error Validasi Input (Form kurang lengkap) --}}
            @if ($errors->any())
                <div class="mb-4 bg-orange-100 border-l-4 border-orange-500 text-orange-700 p-4 shadow-md rounded-md" role="alert">
                    <p class="font-bold">Periksa Inputan Anda:</p>
                    <ul class="mt-2 list-disc list-inside text-sm">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            {{-- ============================================================ --}}

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    
                    {{-- INFORMASI SESI --}}
                    <div class="mb-6 bg-blue-50 p-4 rounded-lg border border-blue-200">
                        <h3 class="text-lg font-bold text-blue-800 mb-2">Detail Sesi</h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-sm">
                            <div>
                                <p class="text-gray-600">Mahasiswa:</p>
                                <p class="font-semibold text-gray-900">{{ $jadwal->konseling->mahasiswa->nm_mhs ?? 'Nama Tidak Ditemukan' }} ({{ $jadwal->konseling->nim_mahasiswa }})</p>
                            </div>
                            <div>
                                <p class="text-gray-600">Waktu:</p>
                                <p class="font-semibold text-gray-900">
                                    {{ \Carbon\Carbon::parse($jadwal->tgl_sesi)->translatedFormat('l, d F Y') }} 
                                    <span class="text-xs bg-blue-200 text-blue-800 px-2 py-0.5 rounded-full ml-1">
                                        {{ \Carbon\Carbon::parse($jadwal->waktu_mulai)->format('H:i') }} - {{ \Carbon\Carbon::parse($jadwal->waktu_selesai)->format('H:i') }}
                                    </span>
                                </p>
                            </div>
                            <div>
                                <p class="text-gray-600">Metode:</p>
                                <span class="px-2 py-1 rounded text-xs font-bold {{ $jadwal->metode_konseling == 'Online' ? 'bg-purple-100 text-purple-800' : 'bg-gray-200 text-gray-800' }}">
                                    {{ $jadwal->metode_konseling }}
                                </span>
                            </div>
                            <div class="col-span-1 md:col-span-2">
                                <p class="text-gray-600">Keluhan Awal:</p>
                                <p class="italic text-gray-700 bg-white p-2 border rounded mt-1">
                                    "{{ $jadwal->konseling->deskripsi_masalah ?? $jadwal->konseling->permasalahan ?? '-' }}"
                                </p>
                            </div>
                        </div>
                    </div>

                    {{-- FORM UTAMA --}}
                    {{-- Pastikan route ini benar. Menggunakan ID Jadwal sebagai parameter --}}
                    <form method="POST" action="{{ route('dosen-konseling.jadwal.simpanSesi', $jadwal->id_jadwal ?? $jadwal->id) }}" class="space-y-6">
                        @csrf
                        
                        {{-- 1. Catatan / Hasil Konseling --}}
                        <div>
                            <x-input-label for="hasil_konseling" :value="__('Catatan / Hasil Konseling (Wajib)')" />
                            <p class="text-xs text-gray-500 mb-2">Tuliskan ringkasan proses konseling, respons mahasiswa, dan poin-poin penting.</p>
                            
                            <textarea id="hasil_konseling" name="hasil_konseling" rows="6" 
                                class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" 
                                required>{{ old('hasil_konseling') }}</textarea>
                            <x-input-error :messages="$errors->get('hasil_konseling')" class="mt-2" />
                        </div>

                        {{-- 2. Rekomendasi (Opsional) --}}
                        <div>
                            <x-input-label for="rekomendasi" :value="__('Rekomendasi / Tindak Lanjut (Opsional)')" />
                            <textarea id="rekomendasi" name="rekomendasi" rows="3" 
                                class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" 
                                placeholder="Saran langkah selanjutnya...">{{ old('rekomendasi') }}</textarea>
                            <x-input-error :messages="$errors->get('rekomendasi')" class="mt-2" />
                        </div>

                        {{-- 3. Status Akhir Sesi --}}
                        <div class="bg-gray-50 p-5 rounded-lg border border-gray-200">
                            <span class="block font-bold text-md text-gray-800 mb-3">Tentukan Status Akhir Sesi Ini:</span>
                            
                            <div class="flex flex-col sm:flex-row gap-4">
                                <label class="flex items-center p-3 border rounded-md cursor-pointer hover:bg-green-50 transition {{ old('status_akhir') == 'Selesai' ? 'bg-green-50 border-green-500 ring-1 ring-green-500' : 'bg-white' }}">
                                    <input type="radio" name="status_akhir" value="Selesai" class="form-radio text-green-600 h-5 w-5" 
                                        {{ old('status_akhir') == 'Selesai' ? 'checked' : '' }} required>
                                    <div class="ml-3">
                                        <span class="block font-semibold text-gray-900">✅ Masalah Selesai</span>
                                        <span class="block text-xs text-gray-500">Kasus ditutup, tidak perlu sesi lagi.</span>
                                    </div>
                                </label>

                                <label class="flex items-center p-3 border rounded-md cursor-pointer hover:bg-orange-50 transition {{ old('status_akhir') == 'Butuh Sesi Lanjutan' ? 'bg-orange-50 border-orange-500 ring-1 ring-orange-500' : 'bg-white' }}">
                                    <input type="radio" name="status_akhir" value="Butuh Sesi Lanjutan" class="form-radio text-orange-600 h-5 w-5" 
                                        {{ old('status_akhir') == 'Butuh Sesi Lanjutan' ? 'checked' : '' }}>
                                    <div class="ml-3">
                                        <span class="block font-semibold text-gray-900">🔄 Butuh Sesi Lanjutan</span>
                                        <span class="block text-xs text-gray-500">Jadwalkan pertemuan berikutnya nanti.</span>
                                    </div>
                                </label>
                            </div>
                            <x-input-error :messages="$errors->get('status_akhir')" class="mt-2" />
                        </div>

                        {{-- Tombol Aksi --}}
                        <div class="flex items-center justify-end gap-3 pt-4 border-t">
                            <a href="{{ route('dosen-konseling.jadwal.index') }}" class="text-sm text-gray-600 hover:text-gray-900 underline">
                                Batal
                            </a>
                            
                            <x-primary-button class="ml-3 bg-blue-600 hover:bg-blue-700 focus:bg-blue-700 active:bg-blue-800">
                                {{ __('Simpan Hasil Sesi') }}
                            </x-primary-button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>