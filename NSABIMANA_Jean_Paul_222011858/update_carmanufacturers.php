<?php
include('database_connection.php');

if (isset($_REQUEST['manufacturer_id'])) {
    $manid = $_REQUEST['manufacturer_id'];

    // Prepare and execute SELECT query
    $stmt = $connection->prepare("SELECT manufacturer_id, manufacturer_name, country FROM carmanufacturers WHERE manufacturer_id=?");
    $stmt->bind_param("i", $manid);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $y = $row['manufacturer_name'];
        $z = $row['country'];
    } else {
        echo "Manufacturer not found.";
        exit; // Exit script if manufacturer not found
    }
}

// Close prepared statement to free up resources
$stmt->close();
?>
<!DOCTYPE html>
<html>
<head>
    <title>Update Car Manufacturers</title>
</head>
<body bgcolor="pink">
    <form method="POST" onsubmit="return confirmUpdate()">
        <label for="man_name">Manufacturer Name:</label>
        <input type="text" name="man_name" value="<?php echo isset($y) ? htmlspecialchars($y) : ''; ?>">
        <br><br>

        <label for="country">Country:</label>
        <input type="text" name="country" value="<?php echo isset($z) ? htmlspecialchars($z) : ''; ?>">
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
if (isset($_POST['up'])) {
    // Retrieve updated values from form
    $man_name = $_POST['man_name'];
    $country = $_POST['country'];

    // Prepare and execute UPDATE query
    $stmt = $connection->prepare("UPDATE carmanufacturers SET manufacturer_name=?, country=? WHERE manufacturer_id=?");
    $stmt->bind_param("ssi", $man_name, $country, $manid);
    $stmt->execute();

    // Redirect after update
    header('Location: carmanufacturers.php');
    exit();
}
?>
