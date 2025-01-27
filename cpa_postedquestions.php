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
                            <span>CPA</span>
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
    include 'cpa_sidebar.php';
    ?>


    <main id="main" class="main">

        <div class="pagetitle">
            <h1>Posted Questions</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                    <li class="breadcrumb-item active">Posted Questions</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->

        <section class="section dashboard">
    <div class="row">
        <?php
        // Query to fetch questions with an "active" status
        $fetch_query = "SELECT * FROM homeworkhelp WHERE status = 'active'";
        $result = mysqli_query($conn, $fetch_query);

        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                // Format the created_at date
                $formatted_date = date("F j, Y", strtotime($row['created_at']));
                ?>
                <div class="col-md-4 mb-4">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title"><?= htmlspecialchars($row['subject_title']); ?></h5>
                            <p class="card-text">
                                <strong>Question:</strong> <?= htmlspecialchars($row['assignment_question']); ?><br>
                                <strong>Difficulty:</strong> <?= htmlspecialchars($row['assignment_difficulty']); ?><br>
                                <strong>Date Submitted:</strong> <?= $formatted_date; ?><br>
                                <strong>Urgency:</strong> <?= htmlspecialchars($row['urgency']) ?: 'Not specified'; ?><br>
                            </p>
                            <a href="#" class="btn btn-primary answer-btn" 
   data-bs-toggle="modal" 
   data-bs-target="#answerModal"
   data-transaction_id="<?= $row['transaction_id']; ?>" 
   data-question="<?= htmlspecialchars($row['assignment_question']); ?>"
   data-difficulty="<?= htmlspecialchars($row['assignment_difficulty']); ?>"
   data-urgency="<?= htmlspecialchars($row['urgency']) ?: 'Not specified'; ?>">
   Answer
</a>

                        </div>
                    </div>
                </div>
                <?php
            }
        } else {
            echo '<div style="display: flex; align-items: center; justify-content: center; height: 90vh;">
            <p>No active questions found.</p>
          </div>';
    
        }
        ?>
    </div>
</section>

<!-- Answer Modal -->
<div class="modal fade" id="answerModal" tabindex="-1" aria-labelledby="answerModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form id="answerForm" method="POST">
                <div class="modal-header">
                    <h5 class="modal-title" id="answerModalLabel">Answer the Question</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="question_id" id="questionId">
                    <p><strong>Question:</strong> <span id="questionText"></span></p>
                    <p><strong>Difficulty:</strong> <span id="difficultyText"></span></p>
                    <p><strong>Urgency:</strong> <span id="urgencyText"></span></p>
                    <div class="form-group">
                        <label for="answerText" class="form-label">Your Answer</label>
                        <textarea class="form-control" name="answer" id="answerText" rows="5" required></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" name="submitAnswer" class="btn btn-success">Submit Answer</button>
                </div>
            </form>
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


   <script>
   document.addEventListener("DOMContentLoaded", function () {
    const answerButtons = document.querySelectorAll(".answer-btn");

    answerButtons.forEach(button => {
        button.addEventListener("click", function () {
            const questionId = this.dataset.transaction_id; // Updated to match the button attribute
            const questionText = this.dataset.question;
            const difficulty = this.dataset.difficulty;
            const urgency = this.dataset.urgency;

            // Populate modal fields
            document.getElementById("questionId").value = questionId;
            document.getElementById("questionText").textContent = questionText;
            document.getElementById("difficultyText").textContent = difficulty;
            document.getElementById("urgencyText").textContent = urgency;
        });
    });
});


   </script>
</body>

</html>