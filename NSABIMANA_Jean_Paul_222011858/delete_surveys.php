<?php
include('database_connection.php');

// Function to show delete confirmation
function showDeleteConfirmation($survey_id) {
    echo <<<HTML
    <div id="confirmModal" style="position: fixed; top: 0; left: 0; width: 100%; height: 100%; background-color: rgba(0,0,0,0.5); display: flex; justify-content: center; align-items: center;">
        <div style="background: white; padding: 20px; border-radius: 5px; box-shadow: 0 0 15px rgba(0,0,0,0.2);">
            <h2>Confirm Deletion</h2>
            <p>Are you sure you want to delete this record?</p>
            <button onclick="confirmDeletion($survey_id)">Confirm</button>
            <button onclick="returnToSurveys()">Back</button>
        </div>
    </div>
    <script>
    function confirmDeletion(survey_id) {
        window.location.href = '?survey_id=' + survey_id + '&confirm=yes';
    }
    function returnToSurveys() {
        window.location.href = 'surveys.php';
    }
    </script>
HTML;
}

// Check if survey_id is set
if(isset($_REQUEST['survey_id'])) {
    $survey_id = $_REQUEST['survey_id'];
    
    // Check if confirmation is received
    if(isset($_GET['confirm']) && $_GET['confirm'] === 'yes') {
        // Prepare and execute the DELETE statement
        $stmt = $connection->prepare("DELETE FROM surveys WHERE survey_id=?");
        $stmt->bind_param("i", $survey_id);
        
        if ($stmt->execute()) {
            echo "Record deleted successfully.";
        } else {
            echo "Error deleting data: " . $stmt->error;
        }

        $stmt->close();
    } else {
        // Show delete confirmation
        showDeleteConfirmation($survey_id);
    }
} else {
    echo "survey_id is not set.";
}

$connection->close();
?>
