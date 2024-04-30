
<?php
// Check if database connection is established
if (!file_exists('database_connection.php')) {
    echo "<p>Error: Database connection file not found.</p>";
    exit; // Exit the script if connection file is not found
}

include('database_connection.php');

if(isset($_GET['query'])) {
    $searchTerm = $connection->real_escape_string($_GET['query']);
    $queries = [
        'surveys' => "SELECT survey_id, rating, comments, survey_date 
                      FROM surveys 
                      WHERE survey_id LIKE '%$searchTerm%' 
                      OR rating LIKE '%$searchTerm%' 
                      OR comments LIKE '%$searchTerm%' 
                      OR survey_date LIKE '%$searchTerm%'",
        'carmanufacturers' => "SELECT manufacturer_id, manufacturer_name 
                               FROM carmanufacturers 
                               WHERE manufacturer_id LIKE '%$searchTerm%' 
                               OR manufacturer_name LIKE '%$searchTerm%'",
        'carmodels' => "SELECT model_id, model_name 
                        FROM carmodels 
                        WHERE model_id LIKE '%$searchTerm%' 
                        OR model_name LIKE '%$searchTerm%'",
        'platformfeedback' => "SELECT feedback_id, feedback_comments 
                                FROM platformfeedback 
                                WHERE feedback_id LIKE '%$searchTerm%' 
                                OR feedback_comments LIKE '%$searchTerm%'",
        'users' => "SELECT user_id, username 
                    FROM users 
                    WHERE user_id LIKE '%$searchTerm%' 
                    OR username LIKE '%$searchTerm%'",
    ];

    echo "<h2><u>Search Results:</u></h2>";
    foreach ($queries as $table => $sql) {
        $result = $connection->query($sql);
        echo "<h3>Table: " . ucfirst($table) . "</h3>"; 

        if ($result) {
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<p>";
                    foreach ($row as $key => $value) {
                        echo "<strong>$key</strong>: $value ";
                    }
                    echo "</p>";
                }
            } else {
                echo "<p>No results found in $table matching the search term: '$searchTerm'</p>";
            }
        } else {
            echo "<p>Error executing query for $table.</p>";
        }
    }

    $connection->close();
} else {
    echo "<p>No search term was provided.</p>";
}
?>

</body>
</html>
