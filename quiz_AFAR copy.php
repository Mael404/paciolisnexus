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
                    <form id="multiStepForm" action="quiz_AFAR_data.php" method="POST" enctype="multipart/form-data">
                        
                        <!-- Step 1: Personal Details -->
                        <div class="form-step" id="step1">
                            <h3 style="color: #4154f1; font-weight: bold;">Personal Details</h3>
                            <div class="mb-3">
                                <label for="fullName" class="form-label">Full Name:</label>
                                <input type="text" id="fullName" name="full_name" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label for="birthdate" class="form-label">Birthdate:</label>
                                <input type="date" id="birthdate" name="birthdate" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label for="address" class="form-label">Address:</label>
                                <input type="text" id="address" name="address" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label for="quizTitle" class="form-label">Quiz Title:</label>
                                <input type="text" id="quizTitle" name="quiz_title" class="form-control" value="Advanced Financial Accounting and Reporting" readonly>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Choose Payment Plan:</label>
                                <select id="paymentPlan" name="payment_plan" class="form-control">
                                    <option value="pay_per_transaction">Pay Per Transaction - 60 PHP</option>
                                    <option value="five_quiz_bundle">5 Quiz Bundle - 270 PHP</option>
                                    <option value="ten_quiz_bundle">10 Quiz Bundle - 510 PHP</option>
                                </select>
                            </div>
                            <div id="subjectSelection" style="display: none; margin-top: 15px;">
                                <h4>Select Subjects:</h4>
                                <!-- Subject Checkboxes -->
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="subject1" name="subjects[]" value="Financial Accounting">
                                    <label class="form-check-label" for="subject1">Financial Accounting and Reporting</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="subject2" name="subjects[]" value="Advanced Financial Accounting">
                                    <label class="form-check-label" for="subject2">Advanced Financial Accounting and Reporting</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="subject3" name="subjects[]" value="Taxation">
                                    <label class="form-check-label" for="subject3">Taxation</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="subject4" name="subjects[]" value="Auditing">
                                    <label class="form-check-label" for="subject4">Auditing</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="subject5" name="subjects[]" value="Regulatory Framework">
                                    <label class="form-check-label" for="subject5">Regulatory Framework for Business Transactions</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="subject6" name="subjects[]" value="Management Advisory">
                                    <label class="form-check-label" for="subject6">Management Advisory Services</label>
                                </div>
                            </div>

                            <!-- Topics Section: Will appear when a subject is selected -->
                            <div id="topicsSelection" style="display: none; margin-top: 15px;">
                                <h4>Select Topics:</h4>
                                <div id="topicCheckboxes">
                                    <!-- Topics will be dynamically inserted here based on the selected subject -->
                                </div>
                            </div>

                            <div class="d-flex justify-content-end">
                                <button type="button" class="btn btn-primary next-step">Next</button>
                            </div>
                        </div>

                        <!-- Step 2: Payment Details -->
                        <div class="form-step" id="step2" style="display: none;">
                            <h3 style="color: #2eca6a; font-weight: bold;">Payment Details</h3>
                            <div class="mb-3">
                                <label for="gcashName" class="form-label">Gcash Account Name:</label>
                                <input type="text" id="gcashName" name="gcash_name" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label for="gcashNumber" class="form-label">Gcash Account Number:</label>
                                <input type="text" id="gcashNumber" name="gcash_number" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label for="paymentProof" class="form-label">Upload Proof of Payment:</label>
                                <input type="file" id="paymentProof" name="payment_proof" class="form-control" accept="image/*" required>
                            </div>
                            <div class="d-flex justify-content-end">
                                <button type="button" class="btn btn-secondary prev-step">Back</button>
                                <button type="submit" class="btn btn-success ms-2">Submit</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

<script>
document.addEventListener("DOMContentLoaded", function() {
    const steps = document.querySelectorAll(".form-step");
    const nextButtons = document.querySelectorAll(".next-step");
    const prevButtons = document.querySelectorAll(".prev-step");
    const paymentPlan = document.getElementById("paymentPlan");
    const subjectSelection = document.getElementById("subjectSelection");
    const topicsSelection = document.getElementById("topicsSelection");
    const topicCheckboxes = document.getElementById("topicCheckboxes");
    const subjectCheckboxes = document.querySelectorAll('input[name="subjects[]"]');
    const submitButton = document.querySelector("button[type='submit']");
    let currentStep = 0;

    const subjects = {
        "Financial Accounting": [
            "Cash Flow Statements",
            "Receivables Management",
            "Inventory Valuation Methods",
            "Investments and Securities",
            "Financial Statement Analysis"
        ],
        "Advanced Financial Accounting": [
            "Consolidated Financial Statements",
            "Business Combinations",
            "Foreign Currency Transactions",
            "Financial Instruments",
            "Leases and Revenue Recognition"
        ],
        "Taxation": [
            "Corporate Taxation",
            "Income Tax Computation",
            "Value-Added Tax (VAT)",
            "Tax Planning and Compliance",
            "International Taxation"
        ],
        "Auditing": [
            "Audit Planning and Risk Assessment",
            "Internal Controls and Fraud Detection",
            "Audit of Financial Statements",
            "Audit Evidence and Procedures",
            "Ethical and Legal Considerations in Auditing"
        ],
        "Regulatory Framework": [
            "Accounting Standards (IFRS, GAAP)",
            "Corporate Governance",
            "Regulatory Bodies and Compliance",
            "Financial Reporting Regulations",
            "Ethics and Corporate Responsibility"
        ],
        "Management Advisory": [
            "Strategic Planning and Analysis",
            "Cost and Management Accounting",
            "Business Process Improvement",
            "Corporate Finance and Investment",
            "Risk Management and Corporate Strategy"
        ]
    };

    function updateTopics() {
        topicCheckboxes.innerHTML = ""; // Clear previous topics

        const selectedSubjects = [...document.querySelectorAll('input[name="subjects[]"]:checked')].map(input => input.value);

        if (selectedSubjects.length > 0) {
            topicsSelection.style.display = "block"; // Ensure topics section is visible
        } else {
            topicsSelection.style.display = "none";
            return;
        }

        selectedSubjects.forEach(subject => {
            if (subjects[subject]) {
                subjects[subject].forEach(topic => {
                    const checkbox = document.createElement("div");
                    checkbox.classList.add("form-check");
                    checkbox.innerHTML = ` 
                        <input class="form-check-input topic-checkbox" type="checkbox" name="topics[]" value="${topic}">
                        <label class="form-check-label">${topic}</label>
                    `;
                    topicCheckboxes.appendChild(checkbox);
                });
            }
        });

        // Add event listener to dynamically created checkboxes
        document.querySelectorAll('.topic-checkbox').forEach(checkbox => {
            checkbox.addEventListener("change", validateQuizSelection);
        });
    }

    function validateQuizSelection() {
        const selectedPlan = paymentPlan.value;
        const checkedCount = document.querySelectorAll('#topicCheckboxes input[name="topics[]"]:checked').length;

        if (selectedPlan === "five_quiz_bundle" && checkedCount > 5) {
            alert("You can only select up to 5 topics for the 5 Quiz Bundle.");
            this.checked = false; // Uncheck the last checked box
        } else if (selectedPlan === "ten_quiz_bundle" && checkedCount > 10) {
            alert("You can only select up to 10 topics for the 10 Quiz Bundle.");
            this.checked = false; // Uncheck the last checked box
        }
    }

    function showStep(stepIndex) {
        steps.forEach((step, index) => {
            step.style.display = index === stepIndex ? "block" : "none";
        });
    }

    paymentPlan.addEventListener("change", function() {
        if (this.value === "five_quiz_bundle" || this.value === "ten_quiz_bundle") {
            subjectSelection.style.display = "block"; // ✅ FIX: Ensure subjects appear for both 5 & 10 quiz bundles
            updateTopics(); // ✅ FIX: Ensure topics update when subjects are already selected
        } else {
            subjectSelection.style.display = "none";
            topicsSelection.style.display = "none"; // Hide topics if not needed
        }
    });

    // Listen for changes in subject selection
    subjectCheckboxes.forEach(subjectInput => {
        subjectInput.addEventListener("change", updateTopics);
    });

    nextButtons.forEach(button => {
        button.addEventListener("click", function() {
            currentStep++;
            showStep(currentStep);
        });
    });

    prevButtons.forEach(button => {
        button.addEventListener("click", function() {
            currentStep--;
            showStep(currentStep);
        });
    });

    submitButton.addEventListener("click", function(event) {
        if (!validateQuizSelection()) {
            event.preventDefault();
        }
    });

    showStep(0); // Start with step 1 visible
});
</script>



        <script>
            function showQRCode() {
                document.getElementById("qrCodeContainer").style.display = "block";
                window.scrollTo(0, document.body.scrollHeight); // Scroll to the QR code
            }
        </script>
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