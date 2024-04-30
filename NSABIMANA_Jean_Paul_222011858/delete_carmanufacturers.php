<?php
include('database_connection.php');

// Function to show delete confirmation
function showDeleteConfirmation($manufacturer_id) {
    echo <<<HTML
    <div id="confirmModal" style="position: fixed; top: 0; left: 0; width: 100%; height: 100%; background-color: rgba(0,0,0,0.5); display: flex; justify-content: center; align-items: center;">
        <div style="background: white; padding: 20px; border-radius: 5px; box-shadow: 0 0 15px rgba(0,0,0,0.2);">
            <h2>Confirm Deletion</h2>
            <p>Are you sure you want to delete this record?</p>
            <button onclick="confirmDeletion($manufacturer_id)">Confirm</button>
            <button onclick="returnToManufacturers()">Back</button>
        </div>
    </div>
    <script>
    function confirmDeletion(manufacturer_id) {
        window.location.href = '?manufacturer_id=' + manufacturer_id + '&confirm=yes';
    }
    function returnToManufacturers() {
        window.location.href = 'carmanufacturers.php';
    }
    </script>
HTML;
}

// Check if manufacturer_id is set
if(isset($_REQUEST['manufacturer_id'])) {
    $manufacturer_id = $_REQUEST['manufacturer_id'];
    
    // Check if confirmation is received
    if(isset($_GET['confirm']) && $_GET['confirm'] === 'yes') {
        // Prepare and execute the DELETE statement
        $stmt = $connection->prepare("DELETE FROM carmanufacturers WHERE manufacturer_id=?");
        $stmt->bind_param("i", $manufacturer_id);
        
        if ($stmt->execute()) {
            echo "Record deleted successfully.";
        } else {
            echo "Error deleting data: " . $stmt->error;
        }

        $stmt->close();
    } else {
        // Show delete confirmation
        showDeleteConfirmation($manufacturer_id);
    }
} else {
    echo "manufacturer_id is not set.";
}

$connection->close();
?>
