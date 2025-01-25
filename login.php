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

            // Check user role and redirect accordingly
            if ($row['role'] === 'admin') {
                header("Location: admin_dashboard.php");
                die();
            } elseif ($row['role'] === 'CPA') {
                header("Location: cpa_dashboard.php");
                die();
            }elseif ($row['role'] === '') {
              header("Location: student_dashboard.php");
              die();
          }

            // Default redirect for students
            header("Location: index.html");
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
    <style>
  /* The modal's background */
  .modal {
    position: fixed;
    z-index: 1;
    left: 0;
    top: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.4); /* Black with opacity */
    display: none; /* Hidden by default */
    align-items: center;
    justify-content: center;
  }

  /* Modal content */
  .modal-content {
    background-color: white;
    padding: 20px;
    border-radius: 8px;
    width: 400px;
    text-align: center;
  }

  /* Close button */
  .close {
    color: #aaa;
    font-size: 28px;
    font-weight: bold;
    position: absolute;
    top: 10px;
    right: 10px;
  }

  .close:hover,
  .close:focus {
    color: black;
    text-decoration: none;
    cursor: pointer;
  }

  /* Button styles */
  button {
    padding: 10px 20px;
    margin: 10px;
    font-size: 16px;
    cursor: pointer;
    border: none;
    border-radius: 5px;
  }

  button:hover {
    background-color: #ddd;
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
                   
                        <?php echo $msg; ?>
                        <form action="" method="post">
                            <input type="email" class="email" name="email" placeholder="Enter Your Email" required>
                            <input type="password" class="password" name="password" placeholder="Enter Your Password" style="margin-bottom: 2px;" required>
                            <p><a href="forgot-password.php" style="margin-bottom: 15px; display: block; text-align: right;">Forgot Password?</a></p>
                            <button name="submit" name="submit" class="btn" type="submit">Login</button>
                        </form>
                        <div class="social-icons">
                        <p>Create Account! <a href="#" onclick="openModal()">Register</a>.</p>

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
     <!-- Modal Structure -->
<div id="registrationModal" class="modal" style="display: none;">
  <div class="modal-content">
    <div class="modal-header">
      <span class="close" onclick="closeModal()">&times;</span>
      <h2>Choose Account Type</h2>
    </div>
    <div class="modal-body">
      <p>Please select the type of account you would like to register for:</p>
      <div>
        <button onclick="window.location.href='register_cpa.php';">Register as CPA</button>
        <button onclick="window.location.href='register.php';">Register as Student</button>
      </div>
    </div>
  </div>
</div>


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
  // Open the modal
  function openModal() {
    document.getElementById("registrationModal").style.display = "flex";
  }

  // Close the modal
  function closeModal() {
    document.getElementById("registrationModal").style.display = "none";
  }

  // Close the modal if the user clicks outside of it
  window.onclick = function(event) {
    var modal = document.getElementById("registrationModal");
    if (event.target == modal) {
      closeModal();
    }
  }
</script>


</body>

</html>