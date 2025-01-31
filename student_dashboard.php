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
      <h1>Dashboard</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.html">Home</a></li>
          <li class="breadcrumb-item active">Dashboard</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section dashboard">
  <div class="row">
    <!-- Left side columns -->
    <div class="col-lg-12">
      <div class="row">

        <!-- Assignments Card -->
        <div class="col-xxl-4 col-md-6">
          <div class="card info-card assignments-card">

            <div class="filter">
              <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
              <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                <li class="dropdown-header text-start">
                  <h6>Filter</h6>
                </li>

                <li><a class="dropdown-item" href="#">Today</a></li>
                <li><a class="dropdown-item" href="#">This Week</a></li>
                <li><a class="dropdown-item" href="#">This Month</a></li>
              </ul>
            </div>

            <div class="card-body">
              <h5 class="card-title">Quizes <span>| This Week</span></h5>

              <div class="d-flex align-items-center">
                <div class="card-icon rounded-circle d-flex align-items-center justify-content-center" style="background-color: #f6f6f6;">
                  <i class="bi bi-pencil" style="color: #4154f1; font-size: 24px;"></i>
                </div>
                <div class="ps-3">
                  <h6>3</h6>
                  <span class="text-success small pt-1 fw-bold">Pending</span>
                  <span class="text-muted small pt-2 ps-1">quizes</span>
                </div>
              </div>
            </div>
          </div>
        </div><!-- End Assignments Card -->

        <!-- Grades Card -->
        <div class="col-xxl-4 col-md-6">
          <div class="card info-card grades-card">

            <div class="filter">
              <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
              <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                <li class="dropdown-header text-start">
                  <h6>Filter</h6>
                </li>

                <li><a class="dropdown-item" href="#">This Semester</a></li>
                <li><a class="dropdown-item" href="#">This Year</a></li>
              </ul>
            </div>

            <div class="card-body">
              <h5 class="card-title">Leaderboards <span>| This Year</span></h5>

              <div class="d-flex align-items-center">
                <div class="card-icon rounded-circle d-flex align-items-center justify-content-center" style="background-color: #e6f4ea;">
                  <i class="bi bi-bar-chart" style="color: #2eca6a; font-size: 24px;"></i>
                </div>
                <div class="ps-3">
                  <h6>A</h6>
                  <span class="text-success small pt-1 fw-bold">Top 85%</span>
                  <span class="text-muted small pt-2 ps-1">Leaderboards</span>
                </div>
              </div>
            </div>
          </div>
        </div><!-- End Grades Card -->

        <!-- Notifications Card -->
        <div class="col-xxl-4 col-md-6">
          <div class="card info-card notifications-card">

            <div class="filter">
              <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
              <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                <li class="dropdown-header text-start">
                  <h6>Filter</h6>
                </li>

                <li><a class="dropdown-item" href="#">New</a></li>
                <li><a class="dropdown-item" href="#">This Week</a></li>
                <li><a class="dropdown-item" href="#">This Month</a></li>
              </ul>
            </div>

            <div class="card-body">
              <h5 class="card-title">Notifications <span>| This Week</span></h5>

              <div class="d-flex align-items-center">
                <div class="card-icon rounded-circle d-flex align-items-center justify-content-center" style="background-color: #f6f1eb;">
                  <i class="bi bi-bell" style="color: #ff771d; font-size: 24px;"></i>
                </div>
                <div class="ps-3">
                  <h6>2</h6>
                  <span class="text-warning small pt-1 fw-bold">Unread</span>
                  <span class="text-muted small pt-2 ps-1">notifications</span>
                </div>
              </div>
            </div>
          </div>
        </div><!-- End Notifications Card -->

      </div>
    </div><!-- End Left side columns -->

    <!-- Right side columns -->
    <div class="col-lg-12">

      <!-- Recent Assignments -->
      <div class="card recent-assignments overflow-auto">

        <div class="filter">
          <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
          <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
            <li class="dropdown-header text-start">
              <h6>Filter</h6>
            </li>

            <li><a class="dropdown-item" href="#">Today</a></li>
            <li><a class="dropdown-item" href="#">This Week</a></li>
            <li><a class="dropdown-item" href="#">This Month</a></li>
          </ul>
        </div>

        <div class="card-body">
  <h5 class="card-title">Quiz Leaderboard <span>| This Week</span></h5>

  <table class="table table-borderless datatable">
    <thead>
      <tr>
        <th scope="col">Rank</th>
        <th scope="col">Name</th>
        <th scope="col">Subject</th>
        <th scope="col">Score</th>
        <th scope="col">Max Score</th>
      </tr>
    </thead>
    <tbody>
      <!-- Example 1 -->
      <tr>
        <th scope="row">1</th>
        <td>John Doe</td>
        <td>Financial Accounting and Reporting</td>
        <td>28</td>
        <td>30</td>
      </tr>
      <!-- Example 2 -->
      <tr>
        <th scope="row">2</th>
        <td>Jane Smith</td>
        <td>Advanced Financial Accounting and Reporting</td>
        <td>26</td>
        <td>30</td>
      </tr>
      <!-- Example 3 -->
      <tr>
        <th scope="row">3</th>
        <td>Mike Johnson</td>
        <td>Auditing</td>
        <td>22</td>
        <td>30</td>
      </tr>
      <!-- Example 4 -->
      <tr>
        <th scope="row">4</th>
        <td>Amy Williams</td>
        <td>Taxation</td>
        <td>20</td>
        <td>30</td>
      </tr>
      <!-- Example 5 -->
      <tr>
        <th scope="row">5</th>
        <td>David Lee</td>
        <td>Regulatory Framework for Business Transactions</td>
        <td>18</td>
        <td>30</td>
      </tr>
      <!-- Example 6 -->
      <tr>
        <th scope="row">6</th>
        <td>Sarah Kim</td>
        <td>Management Advisory Services</td>
        <td>15</td>
        <td>30</td>
      </tr>
    </tbody>
  </table>
</div>


      </div>
    </div><!-- End Recent Assignments -->

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