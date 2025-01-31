<?php
session_start();
include('config.php');

// Get the current logged-in user's user_id
$current_user_id = $_SESSION['user_id']; // Ensure 'user_id' is stored in the session during login

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
    /* Global Colors - The following color variables are used throughout the website. Updating them here will change the color scheme of the entire website */
    :root {
      --background-color: #ffffff;
      /* Background color for the entire website, including individual sections */
      --default-color: #444444;
      /* Default color used for the majority of the text content across the entire website */
      --heading-color: #222222;
      /* Color for headings, subheadings and title throughout the website */
      --accent-color: #106eea;
      /* Accent color that represents your brand on the website. It's used for buttons, links, and other elements that need to stand out */
      --surface-color: #ffffff;
      /* The surface color is used as a background of boxed elements within sections, such as cards, icon boxes, or other elements that require a visual separation from the global background. */
      --contrast-color: #ffffff;
      /* Contrast color for text, ensuring readability against backgrounds of accent, heading, or default colors. */
    }

    /* Nav Menu Colors - The following color variables are used specifically for the navigation menu. They are separate from the global colors to allow for more customization options */
    :root {
      --nav-color: #222222;
      /* The default color of the main navmenu links */
      --nav-hover-color: #106eea;
      /* Applied to main navmenu links when they are hovered over or active */
      --nav-mobile-background-color: #ffffff;
      /* Used as the background color for mobile navigation menu */
      --nav-dropdown-background-color: #ffffff;
      /* Used as the background color for dropdown items that appear when hovering over primary navigation items */
      --nav-dropdown-color: #222222;
      /* Used for navigation links of the dropdown items in the navigation menu. */
      --nav-dropdown-hover-color: #106eea;
      /* Similar to --nav-hover-color, this color is applied to dropdown navigation links when they are hovered over. */
    }

    .pricing .pricing-item {
      background-color: var(--surface-color);
      box-shadow: 0px 0px 4px rgba(0, 0, 0, 0.1);
      padding: 20px;
      text-align: center;
      border-radius: 5px;
      position: relative;
      overflow: hidden;
      display: flex;
      flex-direction: column;
      height: 100%;
      /* Ensure all cards have the same height */
    }

    .pricing .pricing-item h3 {
      font-weight: 400;
      margin: -20px -20px 20px -20px;
      padding: 20px 15px;
      font-size: 16px;
      font-weight: 600;
      color: color-mix(in srgb, var(--default-color), transparent 20%);
      background: color-mix(in srgb, var(--default-color), transparent 95%);
    }

    .pricing .pricing-item h4 {
      font-size: 36px;
      font-weight: 600;
      font-family: var(--heading-font);
    }

    .pricing .pricing-item h4 sup {
      font-size: 20px;
      top: -15px;
      left: -3px;
    }

    .pricing .pricing-item h4 span {
      color: color-mix(in srgb, var(--default-color), transparent 40%);
      font-size: 16px;
      font-weight: 300;
    }

    .pricing .pricing-item ul {
      padding: 15px 0;
      list-style: none;
      text-align: center;
      line-height: 20px;
      font-size: 14px;
      flex-grow: 1;
      /* Ensure the list items take up available space */
    }

    .pricing .pricing-item ul li {
      padding-bottom: 16px;
    }

    .pricing .pricing-item ul i {
      color: var(--accent-color);
      font-size: 18px;
      padding-right: 4px;
    }

    .pricing .pricing-item ul .na {
      color: color-mix(in srgb, var(--default-color), transparent 40%);
      text-decoration: line-through;
    }

    .pricing .btn-wrap {
      background: color-mix(in srgb, var(--default-color), transparent 95%);
      margin: 0 -20px -20px -20px;
      padding: 20px 15px;
      text-align: center;
    }

    .pricing .btn-buy {
      background: var(--accent-color);
      color: var(--contrast-color);
      display: inline-block;
      padding: 8px 35px 10px 35px;
      border-radius: 4px;
      transition: none;
      font-size: 14px;
      font-weight: 400;
      font-family: var(--heading-font);
      font-weight: 600;
      transition: 0.3s;
    }

    .pricing .btn-buy:hover {
      background: color-mix(in srgb, var(--accent-color), transparent 20%);
    }

    .pricing .featured h3 {
      background: var(--accent-color);
      color: var(--contrast-color);
    }

    .pricing .advanced {
      background: var(--accent-color);
      color: var(--contrast-color);
      width: 200px;
      position: absolute;
      top: 18px;
      right: -68px;
      transform: rotate(45deg);
      z-index: 1;
      font-size: 14px;
      padding: 1px 0 3px 0;
    }

    /* Ensure equal card height */
    .pricing .row {
      display: flex;
      flex-wrap: wrap;
      justify-content: space-between;
    }

    .pricing .col-xl-3,
    .pricing .col-lg-6 {
      display: flex;
      flex-direction: column;
      flex-grow: 1;
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
      <h1>Quizes</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.html">Home</a></li>
          <li class="breadcrumb-item active">Take a Quiz</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->
    <style>
      .subject-card {
        display: flex;
        flex-direction: column;
        height: 100%;
      }

      .subject-card .card-body {
        flex: 1;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        /* Distributes the content evenly */
      }

      .card-title {
        margin-bottom: 0px;
      }

      .btn {
        margin-top: auto;
        /* Ensures the button stays at the bottom */
      }
    </style>

<!-- Section with Subject Cards -->
<section class="section dashboard">
  <div class="row">
    <!-- Subject 1: Financial Accounting and Reporting -->
    <div class="col-lg-4 col-md-6 mb-3">
      <div class="card info-card subject-card">
        <div class="card-body text-center">
          <h5 class="card-title">Financial Accounting and Reporting</h5>
          <div class="card-icon rounded-circle d-flex align-items-center justify-content-center mx-auto" style="background-color: #f6f6f6; width: 70px; height: 70px;">
            <i class="bi bi-clipboard-check" style="color: #4154f1; font-size: 30px;"></i>
          </div>
          <a href="far_dashboard.php" class="btn btn-primary mt-3 position-relative">
            View topics
          </a>
        </div>
      </div>
    </div>

    <!-- Subject 2: Advanced Financial Accounting and Reporting -->
    <div class="col-lg-4 col-md-6 mb-3">
      <div class="card info-card subject-card">
        <div class="card-body text-center">
          <h5 class="card-title">Advanced Financial Accounting and Reporting</h5>
          <div class="card-icon rounded-circle d-flex align-items-center justify-content-center mx-auto" style="background-color: #e6f4ea; width: 70px; height: 70px;">
            <i class="bi bi-calculator" style="color: #2eca6a; font-size: 30px;"></i>
          </div>
          <a href="" class="btn btn-success mt-3 position-relative">
          View topics
          </a>
        </div>
      </div>
    </div>

    <!-- Subject 3: Taxation -->
    <div class="col-lg-4 col-md-6 mb-3">
      <div class="card info-card subject-card">
        <div class="card-body text-center">
          <h5 class="card-title">Taxation</h5>
          <div class="card-icon rounded-circle d-flex align-items-center justify-content-center mx-auto" style="background-color: #f6f1eb; width: 70px; height: 70px;">
            <i class="bi bi-wallet2" style="color: #ff771d; font-size: 30px;"></i>
          </div>
          <a href="" class="btn btn-warning mt-3 position-relative">
          View topics
          </a>
        </div>
      </div>
    </div>

    <!-- Subject 4: Auditing -->
    <div class="col-lg-4 col-md-6 mb-3">
      <div class="card info-card subject-card">
        <div class="card-body text-center">
          <h5 class="card-title">Auditing</h5>
          <div class="card-icon rounded-circle d-flex align-items-center justify-content-center mx-auto" style="background-color: #eef6ff; width: 70px; height: 70px;">
            <i class="bi bi-graph-up" style="color: #0d6efd; font-size: 30px;"></i>
          </div>
          <a href="" class="btn btn-info mt-3 position-relative">
          View topics
          </a>
        </div>
      </div>
    </div>

    <!-- Subject 5: Regulatory Framework for Business Transactions -->
    <div class="col-lg-4 col-md-6 mb-3">
      <div class="card info-card subject-card">
        <div class="card-body text-center">
          <h5 class="card-title">Regulatory Framework for Business Transactions</h5>
          <div class="card-icon rounded-circle d-flex align-items-center justify-content-center mx-auto" style="background-color: #fff6e6; width: 70px; height: 70px;">
            <i class="bi bi-briefcase" style="color: #f39c12; font-size: 30px;"></i>
          </div>
          <a href="" class="btn btn-dark mt-3 position-relative">
          View topics
          </a>
        </div>
      </div>
    </div>

    <!-- Subject 6: Management Advisory Services -->
    <div class="col-lg-4 col-md-6 mb-3">
      <div class="card info-card subject-card">
        <div class="card-body text-center">
          <h5 class="card-title">Management Advisory Services</h5>
          <div class="card-icon rounded-circle d-flex align-items-center justify-content-center mx-auto" style="background-color: #eaf2ff; width: 70px; height: 70px;">
            <i class="bi bi-bar-chart" style="color: #5e60ce; font-size: 30px;"></i>
          </div>
          <a href="" class="btn btn-primary mt-3 position-relative">
          View topics
          </a>
        </div>
      </div>
    </div>
  </div>
</section>





   





    <div class="modal fade" id="resultModal" tabindex="-1" aria-labelledby="resultModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-xl">

        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="resultModalLabel"><?php echo $modalTitle; ?></h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <!-- Pricing Section -->
            <section id="pricing" class="pricing section">
              <!-- Section Title -->
              <div class="container section-title" data-aos="fade-up">
                <p><span>Check our</span> <span class="description-title">Pricing</span></p>
              </div>
              <!-- End Section Title -->

              <div class="container">
                <div class="row gy-3">
                  <div class="col-xl-4 col-lg-6" data-aos="fade-up" data-aos-delay="100">
                    <div class="pricing-item">
                      <h3>Basic Package</h3>
                      <h4><sup>₱</sup>1,250<span></span></h4>
                      <ul>
                        <li>Access to 5 Quiz Bundle: Gamified Learning Module</li>
                        <li>2 Q&A (Basic)</li>
                        <li>1 Group Review and Recall Session</li>
                        <li>Access to 1 Subject Personalized Study Plan</li>
                        <li>1 Group Career Guidance Hub Session</li>
                      </ul>
                      <div class="btn-wrap">
                        <a href="#" class="btn-buy">Get Started</a>
                      </div>
                    </div>
                  </div>
                  <div class="col-xl-4 col-lg-6" data-aos="fade-up" data-aos-delay="200">
                    <div class="pricing-item featured">
                      <h3>Standard Package</h3>
                      <h4><sup>₱</sup>2,250<span></span></h4>
                      <ul>
                        <li>Access to 10 Quiz Bundle: Gamified Learning Module</li>
                        <li>5 Q&A (Mix of Basic and Moderate)</li>
                        <li>2 Group Review and Recall Sessions</li>
                        <li>Access to 2 Subject Personalized Study Plans</li>
                        <li>1 Group Career Guidance Hub Session</li>
                      </ul>
                      <div class="btn-wrap">
                        <a href="#" class="btn-buy">Buy Now</a>
                      </div>
                    </div>
                  </div>
                  <div class="col-xl-4 col-lg-6" data-aos="fade-up" data-aos-delay="300">
                    <div class="pricing-item">
                      <h3>Premium Package</h3>
                      <h4><sup>₱</sup>4,250<span></span></h4>
                      <ul>
                        <li>Unlimited Quiz Access: Gamified Learning Module</li>
                        <li>10 Q&A (Any mode of Complexity)</li>
                        <li>3 Group Review and Recall Sessions</li>
                        <li>Access to 4 Subject Personalized Study Plans</li>
                        <li>1 Group Career Guidance Hub Session</li>
                      </ul>
                      <div class="btn-wrap">
                        <a href="#" class="btn-buy">Buy Now</a>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </section>

          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          </div>
        </div>
      </div>
    </div>



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