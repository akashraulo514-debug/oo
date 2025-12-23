<?php
include("php/config.php"); // Database connection

// Retrieve 'design_name' from GET request, or handle the case where it's missing
$designName = isset($_GET['design_name']) ? $_GET['design_name'] : null;

// Ensure 'design_name' is provided in the URL or form
if ($designName) {
    // Modify the query to reflect the correct column name in the database (e.g., 'name' or 'design_name')
    $query = "SELECT email FROM users WHERE name = ?";  // Assuming the column name is 'name'

    // Prepare and execute the query
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $designName);  // 's' is for string (adjust if needed)
    $stmt->execute();

    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo "Email: " . $row['email'] . "<br>";
        }
    } else {
        echo "No results found!";
    }

    $stmt->close();
} else {
    echo "Error: Design name is missing!";
}
?>
