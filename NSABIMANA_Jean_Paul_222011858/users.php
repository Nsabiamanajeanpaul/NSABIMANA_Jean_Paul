<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Our USERS</title>
  <link rel="stylesheet" type="text/css" href="style.css" title="style 1" media="screen, tv, projection, handheld, print"/>
  <style>
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
  </header>
  <section>
    <h1><u>Users Form</u></h1>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
      <label for="user_id">user_id:</label>
      <input type="number" id="user_id" name="user_id" required><br><br>
      <label for="username">Username:</label>
      <input type="text" id="username" name="username" required><br><br>
      <label for="password">Password:</label>
      <input type="password" id="password" name="password" required><br><br>
      <label for="role">Role:</label>
      <input type="text" id="role" name="role" required><br><br>
      <input type="submit" name="insert" value="Insert">
    </form>

    <?php
    include('database_connection.php');
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['insert'])) {
        // Insert section
        $stmt = $connection->prepare("INSERT INTO users (user_id, username, password, role) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssss", $user_id, $username, $password, $role);

        $user_id = $_POST['user_id'];
        $username = $_POST['username'];
        $password = $_POST['password'];
        $role = $_POST['role'];

        if ($stmt->execute()) {
            echo "New record has been added successfully.<br><br>";
        } else {
            echo "Error inserting data: " . $stmt->error;
        }

        $stmt->close();
    }
    ?>

    <h2>Table of Users</h2>
    <table>
      <tr>
        <th>user_id</th>
        <th>Username</th>
        <th>Password</th>
        <th>Role</th>
        <th>Delete</th>
        <th>Update</th>
      </tr>

      <?php
      $sql = "SELECT * FROM users";
      $result = $connection->query($sql);

      if ($result->num_rows > 0) {
          while ($row = $result->fetch_assoc()) {
              $user_id = $row["user_id"];
              echo "<tr>
                      <td>" . $row["user_id"] . "</td>
                      <td>" . $row["username"] . "</td>
                      <td>" . $row["password"] . "</td>
                      <td>" . $row["role"] . "</td> 
                      <td><a style='padding:4px' href='delete_user.php?user_id=$user_id'>Delete</a></td> 
                      <td><a style='padding:4px' href='update_user.php?user_id=$user_id'>Update</a></td> 
                    </tr>";
          }
      } else {
          echo "<tr><td colspan='6'>No data found</td></tr>";
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
