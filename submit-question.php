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
      <h1>Homework Help</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.html">Home</a></li>
          <li class="breadcrumb-item active">Submit a Qustion</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section dashboard">
      <div class="row">
        <div class="col-lg-12">
          <div class="card">
            <div class="card-body">
              <!-- Multi-Step Form -->
              <form id="multiStepForm" action="submit_question_data.php" method="POST" enctype="multipart/form-data">

                <!-- Step 1: Personal Details -->
                <div id="step1" class="form-step">
                  <h3 style="color: #4154f1; font-weight: bold; margin-bottom: 15px; margin-top:15px;">Personal Details</h3>
                  <div class="mb-3">
                    <label for="fullName" style="font-weight: bold;">Full Name:</label>
                    <input type="text" id="fullName" name="full_name" class="form-control" placeholder="Enter your full name" required>
                  </div>
                  <div class="mb-3">
                    <label for="birthdate" style="font-weight: bold;">Birthdate:</label>
                    <input type="date" id="birthdate" name="birthdate" class="form-control" required>
                  </div>
                  <div class="mb-3">
                    <label for="address" style="font-weight: bold;">Address:</label>
                    <input type="text" id="address" name="address" class="form-control" placeholder="Enter your address" required>
                  </div>
                  <div class="mb-3">
                    <label for="quizTitle" style="font-weight: bold;">Quiz Title:</label>
                    <input type="text" id="quizTitle" name="quiz_title" class="form-control" value="Advanced Financial Accounting and Reporting" readonly>
                  </div>
                  <div style="text-align: center; margin-top: 30px;">
                    <button type="button" class="btn btn-primary" onclick="nextStep(2)">Next</button>
                  </div>
                </div>

                <!-- Step 2: Payment Details -->
                <!-- Step 2: Payment Details -->
                <div id="step2" class="form-step" style="display: none;">
                  <h3 style="color: #2eca6a; font-weight: bold; margin-bottom: 15px; margin-top:15px;">Payment Details</h3>
                  <div class="mb-3">
                    <label for="gcashName" style="font-weight: bold;">Gcash Account Name:</label>
                    <input type="text" id="gcashName" name="gcash_name" class="form-control" placeholder="Enter Gcash account name" required>
                  </div>
                  <div class="mb-3">
                    <label for="gcashNumber" style="font-weight: bold;">Gcash Account Number:</label>
                    <input type="text" id="gcashNumber" name="gcash_number" class="form-control" placeholder="Enter Gcash account number" required>
                  </div>
                  <div class="mb-3">
                    <label for="paymentProof" style="font-weight: bold;">Upload Proof of Payment:</label>
                    <input type="file" id="paymentProof" name="payment_proof" class="form-control" accept="image/*" required>
                  </div>

                  <!-- QR Code Section -->
                  <div style="text-align: center; margin-top: 30px;">
                    <button type="button" class="btn btn-secondary" onclick="showQRCode()">Show QR Code</button>
                    <div id="qrCodeContainer" style="text-align: center; margin-top: 20px; display: none;">
                      <h3 style="color: #4154f1;">Scan the QR Code to Pay</h3>
                      <img src="https://businessmaker-academy.com/cms/wp-content/uploads/2022/04/Gcash-BMA-QRcode.jpg"
                        alt="QR Code"
                        style="max-width: 200px; border: 2px solid #ddd; border-radius: 10px;">
                    </div>
                  </div>

                  <div style="text-align: center; margin-top: 30px;">
                    <button type="button" class="btn btn-secondary" onclick="prevStep(1)">Previous</button>
                    <button type="button" class="btn btn-primary" onclick="nextStep(3)">Next</button>
                  </div>
                </div>

                <!-- Step 3: Question Details
                        
                       also in in this part again, can you add like a filter messsage wherein it will filter any names, address, phone numbers that will be inputed in this textbox? if the user enters any of the following, a modal warning pop up will appear.

 <div class="mb-3">
    <label for="question" style="font-weight: bold;">Question:</label>
    <textarea id="question" name="question" class="form-control" rows="4" placeholder="Enter your question" required></textarea>
</div>  -->
                <div id="step3" class="form-step" style="display: none;">
                  <h3 style="color: #ff6347; font-weight: bold; margin-bottom: 15px; margin-top:15px;">Question Details</h3>
                 <!-- HTML -->
<div class="mb-3">
    <label for="question" style="font-weight: bold;">Question:</label>
    <textarea id="question" name="question" class="form-control" rows="4" placeholder="Enter your question" required></textarea>
</div>



<!-- JavaScript -->
<script>
  document.getElementById("question").addEventListener("input", function () {
    const questionInput = this.value;

    // Regular expressions for detecting sensitive information
    const namePattern = /\b[A-Z][a-z]+\s[A-Z][a-z]+\b/; // Matches full names like "John Doe"
    const addressPattern = /\b\d{1,5}\s\w+(\s\w+)*\b/; // Matches addresses like "123 Main Street"
    const phonePattern = /\b\d{10}\b|\b\(?\d{3}\)?[-.\s]?\d{3}[-.\s]?\d{4}\b/; // Matches phone numbers

    if (
      namePattern.test(questionInput) ||
      addressPattern.test(questionInput) ||
      phonePattern.test(questionInput)
    ) {
      // Show warning modal
      const warningModal = new bootstrap.Modal(document.getElementById("warningModal"));
      warningModal.show();
    }
  });
</script>

                  <div class="mb-3">
                    <label for="difficulty" style="font-weight: bold;">Detected Difficulty:</label>
                    <input type="text" id="difficulty" name="difficulty" class="form-control" readonly placeholder="Difficulty will be detected automatically">
                  </div>

                            <!-- JavaScript for Auto Detecting Difficulty -->
                            <script>
                              const questionInput = document.getElementById("question");
                              const difficultyInput = document.getElementById("difficulty");

                              questionInput.addEventListener("blur", function() {
                                const questionText = questionInput.value.trim();
                                if (questionText) {
                                  // Send question to the backend for difficulty detection
                                  fetch("detect_difficulty.php", {
                                      method: "POST",
                                      headers: {
                                        "Content-Type": "application/json",
                                      },
                                      body: JSON.stringify({
                                        question: questionText
                                      }),
                                    })
                                    .then((response) => response.json())
                                    .then((data) => {
                                      difficultyInput.value = data.difficulty || "Could not detect difficulty";
                                    })
                                    .catch((error) => {
                                      console.error("Error:", error);
                                      difficultyInput.value = "Error detecting difficulty";
                                    });
                                }
                              });
                            </script>

                  <div class="mb-3">
                    <label style="font-weight: bold;">Is it urgent?</label>
                    <div class="form-check">
                      <input type="checkbox" id="urgentCheck" class="form-check-input" onclick="toggleUrgencyDropdown()">
                      <label for="urgentCheck" class="form-check-label">Yes, it's urgent</label>
                    </div>
                    <div id="urgencyOptions" class="mb-3" style="display: none;">
                      <label for="urgencyTime" style="font-weight: bold;">Select Urgency:</label>
                      <select id="urgencyTime" name="urgency" class="form-control">
                        <option value="">--------</option>
                        <option value="1 hour">1 Hour</option>
                        <option value="2 hours">2 Hours</option>
                        <option value="3 hours">3 Hours</option>
                      </select>
                    </div>


                    <div style="text-align: center; margin-top: 30px;">
                      <button type="button" class="btn btn-secondary" onclick="prevStep(2)">Previous</button>
                      <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                  </div>

              </form>
            </div>
          </div>
        </div>
      </div>
    </section>

    <script>
      function toggleUrgencyDropdown() {
        const checkbox = document.getElementById("urgentCheck");
        const urgencyOptions = document.getElementById("urgencyOptions");

        if (checkbox.checked) {
          urgencyOptions.style.display = "block";
        } else {
          urgencyOptions.style.display = "none";
        }
      }


      function showQRCode() {
        document.getElementById("qrCodeContainer").style.display = "block";
        window.scrollTo(0, document.body.scrollHeight); // Scroll to the QR code
      }

      function nextStep(step) {
        document.querySelectorAll('.form-step').forEach((element) => {
          element.style.display = 'none';
        });
        document.getElementById('step' + step).style.display = 'block';
      }

      function prevStep(step) {
        document.querySelectorAll('.form-step').forEach((element) => {
          element.style.display = 'none';
        });
        document.getElementById('step' + step).style.display = 'block';
      }
    </script>
<!-- Warning Modal -->

    <!-- Modal Code -->
    <div class="modal fade" id="resultModal" tabindex="-1" aria-labelledby="resultModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-xl">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="resultModalLabel">Exclusive Offers</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <!-- Pricing Section -->
            <section id="pricing" class="pricing section">
              <!-- Section Title -->
              <div class="container section-title" data-aos="fade-up">
                <p><span>Check our</span> <span class="description-title">Pricing</span></p>
              </div>
              <!-- Pricing Items -->
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

<!-- Warning Modal -->
<div class="modal fade" id="warningModal" tabindex="-1" aria-labelledby="warningModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header bg-danger text-white">
        <h5 class="modal-title" id="warningModalLabel">
          <i class="bi bi-exclamation-triangle-fill me-2"></i> Warning
        </h5>
      
      </div>
      <div class="modal-body text-center">
        <i class="bi bi-exclamation-circle text-danger display-4 mb-3"></i>
        <p class="fw-bold text-danger">
          Your input contains sensitive information (names, addresses, or phone numbers).
        </p>
        <p class="text-muted">Please remove it before proceeding.</p>
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


</body>

</html>