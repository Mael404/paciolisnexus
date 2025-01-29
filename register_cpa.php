<?php
//Import PHPMailer classes into the global namespace
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

session_start();
if (isset($_SESSION['SESSION_EMAIL'])) {
    header("Location: welcome.php");
    die();
}

//Load Composer's autoloader
require 'vendor/autoload.php';

include 'config.php';
$msg = "";

if (isset($_POST['submit'])) {
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($conn, md5($_POST['password']));
    $confirm_password = mysqli_real_escape_string($conn, md5($_POST['confirm-password']));
    $code = mysqli_real_escape_string($conn, md5(rand()));
    $user_role = mysqli_real_escape_string($conn, $_POST['user_role']); // Capture the user role

    // Check if the email already exists
    if (mysqli_num_rows(mysqli_query($conn, "SELECT * FROM users WHERE email='{$email}'")) > 0) {
        $msg = "<div class='alert alert-danger'>{$email} - This email address has been already exists.</div>";
    } else {
        if ($password === $confirm_password) {
            // Insert the user with role into the database
            $sql = "INSERT INTO users (name, email, password, code, role) VALUES ('{$name}', '{$email}', '{$password}', '{$code}', '{$user_role}')";
            $result = mysqli_query($conn, $sql);

            if ($result) {
                echo "<div style='display: none;'>";
                //Create an instance; passing `true` enables exceptions
                $mail = new PHPMailer(true);

                try {
                    //Server settings
                    $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
                    $mail->isSMTP();                                            //Send using SMTP
                    $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
                    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
                    $mail->Username   = "maelaquino141@gmail.com";                     //SMTP username
                    $mail->Password   = "aytbbzlqaordegbl";                               //SMTP password
                    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
                    $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

                    //Recipients
                    $mail->setFrom("maelaquino141@gmail.com");
                    $mail->addAddress($email);

                    //Content
                    $mail->isHTML(true);                                  //Set email format to HTML
                    $mail->Subject = 'no reply';
                    $mail->Body = 'Here is the verification link <b><a href="http://localhost/paciolisnexus/login.php?verification=' . $code . '">http://localhost/paciolisnexus/login.php?verification=' . $code . '</a></b>';

                    $mail->send();
                    echo 'Message has been sent';
                } catch (Exception $e) {
                    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
                }
                echo "</div>";
                $msg = "<div class='alert alert-info'>We've sent a verification link to your email address.</div>";
            } else {
                $msg = "<div class='alert alert-danger'>Something went wrong.</div>";
            }
        } else {
            $msg = "<div class='alert alert-danger'>Password and Confirm Password do not match.</div>";
        }
    }
}
?>


<!DOCTYPE html>
<html lang="zxx">

<head>
<title>Pacioli’S Nexus</title>


  <!-- Favicons -->
  <link href="assets/img/favicon.png" rel="icon">
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">
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

              /* Restore native checkbox appearance */
input[type="checkbox"] {
    -webkit-appearance: checkbox;
    -moz-appearance: checkbox;
    appearance: checkbox;
    width: 16px; /* Standard size */
    height: 16px;
    cursor: pointer;
    accent-color: #106eea; /* Optional: Customize checkbox color */
}
  /* Modal Background */
  .custom-modal {
        display: none;
        position: fixed;
        z-index: 1000;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.5);
        animation: fadeIn 0.3s ease-in-out;
    }

    /* Modal Content */
    .custom-modal-content {
        background: white;
        padding: 20px;
        width: 300px;
        max-width: 90%;
        margin: 15% auto;
        text-align: center;
        border-radius: 8px;
        position: relative;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
        animation: slideDown 0.3s ease-in-out;
    }

    /* Close Button */
    .close-modal {
        position: absolute;
        top: 10px;
        right: 15px;
        font-size: 20px;
        cursor: pointer;
    }

    .close-btn {
        background: #106eea;
        color: white;
        border: none;
        padding: 10px 15px;
        cursor: pointer;
        border-radius: 5px;
        margin-top: 10px;
    }

    .close-btn:hover {
        background: #0056b3;
    }

    /* Checkbox Styling */
    .small-checkbox {
        width: 14px;
        height: 14px;
        vertical-align: middle;
        cursor: pointer;
    }

    /* Animations */
    @keyframes fadeIn {
        from {
            opacity: 0;
        }
        to {
            opacity: 1;
        }
    }

    @keyframes slideDown {
        from {
            transform: translateY(-20px);
            opacity: 0;
        }
        to {
            transform: translateY(0);
            opacity: 1;
        }
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
                        <h2>Register Now</h2>
         
                        <?php echo $msg; ?>
                        <form action="" method="post" onsubmit="return validateForm()">
    <input type="text" class="name" name="name" placeholder="Enter Your Name" value="<?php if (isset($_POST['submit'])) { echo $name; } ?>" required>
    <input type="email" class="email" name="email" placeholder="Enter Your Email" value="<?php if (isset($_POST['submit'])) { echo $email; } ?>" required>
    <input type="password" class="password" name="password" placeholder="Enter Your Password" required>
    <input type="password" class="confirm-password" name="confirm-password" placeholder="Enter Your Confirm Password" required>
    
                        <!-- Terms and Conditions Checkbox -->
                        <div style="display: flex; align-items: center; gap: 5px; margin-top: 10px;">
                            <input type="checkbox" id="terms" name="terms">
                            <label for="terms">I agree to the <a href="terms.php">Terms and Conditions</a></label>
                        </div>

                        <!-- Special Deals Checkbox -->
                        <div style="display: flex; align-items: center; gap: 5px; margin-top: 5px;">
                            <input type="checkbox" id="offers" name="offers">
                            <label for="offers">I want to receive special deals and offers</label>
                        </div>
    <!-- Hidden input for user role -->
    <input type="hidden" name="user_role" value="CPA">

    <button name="submit" class="btn" type="submit">Register</button>
</form>

                        <div class="social-icons">
                            <p>Have an account! <a href="login.php">Login</a>.</p>
                        </div>
                    </div>
                </div>
            </div>
            <!-- //form -->
        </div>
    </section>

<!-- Custom Modal -->
<div id="termsModal" class="custom-modal">
    <div class="custom-modal-content">
        <span class="close-modal">&times;</span>
        <h3>Notice</h3>
        <p>You must agree to the Terms and Conditions to proceed.</p>
        <button class="close-btn">OK</button>
    </div>
</div>
</body>
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
<script>
     function validateForm() {
        var termsChecked = document.getElementById("terms").checked;
        if (!termsChecked) {
            document.getElementById("termsModal").style.display = "block";
            return false;
        }
        return true;
    }

    // Close modal when clicking the close button
    document.querySelector(".close-modal").onclick = function () {
        document.getElementById("termsModal").style.display = "none";
    };

    // Close modal when clicking the OK button
    document.querySelector(".close-btn").onclick = function () {
        document.getElementById("termsModal").style.display = "none";
    };

    // Close modal when clicking outside of it
    window.onclick = function (event) {
        var modal = document.getElementById("termsModal");
        if (event.target === modal) {
            modal.style.display = "none";
        }
    };

    console.log('red');
</script>

</html>