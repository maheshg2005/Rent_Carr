<?php
include 'db.php';

if (isset($_GET['id'])) {
    $booking_id = $_GET['id'];
    $query = "UPDATE bookings SET status='Approved' WHERE id=$booking_id";
    if ($conn->query($query) === TRUE) {
        echo "<script>alert('Booking approved!'); window.location='admin.php';</script>";
    } else {
        echo "<script>alert('Error: " . $conn->error . "'); window.location='admin.php';</script>";
    }
}
?>
<a href="admin.php">Back</a>
