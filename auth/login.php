<?php
session_start();
include("../config/db.php");

if(isset($_POST['login'])){

    $email = $_POST['email'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM users WHERE email='$email'";
    $result = $conn->query($sql);

    if($result->num_rows > 0){
        $user = $result->fetch_assoc();

        if(password_verify($password, $user['password'])){
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['role'] = $user['role'];
            $_SESSION['name'] = $user['name'];

           header("Location: ../pages/available_cars.php");
exit();

        } else {
            echo "Wrong Password!";
        }
    } else {
        echo "User not found!";
    }
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Login</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light d-flex justify-content-center align-items-center" style="height:100vh;">

    <div class="card shadow p-4" style="width: 350px;">
        <h3 class="text-center mb-3">🔐 User Login</h3>

        <form method="POST">
            <input type="email" name="email" class="form-control mb-3" placeholder="Enter Email" required>
            <input type="password" name="password" class="form-control mb-3" placeholder="Enter Password" required>
            <button type="submit" name="login" class="btn btn-primary w-100">Login</button>
        </form>

        <p class="text-center mt-3">
            Don’t have an account?
            <a href="register.php">Register</a>
        </p>
    </div>

</body>

</html>