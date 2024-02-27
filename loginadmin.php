<?php
session_start();
include "config.php";

if (isset($_SESSION['sebagai'])) {
  if ($_SESSION['sebagai'] == 'petugas') {
    header("Location: dashboard/petugas.php");
    exit;
  } elseif ($_SESSION['sebagai'] == 'admin') {
    header("Location: dashboard/admin.php");
    exit;
  }
}


if (isset($_POST['btn-login'])) {
  $username = $_POST['username'];
  $password = $_POST['password'];


  // Query to check user credentials
  $query = "SELECT * FROM user WHERE username='$username' AND password='$password'";
  $result = $connection->query($query);

  if (mysqli_num_rows($result) === 1) {
    $_SESSION['username'] = true;
    $rows = mysqli_fetch_assoc($result);
    if ($rows['sebagai'] == 'petugas') {
      $_SESSION['sebagai'] = $rows['sebagai'];
      $_SESSION['username'] = $rows['username'];
      $_SESSION['id'] = $rows['id'];
      // $_SESSION['id'] = $rows['password'];
      return header("Location: dashboard/petugas.php");

      if (isset($_SESSION['username'])) {
        header("Location: dashboard/petugas.php");
        exit;
      }
    } elseif ($rows['sebagai'] == 'admin') {
      $_SESSION['sebagai'] = $rows['sebagai'];
      $_SESSION['username'] = $rows['username'];
      $_SESSION['id'] = $rows['id'];
      // $_SESSION['id'] = $rows['password'];
      return header("Location: dashboard/admin.php");


      if (isset($_SESSION['username'])) {
        header("Location: dashboard/admin.php");
        exit;
      }
    }
  } else {
    // Login failed
    echo "<script>alert('username atau password Anda salah. Silahkan coba lagi!')</script>";
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
  <input type="text" name="username" id="username" placeholder="username" >
  <input type="password" name="password" id="password" placeholder="password">
  <button class="btn btn-primary" type="submit" name="btn-login">Sign In</button>
  <a href="index.php" class="text-2">Member</a>

</form>
<!-- partial -->
  
</body>
</html>