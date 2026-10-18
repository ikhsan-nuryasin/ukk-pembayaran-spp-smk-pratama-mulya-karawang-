<?php
    session_start();
    if($_SESSION['id']==""){
      header('location:../login.php');
    }
     

    include "inc/koneksi.php";
    $qprofil = mysqli_query($konek, "SELECT * FROM tb_siswa WHERE nisn='$_SESSION[id]'");
    $profil = mysqli_fetch_array($qprofil);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="./assets/favicon.png">
 
    <title>Pembayaran SPP SMK Patama Mulya Karawang - SISWA</title>

    <!-- Bootstrap core CSS -->
    <link href="./assets/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="./assets/style.css" rel="stylesheet">

      <style>
        body {
            background-image: url(assets/img/bg-1.jpg);
            background-size: cover;
            background-position: center;
        }
        .navbar {
            border-radius: 0px 0px 30px 30px;
            background-color: #267365;
        }
        .navbar-brand {
            color: white;
            font-weight: bold;
        }
        .nav-pills li a {
            color: white !important;
        }
        .table-responsive {
            overflow-x: auto;
        }
    
            .table {
                font-size: 14px;
            }
        }
    </style>
</head>
<body>

 <nav class="navbar navbar-default navbar-fixed-top" style="border-radius: 0px 0px 40px 40px; border-color: black; background-color:  #267365;">
      <div class="container">
        <div class="navbar-header" >
            <a class="navbar-brand" style="color: white;" href="index_siswa.php">HALLO.. <?php echo $profil['nama']; ?></a>
        </div>
        <div>
         <ul class="nav nav-pills" role="tablist">
            <li role="presentation"><a href="riwayat_siswa.php">History Pembayaran</a></li>
            <li role="presentation"><a href="profile_siswa.php">Profile</a></li>
            <li role="presentation"><a href="inc/logout.php">Keluar</a></li>
      </ul>
        </div><!--/.nav-collapse -->
      </div>
    </nav>
