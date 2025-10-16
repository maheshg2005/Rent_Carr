<?php
include 'db.php';
$result = $conn->query("SELECT bookings.id, users.name, vehicles.brand, vehicles.model, bookings.status 
                        FROM bookings 
                        JOIN users ON bookings.user_id = users.id
                        JOIN vehicles ON bookings.vehicle_id = vehicles.id");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Admin Panel</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="styles.css">
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark">
    <div class="container">
        <a class="navbar-brand" href="#">Admin Panel</a>
        <a class="btn btn-danger" href="logout.php">Logout</a>
    </div>
</nav>

<div class="container mt-5">
    <h2 class="text-center heading">Booking Requests</h2>
    <table class="table table-bordered mt-3">
        <thead class="table-dark">
            <tr>
                <th>User</th>
                <th>Vehicle</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = $result->fetch_assoc()) { ?>
                <tr>
                    <td><?php echo $row['name']; ?></td>
                    <td><?php echo $row['brand'] . " " . $row['model']; ?></td>
                    <td class="status <?php echo $row['status']; ?>"><?php echo $row['status']; ?></td>
                    <td>
                        <a href="approve.php?id=<?php echo $row['id']; ?>" class="btn btn-success btn-sm">Approve</a>
                        <a href="cancel.php?id=<?php echo $row['id']; ?>" class="btn btn-danger btn-sm">Cancel</a>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>

</body>
</html>
