<?php
// Start the session
session_start();

// Include the database configuration
include('config.php');

// Initialize gamified_id as empty
$gamified_id = '';
$leaderboard_data = [];

if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id']; // Get the user_id from session

    // Prepare the query to check for the student_id and active status, and afr = 1
    $query = "SELECT gamefied_id FROM gamified WHERE student_id = ? AND status = 'active' AND afr = 1";

    // Prepare the statement
    if ($stmt = mysqli_prepare($conn, $query)) {
        // Bind the parameter (user_id) to the query
        mysqli_stmt_bind_param($stmt, "i", $user_id);

        // Execute the query
        mysqli_stmt_execute($stmt);

        // Store the result
        mysqli_stmt_store_result($stmt);

        // Check if any row exists with the conditions
        if (mysqli_stmt_num_rows($stmt) > 0) {
            // Bind the result to a variable
            mysqli_stmt_bind_result($stmt, $gamified_id);

            // Fetch and store the gamified_id
            while (mysqli_stmt_fetch($stmt)) {
                // This will output the gamified_id value
            }
        } else {
            echo "No matching data found.";
        }

        // Close the statement
        mysqli_stmt_close($stmt);
    } else {
        echo "Error in preparing the query.";
    }

    // If gamified_id found, proceed to get leaderboard data
    if (!empty($gamified_id)) {
        // Query the leaderboards table to find matching transaction_id
        $query2 = "SELECT transaction_id, created_at, score FROM leaderboards WHERE transaction_id = ?";

        if ($stmt2 = mysqli_prepare($conn, $query2)) {
            // Bind the parameter (gamified_id) to the query
            mysqli_stmt_bind_param($stmt2, "i", $gamified_id);

            // Execute the query
            mysqli_stmt_execute($stmt2);

            // Store the result
            mysqli_stmt_store_result($stmt2);

            // Check if any row exists
            if (mysqli_stmt_num_rows($stmt2) > 0) {
                // Bind the result to variables
                mysqli_stmt_bind_result($stmt2, $transaction_id, $created_at, $score);

                // Fetch the data and store it
                while (mysqli_stmt_fetch($stmt2)) {
                    $leaderboard_data[] = [
                        'transaction_id' => $transaction_id,
                        'created_at' => $created_at,
                        'score' => $score,
                        'points' => $score * 0.5 // Calculate points as score * 2
                    ];
                }
            } else {
                echo "No matching leaderboard data found.";
            }

            // Close the statement
            mysqli_stmt_close($stmt2);
        } else {
            echo "Error in preparing the query for leaderboards.";
        }
    }
} else {
    echo "User not logged in.";
}

// Close the database connection
mysqli_close($conn);
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
        .explanation {
            margin-top: 10px;
            padding: 10px;
            background-color: #f9f9f9;
            border: 1px solid #ddd;
            border-radius: 5px;
        }

        .highlight {
            font-weight: bold;
            color: green;
        }

        h2,
        h3 {
            text-align: center;
            color: #0056b3;
        }

        .section {
            padding: 30px 0;
        }

        /* Form Styles */
        #quizForm {
            max-width: 800px;
            margin: 0 auto;
            background-color: #fff;
            border-radius: 8px;
            padding: 20px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        h3 {
            margin-top: 0px;
            font-size: 24px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        label {
            font-size: 16px;
            font-weight: bold;
            display: block;
            margin-bottom: 10px;
        }

        input[type="radio"] {
            margin-right: 10px;
            margin-left: 10px;
        }

        input[type="radio"]:checked {
            background-color: #0056b3;
        }

        button[type="submit"] {
            background-color: #0056b3;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            font-size: 16px;
            cursor: pointer;
            display: block;
            width: 100%;
            margin-top: 30px;
        }

        button[type="submit"]:hover {
            background-color: #004080;
        }

        /* Spacing and Alignment */
        .form-group {
            margin-bottom: 20px;
        }

        section {
            margin-top: 20px;
        }

        section .row {
            display: flex;
            justify-content: center;
        }

        .row .col-md-12 {
            width: 100%;
            padding: 0 15px;
        }

        h2 {
            margin-bottom: 20px;
            font-size: 28px;
            color: #003366;
        }

        /* Responsive Design */
        @media (max-width: 767px) {
            #quizForm {
                padding: 15px;
            }

            h2 {
                font-size: 24px;
            }

            h3 {
                font-size: 20px;
            }

            button[type="submit"] {
                padding: 8px 16px;
                font-size: 14px;
            }
        }

        .question-container {
            display: none;
            margin-bottom: 20px;
        }

        .question-container.active {
            display: block;
        }

        .highlight {
            background-color: lightgreen;
        }

        .buttons {
            margin-top: 20px;
        }

        #next-btn {
            display: none;
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

                    <a class="nav-link nav-icon" href="#" data-bs-toggle="dropdown">
                        <i class="bi bi-bell"></i>
                        <span class="badge bg-primary badge-number">4</span>
                    </a><!-- End Notification Icon -->

                  
                </li><!-- End Notification Nav -->

                <li class="nav-item dropdown">

                 

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
include 'sidebar.php'; // Use the correct path
?>

    <main id="main" class="main">

        <div class="pagetitle">
            <h1>My Points</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                    <li class="breadcrumb-item active">My Points</li>
             
                </ol>
            </nav>
        </div><!-- End Page Title -->


        <section class="section dashboard">
    <div class="row">
        <div class="col-md-12">
            <!-- Table Display -->
          <!-- Add custom CSS for table styling -->
<style>
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

<?php
// Dummy data for leaderboard
$leaderboard_data = [
    [
        'transaction_id' => 1,
        'created_at' => '2025-01-25 12:30:00',
        'score' => 22,
        'points' => 11
    ],
    [
        'transaction_id' => 2,
        'created_at' => '2025-01-28 09:15:00',
        'score' => 8,
        'points' => 4
    ],
    [
        'transaction_id' => 3,
        'created_at' => '2025-01-30 15:45:00',
        'score' => 14,
        'points' => 7
    ]
];
?>

<!-- Table content -->
<table class="table table-bordered">
    <thead>
        <tr>
            <th>Quiz ID</th>
            <th>Date Quiz Taken</th>
            <th>Score</th>
            <th>Points Earned</th>
        </tr>
    </thead>
    <tbody>
        <?php if (!empty($leaderboard_data)): ?>
            <?php foreach ($leaderboard_data as $data): ?>
                <tr>
                    <td><?php echo $data['transaction_id']; ?></td>
                    <td><?php echo date('F j, Y', strtotime($data['created_at'])); ?></td>
                    <td><?php echo $data['score']; ?></td>
                    <td><?php echo $data['points']; ?></td>
                </tr>
            <?php endforeach; ?>
        <?php else: ?>
            <tr>
                <td colspan="4">No leaderboard data available</td>
            </tr>
        <?php endif; ?>
    </tbody>
</table>


        </div>
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