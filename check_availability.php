<?php
// Include database connection
include("php/config.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $service = $_POST['service'];
    $event_date = $_POST['event_date'];

    // Prepare the query to check if any vendor is available
    $query = "
        SELECT vendor_id 
        FROM vendors 
        WHERE vendor_role = ? 
        AND vendor_id NOT IN (
            SELECT vendor_id 
            FROM bookings 
            WHERE event_date = ?
        ) 
        LIMIT 1
    ";

    if ($stmt = mysqli_prepare($conn, $query)) {
        // Bind parameters
        mysqli_stmt_bind_param($stmt, "ss", $service, $event_date);
        // Execute the query
        mysqli_stmt_execute($stmt);
        // Get the result
        $result = mysqli_stmt_get_result($stmt);

        if (mysqli_num_rows($result) > 0) {
            // Vendor is available
            $vendor = mysqli_fetch_assoc($result);
            $vendor_id = $vendor['vendor_id'];
            $message = "Vendor is available! Proceed to book your event.";
            $status = "success";

            // Redirect to the booking page with vendor_id and event details
            header("Location: booking.php?vendor_id=$vendor_id&event_date=$event_date");
        } else {
            // Vendor is not available
            $message = "Sorry, no vendor is available for $service on $event_date.";
            $status = "error";

            // Redirect back to the form with an error message
            header("Location: event_page.php?message=" . urlencode($message) . "&status=" . $status);
        }

        // Close the statement
        mysqli_stmt_close($stmt);
    } else {
        // Query preparation failed
        echo "Error preparing the query: " . mysqli_error($conn);
    }

    // Close database connection
    mysqli_close($conn);
}
?>
