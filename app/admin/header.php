<?php
    session_start();
    if($_SESSION['id']==""){
      header('location:../login.php');
    }
    if($_SESSION['status']=="petugas"){
      header('location:../petugas/index.php');
    } 

    include "../inc/koneksi.php";
    
  $qprofil = mysqli_query($konek, "SELECT * FROM tb_petugas WHERE id_petugas='$_SESSION[id]'");
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
    <link rel="icon" href="./../assets/favicon.png">


    <!-- Bootstrap core CSS -->
    <link href="./../assets/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="./../assets/style.css" rel="stylesheet">

    <style type="text/css">
      body{
         background-image: url(../assets/img/bg-1.jpg);
                background-size: cover;

      }
      a{
        color: white;
      }
    </style>
</head>
<body>
     <!-- Fixed navbar -->
   <nav class="navbar navbar-default navbar-fixed-top" style="border-radius: 0px 0px 50px 50px; border-color: black; background-color:  #267365;">
      <div class="container">
        <div class="navbar-header" style="margin-top: 20px;">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="./" style="color: white;">ADMIN - (<?php echo $profil['nama_petugas']; ?>)</a>
        </div>
        <div style="margin-top: 25px; margin-bottom: 10px;">
         <ul class="nav nav-pills" role="tablist">
            <li role="presentation"><a href="tampil_siswa.php">Data Siswa</a></li>
            <li role="presentation"><a href="tampil_petugas.php">Data Petugas</a></li>
            <li role="presentation"><a href="tampil_kelas.php">Data Kelas</a></li>
            <li role="presentation"><a href="tampil_spp.php">Data SPP</a></li>
            <li role="presentation"><a href="transaksi.php">Transaksi</a></li>
            <li role="presentation"><a href="laporan.php">Laporan</a></li>
            <li role="presentation"><a href="profile.php">Profile</a></li>
            <li role="presentation"><a href="../inc/logout.php">Keluar</a></li>
      </ul>
        </div><!--/.nav-collapse -->
      </div>
    </nav> 