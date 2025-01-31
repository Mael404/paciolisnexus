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
      <h1>Career Articles</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.html">Home</a></li>
          <li class="breadcrumb-item active">Career Article</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->
 

    <section class="section dashboard">
  <!-- Header Image -->
  <div class="header-image" style="background-image: url('newspaper.jpg'); background-size: cover; background-position: center; height: 300px; position: relative;">
  <!-- Overlay to improve text visibility -->
  <div class="overlay" style="position: absolute; top: 0; left: 0; right: 0; bottom: 0; background: rgba(0, 0, 0, 0.5); z-index: 1;"></div>
  
  <div class="container text-center text-white" style="position: relative; z-index: 2; padding-top: 100px;">
    <h1 class="display-1" style="font-weight: bold; text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.7);">Career Guidance Hub</h1>
    <p class="lead" style="font-size: 1.25rem; text-shadow: 1px 1px 3px rgba(0, 0, 0, 0.6);">Your path to success in the accounting world starts here</p>
  </div>
</div>


  <!-- Articles Section -->
  <div class="container mt-5">
    <div class="row">

      <!-- Article 1: How to Study Accounting -->
      <div class="col-lg-12 mb-4">
        <div class="card">
          <div class="card-body">
            <h5 class="card-title">How to Study Accounting</h5>
            <div class="text-center">
  <img src="studyaccounting.jpg" style="width:700px; height:400px;" class="img-fluid mb-3" alt="How to Study Accounting">
</div>

            <p class="card-text">
              Studying accounting requires a methodical approach to understanding both theory and practical applications. Here are some tips to guide you:
              <ul>
                <li><strong>Start with the basics:</strong> Ensure you have a solid understanding of basic accounting principles like double-entry bookkeeping.</li>
                <li><strong>Practice regularly:</strong> Accounting requires regular practice to master. Work through as many problems as you can.</li>
                <li><strong>Use visual aids:</strong> Diagrams and charts can help you understand complex accounting concepts.</li>
                <li><strong>Review often:</strong> Regularly revisit topics to reinforce your understanding and improve memory retention.</li>
              </ul>
              Consistency and patience are key to mastering accounting. Start with simple concepts and gradually progress to more complex topics.
            </p>
          </div>
        </div>
      </div>

      <!-- Article 2: Tips from CPA -->
      <div class="col-lg-12 mb-4">
        <div class="card">
          <div class="card-body">
            <h5 class="card-title">Tips from CPA</h5>
            <div class="text-center">
            <img src="tips.jpg" style="width:700px; height:400px;" class="img-fluid mb-3" alt="How to Study Accounting">
</div>
            <p class="card-text">
              Here are some insider tips from Certified Public Accountants to help you excel in the field of accounting:
              <ul>
                <li><strong>Stay organized:</strong> Keep detailed records and use accounting software to stay on top of your work.</li>
                <li><strong>Keep learning:</strong> Accounting is an ever-evolving field. Make sure to keep updating your knowledge, especially with new laws and regulations.</li>
                <li><strong>Network with other professionals:</strong> Building connections within the industry can lead to career advancement opportunities.</li>
                <li><strong>Seek mentorship:</strong> A mentor can provide invaluable guidance as you navigate your career path.</li>
              </ul>
              These tips will help you build a strong foundation for a successful career in accounting, whether you're just starting or looking to expand your skills.
            </p>
          </div>
        </div>
      </div>

      <!-- Article 3: Career Path -->
      <div class="col-lg-12 mb-4">
        <div class="card">
          <div class="card-body">
            <h5 class="card-title">Career Path</h5>
            <div class="text-center">
            <img src="careerpath.jpg" style="width:700px; height:400px;" class="img-fluid mb-3" alt="How to Study Accounting">
</div>
            <p class="card-text">
              A career in accounting offers a wide range of opportunities. Here are some key paths you can take:
              <ul>
                <li><strong>Public Accounting:</strong> Work for accounting firms to provide services like tax preparation, auditing, and consulting to clients.</li>
                <li><strong>Corporate Accounting:</strong> Join the finance department of a corporation to manage internal financial records, budgeting, and forecasting.</li>
                <li><strong>Government Accounting:</strong> Work for government agencies to manage public funds, conduct audits, and ensure financial compliance.</li>
                <li><strong>Forensic Accounting:</strong> Specialize in investigating financial discrepancies and fraud within organizations.</li>
              </ul>
              Each path offers its own set of challenges and rewards. Choose the one that aligns with your interests and skills, and continue developing your expertise.
            </p>
          </div>
        </div>
      </div>

    </div>
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