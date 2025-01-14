<?php
// Start the session
session_start();

// Include the database configuration
include('config.php');

// Check if the user_id is stored in the session
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

            // Fetch and echo the gamified_id
            while (mysqli_stmt_fetch($stmt)) {
                echo $gamified_id;
            }
        } else {
            echo "No matching data found.";
        }

        // Close the statement
        mysqli_stmt_close($stmt);
    } else {
        echo "Error in preparing the query.";
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
            <h1>FAR quiz</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                    <li class="breadcrumb-item">Take a quiz</li>
                    <li class="breadcrumb-item active">FAR Quiz</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->

        <section class="section dashboard">
            <div class="row">
                <div class="col-md-12">
                    <form id="quizForm">


                        <h3>True or False (10 Questions)</h3>

                        <div class="form-group">
                            <label for="q1">1. Shareholders' equity represents the residual interest in the assets of a company after deducting liabilities. </label><br>
                            <input type="radio" name="q1" value="true"> TRUE
                            <input type="radio" name="q1" value="false"> FALSE
                        </div>

                        <div class="form-group">
                            <label for="q2">2. A company can issue both ordinary shares and preference shares. </label><br>
                            <input type="radio" name="q2" value="true"> TRUE
                            <input type="radio" name="q2" value="false"> FALSE
                        </div>

                        <div class="form-group">
                            <label for="q3">3. The par value of a share is the market value at which it is traded. </label><br>
                            <input type="radio" name="q3" value="true"> TRUE
                            <input type="radio" name="q3" value="false"> FALSE
                        </div>

                        <div class="form-group">
                            <label for="q4">4. Share premium arises when shares are issued at a price above their par value. </label><br>
                            <input type="radio" name="q4" value="true"> TRUE
                            <input type="radio" name="q4" value="false"> FALSE
                        </div>

                        <div class="form-group">
                            <label for="q5">5. Accumulated profits and losses are not included in the shareholders' equity section of the balance sheet. </label><br>
                            <input type="radio" name="q5" value="true"> TRUE
                            <input type="radio" name="q5" value="false"> FALSE
                        </div>

                        <div class="form-group">
                            <label for="q6">6. The exercise of share options does not affect the total shareholders' equity. </label><br>
                            <input type="radio" name="q6" value="true"> TRUE
                            <input type="radio" name="q6" value="false"> FALSE
                        </div>

                        <div class="form-group">
                            <label for="q7">7. A company can repurchase its own shares, which is known as treasury stock. </label><br>
                            <input type="radio" name="q7" value="true"> TRUE
                            <input type="radio" name="q7" value="false"> FALSE
                        </div>

                        <div class="form-group">
                            <label for="q8">8. The vesting period for share options is the time during which employees must remain with the company to earn their options. </label><br>
                            <input type="radio" name="q8" value="true"> TRUE
                            <input type="radio" name="q8" value="false"> FALSE
                        </div>

                        <div class="form-group">
                            <label for="q9">9. Shareholders have a claim on the company's assets only after all liabilities have been settled. </label><br>
                            <input type="radio" name="q9" value="true"> TRUE
                            <input type="radio" name="q9" value="false"> FALSE
                        </div>

                        <div class="form-group">
                            <label for="q10">10. The market value of a share is always higher than its par value. </label><br>
                            <input type="radio" name="q10" value="true"> TRUE
                            <input type="radio" name="q10" value="false"> FALSE
                        </div>

                        <h3>Multiple Choice (15 Questions)</h3>

                        <div class="form-group">
                            <label for="q11">11. What is the primary purpose of issuing preference shares?</label><br>
                            <input type="radio" name="q11" value="a"> a) To raise debt capital<br>
                            <input type="radio" name="q11" value="b"> b) To provide dividends at a fixed rate<br>
                            <input type="radio" name="q11" value="c"> c) To dilute ownership<br>
                            <input type="radio" name="q11" value="d"> d) To increase voting power<br>
                        </div>

                        <div class="form-group">
                            <label for="q12">12. Which of the following is NOT a component of shareholders' equity?</label><br>
                            <input type="radio" name="q12" value="a"> a) Ordinary shares<br>
                            <input type="radio" name="q12" value="b"> b) Retained earnings<br>
                            <input type="radio" name="q12" value="c"> c) Long-term debt<br>
                            <input type="radio" name="q12" value="d"> d) Share premium<br>
                        </div>

                        <div class="form-group">
                            <label for="q13">13. When a company issues shares at a price higher than par value, the excess amount is credited to:</label><br>
                            <input type="radio" name="q13" value="a"> a) Retained earnings<br>
                            <input type="radio" name="q13" value="b"> b) Share premium<br>
                            <input type="radio" name="q13" value="c"> c) Treasury stock<br>
                            <input type="radio" name="q13" value="d"> d) Accumulated losses<br>
                        </div>

                        <div class="form-group">
                            <label for="q14">14. The vesting condition for share options typically requires:</label><br>
                            <input type="radio" name="q14" value="a"> a) The company to achieve a certain revenue target<br>
                            <input type="radio" name="q14" value="b"> b) Employees to remain with the company<br>
                            <input type="radio" name="q14" value="c"> c) Both a and b<br>
                            <input type="radio" name="q14" value="d"> d) None of the above<br>
                        </div>

                        <div class="form-group">
                            <label for="q15">15. If a company has 100,000 shares outstanding with a par value of P10 and a market price of P50, what is the total par value of the shares?</label><br>
                            <input type="radio" name="q15" value="a"> a) P1,000,000<br>
                            <input type="radio" name="q15" value="b"> b) P500,000<br>
                            <input type="radio" name="q15" value="c"> c) P10,000,000<br>
                            <input type="radio" name="q15" value="d"> d) P50,000,000<br>
                        </div>
                        <div class="form-group">
                            <label for="q16">16. Which of the following statements about share options is true?</label><br>
                            <input type="radio" name="q16" value="a"> a) They are always exercised by employees<br>
                            <input type="radio" name="q16" value="b"> b) They provide employees with the right to purchase shares at a fixed price<br>
                            <input type="radio" name="q16" value="c"> c) They do not have a vesting period<br>
                            <input type="radio" name="q16" value="d"> d) They are considered a liability on the balance sheet<br>
                        </div>

                        <div class="form-group">
                            <label for="q17">17. What happens to the share premium account when shares are repurchased?</label><br>
                            <input type="radio" name="q17" value="a"> a) It increases<br>
                            <input type="radio" name="q17" value="b"> b) It decreases<br>
                            <input type="radio" name="q17" value="c"> c) It remains unchanged<br>
                            <input type="radio" name="q17" value="d"> d) It is eliminated<br>
                        </div>

                        <div class="form-group">
                            <label for="q18">18. Which of the following is a characteristic of ordinary shares?</label><br>
                            <input type="radio" name="q18" value="a"> a) Fixed dividend payments<br>
                            <input type="radio" name="q18" value="b"> b) Priority over preference shares in liquidation<br>
                            <input type="radio" name="q18" value="c"> c) Voting rights<br>
                            <input type="radio" name="q18" value="d"> d) Guaranteed return on investment<br>
                        </div>

                        <div class="form-group">
                            <label for="q19">19. The accumulated profits and losses account reflects:</label><br>
                            <input type="radio" name="q19" value="a"> a) The total amount of dividends paid<br>
                            <input type="radio" name="q19" value="b"> b) The net income retained in the business<br>
                            <input type="radio" name="q19" value="c"> c) The total capital raised from shareholders<br>
                            <input type="radio" name="q19" value="d"> d) The market value of shares<br>
                        </div>

                        <div class="form-group">
                            <label for="q20">20. In the context of share-based payments, the term "vesting" refers to:</label><br>
                            <input type="radio" name="q20" value="a"> a) The period when shares are sold<br>
                            <input type="radio" name="q20" value="b"> b) The period when options can be exercised<br>
                            <input type="radio" name="q20" value="c"> c) The period when employees earn the right to options<br>
                            <input type="radio" name="q20" value="d"> d) The period when dividends are declared<br>
                        </div>

                        <div class="form-group">
                            <label for="q21">21. Which of the following is true regarding the exercise of share options?</label><br>
                            <input type="radio" name="q21" value="a"> a) It always results in a cash outflow for the company<br>
                            <input type="radio" name="q21" value="b"> b) It increases the number of shares outstanding<br>
                            <input type="radio" name="q21" value="c"> c) It decreases shareholders' equity<br>
                            <input type="radio" name="q21" value="d"> d) It has no impact on the share premium account<br>
                        </div>

                        <div class="form-group">
                            <label for="q22">22. The primary risk associated with issuing shares is:</label><br>
                            <input type="radio" name="q22" value="a"> a) Dilution of ownership<br>
                            <input type="radio" name="q22" value="b"> b) Increased debt<br>
                            <input type="radio" name="q22" value="c"> c) Decreased market value<br>
                            <input type="radio" name="q22" value="d"> d) Loss of control<br>
                        </div>

                        <div class="form-group">
                            <label for="q23">23. Which of the following is NOT a reason for a company to repurchase its own shares?</label><br>
                            <input type="radio" name="q23" value="a"> a) To increase earnings per share<br>
                            <input type="radio" name="q23" value="b"> b) To provide shares for employee stock options<br>
                            <input type="radio" name="q23" value="c"> c) To reduce the number of shareholders<br>
                            <input type="radio" name="q23" value="d"> d) To raise capital<br>
                        </div>

                        <div class="form-group">
                            <label for="q24">24. The term "treasury stock" refers to:</label><br>
                            <input type="radio" name="q24" value="a"> a) Shares that are held by the company itself<br>
                            <input type="radio" name="q24" value="b"> b) Shares that are sold to the public<br>
                            <input type="radio" name="q24" value="c"> c) Shares that are issued but not outstanding<br>
                            <input type="radio" name="q24" value="d"> d) Shares that are in the process of being issued<br>
                        </div>

                        <div class="form-group">
                            <label for="q25">25. Which of the following is a common method for valuing share options?</label><br>
                            <input type="radio" name="q25" value="a"> a) Book value method<br>
                            <input type="radio" name="q25" value="b"> b) Market value method<br>
                            <input type="radio" name="q25" value="c"> c) Black-Scholes model<br>
                            <input type="radio" name="q25" value="d"> d) Cost method<br>
                        </div>

                        <h3>Simple Problems (5 Questions)</h3>

                        <div class="form-group">
                            <label for="q26">26. A company has issued 10,000 shares with a par value of P5 and a market price of P20. What is the total par value of the shares?</label><br>
                            <input type="radio" name="q26" value="a"> a) P50,000<br>
                            <input type="radio" name="q26" value="b"> b) P100,000<br>
                            <input type="radio" name="q26" value="c"> c) P200,000<br>
                        </div>

                        <div class="form-group">
                            <label for="q27">27. If a company has a share premium of P200,000 and issues additional shares at a premium of P10, what will be the new share premium if 5,000 shares are issued?</label><br>
                            <input type="radio" name="q27" value="a"> a) P250,000<br>
                            <input type="radio" name="q27" value="b"> b) P300,000<br>
                            <input type="radio" name="q27" value="c"> c) P200,000<br>
                        </div>

                        <div class="form-group">
                            <label for="q28">28. A company has 1,000 preference shares with a par value of P10 and a dividend rate of 5%. What is the total annual dividend obligation?</label><br>
                            <input type="radio" name="q28" value="a"> a) P500<br>
                            <input type="radio" name="q28" value="b"> b) P1,000<br>
                            <input type="radio" name="q28" value="c"> c) P5,000<br>
                        </div>

                        <div class="form-group">
                            <label for="q29">29. If a company repurchases 1,000 shares at P15 each, what is the total cost of the repurchase?</label><br>
                            <input type="radio" name="q29" value="a"> a) P15,000<br>
                            <input type="radio" name="q29" value="b"> b) P10,000<br>
                            <input type="radio" name="q29" value="c"> c) P5,000<br>
                        </div>

                        <div class="form-group">
                            <label for="q30">30. A company has retained earnings of P300,000 and decides to declare a dividend of P50,000. What will be the retained earnings after the dividend declaration?</label><br>
                            <input type="radio" name="q30" value="a"> a) P250,000<br>
                            <input type="radio" name="q30" value="b"> b) P300,000<br>
                            <input type="radio" name="q30" value="c"> c) P350,000<br>
                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">Submit Quiz</button>
                        </div>
                    </form>
                </div>
            </div>
        </section>


        <div class="modal fade" id="scoreModal" tabindex="-1" aria-labelledby="scoreModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="scoreModalLabel">Quiz Result</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body" id="scoreModalBody">
                        <!-- Score will be displayed here -->
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
    document.getElementById('quizForm').addEventListener('submit', function(event) {
        event.preventDefault(); // Prevent form submission

        // Correct answers for True or False questions (q1 to q10)
        const correctAnswersTF = ['true', 'true', 'false', 'true', 'false', 'false', 'true', 'true', 'true', 'false'];

        // Correct answers for Multiple Choice questions (q11 to q25)
        const correctAnswersMC = ['b', 'c', 'b', 'c', 'a', 'b', 'b', 'c', 'b', 'c', 'b', 'a', 'd', 'a', 'c'];

        // Correct answers for Simple Problems (q26 to q30)
        const correctAnswersSP = ['a', 'a', 'a', 'a', 'a'];

        let score = 0;

        // Check True or False answers
        for (let i = 1; i <= 10; i++) {
            const selectedAnswer = document.querySelector(`input[name="q${i}"]:checked`);
            if (selectedAnswer && selectedAnswer.value === correctAnswersTF[i - 1]) {
                score++;
            }
        }

        // Check Multiple Choice answers
        for (let i = 11; i <= 25; i++) {
            const selectedAnswer = document.querySelector(`input[name="q${i}"]:checked`);
            if (selectedAnswer && selectedAnswer.value === correctAnswersMC[i - 11]) {
                score++;
            }
        }

        // Check Simple Problem answers
        for (let i = 26; i <= 30; i++) {
            const selectedAnswer = document.querySelector(`input[name="q${i}"]:checked`);
            if (selectedAnswer && selectedAnswer.value === correctAnswersSP[i - 26]) {
                score++;
            }
        }

        // Update modal content and show it
        const modalBody = document.getElementById('scoreModalBody');
        modalBody.textContent = 'Your final score is: ' + score;

        const scoreModal = new bootstrap.Modal(document.getElementById('scoreModal'));
        scoreModal.show();
    });
</script>

</body>

</html>