<?php
include('database_connection.php');

// Fetch data if model_id is provided in the request
if (isset($_REQUEST['model_id'])) {
    $carmodid = $_REQUEST['model_id'];

    // Prepare and execute the SELECT query
    $stmt = $connection->prepare("SELECT * FROM carmodels WHERE model_id = ?");
    $stmt->bind_param("i", $carmodid);
    $stmt->execute();
    $result = $stmt->get_result();

    // Fetch data and assign to variables
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $model_id = $row['model_id'];
        $model_name = $row['model_name'];
        $manufacturer_id = $row['manufacturer_id'];
        $year = $row['year'];
        $fuel_type = $row['fuel_type'];
        $engine_size = $row['engine_size'];
        $transmission_type = $row['transmission_type'];
    } else {
        echo "Car model not found.";
        exit; // Exit script if car model not found
    }

    // Close the prepared statement
    $stmt->close();
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Update Car Model</title>
</head>
<body bgcolor="yellow">
    <form method="POST" onsubmit="return confirmUpdate()">
        <label for="carmodid">Model ID:</label>
        <input type="number" name="model_id" value="<?php echo isset($model_id) ? $model_id : ''; ?>">
        <br><br>

        <label for="modname">Model Name:</label>
        <input type="text" name="model_name" value="<?php echo isset($model_name) ? htmlspecialchars($model_name) : ''; ?>">
        <br><br>

        <label for="manufid">Manufacturer ID:</label>
        <input type="number" name="manufacturer_id" value="<?php echo isset($manufacturer_id) ? $manufacturer_id : ''; ?>">
        <br><br>

        <label for="year">Year:</label>
        <input type="text" name="year" value="<?php echo isset($year) ? $year : ''; ?>">
        <br><br>

        <label for="fueltype">Fuel Type:</label>
        <input type="text" name="fuel_type" value="<?php echo isset($fuel_type) ? $fuel_type : ''; ?>">
        <br><br>

        <label for="engsize">Engine Size:</label>
        <input type="number" name="engine_size" value="<?php echo isset($engine_size) ? $engine_size : ''; ?>">
        <br><br>

        <label for="t_type">Transmission Type:</label>
        <input type="text" name="transmission_type" value="<?php echo isset($transmission_type) ? $transmission_type : ''; ?>">
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
    $model_id = $_POST['model_id'];
    $model_name = $_POST['model_name'];
    $manufacturer_id = $_POST['manufacturer_id'];
    $year = $_POST['year'];
    $fuel_type = $_POST['fuel_type'];
    $engine_size = $_POST['engine_size'];
    $transmission_type = $_POST['transmission_type'];

    // Prepare and execute UPDATE query
    $stmt = $connection->prepare("UPDATE carmodels SET model_name=?, manufacturer_id=?, year=?, fuel_type=?, engine_size=?, transmission_type=? WHERE model_id=?");
    $stmt->bind_param("sisdsdi", $model_name, $manufacturer_id, $year, $fuel_type, $engine_size, $transmission_type, $model_id);
    $stmt->execute();

    // Redirect after update
    header('Location: carmodels.php');
    exit();
}
?>
