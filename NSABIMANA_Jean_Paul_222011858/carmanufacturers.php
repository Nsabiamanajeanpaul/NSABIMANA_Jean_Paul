<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Our Car Manufacturers</title>
  <link rel="stylesheet" type="text/css" href="style.css" title="style 1" media="screen, tv, projection, handheld, print"/>
  <style>
    /* General styling */
    body {
      background-color: yellow;
    }
    header {
      background-color: darkgray;
      padding: 15px;
      text-align: center;
    }
    ul {
      list-style-type: none;
      padding: 0;
      margin: 0;
    }
    li {
      display: inline;
      margin-right: 10px;
    }
    a {
      padding: 10px;
      color: white;
      background-color: pink;
      text-decoration: none;
    }
    a:visited {
      color: purple;
    }
    a:hover {
      background-color: white;
    }
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
<body>
<header>
  <form class="d-flex" role="search" action="search.php">
    <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search" name="query">
    <button class="btn btn-outline-success" type="submit">Search</button>
    </form>
  <ul style="list-style-type: none; padding: 0;">
    <li style="display: inline; margin-right: 10px;">
      <img src="./Images/car.jpg" width="90" height="60" alt="Logo">
  <ul>
    <li><img src="./Images/car.jpg" width="90" height="60" alt="Logo"></li>
    <li><a href="./home.html">HOME</a></li>
    <li><a href="./about.html">ABOUT</a></li>
    <li><a href="./contact.html">CONTACT</a></li>
    <li><a href="./users.php">USERS</a></li>
    <li><a href="./surveys.php">SURVEYS</a></li>
    <li><a href="./carmodels.php">CAR MODELS</a></li>
    <li><a href="./carmanufacturers.php">CAR MANUFACTURERS</a></li>
    <li><a href="./platformfeedback.php">PLATFORM FEEDBACK</a></li>
    <li class="dropdown">
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
  <h1><u>Car Manufacturers Form</u></h1>
  <form method="post">
    <label for="manufacturer_id">Manufacturer ID:</label>
    <input type="number" id="manufacturer_id" name="manufacturer_id" required><br><br>
    <label for="man_name">Manufacturer Name:</label>
    <input type="text" id="man_name" name="man_name" required><br><br>
    <label for="country">Country:</label>
    <input type="text" id="country" name="country" required><br><br>
    <input type="submit" name="insert" value="Insert">
  </form>

  <?php
  include('database_connection.php');
  if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['insert'])) {
    // Insert section
    $stmt = $connection->prepare("INSERT INTO carmanufacturers(manufacturer_id, manufacturer_name, country) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $manufacturer_id, $man_name, $country);

    // Set parameters from POST and execute
    $manufacturer_id = $_POST['manufacturer_id'];
    $man_name = $_POST['man_name'];
    $country = $_POST['country'];

    if ($stmt->execute()) {
      echo "New record has been added successfully.";
    } else {
      echo "Error inserting data: " . $stmt->error;
    }

    $stmt->close();
  } 
  ?>
  <center><h2>Table of Car Manufacturers</h2></center>
  <table>
    <tr>
      <th>Manufacturer ID</th>
      <th>Manufacturer Name</th>
      <th>Country</th>
      <th>Delete</th>
      <th>Update</th>
    </tr>

    <?php
    $sql = "SELECT * FROM carmanufacturers";
    $result = $connection->query($sql);
    if ($result->num_rows > 0) {
      while ($row = $result->fetch_assoc()) {
        $manufacturer_id = $row["manufacturer_id"]; 
        echo "<tr>
                <td>" . $row["manufacturer_id"] . "</td>
                <td>" . $row["manufacturer_name"] . "</td>
                <td>" . $row["country"] . "</td> 
                <td><a style='padding:4px' href='delete_carmanufacturers.php?manufacturer_id=$manufacturer_id'>Delete</a></td> 
                <td><a style='padding:4px' href='update_carmanufacturers.php?manufacturer_id=$manufacturer_id'>Update</a></td> 
              </tr>";
      }
    } else {
      echo "<tr><td colspan='5'>No data found</td></tr>";
    }
    // Close connection
    $connection->close();
    ?>
  </table>
</section>
<footer>
  <center>UR CBE BIT &copy; 2024 &reg; NSABIMANA Jean Paul</center>
</footer>
</body>
</html>
