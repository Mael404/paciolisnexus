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
          <li class="breadcrumb-item active">Quizes</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->
   
   
    <?php
include('config.php'); // Ensure you have your database connection file included

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    echo "<div class='alert alert-danger text-center'>You must be logged in to view this content.</div>";
    exit;
}

$user_id = $_SESSION['user_id'];

// Query to retrieve data if user_id exists in student_id column
$sql = "SELECT gamefied_id, created_at, status, timer, attempt FROM gamified WHERE student_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
?>

<section class="section dashboard">
    <div class="container mt-5">
        <div class="row">
            <?php while ($row = $result->fetch_assoc()) { ?>
                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="card shadow-lg border-0 rounded-lg text-center p-4" style="background-color: #f3f4f6; border-radius: 20px; box-shadow: 0px 12px 30px rgba(0, 0, 0, 0.1);">
                        <div class="card-body">
                            <h5 class="card-title text-primary mb-3" style="font-size: 1.5rem; font-weight: bold; color: #ff6347;">Game ID: <?php echo $row['gamefied_id']; ?></h5>
                            <p class="text-muted mb-2" style="font-size: 1rem; font-weight: bold;">Status: <span class="text-dark"><?php echo $row['status']; ?></span></p>
                            <p class="text-muted mb-2" style="font-size: 1rem; font-weight: bold;">Timer: <span class="text-dark"><?php echo $row['timer']; ?> seconds</span></p>
                            <p class="text-muted mb-2" style="font-size: 1rem; font-weight: bold;">Attempts: <span class="text-dark"><?php echo $row['attempt']; ?></span></p>
                            <p class="text-muted mb-3" style="font-size: 0.9rem;"><small>Created on: <?php echo date('F j, Y, g:i A', strtotime($row['created_at'])); ?></small></p>
                            

                            <p class="text-dark font-weight-bold" style="font-size: 1.1rem; color: #ff6347;">Do you want to proceed with a timer or without a timer?</p>
                            <p class="text-muted mb-3" style="font-size: 0.9rem;">
                                <small>If you proceed with a timer, your score will be recorded and posted on the leaderboard. If you proceed without a timer, you can take the quiz at your own pace, but your score will not be recorded or posted on the leaderboard.</small>
                            </p>

                            <!-- Button Row (disable buttons if status is 'denied' or 'pending') -->
                            <div class="d-flex justify-content-center">
    <a href="far.php?gamified_id=<?php echo $row['gamefied_id']; ?>" class="btn btn-fun me-3">Proceed with Timer</a>
    <a href="farnotimer.php?gamified_id=<?php echo $row['gamefied_id']; ?>" class="btn btn-fun">Proceed without Timer</a>
</div>

                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>
</section>

<?php
$stmt->close();
$conn->close();
?>


<style>
  .btn-fun {
    background: linear-gradient(45deg, rgb(60, 37, 212), rgb(29, 6, 172)); /* Gradient from purple to blue */
    color: white;
    border: none;
    transition: all 0.3s ease-in-out;
    font-weight: bold;
    padding: 6px 12px; /* Further reduced padding */
    font-size: 0.8rem; /* Smaller font size */
    border-radius: 6px; /* Smaller border radius */
}

.btn-fun:hover {
    background: linear-gradient(45deg, rgb(169, 154, 216), rgb(120, 98, 214)); /* Reverse gradient on hover */
    box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1); /* Smaller shadow */
}


</style>



   





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