<?php
session_start();
include("../config/db.php");

// Only customer can book
if(!isset($_SESSION['role']) || $_SESSION['role'] != 'customer'){
    die("Only customers can book cars!");
}

$car_id = $_POST['car_id'];
$days = $_POST['days'];
$start_date = $_POST['start_date'];
$customer_id = $_SESSION['user_id'];

// Get rent price
$result = $conn->query("SELECT rent_per_day FROM cars WHERE id=$car_id");
$car = $result->fetch_assoc();

$total = $car['rent_per_day'] * $days;

// Insert booking
$sql = "INSERT INTO bookings (car_id,customer_id,start_date,days,total_amount)
        VALUES ($car_id,$customer_id,'$start_date',$days,$total)";

if($conn->query($sql)){
    echo "Car Booked Successfully!";
} else {
    echo "Error: " . $conn->error;
}
?>