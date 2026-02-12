<?php
session_start();
include("../config/db.php");

// Only agency allowed
if(!isset($_SESSION['role']) || $_SESSION['role']!='agency'){
    die("Access Denied");
}

$id = $_GET['id'];
$result = $conn->query("SELECT * FROM cars WHERE id=$id");
$car = $result->fetch_assoc();

if(isset($_POST['update'])){
    $model = $_POST['model'];
    $number = $_POST['vehicle_number'];
    $seats = $_POST['seating'];
    $rent = $_POST['rent'];

    $conn->query("UPDATE cars SET model='$model', vehicle_number='$number',
                 seating_capacity='$seats', rent_per_day='$rent' WHERE id=$id");

    header("Location: ../pages/available_cars.php");
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Edit Car</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">

    <div class="container mt-5">
        <div class="card shadow p-4">
            <h3 class="text-center mb-4">✏️ Edit Car Details</h3>

            <form method="POST" class="row g-3">
                <div class="col-md-6">
                    <input name="model" value="<?= $car['model'] ?>" class="form-control" required>
                </div>
                <div class="col-md-6">
                    <input name="vehicle_number" value="<?= $car['vehicle_number'] ?>" class="form-control" required>
                </div>
                <div class="col-md-6">
                    <input name="seating" value="<?= $car['seating_capacity'] ?>" class="form-control" required>
                </div>
                <div class="col-md-6">
                    <input name="rent" value="<?= $car['rent_per_day'] ?>" class="form-control" required>
                </div>
                <div class="text-center">
                    <button name="update" class="btn btn-success px-4">Update Car</button>
                </div>
            </form>

        </div>
    </div>

</body>

</html>