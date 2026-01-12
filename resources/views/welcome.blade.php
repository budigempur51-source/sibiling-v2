<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=5" />
  <title>SIBILING UBBG | Layanan Konseling Mahasiswa</title>
  <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700,800" rel="stylesheet" />
  <style>
    /* === CSS CUSTOM PROPERTIES (VARIABLES) === */
    :root {
      --primary-green: #2E8B57;
      --primary-green-dark: #23865F;
      --primary-green-light: #3CB371;
      --bg-color: #FFFCF9;
      --text-dark: #1A1A1A;
      --text-medium: #4A4A4A;
      --text-light: #666666;
      --card-bg: #FFFFFF;
      --shadow-sm: 0 2px 8px rgba(0,0,0,0.05);
      --shadow-md: 0 8px 24px rgba(0,0,0,0.08);
      --shadow-lg: 0 20px 40px rgba(0,0,0,0.06);
      --radius-sm: 0.75rem;
      --radius-md: 1.5rem;
      --radius-lg: 2rem;
      --transition-fast: 0.2s ease;
      --transition-medium: 0.3s ease;
      --transition-slow: 0.5s ease;
    }

    /* === RESET & GLOBAL === */
    *, *::before, *::after { box-sizing: border-box; }
    html { scroll-behavior: smooth; overflow-y: scroll; }
    body {
      font-family: 'Inter', sans-serif;
      background-color: var(--bg-color);
      color: var(--text-dark);
      margin: 0;
      padding: 0;
      line-height: 1.6;
      overflow-x: hidden;
      -webkit-font-smoothing: antialiased;
      -moz-osx-font-smoothing: grayscale;
    }

    /* === BACKGROUND DECORATION (ANIMATED) === */
    .bg-decoration {
      position: fixed;
      inset: 0;
      z-index: -1;
      overflow: hidden;
      pointer-events: none;
    }
    .bg-shape-1 {
      position: absolute;
      top: -10%;
      right: -5%;
      width: 50%;
      height: 50%;
      background: linear-gradient(135deg, var(--primary-green-light) 0%, var(--primary-green) 100%);
      border-bottom-left-radius: 50% 40%;
      opacity: 0.08;
      animation: floatShape 25s infinite ease-in-out alternate;
    }
    .bg-shape-2 {
      position: absolute;
      bottom: -10%;
      left: -5%;
      width: 50%;
      height: 50%;
      background: linear-gradient(135deg, var(--primary-green) 0%, var(--primary-green-dark) 100%);
      border-top-right-radius: 50% 40%;
      opacity: 0.08;
      animation: floatShape 30s infinite ease-in-out alternate-reverse;
    }
    @keyframes floatShape {
      0% { transform: translate(0, 0) rotate(0deg); }
      33% { transform: translate(10px, 15px) rotate(1deg); }
      66% { transform: translate(-5px, 10px) rotate(-1deg); }
      100% { transform: translate(0, 0) rotate(0deg); }
    }

    /* === NAVBAR ENHANCED === */
    .navbar {
      position: fixed;
      top: 0;
      left: 0;
      right: 0;
      height: 70px;
      display: flex;
      align-items: center;
      justify-content: center;
      padding: 0 clamp(1rem, 4vw, 3rem);
      background: rgba(255, 252, 249, 0.98);
      backdrop-filter: blur(12px) saturate(180%);
      -webkit-backdrop-filter: blur(12px) saturate(180%);
      z-index: 1000;
      border-bottom: 1px solid rgba(0,0,0,0.03);
      box-shadow: var(--shadow-sm);
      transition: all var(--transition-medium);
    }
    .navbar.scrolled {
      height: 60px;
      box-shadow: 0 4px 20px rgba(0,0,0,0.08);
    }
    .nav-logo-container {
      position: absolute;
      left: clamp(1rem, 4vw, 3rem);
      display: flex;
      align-items: center;
      gap: 0.75rem;
      text-decoration: none;
      transition: transform var(--transition-medium);
    }
    .nav-logo-container:hover {
      transform: translateY(-2px);
    }
    .nav-logo-img {
      height: 35px;
      width: auto;
      transition: transform 0.5s cubic-bezier(0.34, 1.56, 0.64, 1);
    }
    .nav-logo-container:hover .nav-logo-img {
      transform: rotate(10deg) scale(1.1);
    }
    .nav-logo-text {
      font-weight: 800;
      font-size: 1.2rem;
      color: var(--primary-green-dark);
      background: linear-gradient(135deg, var(--primary-green-dark), var(--primary-green));
      -webkit-background-clip: text;
      -webkit-text-fill-color: transparent;
      background-clip: text;
    }
    .nav-links {
      display: flex;
      gap: clamp(1rem, 3vw, 2.5rem);
      list-style: none;
      padding: 0;
      margin: 0;
    }
    .nav-item {
      position: relative;
    }
    .nav-item a {
      text-decoration: none;
      color: var(--text-medium);
      font-weight: 600;
      font-size: clamp(0.85rem, 1.5vw, 0.95rem);
      padding: 0.5rem 0;
      transition: color var(--transition-fast);
    }
    .nav-item a::after {
      content: '';
      position: absolute;
      bottom: -2px;
      left: 0;
      width: 0;
      height: 2px;
      background: linear-gradient(90deg, var(--primary-green), var(--primary-green-light));
      border-radius: 2px;
      transition: width var(--transition-medium);
    }
    .nav-item a:hover {
      color: var(--primary-green);
    }
    .nav-item a:hover::after {
      width: 100%;
    }

    @media (max-width: 768px) {
      .navbar {
        justify-content: space-between;
        padding: 0 1.5rem;
      }
      .nav-logo-container {
        position: static;
      }
      .nav-logo-text {
        display: none;
      }
    }

    /* === HERO SECTION - REDESIGNED === */
    #home {
      min-height: 100vh;
      display: flex;
      flex-direction: column;
      justify-content: center;
      padding: 80px 1.5rem 60px;
      position: relative;
      overflow: hidden;
    }
    .hero-wrapper {
      display: grid;
      grid-template-columns: 1fr;
      gap: 4rem;
      align-items: center;
      max-width: 1400px;
      margin: 0 auto;
      width: 100%;
      animation: fadeInUp 0.8s ease-out;
    }
    .hero-content {
      text-align: center;
    }
    .hero-title-wrapper {
      position: relative;
      display: inline-block;
      margin-bottom: 1.5rem;
    }
    .hero-title {
      font-size: clamp(2rem, 5vw, 3.5rem);
      font-weight: 800;
      line-height: 1.1;
      margin: 0;
      background: linear-gradient(135deg, var(--text-dark) 0%, var(--primary-green-dark) 50%, var(--primary-green) 100%);
      -webkit-background-clip: text;
      -webkit-text-fill-color: transparent;
      background-clip: text;
      position: relative;
      z-index: 2;
    }
    .hero-title-bg {
      position: absolute;
      top: 50%;
      left: 50%;
      transform: translate(-50%, -50%);
      width: 110%;
      height: 120%;
      background: linear-gradient(135deg, rgba(46, 139, 87, 0.05) 0%, rgba(35, 134, 95, 0.1) 100%);
      filter: blur(20px);
      border-radius: 30% 70% 70% 30% / 30% 30% 70% 70%;
      z-index: 1;
      animation: morphing 15s infinite ease-in-out;
    }
    @keyframes morphing {
      0% { border-radius: 30% 70% 70% 30% / 30% 30% 70% 70%; }
      25% { border-radius: 58% 42% 75% 25% / 76% 46% 54% 24%; }
      50% { border-radius: 50% 50% 33% 67% / 55% 27% 73% 45%; }
      75% { border-radius: 33% 67% 58% 42% / 63% 68% 32% 37%; }
      100% { border-radius: 30% 70% 70% 30% / 30% 30% 70% 70%; }
    }
    .hero-subtitle {
      font-size: clamp(1rem, 2.5vw, 1.25rem);
      font-weight: 600;
      color: var(--primary-green);
      margin-bottom: 1.5rem;
      display: inline-block;
      padding: 0.5rem 1.5rem;
      background: rgba(46, 139, 87, 0.08);
      border-radius: 50px;
      animation: fadeInUp 0.8s ease-out 0.1s both;
    }
    .hero-desc {
      font-size: clamp(0.95rem, 1.5vw, 1.1rem);
      color: var(--text-medium);
      max-width: 600px;
      margin: 0 auto 2.5rem;
      line-height: 1.7;
      animation: fadeInUp 0.8s ease-out 0.2s both;
    }
    .btn-hero {
      display: inline-flex;
      align-items: center;
      justify-content: center;
      gap: 0.75rem;
      background: linear-gradient(135deg, var(--primary-green) 0%, var(--primary-green-dark) 100%);
      color: white;
      text-decoration: none;
      font-weight: 600;
      font-size: clamp(0.95rem, 1.5vw, 1.05rem);
      padding: 1rem 2.5rem;
      border-radius: 50px;
      box-shadow: var(--shadow-md);
      transition: all var(--transition-medium);
      position: relative;
      overflow: hidden;
      animation: fadeInUp 0.8s ease-out 0.3s both;
      border: none;
      cursor: pointer;
    }
    .btn-hero::before {
      content: '';
      position: absolute;
      top: 0;
      left: -100%;
      width: 100%;
      height: 100%;
      background: linear-gradient(90deg, transparent, rgba(255,255,255,0.2), transparent);
      transition: left 0.7s ease;
    }
    .btn-hero:hover {
      transform: translateY(-3px);
      box-shadow: var(--shadow-lg);
    }
    .btn-hero:hover::before {
      left: 100%;
    }
    .hero-image-wrapper {
      position: relative;
      animation: floatImage 6s ease-in-out infinite;
    }
    @keyframes floatImage {
      0%, 100% { transform: translateY(0); }
      50% { transform: translateY(-15px); }
    }
    .hero-img {
      width: 100%;
      max-width: 500px;
      height: auto;
      display: block;
      margin: 0 auto;
      filter: drop-shadow(0 20px 40px rgba(0,0,0,0.1));
    }
    .floating-elements {
      position: absolute;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      pointer-events: none;
    }
    .floating-circle {
      position: absolute;
      border-radius: 50%;
      background: rgba(46, 139, 87, 0.05);
      animation: floatElement 15s infinite ease-in-out;
    }
    .circle-1 {
      width: 40px;
      height: 40px;
      top: 10%;
      left: 10%;
      animation-delay: 0s;
    }
    .circle-2 {
      width: 25px;
      height: 25px;
      bottom: 20%;
      right: 15%;
      animation-delay: 1s;
    }
    .circle-3 {
      width: 60px;
      height: 60px;
      top: 50%;
      left: 5%;
      animation-delay: 2s;
    }
    @keyframes floatElement {
      0%, 100% { transform: translate(0, 0) scale(1); }
      33% { transform: translate(10px, -15px) scale(1.1); }
      66% { transform: translate(-15px, 10px) scale(0.9); }
    }

    /* === GRID LAYOUT FOR DESKTOP === */
    @media (min-width: 1024px) {
      .hero-wrapper {
        grid-template-columns: 1fr 1fr;
        text-align: left;
        gap: 5rem;
      }
      .hero-content {
        text-align: left;
      }
      .hero-desc {
        margin: 0 0 2.5rem 0;
      }
      .hero-image-wrapper {
        order: 2;
      }
    }

    /* === COMMON ANIMATIONS === */
    @keyframes fadeInUp {
      from {
        opacity: 0;
        transform: translateY(30px);
      }
      to {
        opacity: 1;
        transform: translateY(0);
      }
    }

    /* === SECTIONS COMMON === */
    section {
      padding: 80px clamp(1rem, 4vw, 2rem);
      max-width: 1300px;
      margin: 0 auto;
      position: relative;
    }

    /* === LANDASAN HUKUM SECTION === */
    #landasan {
      background-color: transparent;
      padding-top: 100px;
    }
    .section-header {
      text-align: center;
      margin-bottom: 4rem;
      animation: fadeInUp 0.8s ease-out;
    }
    .section-title {
      font-size: clamp(1.8rem, 4vw, 2.5rem);
      font-weight: 800;
      margin-bottom: 1rem;
      color: var(--text-dark);
    }
    .section-desc {
      color: var(--text-medium);
      font-size: clamp(1rem, 1.5vw, 1.1rem);
      max-width: 700px;
      margin: 0 auto;
    }
    .docs-grid {
      display: grid;
      grid-template-columns: repeat(auto-fill, minmax(min(100%, 350px), 1fr));
      gap: 2rem;
      animation: fadeInUp 0.8s ease-out 0.2s both;
    }
    .doc-card {
      background: var(--card-bg);
      border-radius: var(--radius-md);
      padding: 2rem;
      box-shadow: var(--shadow-md);
      border: 1px solid rgba(46, 139, 87, 0.1);
      display: flex;
      flex-direction: column;
      position: relative;
      overflow: hidden;
      transition: all var(--transition-medium);
      height: 100%;
    }
    .doc-card::before {
      content: '';
      position: absolute;
      top: 0;
      left: 0;
      width: 100%;
      height: 4px;
      background: linear-gradient(90deg, var(--primary-green), var(--primary-green-light));
      transform: scaleX(0);
      transform-origin: left;
      transition: transform var(--transition-medium);
    }
    .doc-card:hover {
      transform: translateY(-8px);
      box-shadow: var(--shadow-lg);
      border-color: var(--primary-green-light);
    }
    .doc-card:hover::before {
      transform: scaleX(1);
    }
    .doc-category {
      position: absolute;
      top: 1.5rem;
      right: 1.5rem;
      font-size: 0.75rem;
      font-weight: 700;
      text-transform: uppercase;
      padding: 0.25rem 0.75rem;
      border-radius: 20px;
      background: rgba(46, 139, 87, 0.1);
      color: var(--primary-green);
    }
    .doc-icon {
      width: 3.5rem;
      height: 3.5rem;
      background: rgba(46, 139, 87, 0.08);
      border-radius: 1rem;
      display: flex;
      align-items: center;
      justify-content: center;
      margin-bottom: 1.5rem;
      color: var(--primary-green);
      transition: all var(--transition-medium);
    }
    .doc-card:hover .doc-icon {
      transform: scale(1.1) rotate(5deg);
      background: rgba(46, 139, 87, 0.15);
    }
    .doc-title {
      font-size: 1.25rem;
      font-weight: 700;
      margin-bottom: 0.5rem;
      color: var(--text-dark);
    }
    .doc-meta {
      font-size: 0.85rem;
      color: var(--primary-green);
      font-family: 'Inter', monospace;
      margin-bottom: 1rem;
      display: block;
    }
    .doc-desc {
      color: var(--text-medium);
      font-size: 0.95rem;
      margin-bottom: 2rem;
      flex-grow: 1;
      line-height: 1.6;
    }
    .btn-download {
      display: inline-flex;
      align-items: center;
      justify-content: center;
      gap: 0.5rem;
      width: 100%;
      padding: 0.875rem;
      border-radius: var(--radius-sm);
      background: white;
      border: 2px solid var(--primary-green);
      color: var(--primary-green);
      font-weight: 600;
      text-decoration: none;
      transition: all var(--transition-medium);
      margin-top: auto;
    }
    .btn-download:hover {
      background: var(--primary-green);
      color: white;
      transform: translateY(-2px);
    }

    /* === TENTANG KAMI SECTION === */
    #tentang {
      padding-top: 100px;
    }
    .about-label {
      display: inline-block;
      background-color: rgba(46, 139, 87, 0.1);
      color: var(--primary-green);
      padding: 0.5rem 1.5rem;
      border-radius: 50px;
      font-weight: 700;
      font-size: 0.85rem;
      text-transform: uppercase;
      letter-spacing: 1px;
      margin-bottom: 1.5rem;
    }
    .about-header {
      text-align: center;
      max-width: 800px;
      margin: 0 auto 5rem;
      animation: fadeInUp 0.8s ease-out;
    }
    .visi-quote {
      padding: 2.5rem;
      margin-top: 2rem;
      background: var(--card-bg);
      border-radius: var(--radius-md);
      box-shadow: var(--shadow-md);
      text-align: center;
      border: 1px solid rgba(46, 139, 87, 0.1);
      position: relative;
      overflow: hidden;
    }
    .visi-quote::before {
      content: '"';
      position: absolute;
      top: 10px;
      left: 20px;
      font-size: 6rem;
      color: rgba(46, 139, 87, 0.05);
      font-family: serif;
      line-height: 1;
      z-index: 0;
    }
    .visi-quote p {
      font-size: clamp(1.1rem, 1.8vw, 1.3rem);
      font-weight: 600;
      font-style: italic;
      color: var(--primary-green-dark);
      position: relative;
      z-index: 1;
      line-height: 1.6;
    }

    /* TEAM SECTION */
    .team-header {
      text-align: center;
      margin-bottom: 4rem;
      animation: fadeInUp 0.8s ease-out 0.1s both;
    }
    .team-grid {
      display: grid;
      grid-template-columns: 1fr;
      gap: 2.5rem;
      margin-top: 3rem;
      animation: fadeInUp 0.8s ease-out 0.2s both;
    }
    @media (min-width: 768px) {
      .team-grid {
        grid-template-columns: repeat(2, 1fr);
      }
    }
    @media (min-width: 1024px) {
      .team-grid {
        grid-template-columns: repeat(3, 1fr);
        gap: 2.5rem;
      }
    }
    .team-card {
      background: var(--card-bg);
      border-radius: var(--radius-md);
      box-shadow: var(--shadow-md);
      overflow: hidden;
      transition: all var(--transition-medium);
      display: flex;
      flex-direction: column;
      height: 100%;
      border: 1px solid rgba(46, 139, 87, 0.05);
    }
    .team-card:hover {
      transform: translateY(-10px);
      box-shadow: var(--shadow-lg);
      border-color: rgba(46, 139, 87, 0.2);
    }
    .card-top {
      background: linear-gradient(135deg, rgba(46, 139, 87, 0.05), rgba(35, 134, 95, 0.1));
      padding: 3rem 1rem 0;
      text-align: center;
      position: relative;
    }
    .photo-wrapper {
      width: 140px;
      height: 140px;
      margin: 0 auto -70px;
      position: relative;
      z-index: 10;
    }
    .team-photo {
      width: 100%;
      height: 100%;
      object-fit: cover;
      border-radius: 50%;
      border: 5px solid var(--card-bg);
      box-shadow: var(--shadow-md);
      background-color: #eee;
      transition: all var(--transition-medium);
    }
    .team-card:hover .team-photo {
      transform: scale(1.05);
      border-color: var(--primary-green-light);
    }
    .card-body {
      padding: 5rem 1.5rem 2rem;
      text-align: center;
      flex-grow: 1;
      display: flex;
      flex-direction: column;
      justify-content: space-between;
    }
    .team-name {
      font-size: clamp(1.2rem, 1.5vw, 1.35rem);
      font-weight: 700;
      color: var(--text-dark);
      margin-bottom: 0.25rem;
      line-height: 1.3;
    }
    .team-role {
      display: inline-block;
      font-size: 0.85rem;
      font-weight: 700;
      color: var(--primary-green);
      text-transform: uppercase;
      margin-bottom: 1rem;
      padding-bottom: 0.3rem;
      position: relative;
    }
    .team-role::after {
      content: '';
      position: absolute;
      bottom: 0;
      left: 50%;
      transform: translateX(-50%);
      width: 40px;
      height: 2px;
      background: var(--primary-green);
      border-radius: 2px;
    }
    .team-bio {
      font-size: 0.95rem;
      color: var(--text-medium);
      line-height: 1.6;
      margin-bottom: 1.5rem;
    }
    .github-btn {
      display: inline-flex;
      align-items: center;
      justify-content: center;
      gap: 8px;
      background-color: var(--text-dark);
      color: #ffffff;
      padding: 0.75rem 1.5rem;
      border-radius: 50px;
      font-weight: 600;
      font-size: 0.9rem;
      text-decoration: none;
      transition: all var(--transition-medium);
      margin: 0 auto;
      width: fit-content;
      box-shadow: var(--shadow-sm);
      border: 2px solid var(--text-dark);
    }
    .github-btn:hover {
      background-color: var(--primary-green);
      border-color: var(--primary-green);
      transform: translateY(-2px);
      box-shadow: var(--shadow-md);
    }
    .github-btn svg {
      fill: currentColor;
      width: 20px;
      height: 20px;
    }

    /* === RESPONSIVE ENHANCEMENTS === */
    @media (max-width: 480px) {
      .hero-wrapper {
        gap: 2.5rem;
      }
      .btn-hero {
        padding: 0.875rem 2rem;
        width: 100%;
        max-width: 300px;
      }
      .docs-grid {
        grid-template-columns: 1fr;
      }
      .visi-quote {
        padding: 1.5rem;
      }
    }

    /* === PERFORMANCE OPTIMIZATIONS === */
    .will-change {
      will-change: transform;
    }
  </style>
</head>
<body>

  <!-- Background Decoration -->
  <div class="bg-decoration">
    <div class="bg-shape-1"></div>
    <div class="bg-shape-2"></div>
  </div>

  <!-- Navigation -->
  <nav class="navbar" id="navbar">
    <a href="#home" class="nav-logo-container">
      <img src="{{ asset('images/logo-ubbg.png') }}" alt="Logo UBBG" class="nav-logo-img">
      <span class="nav-logo-text">SiBiling</span>
    </a>
    <ul class="nav-links">
      <li class="nav-item"><a href="#home">Beranda</a></li>
      <li class="nav-item"><a href="#landasan">Landasan Hukum</a></li>
      <li class="nav-item"><a href="#tentang">Tentang Kami</a></li>
    </ul>
  </nav>

  <!-- Hero Section -->
  <section id="home">
    <div class="hero-wrapper">
      <div class="hero-content">
        <div class="hero-title-wrapper">
          <h1 class="hero-title">Selamat Datang di SIBILING UBBG</h1>
          <div class="hero-title-bg"></div>
        </div>
        <p class="hero-subtitle">Layanan Konseling Mahasiswa Universitas Bina Bangsa Getsempena</p>
        <p class="hero-desc">
          Kami hadir untuk mendampingi mahasiswa menghadapi berbagai tantangan akademik, pribadi, dan karier.  
          Dapatkan ruang curhat yang aman, nyaman, dan penuh empati bersama konselor profesional kami.
        </p>
        <a href="{{ route('login') }}" class="btn-hero">
          Mari Konseling
          <svg style="width:1.2rem;height:1.2rem;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"/>
          </svg>
        </a>
      </div>
      <div class="hero-image-wrapper">
        <div class="floating-elements">
          <div class="floating-circle circle-1"></div>
          <div class="floating-circle circle-2"></div>
          <div class="floating-circle circle-3"></div>
        </div>
        <img src="{{ asset('images/konseling.png') }}" alt="Ilustrasi Konseling" class="hero-img">
      </div>
    </div>
  </section>

  <!-- Landasan Hukum Section -->
  <section id="landasan">
    <div class="section-header">
      <h2 class="section-title">Landasan Hukum & SOP</h2>
      <p class="section-desc">Transparansi dan standar operasional resmi Unit Layanan Bimbingan Konseling Universitas Bina Bangsa Getsempena.</p>
    </div>

    <div class="docs-grid">
      @if(isset($dokumen) && count($dokumen) > 0)
        @foreach($dokumen as $dok)
        <div class="doc-card">
          <span class="doc-category">{{ $dok['kategori'] }}</span>
          <div class="doc-icon">
            <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
              <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path>
              <polyline points="14 2 14 8 20 8"></polyline>
              <line x1="16" y1="13" x2="8" y2="13"></line>
              <line x1="16" y1="17" x2="8" y2="17"></line>
              <polyline points="10 9 9 9 8 9"></polyline>
            </svg>
          </div>
          <h3 class="doc-title">{{ $dok['judul'] }}</h3>
          <span class="doc-meta">{{ $dok['nomor'] }} • {{ $dok['tahun'] }}</span>
          <p class="doc-desc">{{ $dok['deskripsi'] }}</p>
          <a href="{{ asset('assets/docs/' . $dok['file']) }}" target="_blank" class="btn-download">
            <span>Buka Dokumen</span>
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
              <path d="M18 13v6a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h6"></path>
              <polyline points="15 3 21 3 21 9"></polyline>
              <line x1="10" y1="14" x2="21" y2="3"></line>
            </svg>
          </a>
        </div>
        @endforeach
      @endif
    </div>
  </section>

  <!-- Tentang Kami Section -->
  <section id="tentang">
    <div class="about-header">
      <span class="about-label">Tentang Aplikasi</span>
      <h2 class="section-title" style="margin-bottom: 1rem;">{{ $aboutWeb['judul'] ?? 'Tentang Kami' }}</h2>
      <p class="section-desc">{{ $aboutWeb['deskripsi'] ?? '' }}</p>
      <div class="visi-quote">
        <p>"{{ $aboutWeb['visi'] ?? '' }}"</p>
      </div>
    </div>

    <div class="team-header">
      <span class="about-label">Tim Kami</span>
      <h2 class="section-title">Meet the Developers</h2>
    </div>

    <div class="team-grid">
      @if(isset($tim) && count($tim) > 0)
        @foreach($tim as $member)
        <div class="team-card">
          <div class="card-top">
            <div class="photo-wrapper">
              <img src="{{ asset($member['foto']) }}" alt="{{ $member['nama'] }}" class="team-photo">
            </div>
          </div>
          <div class="card-body">
            <div>
              <h3 class="team-name">{{ $member['nama'] }}</h3>
              <span class="team-role">{{ $member['role'] }}</span>
              <p class="team-bio">{{ $member['bio'] }}</p>
            </div>
            @if(!empty($member['github']))
            <a href="{{ $member['github'] }}" target="_blank" class="github-btn">
              <svg viewBox="0 0 24 24">
                <path d="M12 0c-6.626 0-12 5.373-12 12 0 5.302 3.438 9.8 8.207 11.387.599.111.793-.261.793-.577v-2.234c-3.338.726-4.033-1.416-4.033-1.416-.546-1.387-1.333-1.756-1.333-1.756-1.089-.745.083-.729.083-.729 1.205.084 1.839 1.237 1.839 1.237 1.07 1.834 2.807 1.304 3.492.997.107-.775.418-1.305.762-1.604-2.665-.305-5.467-1.334-5.467-5.931 0-1.311.469-2.381 1.236-3.221-.124-.303-.535-1.524.117-3.176 0 0 1.008-.322 3.301 1.23.957-.266 1.983-.399 3.003-.404 1.02.005 2.047.138 3.006.404 2.291-1.552 3.297-1.23 3.297-1.23.653 1.653.242 2.874.118 3.176.77.84 1.235 1.911 1.235 3.221 0 4.609-2.807 5.624-5.479 5.921.43.372.823 1.102.823 2.222v3.293c0 .319.192.694.801.576 4.765-1.589 8.199-6.086 8.199-11.386 0-6.627-5.373-12-12-12z"/>
              </svg>
              GitHub
            </a>
            @endif
          </div>
        </div>
        @endforeach
      @endif
    </div>
  </section>

  <!-- JavaScript for Enhanced Interactivity -->
  <script>
    // Wait for DOM to be fully loaded
    document.addEventListener('DOMContentLoaded', function() {
      // Navbar scroll effect
      const navbar = document.getElementById('navbar');
      window.addEventListener('scroll', () => {
        if (window.scrollY > 50) {
          navbar.classList.add('scrolled');
        } else {
          navbar.classList.remove('scrolled');
        }
      });

      // Smooth scroll for anchor links
      document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function(e) {
          const targetId = this.getAttribute('href');
          if (targetId === '#') return;
          
          const targetElement = document.querySelector(targetId);
          if (targetElement) {
            e.preventDefault();
            const navbarHeight = navbar.offsetHeight;
            const targetPosition = targetElement.offsetTop - navbarHeight;
            
            window.scrollTo({
              top: targetPosition,
              behavior: 'smooth'
            });
          }
        });
      });

      // Intersection Observer for fade-in animations
      const observerOptions = {
        threshold: 0.1,
        rootMargin: '0px 0px -50px 0px'
      };

      const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
          if (entry.isIntersecting) {
            entry.target.style.opacity = '1';
            entry.target.style.transform = 'translateY(0)';
          }
        });
      }, observerOptions);

      // Observe all sections for fade-in
      document.querySelectorAll('section').forEach(section => {
        section.style.opacity = '0';
        section.style.transform = 'translateY(20px)';
        section.style.transition = 'opacity 0.6s ease, transform 0.6s ease';
        observer.observe(section);
      });

      // Button ripple effect
      document.querySelectorAll('.btn-hero, .btn-download').forEach(button => {
        button.addEventListener('click', function(e) {
          const x = e.clientX - e.target.getBoundingClientRect().left;
          const y = e.clientY - e.target.getBoundingClientRect().top;
          
          const ripple = document.createElement('span');
          ripple.style.position = 'absolute';
          ripple.style.borderRadius = '50%';
          ripple.style.backgroundColor = 'rgba(255, 255, 255, 0.5)';
          ripple.style.transform = 'scale(0)';
          ripple.style.animation = 'ripple 0.6s linear';
          ripple.style.left = x + 'px';
          ripple.style.top = y + 'px';
          
          this.style.position = 'relative';
          this.style.overflow = 'hidden';
          this.appendChild(ripple);
          
          setTimeout(() => ripple.remove(), 600);
        });
      });

      // Add CSS for ripple animation
      const style = document.createElement('style');
      style.textContent = `
        @keyframes ripple {
          to {
            transform: scale(4);
            opacity: 0;
          }
        }
      `;
      document.head.appendChild(style);

      // Preload images for better performance
      const images = document.querySelectorAll('img');
      images.forEach(img => {
        img.loading = 'lazy';
      });
    });
  </script>
</body>
</html>