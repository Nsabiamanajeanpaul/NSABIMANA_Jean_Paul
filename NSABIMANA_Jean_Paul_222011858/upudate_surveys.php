<?php
include('database_connection.php');

if(isset($_REQUEST['survey_id'])) {
    $survey_id = $_REQUEST['survey_id'];
    
    $stmt = $connection->prepare("SELECT * FROM surveys WHERE survey_id=?");
    $stmt->bind_param("i", $survey_id);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $survey_id = $row['survey_id'];
        $user_id = $row['user_id'];
        $model_id = $row['model_id'];
        $rating = $row['rating'];
        $comments = $row['comments'];
        $survey_date = $row['survey_date'];
    } else {
        echo "Survey not found.";
        exit; // Exit script if survey not found
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Update Surveys</title>
</head>
<body bgcolor="pink">
    <form method="POST" onsubmit="return confirmUpdate()">
        <label for="survey_id">Survey ID:</label>
        <input type="number" name="survey_id" value="<?php echo isset($survey_id) ? $survey_id : ''; ?>">
        <br><br>

        <label for="user_id">User ID:</label>
        <input type="number" name="user_id" value="<?php echo isset($user_id) ? $user_id : ''; ?>">
        <br><br>

        <label for="model_id">Model ID:</label>
        <input type="number" name="model_id" value="<?php echo isset($model_id) ? $model_id : ''; ?>">
        <br><br>

        <label for="rating">Rating:</label>
        <input type="number" name="rating" value="<?php echo isset($rating) ? $rating : ''; ?>">
        <br><br>

        <label for="comments">Comments:</label>
        <input type="text" name="comments" value="<?php echo isset($comments) ? htmlspecialchars($comments) : ''; ?>">
        <br><br>

        <label for="survey_date">Survey Date:</label>
        <input type="date" name="survey_date" value="<?php echo isset($survey_date) ? $survey_date : ''; ?>">
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
    $survey_id = $_POST['survey_id'];
    $user_id = $_POST['user_id'];
    $model_id = $_POST['model_id'];
    $rating = $_POST['rating'];
    $comments = $_POST['comments'];
    $survey_date = $_POST['survey_date'];

    $stmt = $connection->prepare("UPDATE surveys SET user_id=?, model_id=?, rating=?, comments=?, survey_date=? WHERE survey_id=?");
    $stmt->bind_param("iiissi", $user_id, $model_id, $rating, $comments, $survey_date, $survey_id);
    $stmt->execute();
    
    header('Location: surveys.php');
    exit();
}
?>
