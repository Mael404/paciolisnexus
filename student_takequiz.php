<?php
session_start();
include('config.php');

// Get the current logged-in user's user_id
$current_user_id = $_SESSION['user_id']; // Ensure 'user_id' is stored in the session during login

// Query to check if the user_id exists in the gamified table
$query = "SELECT student_id FROM gamified WHERE student_id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $current_user_id);
$stmt->execute();
$result = $stmt->get_result();

// Modal content
$modalTitle = '';
$modalMessage = '';

if ($result->num_rows > 0) {
  // user_id exists in the gamified table
  $modalTitle = "You currently have an active pay per transaction subscribtion";
  $modalMessage = "User ID found in the gamified table.";
} else {
  // user_id does not exist in the gamified table
  $modalTitle = "Opps!, You havent subcribe to our subcription pckages yet";
  $modalMessage = "User ID not found in the gamified table.";
}

$stmt->close();
$conn->close();
?>
<?php

include('config.php');

$user_id = $_SESSION['user_id']; // Ensure user_id is set in the session

$counts = [
  'afr' => 0,
  'afar' => 0,
  'taxation' => 0,
  'auditing' => 0,
  'rfbt' => 0,
  'mds' => 0,
];

if (isset($user_id)) {
  $query = "
        SELECT 
            SUM(CASE WHEN afr IS NOT NULL THEN 1 ELSE 0 END) AS afr_count,
            SUM(CASE WHEN afar IS NOT NULL THEN 1 ELSE 0 END) AS afar_count,
            SUM(CASE WHEN taxation IS NOT NULL THEN 1 ELSE 0 END) AS taxation_count,
            SUM(CASE WHEN auditing IS NOT NULL THEN 1 ELSE 0 END) AS auditing_count,
            SUM(CASE WHEN rfbt IS NOT NULL THEN 1 ELSE 0 END) AS rfbt_count,
            SUM(CASE WHEN mds IS NOT NULL THEN 1 ELSE 0 END) AS mds_count
        FROM gamified 
        WHERE student_id = ?
    ";

  $stmt = $conn->prepare($query);
  $stmt->bind_param("i", $user_id);
  $stmt->execute();
  $result = $stmt->get_result();

  if ($row = $result->fetch_assoc()) {
    $counts['afr'] = $row['afr_count'];
    $counts['afar'] = $row['afar_count'];
    $counts['taxation'] = $row['taxation_count'];
    $counts['auditing'] = $row['auditing_count'];
    $counts['rfbt'] = $row['rfbt_count'];
    $counts['mds'] = $row['mds_count'];
  }
  $stmt->close();
}

$conn->close();
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

  <!-- ======= Header ======= -->
  <header id="header" class="header fixed-top d-flex align-items-center">

    <div class="d-flex align-items-center justify-content-between">
      <a href="index.html" class="logo d-flex align-items-center">
        <img src="assets/img/logo.png" alt="">
        <span class="d-none d-lg-block">Pacioli’s Nexus</span>
      </a>
      <i class="bi bi-list toggle-sidebar-btn"></i>
    </div><!-- End Logo -->

    <div class="search-bar">
      <form class="search-form d-flex align-items-center" method="POST" action="#">
        <input type="text" name="query" placeholder="Search" title="Enter search keyword">
        <button type="submit" title="Search"><i class="bi bi-search"></i></button>
      </form>
    </div><!-- End Search Bar -->

    <nav class="header-nav ms-auto">
      <ul class="d-flex align-items-center">

        <li class="nav-item d-block d-lg-none">
          <a class="nav-link nav-icon search-bar-toggle " href="#">
            <i class="bi bi-search"></i>
          </a>
        </li><!-- End Search Icon-->

        <li class="nav-item dropdown">

          <a class="nav-link nav-icon" href="#" id="notificationIcon">
            <i class="bi bi-bell"></i>
            <span class="badge bg-primary badge-number">4</span>
          </a><!-- End Notification Icon -->

          <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow notifications">
            <li class="dropdown-header">
              You have 4 new notifications
              <a href="#"><span class="badge rounded-pill bg-primary p-2 ms-2">View all</span></a>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>

            <li class="notification-item">
              <i class="bi bi-exclamation-circle text-warning"></i>
              <div>
                <h4>Lorem Ipsum</h4>
                <p>Quae dolorem earum veritatis oditseno</p>
                <p>30 min. ago</p>
              </div>
            </li>

            <li>
              <hr class="dropdown-divider">
            </li>

            <li class="notification-item">
              <i class="bi bi-x-circle text-danger"></i>
              <div>
                <h4>Atque rerum nesciunt</h4>
                <p>Quae dolorem earum veritatis oditseno</p>
                <p>1 hr. ago</p>
              </div>
            </li>

            <li>
              <hr class="dropdown-divider">
            </li>

            <li class="notification-item">
              <i class="bi bi-check-circle text-success"></i>
              <div>
                <h4>Sit rerum fuga</h4>
                <p>Quae dolorem earum veritatis oditseno</p>
                <p>2 hrs. ago</p>
              </div>
            </li>

            <li>
              <hr class="dropdown-divider">
            </li>

            <li class="notification-item">
              <i class="bi bi-info-circle text-primary"></i>
              <div>
                <h4>Dicta reprehenderit</h4>
                <p>Quae dolorem earum veritatis oditseno</p>
                <p>4 hrs. ago</p>
              </div>
            </li>

            <li>
              <hr class="dropdown-divider">
            </li>
            <li class="dropdown-footer">
              <a href="#">Show all notifications</a>
            </li>

          </ul><!-- End Notification Dropdown Items -->

        </li><!-- End Notification Nav -->

        <li class="nav-item dropdown">

          <a class="nav-link nav-icon" href="#" data-bs-toggle="dropdown">
            <i class="bi bi-chat-left-text"></i>
            <span class="badge bg-success badge-number">3</span>
          </a><!-- End Messages Icon -->

          <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow messages">
            <li class="dropdown-header">
              You have 3 new messages
              <a href="#"><span class="badge rounded-pill bg-primary p-2 ms-2">View all</span></a>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>

            <li class="message-item">
              <a href="#">
                <img src="assets/img/messages-1.jpg" alt="" class="rounded-circle">
                <div>
                  <h4>Maria Hudson</h4>
                  <p>Velit asperiores et ducimus soluta repudiandae labore officia est ut...</p>
                  <p>4 hrs. ago</p>
                </div>
              </a>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>

            <li class="message-item">
              <a href="#">
                <img src="assets/img/messages-2.jpg" alt="" class="rounded-circle">
                <div>
                  <h4>Anna Nelson</h4>
                  <p>Velit asperiores et ducimus soluta repudiandae labore officia est ut...</p>
                  <p>6 hrs. ago</p>
                </div>
              </a>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>

            <li class="message-item">
              <a href="#">
                <img src="assets/img/messages-3.jpg" alt="" class="rounded-circle">
                <div>
                  <h4>David Muldon</h4>
                  <p>Velit asperiores et ducimus soluta repudiandae labore officia est ut...</p>
                  <p>8 hrs. ago</p>
                </div>
              </a>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>

            <li class="dropdown-footer">
              <a href="#">Show all messages</a>
            </li>

          </ul><!-- End Messages Dropdown Items -->

        </li><!-- End Messages Nav -->

        <li class="nav-item dropdown pe-3">

          <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
            <i class="bi bi-person-fill rounded-circle" style="font-size: 1.5rem;"></i>
            <span class="d-none d-md-block dropdown-toggle ps-2">
              <?php echo htmlspecialchars($_SESSION['name'], ENT_QUOTES, 'UTF-8'); ?>
            </span>
          </a>
          <!-- End Profile Icon -->



          <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
            <li class="dropdown-header">
              <h6> <?php echo htmlspecialchars($_SESSION['name'], ENT_QUOTES, 'UTF-8'); ?></h6>
              <span>STUDENT</span>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>

            <li>
              <a class="dropdown-item d-flex align-items-center" href="users-profile.html">
                <i class="bi bi-person"></i>
                <span>My Profile</span>
              </a>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>

            <li>
              <a class="dropdown-item d-flex align-items-center" href="users-profile.html">
                <i class="bi bi-gear"></i>
                <span>Account Settings</span>
              </a>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>


            <li>
              <a class="dropdown-item d-flex align-items-center" href="pages-faq.html">
                <i class="bi bi-question-circle"></i>
                <span>Need Help?</span>
              </a>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>

            <li>
              <a class="dropdown-item d-flex align-items-center" href="logout.php">
                <i class="bi bi-box-arrow-right"></i>
                <span>Sign Out</span>
              </a>
            </li>

          </ul><!-- End Profile Dropdown Items -->
        </li><!-- End Profile Nav -->

      </ul>
    </nav><!-- End Icons Navigation -->

  </header><!-- End Header -->

  <!-- ======= Sidebar ======= -->
  <aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">

      <li class="nav-item">
        <a class="nav-link " href="student_dashboard.php">
          <i class="bi bi-house"></i>
          <span>Home</span>
        </a>
      </li><!-- End Home Nav -->

      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#study-plans-nav" data-bs-toggle="collapse" href="#">
          <i class="bi bi-book"></i><span>Study Plans</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="study-plans-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
          <li>
            <a href="view-plan.html">
              <i class="bi bi-circle"></i><span>View Plan</span>
            </a>
          </li>
          <li>
            <a href="update-profile.html">
              <i class="bi bi-circle"></i><span>Update Profile</span>
            </a>
          </li>
          <li>
            <a href="progress-tracker.html">
              <i class="bi bi-circle"></i><span>Progress Tracker</span>
            </a>
          </li>
        </ul>
      </li><!-- End Study Plans Nav -->

      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#quizzes-nav" data-bs-toggle="collapse" href="#">
          <i class="bi bi-question-square"></i><span>Quizzes</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="quizzes-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
          <li>
            <a href="student_takequiz.php">
              <i class="bi bi-circle"></i><span>Take a Quiz</span>
            </a>
          </li>
          <li>
            <a href="leaderboard.html">
              <i class="bi bi-circle"></i><span>Leaderboard</span>
            </a>
          </li>
          <li>
            <a href="points-rewards.html">
              <i class="bi bi-circle"></i><span>Points & Rewards</span>
            </a>
          </li>
        </ul>
      </li><!-- End Quizzes Nav -->

      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#homework-help-nav" data-bs-toggle="collapse" href="#">
          <i class="bi bi-question-circle"></i><span>Homework Help</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="homework-help-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
          <li>
            <a href="submit-question.html">
              <i class="bi bi-circle"></i><span>Submit Question</span>
            </a>
          </li>
          <li>
            <a href="my-questions.html">
              <i class="bi bi-circle"></i><span>My Questions</span>
            </a>
          </li>
          <li>
            <a href="pricing.html">
              <i class="bi bi-circle"></i><span>Pricing</span>
            </a>
          </li>
        </ul>
      </li><!-- End Homework Help Nav -->



      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#career-hub-nav" data-bs-toggle="collapse" href="#">
          <i class="bi bi-briefcase"></i><span>Career Hub</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="career-hub-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
          <li>
            <a href="career-articles.html">
              <i class="bi bi-circle"></i><span>Articles</span>
            </a>
          </li>
          <li>
            <a href="expert-talks.html">
              <i class="bi bi-circle"></i><span>Expert Talks</span>
            </a>
          </li>
          <li>
            <a href="career-paths.html">
              <i class="bi bi-circle"></i><span>Career Paths</span>
            </a>
          </li>
        </ul>
      </li><!-- End Career Hub Nav -->

      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#support-nav" data-bs-toggle="collapse" href="#">
          <i class="bi bi-life-preserver"></i><span>Support</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="support-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
          <li>
            <a href="faq.html">
              <i class="bi bi-circle"></i><span>FAQ</span>
            </a>
          </li>
          <li>
            <a href="contact.html">
              <i class="bi bi-circle"></i><span>Contact</span>
            </a>
          </li>
          <li>
            <a href="feedback.html">
              <i class="bi bi-circle"></i><span>Feedback</span>
            </a>
          </li>
        </ul>
      </li><!-- End Support Nav -->



    </ul>

  </aside><!-- End Sidebar -->


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
      <button id="quizButton" class="btn btn-primary mt-3 position-relative"
        data-bs-toggle="modal"
        data-bs-target="#modalFinancialAccounting"
        data-afr-count="<?php echo $counts['afr']; ?>">
        Take Quiz
        <?php if ($counts['afr'] > 0): ?>
          <span class="badge bg-danger position-absolute top-0 start-100 translate-middle">
            <?php echo $counts['afr']; ?>
          </span>
        <?php endif; ?>
      </button>
    </div>
  </div>
</div>

<!-- Repeat similar structure for other subjects -->
<div class="col-lg-4 col-md-6 mb-3">
  <div class="card info-card subject-card">
    <div class="card-body text-center">
      <h5 class="card-title">Advanced Financial Accounting and Reporting</h5>
      <div class="card-icon rounded-circle d-flex align-items-center justify-content-center mx-auto" style="background-color: #e6f4ea; width: 70px; height: 70px;">
        <i class="bi bi-calculator" style="color: #2eca6a; font-size: 30px;"></i>
      </div>
      <button class="btn btn-success mt-3 position-relative"
        data-bs-toggle="modal"
        data-bs-target="#modalAdvancedAccounting"
        data-afar-count="<?php echo $counts['afar']; ?>">
        Take Quiz
        <?php if ($counts['afar'] > 0): ?>
          <span class="badge bg-danger position-absolute top-0 start-100 translate-middle">
            <?php echo $counts['afar']; ?>
          </span>
        <?php endif; ?>
      </button>
    </div>
  </div>
</div>

<div class="col-lg-4 col-md-6 mb-3">
  <div class="card info-card subject-card">
    <div class="card-body text-center">
      <h5 class="card-title">Taxation</h5>
      <div class="card-icon rounded-circle d-flex align-items-center justify-content-center mx-auto" style="background-color: #f6f1eb; width: 70px; height: 70px;">
        <i class="bi bi-wallet2" style="color: #ff771d; font-size: 30px;"></i>
      </div>
      <button class="btn btn-warning mt-3 position-relative"
        data-bs-toggle="modal"
        data-bs-target="#modalTaxation"
        data-taxation-count="<?php echo $counts['taxation']; ?>">
        Take Quiz
        <?php if ($counts['taxation'] > 0): ?>
          <span class="badge bg-danger position-absolute top-0 start-100 translate-middle">
            <?php echo $counts['taxation']; ?>
          </span>
        <?php endif; ?>
      </button>
    </div>
  </div>
</div>

<div class="col-lg-4 col-md-6 mb-3">
  <div class="card info-card subject-card">
    <div class="card-body text-center">
      <h5 class="card-title">Auditing</h5>
      <div class="card-icon rounded-circle d-flex align-items-center justify-content-center mx-auto" style="background-color: #eef6ff; width: 70px; height: 70px;">
        <i class="bi bi-graph-up" style="color: #0d6efd; font-size: 30px;"></i>
      </div>
      <button class="btn btn-info mt-3 position-relative"
        data-bs-toggle="modal"
        data-bs-target="#modalAuditing"
        data-auditing-count="<?php echo $counts['auditing']; ?>">
        Take Quiz
        <?php if ($counts['auditing'] > 0): ?>
          <span class="badge bg-danger position-absolute top-0 start-100 translate-middle">
            <?php echo $counts['auditing']; ?>
          </span>
        <?php endif; ?>
      </button>
    </div>
  </div>
</div>

<div class="col-lg-4 col-md-6 mb-3">
  <div class="card info-card subject-card">
    <div class="card-body text-center">
      <h5 class="card-title">Regulatory Framework for Business Transactions</h5>
      <div class="card-icon rounded-circle d-flex align-items-center justify-content-center mx-auto" style="background-color: #fff6e6; width: 70px; height: 70px;">
        <i class="bi bi-briefcase" style="color: #f39c12; font-size: 30px;"></i>
      </div>
      <button class="btn btn-dark mt-3 position-relative"
        data-bs-toggle="modal"
        data-bs-target="#modalRegulatoryFramework"
        data-rfbt-count="<?php echo $counts['rfbt']; ?>">
        Take Quiz
        <?php if ($counts['rfbt'] > 0): ?>
          <span class="badge bg-danger position-absolute top-0 start-100 translate-middle">
            <?php echo $counts['rfbt']; ?>
          </span>
        <?php endif; ?>
      </button>
    </div>
  </div>
</div>

<div class="col-lg-4 col-md-6 mb-3">
  <div class="card info-card subject-card">
    <div class="card-body text-center">
      <h5 class="card-title">Management Advisory Services</h5>
      <div class="card-icon rounded-circle d-flex align-items-center justify-content-center mx-auto" style="background-color: #eaf2ff; width: 70px; height: 70px;">
        <i class="bi bi-bar-chart" style="color: #5e60ce; font-size: 30px;"></i>
      </div>
      <button class="btn btn-primary mt-3 position-relative"
        data-bs-toggle="modal"
        data-bs-target="#modalManagementAdvisory"
        data-mds-count="<?php echo $counts['mds']; ?>">
        Take Quiz
        <?php if ($counts['mds'] > 0): ?>
          <span class="badge bg-danger position-absolute top-0 start-100 translate-middle">
            <?php echo $counts['mds']; ?>
          </span>
        <?php endif; ?>
      </button>
    </div>
  </div>
</div>


      </div>
    </section>





    <!-- Modals -->
    <div>
      <!-- Modal 1: Financial Accounting and Reporting -->
      <div class="modal fade" id="modalFinancialAccounting" tabindex="-1" aria-labelledby="modalFinancialAccountingLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
          <div class="modal-content">
            <div class="modal-header" style="background-color: #4154f1; color: white;">
              <h5 class="modal-title" id="modalFinancialAccountingLabel">Financial Accounting Quiz</h5>
              <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-center">
              <!-- Price Section -->
              <div style="margin-top: 10px;">
                <h2 style="font-size: 4rem; font-weight: bold; font-family: 'Roboto Mono', monospace; color: #4154f1;">₱1,210</h2>
              </div>
              <!-- Description Section -->
              <p style="font-size: 1rem; color: #555; margin-top: 20px;">Master the fundamentals of financial accounting with this comprehensive quiz.</p>
            </div>
            <div class="modal-footer justify-content-center">
              <button type="button" class="btn btn-primary btn-lg" style="width: 100%;" onclick="window.location.href='quiz_FAR.php'">Proceed</button>
            </div>
          </div>
        </div>
      </div>

      <!-- Modal 2: Advanced Financial Accounting and Reporting -->
      <div class="modal fade" id="modalAdvancedAccounting" tabindex="-1" aria-labelledby="modalAdvancedAccountingLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
          <div class="modal-content">
            <div class="modal-header" style="background-color: #2eca6a; color: white;">
              <h5 class="modal-title" id="modalAdvancedAccountingLabel">Advanced Accounting Quiz</h5>
              <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-center">
              <!-- Price Section -->
              <div style="margin-top: 10px;">
                <h2 style="font-size: 4rem; font-weight: bold; font-family: 'Roboto Mono', monospace; color: #2eca6a;">₱2,112</h2>
              </div>
              <!-- Description Section -->
              <p style="font-size: 1rem; color: #555; margin-top: 20px;">Dive deeper into advanced financial accounting concepts with this challenging quiz.</p>
            </div>
            <div class="modal-footer justify-content-center">
              <button type="button" class="btn btn-success btn-lg" style="width: 100%;" onclick="window.location.href='quiz_AFAR.php'">Proceed</button>
            </div>
          </div>
        </div>
      </div>

      <!-- Modal 3: Taxation -->
      <div class="modal fade" id="modalTaxation" tabindex="-1" aria-labelledby="modalTaxationLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
          <div class="modal-content">
            <div class="modal-header" style="background-color: #ff771d; color: white;">
              <h5 class="modal-title" id="modalTaxationLabel">Taxation Quiz</h5>
              <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-center">
              <!-- Price Section -->
              <div style="margin-top: 10px;">
                <h2 style="font-size: 4rem; font-weight: bold; font-family: 'Roboto Mono', monospace; color: #ff771d;">₱1,214</h2>
              </div>
              <!-- Description Section -->
              <p style="font-size: 1rem; color: #555; margin-top: 20px;">Enhance your taxation knowledge with this practical and insightful quiz.</p>
            </div>
            <div class="modal-footer justify-content-center">
              <button type="button" class="btn btn-warning btn-lg" style="width: 100%;" onclick="window.location.href='quiz_taxation.php'">Proceed</button>
            </div>
          </div>
        </div>
      </div>

      <!-- Modal 4: Auditing -->
      <div class="modal fade" id="modalAuditing" tabindex="-1" aria-labelledby="modalAuditingLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
          <div class="modal-content">
            <div class="modal-header" style="background-color: #0d6efd; color: white;">
              <h5 class="modal-title" id="modalAuditingLabel">Auditing Quiz</h5>
              <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-center">
              <!-- Price Section -->
              <div style="margin-top: 10px;">
                <h2 style="font-size: 4rem; font-weight: bold; font-family: 'Roboto Mono', monospace; color: #0d6efd;">₱2,015</h2>
              </div>
              <!-- Description Section -->
              <p style="font-size: 1rem; color: #555; margin-top: 20px;">Refine your auditing expertise with this quiz covering critical principles and best practices.</p>
            </div>
            <div class="modal-footer justify-content-center">
              <button type="button" class="btn btn-info btn-lg" style="width: 100%;" onclick="window.location.href='quiz_auditing.php'">Proceed</button>
            </div>
          </div>
        </div>
      </div>

      <!-- Modal 5: Regulatory Framework for Business Transactions -->
      <div class="modal fade" id="modalRegulatoryFramework" tabindex="-1" aria-labelledby="modalRegulatoryFrameworkLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
          <div class="modal-content">
            <div class="modal-header" style="background-color: #f39c12; color: white;">
              <h5 class="modal-title" id="modalRegulatoryFrameworkLabel">Regulatory Framework Quiz</h5>
              <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-center">
              <!-- Price Section -->
              <div style="margin-top: 10px;">
                <h2 style="font-size: 4rem; font-weight: bold; font-family: 'Roboto Mono', monospace; color: #f39c12;">₱1,880</h2>
              </div>
              <!-- Description Section -->
              <p style="font-size: 1rem; color: #555; margin-top: 20px;">Challenge yourself on the legal and regulatory aspects of business transactions in this engaging quiz.</p>
            </div>
            <div class="modal-footer justify-content-center">
              <button type="button" class="btn btn-dark btn-lg" style="width: 100%;" onclick="window.location.href='quiz_rfbt.php'">Proceed</button>
            </div>
          </div>
        </div>
      </div>

      <!-- Modal 6: Management Advisory Services -->
      <div class="modal fade" id="modalManagementAdvisory" tabindex="-1" aria-labelledby="modalManagementAdvisoryLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
          <div class="modal-content">
            <div class="modal-header" style="background-color: #5e60ce; color: white;">
              <h5 class="modal-title" id="modalManagementAdvisoryLabel">Management Advisory Quiz</h5>
              <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-center">
              <!-- Price Section -->
              <div style="margin-top: 10px;">
                <h2 style="font-size: 4rem; font-weight: bold; font-family: 'Roboto Mono', monospace; color: #5e60ce;">₱2,000</h2>
              </div>
              <!-- Description Section -->
              <p style="font-size: 1rem; color: #555; margin-top: 20px;">Test your advisory skills with this quiz tailored for future management consultants and advisors.</p>
            </div>
            <div class="modal-footer justify-content-center">
              <button type="button" class="btn btn-primary btn-lg" style="width: 100%;" onclick="window.location.href='quiz_mds.php'">Proceed</button>
            </div>
          </div>
        </div>
      </div>

      <!-- Additional Modals for "Auditing", "Regulatory Framework", "Management Advisory Services" can follow the same structure -->
    </div>

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

  <script>
    document.addEventListener("DOMContentLoaded", function() {
      var modalTitle = document.getElementById('resultModalLabel').textContent;

      // Show the modal on page load if the title is not "Success"
      if (modalTitle !== "You currently have an active pay per transaction subscribtion") {
        var resultModal = new bootstrap.Modal(document.getElementById('resultModal'));
        resultModal.show();
      }

      // Trigger the modal when the notification icon is clicked
      var notificationIcon = document.getElementById('notificationIcon');
      notificationIcon.addEventListener('click', function(e) {
        e.preventDefault(); // Prevent default link behavior
        var resultModal = new bootstrap.Modal(document.getElementById('resultModal'));
        resultModal.show();
      });
    });
  </script>


  <script>
  document.addEventListener("DOMContentLoaded", function() {
    // Financial Accounting button
    const afrButton = document.querySelector("#quizButton");
    if (afrButton) {
      afrButton.addEventListener("click", function(event) {
        const afrCount = <?php echo $counts['afr']; ?>;
        if (afrCount > 0) {
          window.location.href = 'far.php';  // Redirect if count > 0
        } else {
          // Open modal if count is 0
          $('#modalFinancialAccounting').modal('show');
        }
      });
    }

    // Advanced Financial Accounting button
    const afarButton = document.querySelector(".btn-success[data-bs-target='#modalAdvancedAccounting']");
    if (afarButton) {
      afarButton.addEventListener("click", function(event) {
        const afarCount = <?php echo $counts['afar']; ?>;
        if (afarCount > 0) {
          window.location.href = 'afar.php';  // Redirect if count > 0
        } else {
          // Open modal if count is 0
          $('#modalAdvancedAccounting').modal('show');
        }
      });
    }

    // Taxation button
    const taxationButton = document.querySelector(".btn-warning[data-bs-target='#modalTaxation']");
    if (taxationButton) {
      taxationButton.addEventListener("click", function(event) {
        const taxationCount = <?php echo $counts['taxation']; ?>;
        if (taxationCount > 0) {
          window.location.href = 'taxation.php';  // Redirect if count > 0
        } else {
          // Open modal if count is 0
          $('#modalTaxation').modal('show');
        }
      });
    }

    // Auditing button
    const auditingButton = document.querySelector(".btn-info[data-bs-target='#modalAuditing']");
    if (auditingButton) {
      auditingButton.addEventListener("click", function(event) {
        const auditingCount = <?php echo $counts['auditing']; ?>;
        if (auditingCount > 0) {
          window.location.href = 'auditing.php';  // Redirect if count > 0
        } else {
          // Open modal if count is 0
          $('#modalAuditing').modal('show');
        }
      });
    }

    // Regulatory Framework button
    const rfbtButton = document.querySelector(".btn-dark[data-bs-target='#modalRegulatoryFramework']");
    if (rfbtButton) {
      rfbtButton.addEventListener("click", function(event) {
        const rfbtCount = <?php echo $counts['rfbt']; ?>;
        if (rfbtCount > 0) {
          window.location.href = 'rfbt.php';  // Redirect if count > 0
        } else {
          // Open modal if count is 0
          $('#modalRegulatoryFramework').modal('show');
        }
      });
    }

    // Management Advisory button
    const masButton = document.querySelector(".btn-primary[data-bs-target='#modalManagementAdvisory']");
    if (masButton) {
      masButton.addEventListener("click", function(event) {
        const mdsCount = <?php echo $counts['mds']; ?>;
        if (mdsCount > 0) {
          window.location.href = 'mas.php';  // Redirect if count > 0
        } else {
          // Open modal if count is 0
          $('#modalManagementAdvisory').modal('show');
        }
      });
    }
  });
</script>


</body>

</html>