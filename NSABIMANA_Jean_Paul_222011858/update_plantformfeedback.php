<?php
include('database_connection.php');

if(isset($_REQUEST['feedback_id'])) {
    $feedback_id = $_REQUEST['feedback_id'];
    
    $stmt = $connection->prepare("SELECT * FROM platformfeedback WHERE feedback_id=?");
    $stmt->bind_param("i", $feedback_id);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $x = $row['feedback_id'];
        $y = $row['user_id'];
        $z = $row['feedback_comments'];
        $w = $row['feedback_date'];
    } else {
        echo "platformfeedback not found.";
        exit; // Exit script if platform feedback not found
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Update platformfeedback</title>
</head>
<body bgcolor="pink">
    <form method="POST" onsubmit="return confirmUpdate()">

        <label for="feedback_id">Feedback ID:</label>
        <input type="text" name="feedback_id" value="<?php echo isset($x) ? $x : ''; ?>">
        <br><br>

        <label for="userid">User ID:</label>
        <input type="text" name="user_id" value="<?php echo isset($y) ? $y : ''; ?>">
        <br><br>

        <label for="feedcomment">Feedback Comments:</label>
        <input type="text" name="feedback_comments" value="<?php echo isset($z) ? htmlspecialchars($z) : ''; ?>">
        <br><br>

        <label for="feeddate">Feedback Date:</label>
        <input type="date" name="feedback_date" value="<?php echo isset($w) ? $w : ''; ?>">
        <br><br>
        <input type="submit" name="up" value="Update">
        
    </form>
    <script>
        function confirmUpdate() {
            return confirm('Are you sure you want to update this record?');
        }
    </script>
</body>
</html>

<?php
if(isset($_POST['up'])) {
    // Retrieve updated values from form
    $feedback_id = $_POST['feedback_id'];
    $user_id = $_POST['user_id'];
    $feedback_comments = $_POST['feedback_comments'];
    $feedback_date = $_POST['feedback_date'];
    
    $stmt = $connection->prepare("UPDATE platformfeedback SET user_id=?, feedback_comments=?, feedback_date=? WHERE feedback_id=?");
    $stmt->bind_param("sssi", $user_id, $feedback_comments, $feedback_date, $feedback_id);
    $stmt->execute();

    header('Location: platformfeedback.php');
    exit(); 
}
?>
