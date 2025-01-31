<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Pacioli’S Nexus</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="assets/img/favicon.png" rel="icon">
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.gstatic.com" rel="preconnect">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="assets/vendor/quill/quill.snow.css" rel="stylesheet">
  <link href="assets/vendor/quill/quill.bubble.css" rel="stylesheet">
  <link href="assets/vendor/remixicon/remixicon.css" rel="stylesheet">
  <link href="assets/vendor/simple-datatables/style.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="assets/css/style.css" rel="stylesheet">
  <style>
  /* Custom styles for black carousel controls */
  .carousel-control-prev-icon,
  .carousel-control-next-icon {
    background-color: black;
  }

  .carousel-control-prev,
  .carousel-control-next {
    filter: invert(100%) sepia(0%) saturate(0%) hue-rotate(0deg) brightness(100%) contrast(100%);
  }

  .carousel-item img {
  width: 200px;
  height: 200px;
  object-fit: cover; /* Ensures uniform cropping */
  border-radius: 50%; /* Keeps images circular */
}

</style>

</head>

<body>

<?php
include 'header.php'; // Use the correct path
?>

  <?php
include 'sidebar.php'; // Use the correct path
?>


  <main id="main" class="main">

    <div class="pagetitle">
      <h1>Testimonials</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.html">Home</a></li>
          <li class="breadcrumb-item active">Testimonials</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->
 

    <section class="section dashboard">
  <!-- Expression Wall Header -->
  <div class="header-image" style="background-image: url('testimonials.jpg'); background-size: cover; background-position: center; height: 300px; position: relative;">
    <div class="overlay" style="position: absolute; top: 0; left: 0; right: 0; bottom: 0; background: rgba(0, 0, 0, 0.5); z-index: 1;"></div>
    <div class="container text-center text-white" style="position: relative; z-index: 2; padding-top: 100px;">
      <h1 class="display-1" style="font-weight: bold; text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.7);">Testimonials</h1>
      <p class="lead" style="font-size: 1.25rem; text-shadow: 1px 1px 3px rgba(0, 0, 0, 0.6);">Testimonials from CPA'S</p>
    </div>
  </div>

  <!-- Testimonials Carousel -->
<div id="testimonialsCarousel" class="carousel slide mt-5" data-bs-ride="carousel">
  <div class="carousel-inner">
    <!-- Testimonial 1 -->
  <!-- Testimonial 1 -->
<div class="carousel-item active">
    <div class="d-flex justify-content-center">
        <div class="text-center p-4">
            <img src="img/nge.jpeg" alt="User Icon" class="rounded-circle mb-3" width="200" height="200">
            <h5 class="card-title">Paul A. Garvey, CPA</h5>
            <p class="card-text">"An exceptional experience! The attention to detail and ease of use make it stand out from the rest."</p>
        </div>
    </div>
</div>

<!-- Testimonial 2 -->
<div class="carousel-item">
    <div class="d-flex justify-content-center">
        <div class="text-center p-4">
            <img src="img/girl.jpg" alt="User Icon" class="rounded-circle mb-3" width="200" height="200">
            <h5 class="card-title">Edith Orenstein, CPA</h5>
            <p class="card-text">"Highly intuitive and efficient! It simplifies complex tasks and makes everything more manageable."</p>
        </div>
    </div>
</div>

<!-- Testimonial 3 -->
<div class="carousel-item">
    <div class="d-flex justify-content-center">
        <div class="text-center p-4">
            <img src="img/man2.jpg" alt="User Icon" class="rounded-circle mb-3" width="200" height="200">
            <h5 class="card-title">Rick Telberg, CPA</h5>
            <p class="card-text">"A must-have! The level of convenience and reliability it provides is truly impressive."</p>
        </div>
    </div>
</div>

<!-- Testimonial 4 -->
<div class="carousel-item">
    <div class="d-flex justify-content-center">
        <div class="text-center p-4">
            <img src="img/man3.jpg" alt="User Icon" class="rounded-circle mb-3" width="200" height="200">
            <h5 class="card-title">Tom Hood, CPA</h5>
            <p class="card-text">"Absolutely fantastic! It brings a level of simplicity and organization that makes a real difference."</p>
        </div>
    </div>
</div>

<!-- Testimonial 5 -->
<div class="carousel-item">
    <div class="d-flex justify-content-center">
        <div class="text-center p-4">
            <img src="img/man4.jpg" alt="User Icon" class="rounded-circle mb-3" width="200" height="200">
            <h5 class="card-title">Steve Rogers, CPA</h5>
            <p class="card-text">"A game-changer! The ease of use and thoughtful design make it a standout choice."</p>
        </div>
    </div>
</div>

<!-- Testimonial 6 -->
<div class="carousel-item">
    <div class="d-flex justify-content-center">
        <div class="text-center p-4">
            <img src="img/man5.jpg" alt="User Icon" class="rounded-circle mb-3" width="200" height="200">
            <h5 class="card-title">Gail Perry, CPA</h5>
            <p class="card-text">"Highly recommended! It provides exactly what you need in the most seamless way possible."</p>
        </div>
    </div>
</div>




    <!-- Carousel Controls -->
    <button class="carousel-control-prev" type="button" data-bs-target="#testimonialsCarousel" data-bs-slide="prev">
      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
      <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#testimonialsCarousel" data-bs-slide="next">
      <span class="carousel-control-next-icon" aria-hidden="true"></span>
      <span class="visually-hidden">Next</span>
    </button>
  </div>

</section>





  </main><!-- End #main -->

  <!-- ======= Footer ======= -->
  <footer id="footer" class="footer">
    <div class="copyright">
      &copy; Copyright <strong><span>CodeRedx</span></strong>. All Rights Reserved
    </div>
    <div class="credits">

      Designed by <a href="">CodeRedxPh</a>
    </div>
  </footer><!-- End Footer -->

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  <script src="assets/vendor/apexcharts/apexcharts.min.js"></script>
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/chart.js/chart.umd.js"></script>
  <script src="assets/vendor/echarts/echarts.min.js"></script>
  <script src="assets/vendor/quill/quill.js"></script>
  <script src="assets/vendor/simple-datatables/simple-datatables.js"></script>
  <script src="assets/vendor/tinymce/tinymce.min.js"></script>
  <script src="assets/vendor/php-email-form/validate.js"></script>

  <!-- Template Main JS File -->
  <script src="assets/js/main.js"></script>

</body>

</html>