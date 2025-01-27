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

    /* Dashboard Section */
.section.dashboard {
  background: #f9f9f9;
  padding: 2rem;
}

/* Card Styles */
.card {
  border: none;
  border-radius: 16px;
  box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
  background: linear-gradient(135deg, #007bff, #0056b3);
  color: white;
  transition: transform 0.3s ease-in-out, box-shadow 0.3s ease-in-out;
}

.card:hover {
  transform: translateY(-8px);
  box-shadow: 0 6px 12px rgba(0, 0, 0, 0.15);
}

/* Card Body */
.card-body {
  padding: 1.5rem;
  text-align: center;
}

/* Card Title */
.card-title {
  font-size: 1.5rem;
  font-weight: bold;
  margin-bottom: 1rem;
  color:rgb(247, 217, 86); /* School quiz theme highlight color */
}

/* Card Text */
.card-text {
  font-size: 1rem;
  line-height: 1.5;
  margin-bottom: 1.5rem;
}

.card-text strong {
  color:rgb(253, 222, 85);
}

/* View Details Button */
.btn-primary {
  background: #ffdc40;
  color: #0056b3;
  border: none;
  font-weight: bold;
  padding: 0.6rem 1.2rem;
  border-radius: 24px;
  transition: background 0.3s ease-in-out, color 0.3s ease-in-out;
}

.btn-primary:hover {
  background: #ffc107;
  color: white;
}

/* Layout */
.row {
  display: flex;
  flex-wrap: wrap;
  gap: 1.5rem;
}

.col-md-4 {
  flex: 1 1 calc(33.333% - 1.5rem);
  max-width: calc(33.333% - 1.5rem);
}

@media (max-width: 768px) {
  .col-md-4 {
    flex: 1 1 calc(50% - 1.5rem);
    max-width: calc(50% - 1.5rem);
  }
}

@media (max-width: 576px) {
  .col-md-4 {
    flex: 1 1 100%;
    max-width: 100%;
  }
}

.table {
        width: 100%;
        margin: 0 auto;
        border-collapse: collapse;
        background-color: #fff;
        font-family: Arial, sans-serif;
        text-align: center;
    }
    .table th, .table td {
        padding: 15px;
        border: 1px solid #ddd;
        font-size: 14px;
    }
    .table th {
        background-color: #0056b3;
        color: #fff;
    }
    .table tbody tr:nth-child(odd) {
        background-color: #f9f9f9;
    }
    .table tbody tr:hover {
        background-color: #f1f1f1;
    }
    .table td[colspan="4"] {
        text-align: center;
        font-style: italic;
        color: #999;
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

    <?php


// Assuming user_id is stored in the session
$current_user_id = $_SESSION['user_id'] ?? null;

// Ensure user_id exists in the session
if ($current_user_id) {
    ?>
   <section class="section dashboard">
    <div class="row">
        <div class="col-12">
            <table id="homeworkTable" class="display table table-striped table-bordered" style="width:100%">
                <thead>
                    <tr>
                        <th>Subject Title</th>
                        <th>Question</th>
                        <th>Difficulty</th>
                        <th>Date Submitted</th>
                        <th>Urgency</th>
                        <th>Status</th> <!-- Added Status column -->
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    // Query to fetch questions for the logged-in user with "active" status
                    $fetch_query = "SELECT * FROM homeworkhelp WHERE status IN ('active', 'answered', 'pending') AND user_id = ?";

                    // Prepare and execute the query using a prepared statement
                    if ($stmt = mysqli_prepare($conn, $fetch_query)) {
                        mysqli_stmt_bind_param($stmt, "i", $current_user_id);
                        mysqli_stmt_execute($stmt);
                        $result = mysqli_stmt_get_result($stmt);

                        // Check if any results are returned
                        if (mysqli_num_rows($result) > 0) {
                            while ($row = mysqli_fetch_assoc($result)) {
                                // Format the created_at date
                                $formatted_date = date("F j, Y", strtotime($row['created_at']));
                                ?>
                                <tr>
                                    <td><?= htmlspecialchars($row['subject_title']); ?></td>
                                    <td><?= htmlspecialchars($row['assignment_question']); ?></td>
                                    <td><?= htmlspecialchars($row['assignment_difficulty']); ?></td>
                                    <td><?= $formatted_date; ?></td>
                                    <td><?= htmlspecialchars($row['urgency']) ?: 'Not specified'; ?></td>
                                    <td><?= htmlspecialchars($row['status']); ?></td> <!-- Display the status here -->
                                    <td><a href="#" class="btn btn-success btn-sm" data-id="<?= $row['transaction_id']; ?>" id="viewDetailsBtn">View Details</a></td>
                                </tr>
                                <?php
                            }
                        } 

                        // Close the statement
                        mysqli_stmt_close($stmt);
                    } else {
                        echo '<tr><td colspan="7">Unable to prepare the query.</td></tr>'; 
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</section>


    <!-- Include DataTables.net -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>

    <!-- Initialize DataTable -->
    <script>
        $(document).ready(function () {
            $('#homeworkTable').DataTable({
                responsive: true,
                pageLength: 10,
                lengthChange: true,
                autoWidth: false
            });
        });
    </script>
    <?php
} else {
    echo '<p>User not logged in or session expired.</p>';
}
?>
<!-- Modal -->
<div class="modal fade" id="homeworkDetailModal" tabindex="-1" aria-labelledby="homeworkDetailModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content rounded-3 shadow-lg">
            <div class="modal-header border-0 bg-primary text-white">
                <h5 class="modal-title" id="homeworkDetailModalLabel">Homework Details</h5>
                <button type="button" class="btn-close text-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="mb-4">
                    <h6 class="text-secondary">CPA Information</h6>
                    <p><strong>CPA ID:</strong> <span id="cpaId" class="fw-bold text-dark"></span></p>
                    <p><strong>CPA Name:</strong> <span id="cpaName" class="text-dark"></span></p> <!-- New field for CPA Name -->
                    <p><strong>Answer:</strong> <span id="answer" class="text-success fw-bold text-uppercase unique-answer"></span></p> <!-- Updated with a unique class and style -->
                </div>
            </div>
        </div>
    </div>
</div>




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


 
<script>
$(document).ready(function() {
    // When 'View Details' button is clicked
    $('#homeworkTable').on('click', '#viewDetailsBtn', function(e) {
        e.preventDefault();
        
        var transactionId = $(this).data('id');  // Get the transaction_id from the button's data-id attribute
        
        // Make an AJAX request to fetch the details for this transaction_id
        $.ajax({
            url: 'fetch_homework_details.php',  // PHP script that fetches the details
            type: 'GET',
            data: { transaction_id: transactionId },
            success: function(response) {
                var data = JSON.parse(response);  // Assuming JSON response
                // Update modal with fetched data
                $('#cpaId').text(data.cpa_id);
                $('#cpaName').text(data.cpa_name); // Update the CPA name field
                $('#answer').text(data.answer);
                // Show the modal
                $('#homeworkDetailModal').modal('show');
            },
            error: function() {
                alert('An error occurred while fetching details.');
            }
        });
    });
});


</script>



</body>

</html>