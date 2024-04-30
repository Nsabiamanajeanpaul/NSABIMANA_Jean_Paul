<?php
include('database_connection.php');

// Function to show delete confirmation
function showDeleteConfirmation($carmodid) {
    echo <<<HTML
    <div id="confirmModal" style="position: fixed; top: 0; left: 0; width: 100%; height: 100%; background-color: rgba(0,0,0,0.5); display: flex; justify-content: center; align-items: center;">
        <div style="background: white; padding: 20px; border-radius: 5px; box-shadow: 0 0 15px rgba(0,0,0,0.2);">
            <h2>Confirm Deletion</h2>
            <p>Are you sure you want to delete this record?</p>
            <button onclick="confirmDeletion($carmodid)">Confirm</button>
            <button onclick="returnToModels()">Back</button>
        </div>
    </div>
    <script>
    function confirmDeletion(carmodid) {
        window.location.href = '?model_id=' + carmodid + '&confirm=yes';
    }
    function returnToModels() {
        window.location.href = 'carmodels.php';
    }
    </script>
HTML;
}

// Check if model_id is set
if(isset($_REQUEST['model_id'])) {
    $carmodid = $_REQUEST['model_id'];
    
    // Check if confirmation is received
    if(isset($_GET['confirm']) && $_GET['confirm'] === 'yes') {
        // Prepare and execute the DELETE statement
        $stmt = $connection->prepare("DELETE FROM carmodels WHERE model_id=?");
        $stmt->bind_param("i", $carmodid);
        
        if ($stmt->execute()) {
            echo "Record deleted successfully.";
        } else {
            echo "Error deleting data: " . $stmt->error;
        }

        $stmt->close();
    } else {
        // Show delete confirmation
        showDeleteConfirmation($carmodid);
    }
} else {
    echo "model_id is not set.";
}

$connection->close();
?>
