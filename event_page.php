<?php
if (isset($_GET['message']) && isset($_GET['status'])) {
    $message = urldecode($_GET['message']);
    $status = $_GET['status'];

    echo "<div class='" . htmlspecialchars($status) . "'>" . htmlspecialchars($message) . "</div>";
}
?>
