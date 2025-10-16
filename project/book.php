<?php
session_start();
include 'db.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $vehicle_id = $_POST['vehicle_id'];
    $user_id = $_SESSION['user_id'];
    $address = $_POST['address'];
    $phone = $_POST['phone'];
    $start_date = $_POST['start_date'];
    $end_date = $_POST['end_date'];

    $query = "INSERT INTO bookings (user_id, vehicle_id, address, phone, start_date, end_date, status) 
              VALUES ($user_id, $vehicle_id, '$address', '$phone', '$start_date', '$end_date', 'Pending')";
    if ($conn->query($query) === TRUE) {
        echo "<script>alert('Booking successful!'); window.location='dashboard.php?booked=1';</script>";
    } else {
        echo "<div class='alert alert-danger text-center'>Error: " . $conn->error . "</div>";
    }
} else if (isset($_GET['id'])) {
    $vehicle_id = $_GET['id'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Book Vehicle</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="styles.css">
</head>
<body>
<div class="container mt-5">
    <h2 class="text-center">Book Vehicle</h2>
    <form method="POST">
        <input type="hidden" name="vehicle_id" value="<?php echo $vehicle_id; ?>">
        <div class="mb-3">
            <label>Address:</label>
            <input type="text" class="form-control" name="address" required>
        </div>
        <div class="mb-3">
            <label>Phone Number:</label>
            <input type="text" class="form-control" name="phone" required>
        </div>
        <div class="mb-3">
            <label>Start Date:</label>
            <input type="date" class="form-control" name="start_date" required>
        </div>
        <div class="mb-3">
            <label>End Date:</label>
            <input type="date" class="form-control" name="end_date" required>
        </div>
        <button type="submit" class="btn btn-success">Book Now</button>
    </form>
    <a href="dashboard.php">Back to Dashboard</a>
</div>
</body>
</html>
<?php
}
?>
