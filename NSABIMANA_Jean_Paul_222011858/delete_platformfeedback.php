<?php
include('database_connection.php');

// Function to show delete confirmation
function showDeleteConfirmation($feedback_id) {
    echo <<<HTML
    <div id="confirmModal" style="position: fixed; top: 0; left: 0; width: 100%; height: 100%; background-color: rgba(0,0,0,0.5); display: flex; justify-content: center; align-items: center;">
        <div style="background: white; padding: 20px; border-radius: 5px; box-shadow: 0 0 15px rgba(0,0,0,0.2);">
            <h2>Confirm Deletion</h2>
            <p>Are you sure you want to delete this record?</p>
            <button onclick="confirmDeletion($feedback_id)">Confirm</button>
            <button onclick="returnToFarmers()">Back</button>
        </div>
    </div>
    <script>
    function confirmDeletion(feedback_id) {
        window.location.href = '?feedback_id=' + feedback_id + '&confirm=yes';
    }
    function returnToplatformfeedback () {
        window.location.href = 'platformfeedback.php';
    }
    </script>
HTML;
}

// Check if feedback_id is set
if(isset($_REQUEST['feedback_id'])) {
    $feedback_id = $_REQUEST['feedback_id'];
    
    // Check if confirmation is received
    if(isset($_GET['confirm']) && $_GET['confirm'] === 'yes') {
        // Prepare and execute the DELETE statement
        $stmt = $connection->prepare("DELETE FROM platformfeedback WHERE feedback_id=?");
        $stmt->bind_param("i", $feedback_id);
        if ($stmt->execute()) {
            echo "Record deleted successfully.";
        } else {
            echo "Error deleting data: " . $stmt->error;
        }
        $stmt->close();
    } else {
        // Show delete confirmation
        showDeleteConfirmation($feedback_id);
    }
} else {
    echo "feedback_id is not set.";
}

$connection->close();
?>
