<?php
session_start();
include("../config/db.php");

// Only agency allowed
if(!isset($_SESSION['role']) || $_SESSION['role'] != 'agency'){
    die("Access Denied! Only Agency can add cars.");
}

if(isset($_POST['add'])){
    $model = $_POST['model'];
    $number = $_POST['vehicle_number'];
    $seats = $_POST['seating'];
    $rent = $_POST['rent'];
    $agency_id = $_SESSION['user_id'];

    $sql = "INSERT INTO cars (agency_id,model,vehicle_number,seating_capacity,rent_per_day)
            VALUES ('$agency_id','$model','$number','$seats','$rent')";

    if($conn->query($sql)){
        echo "Car Added Successfully!";
    } else {
        echo "Error: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Add Car</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">

    <div class="container mt-5">
        <div class="card shadow p-4">
            <h3 class="mb-4 text-center">🚘 Add New Car</h3>

            <form method="POST" class="row g-3">
                <div class="col-md-6">
                    <input type="text" name="model" class="form-control" placeholder="Car Model" required>
                </div>

                <div class="col-md-6">
                    <input type="text" name="vehicle_number" class="form-control" placeholder="Vehicle Number" required>
                </div>

                <div class="col-md-6">
                    <input type="number" name="seating" class="form-control" placeholder="Seating Capacity" required>
                </div>

                <div class="col-md-6">
                    <input type="number" name="rent" class="form-control" placeholder="Rent Per Day" required>
                </div>

                <div class="col-12 text-center">
                    <button type="submit" name="add" class="btn btn-success px-5">Add Car</button>
                </div>
            </form>

            <div class="text-center mt-3">
                <a href="../pages/available_cars.php" class="btn btn-secondary btn-sm">⬅ Back</a>
            </div>
        </div>
    </div>

</body>

</html>