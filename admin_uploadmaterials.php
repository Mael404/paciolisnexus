<?php
session_start();
include('config.php');

if (isset($_POST['submitAnswer'])) {
    $question_id = $_POST['question_id'];
    $answer = mysqli_real_escape_string($conn, $_POST['answer']);
    $current_user_id = $_SESSION['user_id']; // Assuming the user ID is stored in the session

    // Query to get the name of the logged-in user from the 'users' table
    $user_query = "SELECT name FROM users WHERE user_id = '$current_user_id'";
    $result = mysqli_query($conn, $user_query);
    
    if ($result && mysqli_num_rows($result) > 0) {
        $user = mysqli_fetch_assoc($result);
        $user_name = $user['name']; // Get the name of the user
        
        // Update the homeworkhelp table with the answer, cpa_id, and cpa_name
        $update_query = "UPDATE homeworkhelp 
                         SET answer = '$answer', cpa_id = '$current_user_id', cpa_name = '$user_name', status = 'Answered' 
                         WHERE transaction_id = '$question_id'";

        if (mysqli_query($conn, $update_query)) {
            echo "<script>alert('Answer submitted successfully!');</script>";
        } else {
            echo "Error: " . mysqli_error($conn);
            echo "<script>alert('Error submitting answer. Please try again.');</script>";
        }
    } else {
        echo "<script>alert('Error: User not found.');</script>";
    }
}
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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

    <!-- DataTables CSS (only need this once) -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">

    <!-- DataTables Black and White theme CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/dataTables.bbnw.min.css">

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- DataTables JS -->
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>

    <!-- Template Main CSS File -->
    <link href="assets/css/style.css" rel="stylesheet">
    <style>
        .btn-action {
            width: 40px;
            /* Set a fixed width */
            height: 40px;
            /* Set a fixed height */
            display: flex;
            /* Use flexbox to center the icon */
            justify-content: center;
            /* Center horizontally */
            align-items: center;
            /* Center vertically */
            padding: 0;
            /* Remove default padding */
            font-size: 18px;
            /* Icon size */
        }

     
  .card {
    margin-bottom: 20px;
  }
  .text-danger {
    color: #dc3545;
  }
  .text-warning {
    color: #ffc107;
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
                            <span>ADMIN</span>
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
    include 'admin_sidebar.php';
    ?>


    <main id="main" class="main">

        <div class="pagetitle">
            <h1>Manage Materials</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                    <li class="breadcrumb-item active">Posted Questions</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->
        <style>
  .upload-container {
    max-width: 600px; /* Reduced max-width */
    margin: auto;
    background-color: #fff;
    padding: 20px; /* Reduced padding */
    border-radius: 8px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    margin-bottom: 10px;
  }

  .upload-container h2 {
    margin-bottom: 15px; /* Reduced margin */
    color: #0056b3;
    font-size: 1.8rem; /* Reduced font size */
  }

  .upload-container label {
    font-weight: bold;
    font-size: 1rem; /* Adjusted font size for label */
  }

  .upload-container button {
    background-color: #0056b3;
    color: white;
    border: none;
    padding: 8px 18px; /* Reduced padding */
    font-size: 14px; /* Smaller button font size */
    cursor: pointer;
  }

  .upload-container button:hover {
    background-color: #004085;
  }
</style>

<section class="section dashboard">
  <div class="container">
    <!-- Button to toggle the upload form visibility -->
    <button id="toggleUploadForm" class="btn btn-success mb-4">
      <i class="bi bi-plus-circle"></i> Upload PDF
    </button>

    <!-- Upload Form Section (Initially hidden) -->
    <div id="uploadSection" class="row" style="display: none;">
      <div class="container">
        <div class="upload-container">
          <h2>Upload Your PDF</h2>
          <form action="upload_pdf.php" method="POST" enctype="multipart/form-data">
            <div class="mb-3">
              <label for="subject" class="form-label">Choose Subject:</label>
              <select name="subject" id="subject" class="form-control" required>
                <option value="">Select a Subject</option>
                <option value="Financial Accounting and Reporting">Financial Accounting and Reporting</option>
                <option value="Advanced Financial Accounting and Reporting">Advanced Financial Accounting and Reporting</option>
                <option value="Taxation">Taxation</option>
                <option value="Auditing">Auditing</option>
                <option value="Regulatory Framework for Business Transactions">Regulatory Framework for Business Transactions</option>
                <option value="Management Advisory Services">Management Advisory Services</option>
              </select>
            </div>
            <div class="mb-3">
              <label for="pdfFile" class="form-label">Choose PDF File:</label>
              <input type="file" name="pdfFile" id="pdfFile" accept="application/pdf" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-primary w-100">Upload</button>
          </form>
        </div>
      </div>
    </div>
  </div>
</section>



<!-- JavaScript to toggle the upload form visibility with fade-in animation -->
<script>
  document.getElementById("toggleUploadForm").addEventListener("click", function() {
    var uploadSection = document.getElementById("uploadSection");
    if (uploadSection.style.display === "none" || uploadSection.style.display === "") {
      uploadSection.style.display = "block";  // Show the section
      uploadSection.classList.add("fade-in");  // Add fade-in animation class
      this.innerHTML = '<i class="bi bi-dash-circle"></i> Hide Upload Form';  // Change button text to "Hide"
    } else {
      uploadSection.style.display = "none";  // Hide the section
      uploadSection.classList.remove("fade-in");  // Remove fade-in class to reset animation
      this.innerHTML = '<i class="bi bi-plus-circle"></i> Upload PDF';  // Change button text back to "+"
    }
  });
</script>

<!-- CSS for fade-in animation -->
<style>
  .fade-in {
    animation: fadeIn 1s ease-in-out;
  }

  @keyframes fadeIn {
    0% {
      opacity: 0;
    }
    100% {
      opacity: 1;
    }
  }
</style>



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
      $query = "SELECT id, file_path, file_name, subject, status FROM materials";
      
      // Add condition for subject if selected
      if ($selectedSubject != '') {
          $query .= " WHERE subject = ?";
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
                  <div class="form-check" style="position: absolute; top: 10px; right: 10px; font-size: 1.2em;">
    <input class="form-check-input" type="checkbox" id="visibilityCheckbox<?= $fileId ?>" data-id="<?= $fileId ?>" <?= $status === 'visible' ? 'checked' : '' ?>>
    <label class="form-check-label" for="visibilityCheckbox<?= $fileId ?>">
      Mark as visible
    </label>
</div>

                    <h5 class="card-title text-primary"><?= htmlspecialchars($fileName) ?></h5>
                    <p class="text-secondary"><strong>Subject:</strong> <?= htmlspecialchars($subject) ?></p> <!-- Display subject here -->
                    <?php 
                    // Check if file path is valid and accessible
                    if (file_exists($filePath)) { 
                        $fileUrl = htmlspecialchars($filePath); 
                    ?>
                      <!-- Embed PDF content in iframe -->
                      <iframe 
                        src="<?= $fileUrl ?>" 
                        width="100%" 
                        height="500px" 
                        style="border: 1px solid #ddd;">
                      </iframe>
                      <!-- Checkbox for visibility -->
                     
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
          echo "<p class='text-warning'>No PDF files found.</p>";
      }
      ?>
    </div>
  </div>
</section>

<!-- Confirmation Modal -->
<!-- Confirmation Modal -->
<div class="modal fade" id="confirmationModal" tabindex="-1" aria-labelledby="confirmationModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="confirmationModalLabel">Confirm Visibility Change</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body" id="confirmationModalMessage">
        Are you sure you want to hide this material?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
        <button type="button" class="btn btn-primary" id="confirmVisibility">Yes</button>
      </div>
    </div>
  </div>
</div>


<script>
  // Handle checkbox change event
  document.querySelectorAll('.form-check-input').forEach(function(checkbox) {
    checkbox.addEventListener('change', function() {
      const fileId = this.getAttribute('data-id');
      
      // Show confirmation modal if unchecked (for hiding)
      if (!this.checked) {
        // Store file ID in the modal's confirm button
        document.getElementById('confirmVisibility').setAttribute('data-id', fileId);
        // Set the confirmation message to "Hide"
        document.getElementById('confirmationModalLabel').textContent = 'Confirm Visibility Change';
        document.getElementById('confirmationModalMessage').textContent = 'Are you sure you want to hide this material?';
        // Show the modal
        new bootstrap.Modal(document.getElementById('confirmationModal')).show();
      } else {
        // Show confirmation modal if checked (for making visible)
        document.getElementById('confirmVisibility').setAttribute('data-id', fileId);
        // Set the confirmation message to "Visible"
        document.getElementById('confirmationModalLabel').textContent = 'Confirm Visibility Change';
        document.getElementById('confirmationModalMessage').textContent = 'Are you sure you want to make this material visible?';
        // Show the modal
        new bootstrap.Modal(document.getElementById('confirmationModal')).show();
      }
    });
  });

  // Handle modal confirmation for setting status to either hidden or visible
  document.getElementById('confirmVisibility').addEventListener('click', function() {
    const fileId = this.getAttribute('data-id');
    const status = document.getElementById('visibilityCheckbox' + fileId).checked ? 'visible' : 'hidden';
    
    // Send an AJAX request to update the status in the database
    updateFileStatus(fileId, status);
    
    // Close the modal
    bootstrap.Modal.getInstance(document.getElementById('confirmationModal')).hide();
  });

  // Function to update file status
  function updateFileStatus(fileId, status) {
    // Determine the correct PHP file based on the status (visible or hidden)
    const url = (status === 'visible') ? 'update_visibility.php' : 'update_visibility_hidden.php';

    fetch(url, {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json'
      },
      body: JSON.stringify({ id: fileId })
    })
    .then(response => response.json())
    .then(data => {
      if (data.success) {
        // Update the checkbox based on the status
        document.getElementById('visibilityCheckbox' + fileId).checked = (status === 'visible');
        alert('File status updated to ' + status + '.');
        location.reload(); // Reload the page to reflect changes
      } else {
        alert('Error updating status.');
      }
    })
    .catch(error => {
      console.error('Error:', error);
    });
  }
</script>




<!-- Additional Styling -->
<style>
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



</body>

</html>