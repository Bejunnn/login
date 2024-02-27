<?php
session_start();
include "config.php";
if (isset($_POST['nisn'])) {
    // Get user input
    $password = $_POST['password'];
    $nisn = $_POST['nisn'];

    // Query to check user credentials
    $query = "SELECT * FROM member WHERE nisn='$nisn' AND password='$password'";
    $result = $connection->query($query);

    if ($result->num_rows == 1) {
        // Login successful
        $row = $result->fetch_assoc();
        $_SESSION['nama'] = $row['nama']; // Set nama session variable
        $_SESSION['password'] = $password;
        $_SESSION['nisn'] = $nisn;

        header("Location: dashboard/member.php"); // Redirect to dashboard or any other page
        exit(); // Ensure script stops execution after redirection
    } else {
        // Login failed
        echo "<script>alert('nisn dan password Anda salah. Silahkan coba lagi!')</script>";
    }
}
$connection->close();
?>

<!DOCTYPE html>
<html lang="en" >
<head>
<link rel="icon" href="assets/img/smkmadya.png">
  <meta charset="UTF-8">
  <title>Absensi | Siswa Login</title>
  <link href="https://fonts.googleapis.com/css?family=Asap" rel="stylesheet"><link rel="stylesheet" href="assets/css/style.css">

</head>
<style>
  .text-2{
    color: lightslategray;
    font-weight: bold;
  }
</style>

<body>
<!-- partial:index.partial.html -->
<form method="post" class="login">
  <input type="text" name="nisn" id="nisn" placeholder="nisn" >
  <input type="password" name="password" id="password" placeholder="password">
  <button class="btn btn-primary" type="submit" name="btn-login">Sign In</button>
  <a href="loginadmin.php" class="text-2">admin</a>

</form>
<!-- partial -->
  
</body>
</html>