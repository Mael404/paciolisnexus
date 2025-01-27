<?php
session_start();
include('config.php');

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
  echo "Please log in to continue.";
  exit;
}

// Get the current user's user_id from the session
$current_user_id = $_SESSION['user_id'];

// Query to check if the user_id exists in the homeworkhelp table
$query = "SELECT COUNT(*) AS count FROM homeworkhelp WHERE user_id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $current_user_id);
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();

// If user_id does not exist, set a flag to show the modal
$show_modal = $row['count'] == 0;
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


    #footer {
      position: fixed;
      bottom: 0;
      width: 80%;
      background: #f8f9fa;
      /* Adjust as needed for your design */
      padding: 10px 0;
      /* Optional: Add padding for spacing */
      text-align: left;
    }

    .content {
      min-height: calc(100vh - 60px);
      /* Adjust based on footer height */
      padding-bottom: 60px;
      /* Reserve space for the footer */
    }
  </style>

  <!-- Additional Styling -->
<style>
/* Style for the PDF iframe container */
.iframe-container {
    position: relative;
    width: 100%;
    height: 500px;
}

/* Position the unlock button in the center */
.unlock-btn {
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    display: none;
}

.pdf-iframe {
    filter: blur(2px); /* Blur the iframe */
}

.iframe-container:hover .unlock-btn {
    display: inline-block; /* Show the button when hovering over the iframe */
}

.unlock-btn:hover {
    background-color: #f39c12; /* Hover effect for the unlock button */
}


    .section-title {
    font-size: 2.5rem;
    font-weight: bold;
    color: #333; /* Dark text color for visibility */
    background: linear-gradient(135deg, #0056b3, #00bfff); /* Gradient color */
    -webkit-background-clip: text;
    background-clip: text;
    text-transform: uppercase;
    margin-bottom: 10px;
    margin-top: 10px;
    letter-spacing: 2px;
    position: relative;
    display: inline-block;
    padding-bottom: 5px;
  }

  .section-title::after {
    content: '';
    position: absolute;
    width: 50%;
    height: 3px;
    background-color: #00bfff; /* Underline effect with highlight color */
    bottom: 0;
    left: 25%;
    transition: width 0.3s ease-in-out;
  }

  .section-title:hover::after {
    width: 100%; /* Full underline effect on hover */
    left: 0;
  }
  
  .card {
    border-radius: 8px;
    transition: transform 0.3s ease-in-out;
  }

  .card:hover {
    transform: translateY(-5px);
  }

  .card-body {
    padding: 20px;
  }

  .card-title {
    font-size: 1.25rem;
    font-weight: 500;
    color: #0056b3;
    margin-bottom: 20px;
  }

  iframe {
    border-radius: 8px;
    border: 1px solid #ccc;
  }

  .row.mb-4 {
    margin-bottom: 20px;
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

  <?php
  include 'sidebar.php';
  ?>


  <main id="main" class="main">

    <div class="pagetitle">
      <h1>View Plans</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.html">Home</a></li>
          <li class="breadcrumb-item active">View Plans</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section dashboard">
  <div class="container">
    <div class="row mb-4">
      <div class="col-12">
        <h2 class="section-title text-center">Uploaded PDF Files</h2>
      </div>
    </div>

    <!-- Dropdown for sorting by subject -->
    <div class="row mb-3">
      <div class="col-12">
        <form method="GET" action="">
          <div class="form-group">
            <label for="subject">Sort by Subject:</label>
            <select name="subject" id="subject" class="form-control" onchange="this.form.submit()">
              <option value="">All Subjects</option>
              <option value="Financial Accounting and Reporting" <?= isset($_GET['subject']) && $_GET['subject'] == 'Financial Accounting and Reporting' ? 'selected' : '' ?>>Financial Accounting and Reporting</option>
              <option value="Advanced Financial Accounting and Reporting" <?= isset($_GET['subject']) && $_GET['subject'] == 'Advanced Financial Accounting and Reporting' ? 'selected' : '' ?>>Advanced Financial Accounting and Reporting</option>
              <option value="Taxation" <?= isset($_GET['subject']) && $_GET['subject'] == 'Taxation' ? 'selected' : '' ?>>Taxation</option>
              <option value="Auditing" <?= isset($_GET['subject']) && $_GET['subject'] == 'Auditing' ? 'selected' : '' ?>>Auditing</option>
              <option value="Regulatory Framework for Business Transactions" <?= isset($_GET['subject']) && $_GET['subject'] == 'Regulatory Framework for Business Transactions' ? 'selected' : '' ?>>Regulatory Framework for Business Transactions</option>
              <option value="Management Advisory Services" <?= isset($_GET['subject']) && $_GET['subject'] == 'Management Advisory Services' ? 'selected' : '' ?>>Management Advisory Services</option>
            </select>
          </div>
        </form>
      </div>
    </div>

    <div class="row">
      <?php
      // Get selected subject from the dropdown (if any)
      $selectedSubject = isset($_GET['subject']) ? $_GET['subject'] : '';

      // Build query to fetch file paths, file names, and subject based on selected subject
      $query = "SELECT id, file_path, file_name, subject, status FROM materials WHERE status = 'visible'";  // Only visible files

      // Add condition for subject if selected
      if ($selectedSubject != '') {
          $query .= " AND subject = ?";
      }

      // Prepare and execute the query
      $stmt = $conn->prepare($query);
      if ($selectedSubject != '') {
          $stmt->bind_param("s", $selectedSubject); // Bind only subject
      }
      $stmt->execute();
      $result = $stmt->get_result();

      if ($result && $result->num_rows > 0) {
          while ($row = $result->fetch_assoc()) {
              $fileId = $row['id']; // ID of the file
              $filePath = $row['file_path']; // Path to the PDF file
              $fileName = $row['file_name']; // Name of the file
              $subject = $row['subject']; // Subject from the database
              $status = $row['status']; // Status of the file
              ?>
              <div class="col-md-6 mb-4">
                <div class="card shadow-sm">
                  <div class="card-body">
                    <h5 class="card-title text-primary"><?= htmlspecialchars($fileName) ?></h5>
                    <p class="text-secondary"><strong>Subject:</strong> <?= htmlspecialchars($subject) ?></p>
                    <?php 
                    // Check if file path is valid and accessible
                    if (file_exists($filePath)) { 
                        $fileUrl = htmlspecialchars($filePath); 
                    ?>
                      <!-- Wrapper for iframe and unlock button -->
                      <div class="iframe-container position-relative">
                        <iframe 
                          src="<?= $fileUrl ?>" 
                          width="100%" 
                          height="500px" 
                          class="pdf-iframe" 
                          style="border: 1px solid #ddd;">
                        </iframe>

                        <!-- Unlock Module Button -->
                        <button 
  class="btn btn-warning unlock-btn" 
  data-id="<?= $fileId ?>" 
  data-bs-toggle="modal" 
  data-bs-target="#pricingModal">
  UNLOCK MODULE
</button>



                      </div>
                    <?php } else { ?>
                      <p class="text-danger">PDF file not found or inaccessible.</p>
                    <?php } ?>
                  </div>
                </div>
              </div>
              <?php
          }
      } else {
          // No PDFs found in the table
          echo "<p class='text-warning'>No visible PDF files found.</p>";
      }
      ?>
    </div>
  </div>
</section>

<!-- Modal for choosing subscription or pay-per-transaction -->
<div class="modal fade" id="pricingModal" tabindex="-1" aria-labelledby="pricingModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="pricingModalLabel">Choose Your Plan</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <section id="pricing" class="pricing section">
          <!-- Section Title -->
         
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
                    <a href="#" class="btn-buy" data-bs-toggle="modal" data-bs-target="#payModal">Choose Subscription</a>
            
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
                    <a href="#" class="btn-buy" data-bs-toggle="modal" data-bs-target="#payModal">Choose Subscription</a>
                
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
                    <a href="#" class="btn-buy" data-bs-toggle="modal" data-bs-target="#payModal">Choose Subscription</a>
   
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div>
            
          </div>
        </section>
      </div>
      <div class="modal-footer">
  <div class="w-100 text-center">
    <a href="#" class="btn-buy" data-bs-toggle="modal" data-bs-target="#payModal"> Continue with Pay Per Transaction</a>
  </div>
  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
</div>

    </div>
  </div>
</div>

<!-- Modal for Unlocking the Module with Form -->
<div class="modal fade" id="payModal" tabindex="-1" aria-labelledby="payModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="payModalLabel">Unlock Module</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      <form id="unlockForm" method="POST" enctype="multipart/form-data" action="insert_material_access.php">

          <!-- Hidden Input for Transaction ID -->
          <input type="hidden" id="transactionId" name="transactionId" value="">

          <!-- Full Name -->
          <div class="mb-3">
            <label for="fullName" class="form-label">Full Name</label>
            <input type="text" class="form-control" id="fullName" name="fullName" placeholder="Enter your full name" required>
          </div>

          <!-- GCash Number -->
          <div class="mb-3">
            <label for="gcashNumber" class="form-label">GCash Number</label>
            <input type="text" class="form-control" id="gcashNumber" name="gcashNumber" placeholder="Enter your GCash number" required>
          </div>

          <!-- GCash Name -->
          <div class="mb-3">
            <label for="gcashName" class="form-label">GCash Name</label>
            <input type="text" class="form-control" id="gcashName" name="gcashName" placeholder="Enter the name registered with GCash" required>
          </div>

          <!-- Upload Proof of Payment -->
          <div class="mb-3">
            <label for="proofOfPayment" class="form-label">Upload Proof of Payment</label>
            <input type="file" class="form-control" id="proofOfPayment" name="proofOfPayment" accept=".jpg,.jpeg,.png,.pdf" required>
          </div>

          <!-- Submit Button -->
          <button type="submit" class="btn btn-primary">Submit</button>
        </form>
      </div>
    </div>
  </div>
</div>





  </main>

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


  <!-- Trigger Modal if Condition Met -->
  <?php if ($show_modal): ?>
    <script>
      var resultModal = new bootstrap.Modal(document.getElementById('resultModal'), {});
      resultModal.show();

    

    </script>
  <?php endif; ?>

<script>
   
  document.addEventListener("DOMContentLoaded", function () {
    // Get all "Unlock Module" buttons
    const unlockButtons = document.querySelectorAll(".unlock-btn");

    unlockButtons.forEach(button => {
      button.addEventListener("click", function () {
        // Get the data-id of the clicked button
        const transactionId = this.getAttribute("data-id");
        
        // Log the transaction ID to the console
        console.log("Transaction ID:", transactionId);

        // Optional: Pass the transaction ID to the payModal (if needed)
        const payModal = document.querySelector("#payModal");
        if (payModal) {
          // Set the transaction ID value in a hidden input field in the form
          const hiddenInput = document.querySelector("#unlockForm input[name='transactionId']");
          if (hiddenInput) {
            hiddenInput.value = transactionId;
          } else {
            // Create a hidden input field if not already present
            const input = document.createElement("input");
            input.type = "hidden";
            input.name = "transactionId";
            input.value = transactionId;
            document.querySelector("#unlockForm").appendChild(input);
          }
        }
      });
    });
  });


</script>
</body>

</html>