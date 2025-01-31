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

<?php
include 'header.php'; // Use the correct path
?>

  <?php
include 'sidebar.php'; // Use the correct path
?>


  <main id="main" class="main">

    <div class="pagetitle">
      <h1>Expression Wall</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.html">Home</a></li>
          <li class="breadcrumb-item active">Expression Wall</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->
 

    <section class="section dashboard">
  <!-- Expression Wall Header -->
  <div class="header-image" style="background-image: url('mind.jpg'); background-size: cover; background-position: center; height: 300px; position: relative;">
    <div class="overlay" style="position: absolute; top: 0; left: 0; right: 0; bottom: 0; background: rgba(0, 0, 0, 0.5); z-index: 1;"></div>
    <div class="container text-center text-white" style="position: relative; z-index: 2; padding-top: 100px;">
      <h1 class="display-1" style="font-weight: bold; text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.7);">What's on your mind?</h1>
      <p class="lead" style="font-size: 1.25rem; text-shadow: 1px 1px 3px rgba(0, 0, 0, 0.6);">Share your thoughts and expressions here</p>
      
      <!-- Input and Post Button -->
    
    </div>
  </div>

  <!-- Clearfix to ensure cards are below the header -->
  <div class="clearfix"></div>
  <div class="mt-4">
    <textarea id="expressionInput" class="form-control" rows="4" placeholder="Write your thoughts here..."></textarea>
    <button id="postButton" class="btn btn-primary mt-3">Post Now</button>
</div>

<?php
include('config.php'); 

$sql = "SELECT post_id, user_name, content, created_at FROM posts ORDER BY created_at DESC"; // Include 'id' in the query
$result = $conn->query($sql);

if ($result && $result->num_rows > 0) {
    echo '<div class="container mt-5">
            <div class="row">
            <p class="lead" style="font-size: 1.25rem; text-shadow: 1px 1px 3px rgba(0, 0, 0, 0.6);">Recent Posts</p>';

    while ($row = $result->fetch_assoc()) {
        $user_name = $row['user_name'];
        $content = $row['content'];
        $created_at = $row['created_at'];
        $post_id = $row['post_id']; // Now you have access to the 'id'

        $formatted_date = date('F j, Y, g:i a', strtotime($created_at));

        echo '<div class="col-md-6 mb-4">
                <div class="card">
                  <div class="card-body">
                    <h5 class="card-title">' . htmlspecialchars($user_name) . '</h5>
                    <p class="card-text">"' . htmlspecialchars($content) . '"</p>
                    <p class="card-text text-muted" style="font-size: 0.85rem;">Posted on: ' . $formatted_date . '</p>

                    <!-- Like and Comment Section -->
                    <div class="d-flex justify-content-between align-items-center">
                        <button class="btn btn-outline-danger btn-m" id="like-btn' . $post_id . '" onclick="toggleLike(this)">
                            <i class="bi bi-heart"></i> <!-- Like Icon -->
                        </button>
                        <button class="btn btn-outline-secondary btn-sm" data-bs-toggle="collapse" data-bs-target="#commentForm' . $post_id . '" aria-expanded="false" aria-controls="commentForm' . $post_id . '">Comment</button>
                    </div>
                    
                    <!-- Comment Form -->
                    <div class="collapse" id="commentForm' . $post_id . '">
                        <div class="mt-3">
                            <textarea class="form-control" id="comment' . $post_id . '" rows="2" placeholder="Write your comment..."></textarea>
                            <button class="btn btn-primary btn-sm mt-2" onclick="postComment(' . $post_id . ')">Post Comment</button>
                        </div>
                    </div>
                    <div id="comments' . $post_id . '" class="mt-2"><strong>Comments:</strong><br></div> <!-- Display comments here -->
                  </div>
                </div>
              </div>';
    }

    echo '</div></div>';
} else {
    echo '<div class="container mt-5"><p>No posts available.</p></div>';
}

$conn->close();
?>

<!-- Modal -->
<div class="modal fade" id="successModal" tabindex="-1" aria-labelledby="successModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="successModalLabel">Success</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        Post submitted successfully!
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" id="reloadPageButton">Okay</button>
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
<script>
  document.getElementById('postButton').addEventListener('click', function() {
    var content = document.getElementById('expressionInput').value;  // Get the value of the textarea

    if(content.trim() === "") {
        alert("Please write something to post!");
        return;
    }

    // Send the content to the server using AJAX
    var xhr = new XMLHttpRequest();
    xhr.open("POST", "insert_post.php", true);  // Pointing to PHP script that will handle the insertion
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

    xhr.onreadystatechange = function() {
    if (xhr.readyState == 4 && xhr.status == 200) {
        // Trigger the modal to show
        var myModal = new bootstrap.Modal(document.getElementById('successModal'));
        myModal.show();

        // Clear the textarea after successful post
        document.getElementById('expressionInput').value = "";

        // Reload page after modal action
        document.getElementById('reloadPageButton').addEventListener('click', function() {
            location.reload(); // Reload the page
        });
    }
};

    // Send the content and user_id (from session) to the server
    xhr.send("content=" + encodeURIComponent(content));
});


// Toggle Like Button Color
function toggleLike(button) {
    const icon = button.querySelector('i');
    if (icon.classList.contains('bi-heart')) {
        icon.classList.remove('bi-heart');
        icon.classList.add('bi-heart-fill');
        button.classList.add('btn-danger');  // Apply red color to button
        button.classList.remove('btn-outline-danger');  // Ensure it's not outlined
    } else {
        icon.classList.remove('bi-heart-fill');
        icon.classList.add('bi-heart');
        button.classList.remove('btn-danger');
        button.classList.add('btn-outline-danger');  // Revert to outlined button
    }
}

// Post Comment (temporarily adds comment to the post)
function postComment(postId) {
    const commentText = document.getElementById('comment' + postId).value;
    if (commentText) {
        const commentsDiv = document.getElementById('comments' + postId);
        const newComment = document.createElement('p');
        newComment.textContent = commentText;
        commentsDiv.appendChild(newComment);
        document.getElementById('comment' + postId).value = ''; // Clear the textarea after posting
    }
}




</script>
</body>

</html>