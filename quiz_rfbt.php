<?php
session_start();
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
                    <li class="breadcrumb-item active">FAR Form</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->

        <section class="section dashboard">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">

                        <form action="quiz_rfbt_data.php" method="POST" enctype="multipart/form-data">

                                <!-- Personal Details -->
                                <div style="border-bottom: 2px solid #ddd; margin-bottom: 20px; padding-bottom: 10px; margin-top:2%;">
                                    <h3 style="color: #4154f1; font-weight: bold; margin-bottom: 15px;">Personal Details</h3>
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
                                        <input type="text" id="quizTitle" name="quiz_title" class="form-control" value="Regulatory Framework for Business Transactions" readonly>
                                    </div>
                                </div>
                                <div style="text-align: center; margin-top: 30px;">
                                    <button type="button" class="btn btn-secondary" style="padding: 10px 20px; font-size: 16px;" onclick="showQRCode()">Show QR Code</button>
                                    <!-- QR Code Section -->
                                    <div id="qrCodeContainer" style="text-align: center; margin-top: 20px; display: none;">
                                        <h3 style="color: #4154f1;">Scan the QR Code to Pay</h3>
                                        <img src="https://businessmaker-academy.com/cms/wp-content/uploads/2022/04/Gcash-BMA-QRcode.jpg" alt="QR Code" style="max-width: 200px; border: 2px solid #ddd; border-radius: 10px;">
                                    </div>
                                </div>
                                <!-- Payment Details -->
                                <div style="margin-top: 20px;">
                                    <h3 style="color: #2eca6a; font-weight: bold; margin-bottom: 15px;">Payment Details</h3>
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
                                </div>

                                <!-- Buttons -->
                                <div style="text-align: center; margin-top: 30px;">
                                    <button type="submit" class="btn btn-primary" style="padding: 10px 20px; font-size: 16px;">Submit</button>

                                </div>
                            </form>



                            <script>
                                function showQRCode() {
                                    document.getElementById("qrCodeContainer").style.display = "block";
                                    window.scrollTo(0, document.body.scrollHeight); // Scroll to the QR code
                                }
                            </script>

                        </div>
                    </div>
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