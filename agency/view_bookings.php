<?php
session_start();
include("../config/db.php");

// Only agency allowed
if(!isset($_SESSION['role']) || $_SESSION['role'] != 'agency'){
    die("Access Denied! Only Agency allowed.");
}

$agency_id = $_SESSION['user_id'];

$sql = "SELECT b.id, u.name AS customer_name, c.model, c.vehicle_number,
        b.start_date, b.days, b.total_amount
        FROM bookings b
        JOIN cars c ON b.car_id = c.id
        JOIN users u ON b.customer_id = u.id
        WHERE c.agency_id = '$agency_id'";

$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>

<head>
    <title>Bookings</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">

    <div class="container mt-5">
        <h3 class="text-center mb-4">📋 Bookings for Your Cars</h3>

        <div class="card shadow">
            <div class="card-body">
                <table class="table table-bordered table-hover text-center align-middle">
                    <thead class="table-dark">
                        <tr>
                            <th>Customer</th>
                            <th>Car Model</th>
                            <th>Vehicle No</th>
                            <th>Start Date</th>
                            <th>Days</th>
                            <th>Total Amount</th>
                        </tr>
                    </thead>
                    <tbody>

                        <?php if($result->num_rows > 0){ ?>
                        <?php while($row = $result->fetch_assoc()){ ?>
                        <tr>
                            <td><?= $row['customer_name'] ?></td>
                            <td><?= $row['model'] ?></td>
                            <td><?= $row['vehicle_number'] ?></td>
                            <td><?= $row['start_date'] ?></td>
                            <td><?= $row['days'] ?></td>
                            <td>₹<?= $row['total_amount'] ?></td>
                        </tr>
                        <?php } ?>
                        <?php } else { ?>
                        <tr>
                            <td colspan="6">No bookings yet</td>
                        </tr>
                        <?php } ?>

                    </tbody>
                </table>
            </div>
        </div>

        <div class="text-center mt-3">
            <a href="../pages/available_cars.php" class="btn btn-secondary btn-sm">⬅ Back</a>
        </div>
    </div>

</body>

</html>