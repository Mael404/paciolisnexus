<?php
session_start();
if (!isset($_SESSION['SESSION_EMAIL'])) {
    header("Location: login.php");  // Redirect to login if not logged in
    die();
}

include 'config.php';
$msg = "";

if (isset($_POST['submit'])) {
    $academic_level = mysqli_real_escape_string($conn, $_POST['academic_level']);
    $learning_goals = mysqli_real_escape_string($conn, $_POST['learning_goals']);
    $areas_of_difficulty = mysqli_real_escape_string($conn, $_POST['areas_of_difficulty']);
    $user_id = $_SESSION['user_id'];  // Assuming the user ID is stored in the session after login

    // Insert data into users table
    $sql = "UPDATE users SET academic_level='$academic_level', learning_goals='$learning_goals', areas_of_difficulty='$areas_of_difficulty' WHERE user_id='$user_id'";
    
    if (mysqli_query($conn, $sql)) {
        $msg = "<div class='alert alert-success'>Your study plan has been saved successfully.</div>";
        header("Location: welcome.php");  // Redirect to welcome page
    } else {
        $msg = "<div class='alert alert-danger'>Error: " . mysqli_error($conn) . "</div>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Study Plan</title>
</head>
<body>
    <h2>Fill Out Your Study Plan</h2>
    
    <?php echo $msg; ?>

    <form action="" method="POST">
        <label for="academic_level">Academic Level:</label><br>
        <select id="academic_level" name="academic_level" required>
            <option value="">Select your level</option>
            <option value="high_school">High School</option>
            <option value="undergraduate">Undergraduate</option>
            <option value="graduate">Graduate</option>
        </select><br><br>

        <label for="learning_goals">Learning Goals:</label><br>
        <textarea id="learning_goals" name="learning_goals" rows="4" cols="50" required></textarea><br><br>

        <label for="areas_of_difficulty">Areas of Difficulty:</label><br>
        <textarea id="areas_of_difficulty" name="areas_of_difficulty" rows="4" cols="50" required></textarea><br><br>

        <button type="submit" name="submit">Submit</button>
    </form>
</body>
</html>
