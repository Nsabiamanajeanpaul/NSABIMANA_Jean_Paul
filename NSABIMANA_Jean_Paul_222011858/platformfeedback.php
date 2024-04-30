<!DOCTYPE html>
<html lang="en">
<head>
  <!-- Linking to external stylesheet -->
  <link rel="stylesheet" type="text/css" href="style.css" title="style 1" media="screen, tv, projection, handheld, print"/>
  <!-- Defining character encoding -->
  <meta charset="utf-8">
  <!-- Setting viewport for responsive design -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Our Plat formFeedback</title>
  <style>
    /* Stylesheet goes here */
    /* Normal link */
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

    /* Unvisited link */
    a:link {
      color: brown; /* Changed to lowercase */
    }

    /* Hover effect */
    a:hover {
      background-color: white;
    }

    /* Active link */
    a:active {
      background-color: red;
    }

    /* Extend margin left for search button */
    button.btn {
      margin-left: 15px; /* Adjust this value as needed */
      margin-top: 4px;
    }

    /* Extend margin left for search button */
    input.form-control {
      margin-left: 15px; /* Adjust this value as needed */
      padding: 8px;
    }

    section {
      padding: 71px;
      border-bottom: 1px solid #ddd;
    }

    footer {
      text-align: center;
      padding: 15px;
      background-color: darkgray;
    }

    table {
      width: 100%;
      border-collapse: collapse;
    }

    th, td {
      border: 1px solid #ddd;
      padding: 8px;
      text-align: left;
    }

    th {
      background-color: #f2f2f2;
    }
  </style>
</head>
<body bgcolor="skyblue">

<header>
  <ul style="list-style-type: none; padding: 0;">
    <li style="display: inline; margin-right: 10px;">
      <img src="./Images/car.jpg" width="90" height="60" alt="Logo">
    </li>
    <li style="display: inline; margin-right: 10px;"><a href="./home.html">HOME</a></li>
    <li style="display: inline; margin-right: 10px;"><a href="./about.html">ABOUT</a></li>
    <li style="display: inline; margin-right: 10px;"><a href="./contact.html">CONTACT</a></li>
    <li style="display: inline; margin-right: 10px;"><a href="./users.php">USERS</a></li>
    <li style="display: inline; margin-right: 10px;"><a href="./surveys.php">SURVEYS</a></li>
    <li style="display: inline; margin-right: 10px;"><a href="./carmodels.php">CARMODELS</a></li>
    <li style="display: inline; margin-right: 10px;"><a href="./carmanufacturers.php">CARMANUFACTURERS</a></li>
    <li style="display: inline; margin-right: 10px;"><a href="./platformfeedback.php">PLATFORMFEEDBACK</a></li>
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
  <form class="d-flex" role="search" action="search.php">
    <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search" name="query">
    <button class="btn btn-outline-success" type="submit">Search</button>
  </form>
</header>

<section>
  <h1><u>Plat formFeedback Form</u></h1>
  <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
    <label for="feedback_id">Feedback ID:</label>
    <input type="number" id="feedback_id" name="feedback_id"><br><br>

    <label for="user_id">User ID:</label>
    <input type="number" id="user_id" name="user_id" required><br><br>

    <label for="feedback_comments">Feedback Comments:</label>
    <input type="text" id="feedback_comments" name="feedback_comments" required><br><br>

    <label for="feedback_date">Feedback Date:</label>
    <input type="date" id="feedback_date" name="feedback_date" required><br><br>

    <input type="submit" name="insert" value="Insert">
  </form>

  <?php
  include('database_connection.php');

  // Check if the form is submitted for insert
  if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['insert'])) {
      // Insert section
      $stmt = $connection->prepare("INSERT INTO platformfeedback (feedback_id, user_id, feedback_comments, feedback_date) VALUES (?, ?, ?, ?)");
      $stmt->bind_param("ssss", $feedback_id, $user_id, $feedback_comments, $feedback_date);

      // Set parameters from POST and execute
      $feedback_id = $_POST['feedback_id'];
      $user_id = $_POST['user_id'];
      $feedback_comments = $_POST['feedback_comments'];
      $feedback_date = $_POST['feedback_date'];

      if ($stmt->execute()) {
          echo "New record has been added successfully.<br><br>
               <a href='platformfeedback.php'>Back to Form</a>";
      } else {
          echo "Error inserting data: " . $stmt->error;
      }

      $stmt->close();
  }
  ?>
  <center><h2>Table of Plat formFeedback</h2></center>
  <table>
    <tr>
      <th>Feedback ID</th>
      <th>User ID</th>
      <th>Feedback Comments</th>
      <th>Feedback Date</th>
      <th>Delete</th>
      <th>Update</th>
    </tr>
    <?php
    $sql = "SELECT * FROM platformfeedback";
    $result = $connection->query($sql);

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $feedback_id = $row["feedback_id"];
            echo "<tr>
                <td>" . $row["feedback_id"] . "</td>
                <td>" . $row["user_id"] . "</td>
                <td>" . $row["feedback_comments"] . "</td>
                <td>" . $row["feedback_date"] . "</td>
                <td><a style='padding:4px' href='delete_platformfeedback.php?feedback_id=$feedback_id'>Delete</a></td>
                <td><a style='padding:4px' href='update_plantformfeedback.php?feedback_id=$feedback_id'>Update</a></td>
              </tr>";
        }
    } else {
        echo "<tr><td colspan='6'>No data found</td></tr>";
    }
    $connection->close();
    ?>
  </table>
</section>
<footer>
  <center> 
    <b><h2>UR CBE BIT &copy; 2024 &reg; NSABIMANA Jean Paul</h2></b>
</footer>
</body>
</html>
