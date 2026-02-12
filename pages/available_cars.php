<?php
session_start();
include("../config/db.php");

$sql = "SELECT * FROM cars";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>

<head>
    <title>Available Cars</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">

    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="../pages/available_cars.php">🚗 Car Rental</a>

            <ul class="navbar-nav ms-auto">
                <?php if(isset($_SESSION['role']) && $_SESSION['role']=='agency'){ ?>
                <li class="nav-item">
                    <a class="nav-link" href="../agency/add_car.php">Add Car</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="../agency/view_bookings.php">View Bookings</a>
                </li>
                <?php } ?>

                <?php if(isset($_SESSION['name'])){ ?>
                <li class="nav-item">
                    <span class="nav-link">Hi, <?= $_SESSION['name'] ?></span>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-danger" href="../auth/logout.php">Logout</a>
                </li>
                <?php } else { ?>
                <li class="nav-item">
                    <a class="nav-link" href="../auth/login.php">Login</a>
                </li>
                <?php } ?>
            </ul>
        </div>
    </nav>

    <div class="container mt-5">

        <div class="card shadow">
            <div class="card-body">
                <table class="table table-bordered table-hover text-center align-middle">
                    <thead class="table-dark">
                        <tr>
                            <th>Model</th>
                            <th>Vehicle No</th>
                            <th>Seats</th>
                            <th>Rent / Day</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>

                        <?php while($row = $result->fetch_assoc()) { ?>
                        <tr>
                            <td><?= $row['model'] ?></td>
                            <td><?= $row['vehicle_number'] ?></td>
                            <td><?= $row['seating_capacity'] ?></td>
                            <td>₹<?= $row['rent_per_day'] ?></td>
                            <td>

                                <?php if(isset($_SESSION['role']) && $_SESSION['role']=='customer'){ ?>

                                <form action="../customer/book_car.php" method="POST"
                                    class="d-flex gap-2 justify-content-center">
                                    <input type="hidden" name="car_id" value="<?= $row['id'] ?>">
                                    <input type="date" name="start_date" class="form-control" required>
                                    <select name="days" class="form-select">
                                        <option>1</option>
                                        <option>2</option>
                                        <option>3</option>
                                    </select>
                                    <button class="btn btn-success btn-sm">Rent</button>
                                </form>

                                <?php } elseif(isset($_SESSION['role']) && $_SESSION['role']=='agency' && $_SESSION['user_id']==$row['agency_id']) { ?>

                                <a href="../agency/edit_car.php?id=<?= $row['id'] ?>"
                                    class="btn btn-warning btn-sm">Edit</a>
                                <a href="../agency/delete_car.php?id=<?= $row['id'] ?>" class="btn btn-danger btn-sm"
                                    onclick="return confirm('Delete this car?')">Delete</a>

                                <?php } else { ?>
                                <a href="../auth/login.php" class="btn btn-primary btn-sm">Login to Rent</a>
                                <?php } ?>

                            </td>
                        </tr>
                        <?php } ?>

                    </tbody>
                </table>
            </div>
        </div>

    </div>

</body>

</html>