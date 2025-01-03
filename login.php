<?php
session_start();
if (isset($_SESSION['SESSION_EMAIL'])) {
    header("Location: student_dashboard.php");
    die();
}

include 'config.php';
$msg = "";

// Account verification code
if (isset($_GET['verification'])) {
    if (mysqli_num_rows(mysqli_query($conn, "SELECT * FROM users WHERE code='{$_GET['verification']}'")) > 0) {
        $query = mysqli_query($conn, "UPDATE users SET code='' WHERE code='{$_GET['verification']}'");

        if ($query) {
            $msg = "<div class='alert alert-success'>Account verification has been successfully completed.</div>";
        }
    } else {
        header("Location: login.php");
    }
}

// Login submission handling
if (isset($_POST['submit'])) {
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($conn, md5($_POST['password']));

    $sql = "SELECT * FROM users WHERE email='{$email}' AND password='{$password}'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) === 1) {
        $row = mysqli_fetch_assoc($result);

        if (empty($row['code'])) {
            // Set session for logged-in user
            $_SESSION['SESSION_EMAIL'] = $email;
            $_SESSION['user_id'] = $row['user_id'];  // Store user ID in session for future queries
            $_SESSION['name'] = $row['name'];  // Store user name in session for future queries

            // Check if the user is an admin
            if ($row['role'] === 'admin') {
                header("Location: cpa_dashboard.php");
                die();
            }

            // Redirect to welcome page
            header("Location: student_dashboard.php");
            die();
        } else {
            $msg = "<div class='alert alert-info'>First verify your account and try again.</div>";
        }
    } else {
        $msg = "<div class='alert alert-danger'>Email or password do not match.</div>";
    }
}
?>



<!DOCTYPE html>
<html lang="zxx">

<head>
    <title>Login Form - Paciolis Nexus</title>
    <!-- Meta tag Keywords -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta charset="UTF-8" />
    <meta name="keywords"
        content="Login Form" />
    <!-- //Meta tag Keywords -->

    <link href="//fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">

    <!--/Style-CSS -->
    <link rel="stylesheet" href="css/login.css" type="text/css" media="all" />
    <!--//Style-CSS -->

    <script src="https://kit.fontawesome.com/af562a2a63.js" crossorigin="anonymous"></script>
    <style>
        /* Define the animation */
        @keyframes upDown {

            0%,
            100% {
                transform: translateY(0);
                /* Start and end at the same position */
            }

            50% {
                transform: translateY(-20px);
                /* Move up by 20px */
            }
        }

        /* Apply animation to the image */
        .animate-up-down {
            display: inline-block;
            /* Ensure the image behaves as an inline-block for proper animation */
            animation: upDown 2s ease-in-out infinite;
            /* Infinite loop, smooth transition */
        }
    </style>
</head>

<body>

    <!-- form section start -->
    <section class="w3l-mockup-form">
        <div class="container">
            <!-- /form -->
            <div class="workinghny-form-grid">
                <div class="main-mockup">
                    <div class="alert-close">
                        <span class="fa fa-close"></span>
                    </div>
                    <div class="w3l_form align-self">
                        <div class="left_grid_info">
                            <img src="herobg.png" alt="" class="animate-up-down">
                            <img src="herotitle.png" alt="" class="animaste-up-down">

                        </div>
                    </div>
                    <div class="content-wthree">
                        <h2>Login Now</h2>
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. </p>
                        <?php echo $msg; ?>
                        <form action="" method="post">
                            <input type="email" class="email" name="email" placeholder="Enter Your Email" required>
                            <input type="password" class="password" name="password" placeholder="Enter Your Password" style="margin-bottom: 2px;" required>
                            <p><a href="forgot-password.php" style="margin-bottom: 15px; display: block; text-align: right;">Forgot Password?</a></p>
                            <button name="submit" name="submit" class="btn" type="submit">Login</button>
                        </form>
                        <div class="social-icons">
                            <p>Create Account! <a href="register.php">Register</a>.</p>
                            <br>
                            <br>
                            <a href="index.html">Back to Home</a>

                        </div>

                    </div>
                </div>
            </div>
            <!-- //form -->
        </div>
    </section>
    <!-- //form section start -->

    <script src="js/jquery.min.js"></script>
    <script>
        $(document).ready(function(c) {
            $('.alert-close').on('click', function(c) {
                $('.main-mockup').fadeOut('slow', function(c) {
                    $('.main-mockup').remove();
                });
            });
        });
    </script>

</body>

</html>