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

     <style type="text/css">
        body{
        background-image: url(assets/img/bg-1.jpg);
        background-size: cover;
      }
      a{
        color: white;
      }
      td{
        font-weight: bold;
      }
    </style>
</head>
<body>
     <nav class="navbar navbar-default navbar-fixed-top" style="border-radius: 0px 0px 50px 50px; border-color: black; background-color:  #267365;">
      <div class="container">
        <div class="navbar-header" style="margin-top: 2%;">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
            <a class="navbar-brand" style="color: white;" href="index_siswa.php">SISWA - (<?php echo $profil['nama']; ?>)</a>
        </div>
        <div style="margin-top: 2%; margin-bottom: 1%;">
         <ul class="nav nav-pills" role="tablist">
            <li role="presentation"><a href="riwayat_siswa.php">History pembayaran</a></li>
            <li role="presentation"><a href="profile_siswa.php">Profile</a></li>
            <li role="presentation"><a href="inc/logout.php">Keluar</a></li>
      </ul>
        </div><!--/.nav-collapse -->
      </div>
    </nav>