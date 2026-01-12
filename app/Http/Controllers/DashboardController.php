<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\KonselingDosen;
use App\Models\Dosen;
use App\Models\Mahasiswa;
use App\Models\User;
use App\Models\Konseling;
use App\Models\JadwalKonseling;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        /** @var User $user */
        $user = Auth::user();

        // 1. Role Admin
        if ($user->hasRole('admin')) {
            return view('admin.dashboard', [
                'totalDosen' => Dosen::count(),
                'totalMahasiswa' => Mahasiswa::count(),
                'totalUsers' => User::count(),
            ]);
        }

        // 2. Role Warek
        if ($user->hasRole('warek')) {
            return redirect()->route('warek.dashboard');
        }

        // 3. Role Mahasiswa
        if ($user->hasRole('mahasiswa')) {
            $konselingTerakhir = null;
            if ($user->mahasiswa) {
                $konselingTerakhir = Konseling::where('nim_mahasiswa', $user->mahasiswa->nim)
                                            ->latest('tgl_pengajuan')
                                            ->first();
            }
            return view('mahasiswa.dashboard', compact('konselingTerakhir'));
        }

        // 4. LOGIKA "SUPER DOSEN" (Multi-Role)
        $dosen = $user->dosen; 

        // Default Data Dashboard
        $data = [
            'user' => $user,
            'isKonselor' => false,
            'jumlahPengajuanBaru' => 0,
            'jadwalHariIni' => 0,
            'isPA' => false,
            'totalMahasiswaBimbingan' => 0,
            'totalCurhat' => 0,
            'dalamProses' => 0,
            'selesai' => 0,
            'jadwalTerdekat' => null,
        ];

        // --- Logic Dashboard Existing ---
        if ($user->hasRole('dosen_konseling')) {
            $data['isKonselor'] = true;
            $data['jumlahPengajuanBaru'] = Konseling::where('status_konseling', 'Menunggu Verifikasi')->count();
            if ($dosen) {
                $dosenId = $dosen->id_dosen ?? $dosen->id;
                $data['jadwalHariIni'] = JadwalKonseling::whereDate('tgl_sesi', Carbon::today())
                                            ->where('id_dosen_konseling', $dosenId)
                                            ->whereDoesntHave('hasilKonseling')
                                            ->count();
            }
        }

        if ($user->hasRole('dosen_pembimbing')) {
            $data['isPA'] = true;
            if ($dosen) {
                 $data['totalMahasiswaBimbingan'] = Mahasiswa::where('id_dosen_wali', $dosen->nidn)->count();
            }
        }

        $data['totalCurhat'] = KonselingDosen::where('email_dosen', $user->email)->count();
        $data['dalamProses'] = KonselingDosen::where('email_dosen', $user->email)
                        ->whereIn('status_konseling', ['Menunggu Verifikasi', 'Dijadwalkan'])
                        ->count();     
        $data['selesai'] = KonselingDosen::where('email_dosen', $user->email)
                        ->where('status_konseling', 'Selesai')
                        ->count();
        $data['jadwalTerdekat'] = KonselingDosen::where('email_dosen', $user->email)
                        ->where('status_konseling', 'Dijadwalkan')
                        ->whereNotNull('jadwal_konseling')
                        ->where('jadwal_konseling', '>=', now())
                        ->orderBy('jadwal_konseling', 'asc')
                        ->first();

        // --- TAMBAHAN DATA PUBLIC (LANDASAN & TENTANG KAMI) ---
        // Data ini kita inject agar view dashboard bisa merender section bawah
        
        $data['dokumen'] = [
            [
                'judul' => 'SOP Layanan Bimbingan Konseling',
                'nomor' => 'SOP-0001/UPBK/IX/2025',
                'tahun' => '2025',
                'deskripsi' => 'Pedoman standar alur pendaftaran, pelaksanaan konseling, hingga evaluasi.',
                'file' => 'sop-bk-2025.pdf', 
                'kategori' => 'SOP'
            ],
            [
                'judul' => 'Kebijakan Pengelolaan & Fungsi UPBK',
                'nomor' => '0470/131013/RKT/SK/IX/2025',
                'tahun' => '2025',
                'deskripsi' => 'Landasan operasional yang mengatur jenis pelayanan serta tugas dan fungsi konselor.',
                'file' => 'sk-kebijakan-2025.pdf',
                'kategori' => 'SK Rektor'
            ],
            [
                'judul' => 'SK Pembentukan Unit Layanan Kesehatan',
                'nomor' => '1740/131013/SK/V/2021',
                'tahun' => '2021',
                'deskripsi' => 'Surat Keputusan pendirian resmi Unit Layanan Kesehatan dan Bimbingan Konseling.',
                'file' => 'sk-pembentukan-2021.pdf',
                'kategori' => 'SK Rektor'
            ],
        ];

        $data['aboutWeb'] = [
            'judul' => 'Menghubungkan Hati, Menyelesaikan Masalah',
            'deskripsi' => 'SiBiling hadir sebagai respons digital terhadap kebutuhan kesehatan mental di lingkungan UBBG. Kami percaya bahwa setiap civitas akademika berhak mendapatkan akses layanan konseling yang privat, mudah, dan profesional.',
            'visi' => 'Mewujudkan civitas akademika UBBG yang sehat mental, berkarakter, dan prestatif.'
        ];

        $data['tim'] = [
            [
                'nama' => 'Gempur Budi Anarki',
                'role' => 'Back End Developer',
                'prodi' => 'S1 Ilmu Komputer',
                'foto' => 'images/gempur.png', 
                'bio' => 'Merancang arsitektur server yang kokoh dan keamanan data sistem.',
                'github' => 'https://github.com/gempurbudianarki',
            ],
            [
                'nama' => 'Muhamad Adzky Maulana',
                'role' => 'Front End Developer',
                'prodi' => 'S1 Ilmu Komputer',
                'foto' => 'images/adzky.png', 
                'bio' => 'Mengubah desain menjadi antarmuka web yang responsif dan interaktif.',
                'github' => 'https://github.com/kyyyyyykyyy', 
            ],
            [
                'nama' => 'Farhan Alfarisi',
                'role' => 'UI/UX Designer',
                'prodi' => 'S1 Ilmu Komputer',
                'foto' => 'images/farhan.png', 
                'bio' => 'Menciptakan desain visual yang estetis dan pengalaman pengguna yang intuitif.',
                'github' => 'https://github.com/kyyyyyykyyy',
            ],
        ];

        return view('dosen.dashboard', $data);
    }
}