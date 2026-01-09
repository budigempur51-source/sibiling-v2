<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>SIBILING UBBG | Layanan Konseling Mahasiswa</title>
  <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700,800" rel="stylesheet" />
  <style>
    /* === FIX SCROLLBAR LONCAT === */
    html {
        overflow-y: scroll; /* Paksa scrollbar selalu ada biar layout gak geser */
    }

    /* === VARIABLES (SAMA PERSIS) === */
    :root {
      --primary-green: #2E8B57;
      --primary-light: #3CB371;
      --primary-dark: #23865F;
      --bg-cream: #FFFCF9;
      --bg-green-light: #EAF7F2;
      --text-dark: #1A1A1A;
      --text-gray: #4A4A4A;
      --shadow-sm: 0 2px 8px rgba(0, 0, 0, 0.05);
      --shadow-md: 0 8px 24px rgba(0, 0, 0, 0.08);
      --shadow-lg: 0 20px 40px rgba(0, 0, 0, 0.06);
    }

    * { margin: 0; padding: 0; box-sizing: border-box; }

    body {
      font-family: 'Inter', sans-serif;
      background-color: var(--bg-cream);
      color: var(--text-dark);
      line-height: 1.6;
    }

    /* === NAVBAR FIXED & CENTERED (COPY-PASTE 1:1 DARI TENTANG KAMI) === */
    .navbar {
        position: fixed;
        top: 0; left: 0; right: 0;
        height: 70px;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 0 2rem;
        background: rgba(255, 252, 249, 0.95);
        backdrop-filter: blur(8px);
        z-index: 1000;
        border-bottom: 1px solid rgba(0,0,0,0.03);
        box-shadow: var(--shadow-sm);
    }

    .nav-logo-container {
        position: absolute; left: 2rem; display: flex; align-items: center; gap: 0.75rem; text-decoration: none;
    }
    .nav-logo-img { height: 35px; width: auto; transition: transform 0.3s; }
    .nav-logo-img:hover { transform: scale(1.1); }
    .nav-logo-text { font-weight: 800; font-size: 1.2rem; color: var(--primary-dark); }

    .nav-links { display: flex; gap: 2.5rem; list-style: none; }
    .nav-item a {
        text-decoration: none; color: var(--text-gray); font-weight: 600; font-size: 0.95rem;
        transition: color 0.3s ease; position: relative;
    }
    .nav-item a:hover, .nav-item a.active { color: var(--primary-green); }
    .nav-item a::after {
        content: ''; position: absolute; bottom: -4px; left: 50%; width: 0; height: 2px;
        background: var(--primary-green); transition: all 0.3s ease; transform: translateX(-50%);
    }
    .nav-item a:hover::after, .nav-item a.active::after { width: 100%; }

    @media (max-width: 768px) {
        .navbar { justify-content: space-between; padding: 0 1.5rem; }
        .nav-logo-container { position: static; }
        .nav-logo-text { display: none; }
        .nav-links { gap: 1rem; font-size: 0.85rem; }
    }

    /* === BACKGROUND SHAPES (SAMA) === */
    .bg-shapes { position: fixed; inset: 0; z-index: -1; overflow: hidden; pointer-events: none; }
    .shape-top-right { position: absolute; top: -10%; right: -5%; width: 50%; height: 50%; background: linear-gradient(135deg, var(--primary-light) 0%, var(--primary-green) 100%); border-bottom-left-radius: 50% 40%; opacity: 0.08; animation: float 8s ease-in-out infinite; }
    .shape-bottom-left { position: absolute; bottom: -10%; left: -5%; width: 50%; height: 50%; background: linear-gradient(135deg, var(--primary-green) 0%, var(--primary-dark) 100%); border-top-right-radius: 50% 40%; opacity: 0.08; animation: float 10s ease-in-out infinite reverse; }
    @keyframes float { 0%, 100% { transform: translateY(0) rotate(0deg); } 50% { transform: translateY(-20px) rotate(1deg); } }

    /* === CONTAINER (DISAMAKAN 1100px) === */
    .container {
        max-width: 1100px; /* Disamakan dengan Tentang Kami */
        margin: 0 auto;
        padding: 100px 1.5rem 4rem; /* Padding top disamakan 100px */
        /* Hapus min-height 100vh biar flow-nya sama kayak halaman lain */
        display: flex; flex-direction: column; 
    }

    /* === HERO CONTENT (ANIMASI SAMA) === */
    .hero-wrapper {
        display: flex; flex-direction: column; align-items: center; gap: 3rem;
        animation: fadeIn 0.8s ease-out; /* Animasi Fade In global */
    }

    .hero-content {
        text-align: center; max-width: 600px;
        animation: slideUp 0.8s 0.2s both;
    }

    h1 {
        font-size: 2.25rem; font-weight: 800; margin-bottom: 1rem; line-height: 1.2;
        background: linear-gradient(135deg, var(--text-dark) 0%, var(--primary-dark) 100%);
        -webkit-background-clip: text; -webkit-text-fill-color: transparent;
    }

    .subtitle {
        font-size: 1.15rem; font-weight: 600; color: var(--primary-green);
        margin-bottom: 1rem; letter-spacing: -0.01em;
    }

    .desc {
        font-size: 1rem; color: var(--text-gray); margin-bottom: 2rem;
        line-height: 1.6;
    }

    /* BUTTON */
    .btn {
        display: inline-flex; align-items: center; justify-content: center; gap: 0.5rem;
        background: linear-gradient(135deg, var(--primary-green) 0%, var(--primary-dark) 100%);
        color: white; text-decoration: none; font-weight: 600;
        font-size: 1rem; padding: 0.875rem 2rem; border-radius: 50px;
        box-shadow: var(--shadow-md); transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        position: relative; overflow: hidden;
    }
    .btn:hover { transform: translateY(-3px); box-shadow: var(--shadow-lg); }
    .btn svg { width: 1.2rem; height: 1.2rem; transition: transform 0.3s; }
    .btn:hover svg { transform: translateX(4px); }

    /* IMAGE */
    .hero-image-wrapper {
        width: 100%; display: flex; justify-content: center;
        animation: slideUp 0.8s 0.4s both;
    }
    .hero-img {
        width: 100%; max-width: 450px; height: auto;
        filter: drop-shadow(var(--shadow-lg));
        transition: transform 0.5s ease;
    }
    .hero-img:hover { transform: scale(1.02); }

    /* ANIMASI (SAMA PERSIS) */
    @keyframes fadeIn { from { opacity: 0; } to { opacity: 1; } }
    @keyframes slideUp { from { opacity: 0; transform: translateY(30px); } to { opacity: 1; transform: translateY(0); } }

    /* DESKTOP LAYOUT */
    @media (min-width: 1024px) {
        /* Tambah margin top di desktop biar vertikal align lebih enak */
        .container { padding-top: 140px; } 
        
        .hero-wrapper {
            flex-direction: row; justify-content: space-between; align-items: center;
            text-align: left; gap: 4rem;
        }
        .hero-content { text-align: left; flex: 1; margin: 0; }
        .hero-image-wrapper { flex: 1; justify-content: flex-end; }
        h1 { font-size: 3rem; }
    }
  </style>
</head>
<body>

  <div class="bg-shapes">
    <div class="shape-top-right"></div>
    <div class="shape-bottom-left"></div>
  </div>

  <nav class="navbar">
      <a href="{{ route('welcome') }}" class="nav-logo-container">
          <img src="{{ asset('images/logo-ubbg.png') }}" alt="Logo" class="nav-logo-img">
          <span class="nav-logo-text">SiBiling</span>
      </a>
      <ul class="nav-links">
          <li class="nav-item"><a href="{{ route('welcome') }}" class="active">Beranda</a></li>
          <li class="nav-item"><a href="{{ route('public.landasan') }}">Landasan Hukum</a></li>
          <li class="nav-item"><a href="{{ route('public.tentang') }}">Tentang Kami</a></li>
      </ul>
  </nav>

  <div class="container">
    <div class="hero-wrapper">
        <div class="hero-content">
          <h1>Selamat Datang di SIBILING UBBG</h1>
          <p class="subtitle">Layanan Konseling Mahasiswa Universitas Bina Bangsa Getsempena</p>
          <p class="desc">
            Kami hadir untuk mendampingi mahasiswa menghadapi berbagai tantangan akademik, pribadi, dan karier.  
            Dapatkan ruang curhat yang aman, nyaman, dan penuh empati bersama konselor profesional kami.
          </p>
          
          <a href="{{ route('login') }}" class="btn">
            Mari Konseling
            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"/>
            </svg>
          </a>
        </div>

        <div class="hero-image-wrapper">
          <img src="{{ asset('images/konseling.png') }}" alt="Ilustrasi Konseling" class="hero-img">
        </div>
    </div>
  </div>

</body>
</html>
