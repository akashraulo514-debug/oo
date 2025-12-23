<?php
// Assuming the database connection is included
include("php/config.php"); 

// Check if 'design_name' is passed through URL (GET request)
if (isset($_GET['design_name'])) {
    $designName = $_GET['design_name'];

    // SQL Query to get the email of users based on the mandap design name
    $query = "SELECT email FROM users WHERE design_name = ?";
    
    // Prepare and execute the query
    if ($stmt = $conn->prepare($query)) {
        $stmt->bind_param("s", $designName);  // 's' for string data type
        
        $stmt->execute();
        $result = $stmt->get_result();

        // Check if results are found
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "Email: " . $row['email'] . "<br>";
            }
        } else {
            echo "No results found for the design name '$designName'.";
        }

        $stmt->close();
    } else {
        echo "Error preparing the SQL query.";
    }
} else {
    echo "Error: Design name is missing!";
}
?>
