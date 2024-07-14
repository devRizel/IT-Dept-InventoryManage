<?php
date_default_timezone_set('Asia/Manila');
  ob_start();
  require_once('includes/load.php');
  if($session->isUserLoggedIn(true)) { redirect('home.php', false);}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Inventory Management System</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="assets/image/images.png" rel="icon">
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Fonts -->
  <link href="https://fonts.googleapis.com" rel="preconnect">
  <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Raleway:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/aos/aos.css" rel="stylesheet">
  <link href="assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
  <link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

  <!-- Main CSS File -->
  <link href="assets/css/main.css" rel="stylesheet">

  <style>
    @media (max-width: 768px) {
      .hero h1 {
        font-size: 20px; /* Adjust font size for smaller screens */
      }
    }
  </style>
</head>

<body class="index-page">

  <header id="header" class="header d-flex align-items-center sticky-top">
    <div class="container-fluid container-xl position-relative d-flex align-items-center">

      <a href="index.html" class="logo d-flex align-items-center me-auto">
        <img src="assets/image/download.png" class="img-fluid animated"alt="">
        <h1 class="sitename">IT DEPARTMENT</h1>
      </a>

      <nav id="navmenu" class="navmenu">
        <ul>
          <li><a href="#hero" class="active">Home<br></a></li>
          <li><a href="#about">About</a></li>
        </ul>
        <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
      </nav>
      <a class="btn-getstarted" href="login.php?access=allowed">Login</a>

    </div>
  </header>

  <main class="main">
    <section id="hero" class="hero section">
      <div class="container">
        <div class="row gy-4">
          <div class="col-lg-6 order-2 order-lg-1 d-flex flex-column justify-content-center">
            <h1>INVENTORY MANAGEMENT</h1>
            <center><h1>SYSTEM</h1></center>
            <!-- <p>Please Select Portal to proceed.</p>
            <div class="d-flex">
              <a href="portal.php" class="btn-get-started">Portal</a>
              <a href="https://www.youtube.com/watch?v=LXb3EKWsInQ" class="glightbox btn-watch-video d-flex align-items-center"></a>
            </div> -->
          </div>
          <div class="col-lg-6 order-1 order-lg-2 hero-img">
            <img src="assets/image/fontsize.jpg" class="img-fluid animated" alt="">
          </div>
        </div>
      </div>

    </section><!-- /Hero Section -->
    <section id="about" class="about section">
      <div class="container section-title" data-aos="fade-up">
        <h2>About Us</h2>
        <p>His needs result from something he wants to escape from</p>
      <!-- <div class="container">
        <div class="row gy-5">
          <div class="content col-xl-5 d-flex flex-column" data-aos="fade-up" data-aos-delay="100">
            <h3>They provide the most valuable pleasure as it were</h3>
            <p>
              It is important to take care of the patient, to be followed by the patient, but it will happen at such a time that there is a lot of work and pain. Duis or Irure pain in the rebuke </p>
            <a href="#" class="about-btn align-self-center align-self-xl-start"><span>About us</span> <i class="bi bi-chevron-right"></i></a>
          </div>
          <div class="col-xl-7" data-aos="fade-up" data-aos-delay="200">
            <div class="row gy-4"> -->

              <!-- <div class="col-md-6 icon-box position-relative">
                <i class="bi bi-briefcase"></i>
                <h4><a href="" class="stretched-link">Let it be the pleasures of the body</a></h4>
                <p>They are the result, or as it were, of something that is equal to these labors, except that some</p>
              </div>

              <div class="col-md-6 icon-box position-relative">
                <i class="bi bi-gem"></i>
                <h4><a href="" class="stretched-link">Except for any work</a></h4>
                <p>Unless they are blinded by lust, they do not come forth; they are in fault who abandon their duties</p>
              </div>

              <div class="col-md-6 icon-box position-relative">
                <i class="bi bi-broadcast"></i>
                <h4><a href="" class="stretched-link">Hard work will result</a></h4>
                <p>Either he takes it with no one, or everyone. All the pains that the elders do</p>
              </div>

              <div class="col-md-6 icon-box position-relative">
                <i class="bi bi-easel"></i>
                <h4><a href="" class="stretched-link">Of the blessed truth</a></h4>
                <p>The expedients of the truth are of no consequence at the time of the praises of the covenants of life</p>
              </div> -->

            <!-- </div>
          </div>

        </div> -->

      </div>

    </section><!-- /About Section -->


  </main>

  <footer id="footer" class="footer">

    <div class="container">
      <div class="copyright text-center ">
        <p>© <span>Copyright</span> <strong class="px-1 sitename">IT DEPARTMENT</strong></p>
      </div>
      <div class="social-links d-flex justify-content-center">
        <a href=""><i class="bi bi-facebook"></i></a>
        <a href=""><i class="bi bi-instagram"></i></a>
      </div>
    </div>

  </footer>

  <a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>
  <div id="preloader"></div>
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/php-email-form/validate.js"></script>
  <script src="assets/vendor/aos/aos.js"></script>
  <script src="assets/vendor/glightbox/js/glightbox.min.js"></script>
  <script src="assets/vendor/purecounter/purecounter_vanilla.js"></script>
  <script src="assets/vendor/swiper/swiper-bundle.min.js"></script>
  <script src="assets/vendor/imagesloaded/imagesloaded.pkgd.min.js"></script>
  <script src="assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
  <script src="assets/js/main.js"></script>

</body>

</html>
