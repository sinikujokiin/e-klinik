<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title><?= web()->name ?></title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="<?= base_url(web()->icon) ?>" rel="icon">
  <link href="<?= base_url(web()->icon) ?>" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Roboto:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="<?= base_url('assets/landing') ?>/vendor/fontawesome-free/css/all.min.css" rel="stylesheet">
  <link href="<?= base_url('assets/landing') ?>/vendor/animate.css/animate.min.css" rel="stylesheet">
  <link href="<?= base_url('assets/landing') ?>/vendor/aos/aos.css" rel="stylesheet">
  <link href="<?= base_url('assets/landing') ?>/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="<?= base_url('assets/landing') ?>/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="<?= base_url('assets/landing') ?>/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="<?= base_url('assets/landing') ?>/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
  <link href="<?= base_url('assets/landing') ?>/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="<?= base_url('assets/landing') ?>/css/style.css" rel="stylesheet">

  <!-- =======================================================
  * Template Name: Medicio
  * Updated: May 30 2023 with Bootstrap v5.3.0
  * Template URL: https://bootstrapmade.com/medicio-free-bootstrap-theme/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body>

  <!-- ======= Top Bar ======= -->
  <div id="topbar" class="d-flex align-items-center fixed-top">
    <div class="container d-flex align-items-center justify-content-center justify-content-md-between">
      <div class="align-items-center d-none d-md-flex">
        <i class="bi bi-envelope"></i> <?= web()->email ?>
      </div>
      <div class="d-flex align-items-center">
        <i class="bi bi-phone"></i> <?= web()->phone ?>
      </div>
    </div>
  </div>

  <!-- ======= Header ======= -->
  <header id="header" class="fixed-top">
    <div class="container d-flex align-items-center">

      <a href="<?= base_url() ?>" class="logo me-auto"><img src="<?= base_url(web()->logo) ?>" alt=""> <span class="h4"><?= web()->name ?></span></a>
      <!-- Uncomment below if you prefer to use an image logo -->
      <!-- <h1 class="logo me-auto"><a href="<?= base_url() ?>">Medicio</a></h1> -->

      <nav id="navbar" class="navbar order-last order-lg-0">
        <ul>
          <li><a class="nav-link scrollto " href="#hero">Beranda</a></li>
          <li><a class="nav-link scrollto" href="#about">Tentang Kami</a></li>
          <li><a class="nav-link scrollto" href="#services">Pelayanan</a></li>
          <!-- <li><a class="nav-link scrollto" href="#departments">Departments</a></li>
          <li><a class="nav-link scrollto" href="#doctors">Doctors</a></li>
          <li class="dropdown"><a href="#"><span>Drop Down</span> <i class="bi bi-chevron-down"></i></a>
            <ul>
              <li><a href="#">Drop Down 1</a></li>
              <li class="dropdown"><a href="#"><span>Deep Drop Down</span> <i class="bi bi-chevron-right"></i></a>
                <ul>
                  <li><a href="#">Deep Drop Down 1</a></li>
                  <li><a href="#">Deep Drop Down 2</a></li>
                  <li><a href="#">Deep Drop Down 3</a></li>
                  <li><a href="#">Deep Drop Down 4</a></li>
                  <li><a href="#">Deep Drop Down 5</a></li>
                </ul>
              </li>
              <li><a href="#">Drop Down 2</a></li>
              <li><a href="#">Drop Down 3</a></li>
              <li><a href="#">Drop Down 4</a></li>
            </ul>
          </li>
          <li><a class="nav-link scrollto" href="#contact">Contact</a></li>
        </ul> -->
        <i class="bi bi-list mobile-nav-toggle"></i>
      </nav><!-- .navbar -->

      <!-- <a href="#appointment" class="appointment-btn scrollto"><span class="d-none d-md-inline">Make an</span> Appointment</a> -->

    </div>
  </header><!-- End Header -->

  <!-- ======= Hero Section ======= -->
  <section id="hero">
    <div id="heroCarousel" data-bs-interval="5000" class="carousel slide carousel-fade" data-bs-ride="carousel">

      <ol class="carousel-indicators" id="hero-carousel-indicators"></ol>

      <div class="carousel-inner" role="listbox">

        <!-- Slide 1 -->
        <div class="carousel-item active" style="background-image: url(<?= base_url('assets/landing/')?>img//slide/slide-1.jpg)">
          <div class="container">
            <h2>Selamat Datang di <span><?= web()->name ?></span></h2>
            <p><?= implode(".", array_slice(explode(".",web()->about), 0,2)) ?>.</p>
            <a href="<?= base_url('login') ?>" class="btn-get-started scrollto">Login</a>
          </div>
        </div>
      </div>
<!-- 
      <a class="carousel-control-prev" href="#heroCarousel" role="button" data-bs-slide="prev">
        <span class="carousel-control-prev-icon bi bi-chevron-left" aria-hidden="true"></span>
      </a>

      <a class="carousel-control-next" href="#heroCarousel" role="button" data-bs-slide="next">
        <span class="carousel-control-next-icon bi bi-chevron-right" aria-hidden="true"></span>
      </a> -->

    </div>
  </section><!-- End Hero -->

  <main id="main">

    <!-- ======= Featured Services Section ======= -->
    <section id="featured-services" class="featured-services">
      <div class="container" data-aos="fade-up">

        <div class="row">
          <div class="col-md-6 col-lg-3 d-flex align-items-stretch mb-5 mb-lg-0">
            <div class="icon-box" data-aos="fade-up" data-aos-delay="100">
              <div class="icon"><i class="fas fa-heartbeat"></i></div>
              <h4 class="title"><a href="">Pemeriksaan Umum</a></h4>
              <p class="description">Pemeriksaan umum di klinik adalah langkah awal dalam mengevaluasi kondisi kesehatan pasien. </p>
            </div>
          </div>

          <div class="col-md-6 col-lg-3 d-flex align-items-stretch mb-5 mb-lg-0">
            <div class="icon-box" data-aos="fade-up" data-aos-delay="200">
              <div class="icon"><i class="fas fa-pills"></i></div>
              <h4 class="title"><a href="">Konsultasi Medis</a></h4>
              <p class="description">Konsultasi medis melibatkan diskusi antara dokter dan pasien mengenai keluhan atau kondisi medis tertentu. </p>
            </div>
          </div>

          <div class="col-md-6 col-lg-3 d-flex align-items-stretch mb-5 mb-lg-0">
            <div class="icon-box" data-aos="fade-up" data-aos-delay="300">
              <div class="icon"><i class="fas fa-dna"></i></div>
              <h4 class="title"><a href="">Pemeriksaan Laboratorium</a></h4>
              <p class="description">Pemeriksaan laboratorium digunakan untuk mendapatkan informasi lebih lanjut mengenai kondisi kesehatan pasien.</p>
            </div>
          </div>

          <div class="col-md-6 col-lg-3 d-flex align-items-stretch mb-5 mb-lg-0">
            <div class="icon-box" data-aos="fade-up" data-aos-delay="400">
              <div class="icon"><i class="fas fa-thermometer"></i></div>
              <h4 class="title"><a href="">Tindakan Medis Sederhana</a></h4>
              <p class="description">Tindakan medis sederhana meliputi prosedur non-bedah seperti membersihkan luka, memberikan suntikan, meresepkan obat, atau melakukan jahitan pada luka yang cukup dalam.</p>
            </div>
          </div>

        </div>

      </div>
    </section><!-- End Featured Services Section -->

    <!-- ======= About Us Section ======= -->
    <section id="about" class="about text-light" style="background-color:#a90868">
      <div class="container" data-aos="fade-up">

        <div class="section-title">
          <h2>Tentang <?= web()->name ?></h2>
          <p><?= web()->about ?></p>
        </div>

        <div class="row contact">
          <div class="col-lg-6" data-aos="fade-right">
            <div class="info-box" style="background-color:white">
              <h3 class="text-dark">Visi</h3>
              <p class="fst-italic">
                <?= web()->visi ?>
              </p>
            </div>
          </div>
          <div class="col-lg-6" data-aos="fade-left">
            <div class="info-box" style="background-color:white">
              <h3 class="text-dark">Misi</h3>
              <p class="fst-italic">
                <?= web()->misi ?>
              </p>
            </div>
          </div>
        </div>

      </div>
    </section><!-- End About Us Section -->

    <!-- ======= Departments Section ======= -->
    <section id="services" class="departments">
      <div class="container" data-aos="fade-up">

        <div class="section-title">
          <h2>Pelayanan</h2>
          <p>Pelayanan kesehatan mencakup pemeriksaan umum, konsultasi medis, pemeriksaan laboratorium, dan tindakan medis sederhana yang melibatkan anamnesis, evaluasi kesehatan, pengujian laboratorium, dan prosedur pengobatan sederhana untuk mendiagnosis, merawat, dan memantau kondisi pasien.</p>
        </div>

        <div class="row" data-aos="fade-up" data-aos-delay="100">
          <div class="col-lg-4 mb-5 mb-lg-0">
            <ul class="nav nav-tabs flex-column">
              <li class="nav-item">
                <a class="nav-link active show" data-bs-toggle="tab" data-bs-target="#tab-1">
                  <h4>Pemeriksaan Umum</h4>
                  <p></p>
                </a>
              </li>
              <li class="nav-item mt-2">
                <a class="nav-link" data-bs-toggle="tab" data-bs-target="#tab-2">
                  <h4>Konsultasi medis </h4>
                </a>
              </li>
              <li class="nav-item mt-2">
                <a class="nav-link" data-bs-toggle="tab" data-bs-target="#tab-3">
                  <h4>Pemeriksaan laboratorium</h4>
                </a>
              </li>
              <li class="nav-item mt-2">
                <a class="nav-link" data-bs-toggle="tab" data-bs-target="#tab-4">
                  <h4>Tindakan medis sederhana</h4>
                </a>
              </li>
            </ul>
          </div>
          <div class="col-lg-8">
            <div class="tab-content">
              <div class="tab-pane active show" id="tab-1">
                <h3>Pemeriksaan Umum</h3>
                <p class="fst-italic">Pemeriksaan umum adalah proses evaluasi medis yang melibatkan anamnesis, pemeriksaan fisik, dan pengumpulan informasi penting untuk mengevaluasi kesehatan seseorang secara keseluruhan. Pemeriksaan umum ini bertujuan untuk mendapatkan gambaran umum tentang kondisi kesehatan pasien, termasuk riwayat penyakit, gejala yang dialami, serta pemeriksaan fisik seperti pengukuran tekanan darah, suhu tubuh, dan pemeriksaan organ-organ vital lainnya.</p>
              </div>
              <div class="tab-pane" id="tab-2">
                <h3>Konsultasi medis</h3>
                <p class="fst-italic">Konsultasi medis adalah pertemuan antara pasien dengan dokter untuk mendapatkan penilaian, diagnosis, dan rekomendasi terkait masalah kesehatan yang dialami. Selama konsultasi medis, pasien dapat berbagi keluhan, riwayat penyakit, serta gejala yang dialami untuk membantu dokter dalam menentukan langkah selanjutnya. Dokter akan memberikan penjelasan mengenai kondisi kesehatan pasien, memberikan saran pengobatan atau tindakan yang diperlukan, dan meresepkan obat jika diperlukan.</p>
              </div>
              <div class="tab-pane" id="tab-3">
                <h3>Pemeriksaan laboratorium</h3>
                <p class="fst-italic">Pemeriksaan laboratorium melibatkan pengambilan sampel seperti darah, urine, atau jaringan tubuh lainnya untuk dilakukan analisis di laboratorium. Pemeriksaan ini dapat memberikan informasi penting tentang kondisi kesehatan pasien, termasuk deteksi penyakit, pengukuran fungsi organ, penilaian kadar zat dalam tubuh, dan pemantauan respons terhadap pengobatan. Hasil pemeriksaan laboratorium digunakan sebagai dasar bagi dokter dalam menegakkan diagnosis dan merencanakan pengobatan yang tepat.</p>
              </div>
              <div class="tab-pane" id="tab-4">
                <h3>Tindakan medis sederhana</h3>
                <p class="fst-italic">Tindakan medis sederhana mencakup prosedur atau intervensi yang relatif sederhana dan tidak memerlukan pembiusan atau pembedahan yang rumit. Contoh tindakan medis sederhana termasuk pemberian suntikan, pemasangan infus, pembersihan luka, pengangkatan benda asing dari tubuh, atau pemeriksaan endoskopi ringan. Tindakan ini dilakukan oleh tenaga medis yang terlatih untuk memberikan perawatan langsung kepada pasien dengan tujuan pengobatan, diagnosis, atau pencegahan komplikasi.</p>
              </div>
            </div>
          </div>
        </div>

      </div>
    </section><!-- End Departments Section -->


  </main><!-- End #main -->

  <!-- ======= Footer ======= -->
  <footer id="footer">

    <div class="container">
      <div class="copyright">
        &copy; Copyright <strong><span><?= web()->name ?></span></strong>. All Rights Reserved
      </div>
      <div class="credits">
        <!-- All the links in the footer should remain intact. -->
        <!-- You can delete the links only if you purchased the pro version. -->
        <!-- Licensing information: https://bootstrapmade.com/license/ -->
        <!-- Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/medicio-free-bootstrap-theme/ -->
        Designed by <a href="https://bootstrapmade.com/">BootstrapMade</a>
      </div>
    </div>
  </footer><!-- End Footer -->

  <div id="preloader"></div>
  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  <script src="<?= base_url('assets/landing') ?>/vendor/purecounter/purecounter_vanilla.js"></script>
  <script src="<?= base_url('assets/landing') ?>/vendor/aos/aos.js"></script>
  <script src="<?= base_url('assets/landing') ?>/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="<?= base_url('assets/landing') ?>/vendor/glightbox/js/glightbox.min.js"></script>
  <script src="<?= base_url('assets/landing') ?>/vendor/swiper/swiper-bundle.min.js"></script>
  <script src="<?= base_url('assets/landing') ?>/vendor/php-email-form/validate.js"></script>

  <!-- Template Main JS File -->
  <script src="<?= base_url('assets/landing') ?>/js/main.js"></script>

</body>

</html>