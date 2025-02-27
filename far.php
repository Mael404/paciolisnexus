<?php
session_start();
include('config.php');
$gamified_id = '';
$timer_enabled = false;

if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];

    // Check if gamified_id is set in the URL and is numeric
    if (isset($_GET['gamified_id']) && is_numeric($_GET['gamified_id'])) {
        $gamified_id = $_GET['gamified_id'];
        echo "Received gamified_id: " . $gamified_id . "<br>";  // Debugging output
    } else {
        echo "Invalid or missing gamified_id.";
        exit();
    }

    // Check for pending status
    $pending_query = "SELECT status FROM gamified WHERE student_id = ? AND status = 'pending'";
    if ($pending_stmt = mysqli_prepare($conn, $pending_query)) {
        mysqli_stmt_bind_param($pending_stmt, "i", $user_id);
        mysqli_stmt_execute($pending_stmt);
        mysqli_stmt_store_result($pending_stmt);

        if (mysqli_stmt_num_rows($pending_stmt) > 0) {
            // Redirect if pending status is found
            header("Location: pendingstatus.html");
            exit();
        }

        mysqli_stmt_close($pending_stmt);
    } else {
        echo "Error in preparing the pending status query.";
    }

    // Original query for active status and timer
    $query = "SELECT gamefied_id, timer FROM gamified WHERE student_id = ? AND status = 'active' AND afr = 1";

    if ($stmt = mysqli_prepare($conn, $query)) {
        mysqli_stmt_bind_param($stmt, "i", $user_id);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_store_result($stmt);

        if (mysqli_stmt_num_rows($stmt) > 0) {
            mysqli_stmt_bind_result($stmt, $gamified_id, $timer); // Binding both variables
            while (mysqli_stmt_fetch($stmt)) {
                echo "Game ID: " . $gamified_id . " - Timer: " . $timer . "<br>"; // Debugging output
                if ($timer === 'enabled') {
                    $timer_enabled = true;
                }
            }
        } else {
            echo "No matching data found.";
        }

        mysqli_stmt_close($stmt);
    } else {
        echo "Error in preparing the query.";
    }

    if ($timer_enabled) {
        header("Location: timer_enabled.html");
        exit();
    }
} else {
    echo "User not logged in.";
}

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
include 'sidebar.php'; // Use the correct path
?>

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
        <h3>Quiz</h3>
        <!-- Timer -->
        <div id="timer" style="font-size: 18px; font-weight: bold; margin-bottom: 15px; color: red; float: right;">
            Time Remaining: 30:00
        </div>

        <!-- Clearfix to fix float -->
        <div style="clear: both;"></div>
        
        <!-- Quiz Container -->
        <div id="quiz-container"></div>

        <!-- Buttons -->
        <div class="buttons">
            <button id="submit-btn" disabled style="background-color:gray; color: white; padding: 10px 20px; border: none; border-radius: 5px; font-size: 16px; opacity: 0.6;">Submit</button>
            <button id="next-btn" style="background-color: #0056b3; color: white; padding: 10px 20px; border: none; border-radius: 5px; font-size: 16px; cursor: pointer; transition: background-color 0.3s;">
                Next
            </button>
        </div>
    </div>
</div>

<!-- Bootstrap Modal -->
<div class="modal fade" id="timeoutModal" tabindex="-1" aria-labelledby="timeoutModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="timeoutModalLabel">Time's Up</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                The timer has expired, and the quiz will be submitted automatically.
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" id="modalSubmitButton">Submit Quiz</button>
            </div>
        </div>
    </div>
</div>
</section>

<script>
    // Timer setup
    let timerDuration = 30 * 60; // 30 minutes in seconds
    const timerElement = document.getElementById('timer');

    function updateTimer() {
        const minutes = Math.floor(timerDuration / 60);
        const seconds = timerDuration % 60;
        timerElement.textContent = `Time Remaining: ${minutes}:${seconds.toString().padStart(2, '0')}`;

        if (timerDuration === 0) {
            clearInterval(timerInterval);
            const timeoutModal = new bootstrap.Modal(document.getElementById('timeoutModal'));
            timeoutModal.show();
        }
        timerDuration--;
    }

    const timerInterval = setInterval(updateTimer, 1000); // Update every second
    updateTimer(); // Initialize the timer immediately

    // Modal submit button handler
    document.getElementById('modalSubmitButton').addEventListener('click', () => {
        // Handle quiz submission logic here
        document.getElementById('submit-btn').disabled = false; // Example action
        alert("Quiz submitted successfully."); // Replace with actual submission logic
    });
</script>


        <!-- Modal -->
        <div class="modal fade" id="scoreModal" tabindex="-1" aria-labelledby="scoreModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form id="scoreForm">
                        <div class="modal-header">
                            <h5 class="modal-title" id="scoreModalLabel">Quiz Completed</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <p id="score-message"></p>
                            <!-- Hidden input for gamified_id -->
                            <input type="hidden" id="gamified_id" name="gamified_id" value="<?php echo $gamified_id; ?>">
                            <input type="hidden" id="score" name="score" value="">
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-primary" id="submitScore">Submit</button>
                        </div>
                    </form>
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
        // Questions and answers

        const questions = [
            "Shareholders' equity represents the residual interest in the assets of a company after deducting liabilities."
           



        ];

        const correctAnswers = [
            'true', 'true', 'false', 'true', 'false', 'false', 'true', 'true', 'true', 'false',
            'b', 'c', 'b', 'c', 'a', 'b', 'b', 'c', 'b', 'c', 'b', 'a', 'd', 'a', 'c',
            'a', 'a', 'a', 'a', 'a'
        ];

        const multipleChoiceQuestionsStartIndex = 10;

        const multipleChoiceOptions = [
            ['a) To raise debt capital', 'b) To provide dividends at a fixed rate', 'c) To dilute ownership', 'd) To increase voting power'],
            ['a) Ordinary shares', 'b) Retained earnings', 'c) Long-term debt', 'd) Share premium'],
            ['a) Retained earnings', 'b) Share premium', 'c) Treasury stock', 'd) Accumulated losses'],
            ['a) The company to achieve a certain revenue target', 'b) Employees to remain with the company', 'c) Both a and b', 'd) None of the above'],
            ['a) P1,000,000', 'b) P500,000', 'c) P10,000,000', 'd) P50,000,000'],
            ['a) They are always exercised by employees.', 'b) They provide employees with the right to purchase shares at a fixed price.', 'c) They do not have a vesting period.', 'd) They are considered a liability on the balance sheet.'],
            ['a) It increases', 'b) It decreases', 'c) It remains unchanged', 'd) It is eliminated'],
            ['a) Fixed dividend payments', 'b) Priority over preference shares in liquidation', 'c) Voting rights', 'd) Guaranteed return on investment'],
            ['a) The total amount of dividends paid', 'b) The net income retained in the business', 'c) The total capital raised from shareholders', 'd) The market value of shares'],
            ['a) The period when shares are sold', 'b) The period when options can be exercised', 'c) The period when employees earn the right to options', 'd) The period when dividends are declared'],
            ['a) It always results in a cash outflow for the company.', 'b) It increases the number of shares outstanding.', 'c) It decreases shareholders\' equity.', 'd) It has no impact on the share premium account.'],
            ['a) Dilution of ownership', 'b) Increased debt', 'c) Decreased market value', 'd) Loss of control'],
            ['a) To increase earnings per share', 'b) To provide shares for employee stock options', 'c) To reduce the number of shareholders', 'd) To raise capital'],
            ['a) Shares that are held by the company itself', 'b) Shares that are sold to the public', 'c) Shares that are issued but not outstanding', 'd) Shares that are in the process of being issued'],
            ['a) Book value method', 'b) Market value method', 'c) Black-Scholes model', 'd) Cost method'],
            ['a) P50,000', 'b) P100,000', 'c) P200,000'],
            ['a) P250,000', 'b) P300,000', 'c) P200,000'],
            ['a) P500', 'b) P1,000', 'c) P5,000'],
            ['a) P15,000', 'b) P10,000', 'c) P5,000'],
            ['a) P250,000', 'b) P300,000', 'c) P350,000']
        ];



        let currentQuestionIndex = 0;
        let score = 0;

        // Render questions dynamically
        function renderQuestions() {
            const quizContainer = document.getElementById('quiz-container');
            questions.forEach((question, index) => {
                const questionDiv = document.createElement('div');
                questionDiv.classList.add('question-container');
                if (index === 0) questionDiv.classList.add('active');

                if (index < multipleChoiceQuestionsStartIndex) {
                    questionDiv.innerHTML = `
                <p>${index + 1}. ${question}</p>
               <label class="custom-radio">
    <input type="radio" name="q${index}" value="true"> TRUE
</label>
<label class="custom-radio">
    <input type="radio" name="q${index}" value="false"> FALSE
</label>
            `;
                } else {
                    const options = multipleChoiceOptions[index - multipleChoiceQuestionsStartIndex];
                    questionDiv.innerHTML = `
                <p>${index + 1}. ${question}</p>
                ${options.map((option, i) => `
                    <label>
                        <input type="radio" name="q${index}" value="${String.fromCharCode(97 + i)}"> ${option}
                    </label><br>
                `).join('')}
            `;
                }

                quizContainer.appendChild(questionDiv);
            });
        }
        const explanations = [
            "TRUE - This is a fundamental accounting principle that defines equity as what remains for shareholders after all debts are paid.",
            "TRUE - This allows companies to raise capital through different types of equity instruments, each with distinct rights and privileges.",
            "FALSE - Par value is a nominal value assigned to shares, while market value is determined by supply and demand in the stock market.",
            "TRUE - This excess amount is recorded in the share premium account, reflecting the additional capital received from shareholders.",
            "FALSE - They are part of retained earnings, which represent the cumulative profits retained in the business.",
            "FALSE - When options are exercised, new shares are issued, increasing the equity base and potentially affecting share premium.",
            "TRUE - This practice allows companies to manage their capital structure and can affect the share price and earnings per share.",
            "TRUE - This period incentivizes employees to stay with the company.",
            "TRUE - This means that creditors are paid first before any distribution to shareholders.",
            "FALSE - Market value can fluctuate based on various factors and can be lower than the par value, especially in cases of poor company performance or market conditions.",
            "b) To provide dividends at a fixed rate- The primary purpose of issuing preference shares is to provide investors with fixed dividends, making them attractive for income-seeking investors.",
            "c) Long-term debt- Long-term debt is not a component of shareholders' equity; it is a liability. Shareholders' equity includes ordinary shares, retained earnings, and share premium.",
            "b) Share premium- When shares are issued at a price higher than par value, the excess amount is credited to the share premium account, reflecting the additional capital received.",
            "c) Both a and b- The vesting condition for share options typically requires employees to remain with the company and may also include performance targets, making both options correct.",
            "a) P1,000,000- The total par value of the shares is calculated as the number of shares (100,000) multiplied by the par value (P10), resulting in P1,000,000.",
            "b) They provide employees with the right to purchase shares at a fixed price.- This statement is true as share options grant employees the right to buy shares at a predetermined price, which can be beneficial if the market price rises.",
            "b) It decreases- When shares are repurchased, the share premium account decreases as the company uses its equity to buy back shares, reducing the overall equity.",
            "c) Voting rights- Ordinary shares typically come with voting rights, allowing shareholders to influence company decisions, unlike preference shares which usually do not have such rights.",
            "b) The net income retained in the business- The accumulated profits and losses.",
            "c) The period when employees earn the right to options- In share-based payments, 'vesting' refers to the period during which employees must meet certain conditions to earn their options.",
            "b) It increases the number of shares outstanding.- Exercising share options increases the number of shares outstanding as new shares are issued to employees.",
            "a) Dilution of ownership- The primary risk associated with issuing shares is dilution of ownership, as existing shareholders' percentage of ownership decreases when new shares are issued.",
            "d) To raise capital- Companies typically do not repurchase their own shares to raise capital; rather, they do so for reasons like increasing earnings per share or providing shares for employee options.",
            "a) Shares that are held by the company itself- Treasury stock refers to shares that are repurchased and held by the company, not available for public trading.",
            "c) Black-Scholes model- The Black-Scholes model is a common method for valuing share options, providing a theoretical estimate of the price of options based on various factors.",
            // New items added
            "a) P50,000* Total Par Value = Number of Shares × Par Value per Share. Total Par Value = 10,000 shares × P 5 = P 50,000.",
            "a) P250,000* New Share Premium = Existing Share Premium + (Number of New Shares × Premium per New Share). New Share Premium = P 200,000 + (5,000 shares × P 10) = P 200,000 + P 50,000 = P 250,000.",
            "a) P500* Total Annual Dividend = Number of Preference Shares × Par Value per Share × Dividend Rate. Total Annual Dividend = 1,000 shares × P 10 × 5% = 1,000 × 10 × 0.05 = P 500.",
            "a) P15,000* Total Cost = Number of Shares Repurchased × Price per Share. Total Cost = 1,000 shares × P 15 = P 15,000.",
            "a) P250,000* Retained Earnings After Dividend = Initial Retained Earnings - Dividend Declared. Retained Earnings After Dividend = P 300,000 - P 50,000 = P 250,000."
        ];



        function showConfirmation(selectedAnswer, correctAnswer) {
            const userConfirmed = confirm("Are you sure about your answer?");
            if (userConfirmed) {
                if (selectedAnswer === correctAnswer) {
                    score++;
                }
                highlightCorrectAnswer(correctAnswer);
                document.getElementById('submit-btn').disabled = true;
                document.getElementById('next-btn').style.display = 'inline-block';
            }
        }

        function highlightCorrectAnswer(correctAnswer) {
            const currentQuestion = document.querySelector('.question-container.active');
            const inputs = currentQuestion.querySelectorAll('input');
            const explanationContainer = document.createElement('div');
            explanationContainer.classList.add('explanation');

            inputs.forEach(input => {
                if (input.value === correctAnswer) {
                    input.parentElement.classList.add('highlight');
                }
                input.disabled = true;
            });

            // Add the explanation for the correct answer
            explanationContainer.innerHTML = `<p><strong>Explanation:</strong> ${explanations[currentQuestionIndex]}</p>`;
            currentQuestion.appendChild(explanationContainer);
        }


        function moveToNextQuestion() {
            const currentQuestion = document.querySelector('.question-container.active');
            currentQuestion.classList.remove('active');
            currentQuestionIndex++;

            if (currentQuestionIndex < questions.length) {
                const nextQuestion = document.querySelectorAll('.question-container')[currentQuestionIndex];
                nextQuestion.classList.add('active');
                document.getElementById('submit-btn').disabled = true;
                document.getElementById('next-btn').style.display = 'none';
            } else {
                showScore();
            }
        }

        function showScore() {
    const scoreMessage = `You scored ${score} out of ${questions.length}!`;
    document.getElementById('score-message').innerText = scoreMessage;
    document.getElementById('score').value = score;

    // Show the modal
    const scoreModal = new bootstrap.Modal(document.getElementById('scoreModal'));
    scoreModal.show();

    // Handle form submission
    document.getElementById('submitScore').addEventListener('click', function() {
        const formData = new FormData(document.getElementById('scoreForm'));

        fetch('far_insert_score.php', {
                method: 'POST',
                body: formData
            })
            .then(response => response.text())
            .then(data => {
                console.log(data); // Handle the response from the server
                // Optionally, close the modal
                scoreModal.hide();
                // Redirect to student_takequiz.php
                window.location.href = 'student_takequiz.php';
            })
            .catch(error => {
                console.error('Error:', error);
            });
    });
}




        // Event listeners
        document.getElementById('submit-btn').addEventListener('click', () => {
            const currentQuestion = document.querySelector('.question-container.active');
            const selectedInput = currentQuestion.querySelector('input:checked');

            if (!selectedInput) {
                alert('Please select an answer.');
                return;
            }

            const selectedAnswer = selectedInput.value;
            const correctAnswer = correctAnswers[currentQuestionIndex];
            showConfirmation(selectedAnswer, correctAnswer);
        });



        document.getElementById('next-btn').addEventListener('click', moveToNextQuestion);

        // Enable Submit button when an option is selected
        document.addEventListener('change', (e) => {
            if (e.target.name === `q${currentQuestionIndex}`) {
                document.getElementById('submit-btn').disabled = false;
            }
        });

        // Initialize quiz
        renderQuestions();
    </script>

</body>

</html>