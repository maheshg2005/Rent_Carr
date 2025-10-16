<?php
session_start();
include 'db.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];
$result = $conn->query("SELECT * FROM vehicles WHERE availability = 1");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Dashboard</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="styles.css">
</head>
<body class="dashboard-bg">

<nav class="navbar navbar-expand-lg navbar-dark">
    <div class="container">
        <a class="navbar-brand" href="#">Rental Vehicle System</a>
        <a class="btn btn-logout" href="logout.php">Logout</a>
    </div>
</nav>

<div class="container mt-4">
    <h2 class="text-center heading">Available Vehicles</h2>
    <div class="row">
        <?php while ($row = $result->fetch_assoc()) { 
            $new_price = $row['price_per_day'] * 1.2; // Increase price by 20%
        ?>
            <div class="col-md-4">
                <div class="card p-3 text-center">
                    <img src="images/<?php echo $row['image']; ?>" class="img-fluid vehicle-image">
                    <h4 class="mt-2 vehicle-name" style="color: white;"><?php echo $row['brand'] . " " . $row['model']; ?></h4>
                    <p>Type: <?php echo $row['type']; ?></p>
                    <p class="price"><strong>Price per day: ₹<?php echo number_format($new_price, 2); ?></strong></p>
                    <a href="book.php?id=<?php echo $row['id']; ?>" class="btn btn-success w-100">Book Now</a>
                </div>
            </div>
        <?php } ?>
        <!-- Add Yamaha MT-15 bike -->
        <div class="col-md-4">
            <div class="card p-3 text-center">
                <img src="images/yamaha-mt15.jpg" class="img-fluid vehicle-image">
                <h4 class="mt-2 vehicle-name" style="color: white;">Yamaha MT-15</h4>
                <p>Type: Bike</p>
                <p class="price"><strong>Price per day: ₹600.00</strong></p>
                <a href="book.php?id=mt15" class="btn btn-success w-100">Book Now</a>
            </div>
        </div>
    </div>
</div>
<!-- 🚗 Booked Successfully Notification -->
<div id="bookedNotification" class="booked-notification">
    ✅ Vehicle booked successfully!
</div>
<script>
    function showBookedNotification() {
        var notification = document.getElementById("bookedNotification");
        notification.style.display = "block"; // Show the notification
        
        // Hide notification after 5 seconds
        setTimeout(function() {
            notification.style.display = "none";
        }, 5000);
    }

    // Show notification when "booked" is in URL
    var urlParams = new URLSearchParams(window.location.search);
    if (urlParams.has('booked')) {
        showBookedNotification();
    }
</script>

</body>
</html>