<?php
session_start();

if (isset($_POST['adminlogin'])) {
    require('connection.php'); // Include the database connection

    $email = $_POST['email'];
    $password = $_POST['password'];

    $query = "SELECT * FROM `admin` WHERE `email`='$email' AND `password`='$password'";
    $result = mysqli_query($con, $query);

    if (mysqli_num_rows($result) == 1) {
        header('Location: Admin.html');
        exit(); // Important: Exit the script after redirecting
    } else {
        $_SESSION['error'] = "Incorrect password";
        echo "<script>
                alert('Incorrect password');
                window.location.href = 'Adminlogin.html';
              </script>";
    }
}
?>
