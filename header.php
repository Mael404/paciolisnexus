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

    <?php
// Start the session


// Include the database configuration file
include('config.php');

// Check if the user is logged in (session exists)
if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id']; // Get the user_id from session

    // Query to count unread messages for the current user
    $sql = "SELECT COUNT(*) AS unread_count FROM messages WHERE student_id = ? AND status = 'unread'";

    // Prepare and bind parameters
    if ($stmt = $conn->prepare($sql)) {
        $stmt->bind_param("i", $user_id); // Bind the user_id
        $stmt->execute(); // Execute the query
        $stmt->bind_result($unread_count); // Bind the result to the variable

        // Fetch the result
        $stmt->fetch();

        // Close the statement
        $stmt->close();
    }
} else {
    $unread_count = 0; // Default to 0 if user is not logged in
}
?>
<li class="nav-item dropdown">
    <a class="nav-link nav-icon" href="#" data-bs-toggle="dropdown" id="notificationIcon">
        <i class="bi bi-bell"></i>
        <span class="badge bg-primary badge-number"><?php echo $unread_count; ?></span>
    </a><!-- End Notification Icon -->
</li><!-- End Notification Nav -->

<script>
    document.getElementById('notificationIcon').addEventListener('click', function() {
        window.location.href = 'view-messages.php'; // Redirect to the messages page
    });
</script>

  

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
          <h6>  <?php echo htmlspecialchars($_SESSION['name'], ENT_QUOTES, 'UTF-8'); ?></h6>
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