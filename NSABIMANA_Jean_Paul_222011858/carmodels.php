<!DOCTYPE html>
<html lang="en">
<head>
  <!-- Linking to external stylesheet -->
  <link rel="stylesheet" type="text/css" href="style.css" title="style 1" media="screen, tv, projection, handheld, print"/>
  <!-- Defining character encoding -->
  <meta charset="utf-8">
  <!-- Setting viewport for responsive design -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Our Car Models</title>
  <style>
    /* General link styling */
    a {
      padding: 10px;
      color: white;
      background-color: pink;
      text-decoration: none;
      margin-right: 15px;
    }

    /* Visited link */
    a:visited {
      color: purple;
    }

    /* Hover effect */
    a:hover {
      background-color: white;
    }

    /* Active link */
    a:active {
      background-color: red;
    }

    /* Form styling */
    form {
      margin-top: 20px;
      text-align: center;
    }

    input[type="number"],
    input[type="text"],
    input[type="year"],
    input[type="submit"] {
      margin: 5px;
      padding: 8px;
    }

    /* Table styling */
    table {
      width: 100%;
      border-collapse: collapse;
    }

    th, td {
      padding: 8px;
      text-align: left;
      border-bottom: 1px solid #ddd;
    }

    th {
      background-color: #f2f2f2;
    }

    /* Footer styling */
    footer {
      background-color: darkgray;
      padding: 15px;
      text-align: center;
    }
  </style>
</head>
<body bgcolor="blue">
<header>
  <form class="d-flex" role="search" action="search.php">
    <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search" name="query">
    <button class="btn btn-outline-success" type="submit">Search</button>
  </form>
  <ul style="list-style-type: none; padding: 0;">
    <li style="display: inline; margin-right: 10px;">
      <img src="./Images/car.jpg" width="90" height="60" alt="Logo">
    </li>
    <li style="display: inline; margin-right: 10px;"><a href="./home.html">HOME</a></li>
    <li style="display: inline; margin-right: 10px;"><a href="./about.html">ABOUT</a></li>
    <li style="display: inline; margin-right: 10px;"><a href="./contact.html">CONTACT</a></li>
    <li style="display: inline; margin-right: 10px;"><a href="./users.php">USERS</a></li>
    <li style="display: inline; margin-right: 10px;"><a href="./surveys.php">SURVEYS</a></li>
    <li style="display: inline; margin-right: 10px;"><a href="./carmodels.php">CAR MODELS</a></li>
    <li style="display: inline; margin-right: 10px;"><a href="./carmanufacturers.php">CAR MANUFACTURERS</a></li>
    <li style="display: inline; margin-right: 10px;"><a href="./platformfeedback.php">PLATFORM FEEDBACK</a></li>
    <li class="dropdown" style="display: inline; margin-right: 10px;">
      <a href="#" style="padding: 10px; color: white; background-color: skyblue; text-decoration: none; margin-right: 15px;">Settings</a>
      <div class="dropdown-contents">
        <!-- Links inside the dropdown menu -->
        <a href="login.html">Login</a>
        <a href="register.html">Register</a>
        <a href="logout.php">Logout</a>
      </div>
    </li>
  </ul>
</header>
<section>
  <h1><u>Car Models Form</u></h1>
  <form method="post">
    <label for="carmodid">Model ID:</label>
    <input type="number" id="carmodid" name="carmodid" required><br><br>
    <label for="modname">Model Name:</label>
    <input type="text" id="modname" name="modname" required><br><br>
    <label for="manufid">Manufacturer ID:</label>
    <input type="number" id="manufid" name="manufid" required><br><br>
    <label for="year">Year:</label>
    <input type="year" id="year" name="year" required><br><br>
    <label for="fueltype">Fuel Type:</label>
    <input type="text" id="fueltype" name="fueltype" required><br><br>
    <label for="engsize">Engine Size:</label>
    <input type="number" id="engsize" name="engsize" required><br><br>
    <label for="t_type">Transmission Type:</label>
    <input type="text" id="t_type" name="t_type" required><br><br>
    <input type="submit" name="insert" value="Insert">
  </form>
  <?php
  include('database_connection.php');
  // Check if the form is submitted for insert
  if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['insert'])) {
    // Insert section
    $stmt = $connection->prepare("INSERT INTO carmodels(model_id, model_name, manufacturer_id, year, fuel_type, engine_size, transmission_type) VALUES (?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sssssss", $carmodid, $modname, $manufid, $year, $fueltype, $engsize, $t_type);

    // Set parameters from POST and execute
    $carmodid = $_POST['carmodid'];
    $modname = $_POST['modname'];
    $manufid = $_POST['manufid'];
    $year = $_POST['year'];
    $fueltype = $_POST['fueltype'];
    $engsize = $_POST['engsize'];
    $t_type = $_POST['t_type'];

    if ($stmt->execute()) {
      echo "New record has been added successfully.<br><br>
           <a href='carmodels.php'>Back to Form</a>";
    } else {
      echo "Error inserting data: " . $stmt->error;
    }

    $stmt->close();
  } 
  ?>
  <center><h2>Table of Car Models</h2></center>
  <table>
    <tr>
      <th>Model ID</th>
      <th>Model Name</th>
      <th>Manufacturer ID</th>
      <th>Year</th>
      <th>Fuel Type</th>
      <th>Engine Size</th>
      <th>Transmission Type</th>
      <th>Delete</th>
      <th>Update</th>
    </tr>
    <?php
    $sql = "SELECT * FROM carmodels";
    $result = $connection->query($sql);
    if ($result->num_rows > 0) {
      while ($row = $result->fetch_assoc()) {
        $model_id = $row["model_id"];
        echo "<tr>
                <td>" . $row["model_id"] . "</td>
                <td>" . $row["model_name"] . "</td>
                <td>" . $row["manufacturer_id"] . "</td>
                <td>" . $row["year"] . "</td>
                <td>" . $row["fuel_type"] . "</td>
                <td>" . $row["engine_size"] . "</td>
                <td>" . $row["transmission_type"] . "</td>
                <td><a style='padding:4px' href='delete_carmodels.php?model_id=$model_id'>Delete</a></td>
                <td><a style='padding:4px' href='update_carmodels.php?model_id=$model_id'>Update</a></td> 
              </tr>";
      }
    } else {
      echo "<tr><td colspan='9'>No data found</td></tr>";
    }
    // Close connection
    $connection->close();
    ?>
  </table>
</section>
<footer>
  <center>
    <b><h2>UR CBE BIT &copy; 2024 &reg; NSABIMANA Jean Paul</h2></b>
  </center>
</footer>
</body>
</html>
