<?php
session_start();
include('config.php');


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

<?php
include 'header.php'; // Use the correct path
?>

    <?php
    include 'sidebar.php';
    ?>


    <main id="main" class="main">

        <div class="pagetitle">
            <h1>Library</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                    <li class="breadcrumb-item active">Library</li>
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
        <h2 class="section-title text-center">Library</h2>
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
   
      $user_id = $_SESSION['user_id']; // Assuming user_id is stored in the session

      // Get selected subject from the dropdown (if any)
      $selectedSubject = isset($_GET['subject']) ? $_GET['subject'] : '';

      // Build query to fetch file paths, file names, subject, and status based on selected subject and student_id match
      $query = "SELECT id, file_path, file_name, subject, status FROM materials WHERE student_id = ?";

      // Add condition for subject if selected
      if ($selectedSubject != '') {
          $query .= " AND subject = ?";
      }

      // Prepare and execute the query
      $stmt = $conn->prepare($query);
      if ($selectedSubject != '') {
          $stmt->bind_param("is", $user_id, $selectedSubject); // Bind user_id and subject
      } else {
          $stmt->bind_param("i", $user_id); // Bind only user_id if no subject is selected
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

<!-- Progress Tracker -->
<div style="margin-top: 20px;">
  <label for="progress" style="font-weight: bold;">Progress:</label>
  <div style="background-color: #f3f3f3; border-radius: 5px; width: 100%; height: 30px;">
    <div id="progress" style="background-color: #4caf50; height: 100%; width: 5%; border-radius: 5px; text-align: center; color: white; font-weight: bold; line-height: 30px;">
      5%
    </div>
  </div>
</div>

<!-- Expiration Date -->
<div style="margin-top: 10px; font-weight:bold; color:#dc3545">
  <label for="expiration">Material Expiration Date:</label>
  <span id="expiration">July 14, 2025</span>
</div>

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
          // No PDFs found for the logged-in user
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