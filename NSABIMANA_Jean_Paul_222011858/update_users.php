<?php
include('database_connection.php');

if(isset($_REQUEST['user_id'])) {
    $userid = $_REQUEST['user_id'];
    
   $stmt = $connection->prepare("SELECT * FROM users WHERE user_id=?");
    $stmt->bind_param("i", $userid);
    $stmt->execute();
    $result = $stmt->get_result();
    
   if($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $x = $row['user_id'];
        $y = $row['username'];
        $z = $row['password'];
        $w = $row['role'];
    } else {
        echo "users not found.";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Update users</title>
</head>
<body>
    <body bgcolor="yellow">
    <form method="POST">

        <label for="userid">user_id:</label>
        <input type="number" name="userid" value="<?php echo isset($y) ? $y : ''; ?>">
        <br><br>

        <label for="username">username:</label>
        <input type="text" name="username" value="<?php echo isset($y) ? $y : ''; ?>">
        <br><br>

        <label for="password">password:</label>
        <input type="text" name="password" value="<?php echo isset($z) ? $z : ''; ?>">
        <br><br>

        <label for="role">role:</label>
        <input type="text" name="role" value="<?php echo isset($w) ? $w : ''; ?>">
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
    $userid = $_POST['user_id'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $role = $_POST['role'];

    $stmt = $connection->prepare("UPDATE users SET username=?, password=?, role=? WHERE user_id=?");
    $stmt->bind_param("sssi", $username, $password, $role, $userid);
    if ($stmt->execute(); 
        
    header('Location: users.php');
    exit();
?>
