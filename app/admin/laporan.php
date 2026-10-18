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

    <title>Aplikasi Pembayaran SPP</title>

    <!-- Bootstrap core CSS -->
    <link href="./../assets/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="./../assets/style.css" rel="stylesheet">
    <style type="text/css">

       body { background-image: url(../assets/img/bg-1.jpg);
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
            <li role="presentation"   style="background-color: #F23030; border-radius: 50px;"><a href="laporan.php">Laporan</a></li>
            <li role="presentation"><a href="profile.php">Profile</a></li>
            <li role="presentation"><a href="../inc/logout.php">Keluar</a></li>
      </ul>
        </div><!--/.nav-collapse -->
      </div>
    </nav> 
    <div class="container">
        <div class="page-header">
            <h1>LAPORAN</h1>
            <div class="row">
        <div class="col-sm-4">
          <div class="panel panel-primary">
            <div class="panel-heading" style="background-color: #267356;">
              <h3 class="panel-title">Laporan Data Siswa</h3>
            </div>
            <div class="panel-body">
             <button type="button" class="btn btn-lg " style="background-color: #F23030;"><a href="laporan_data_siswa.php" target="_blank">cetak/print laporan data siswa</a></button>
            </div>
          </div>
          <div class="panel panel-primary">
            <div class="panel-heading" style="background-color: #267356;">
              <h3 class="panel-title">Laporan Data Petugas</h3>
            </div>
            <div class="panel-body">
              <button type="button" class="btn btn-lg" style="background-color: #F23030;"><a href="laporan_data_petugas.php" target="_blank">cetak/print laporan data petugas</a></button>
            </div>
          </div>
        </div><!-- /.col-sm-4 -->
        <div class="col-sm-4">
          <div class="panel panel-primary">
            <div class="panel-heading" style="background-color: #267356;">
              <h3 class="panel-title">Laporan Data SPP</h3>
            </div>
            <div class="panel-body">
              <button type="button" class="btn btn-lg" style="background-color: #F23030;"><a href="laporan_data_spp.php" target="_blank">cetak/print laporan data spp</a></button>
            </div>
          </div>
          <div class="panel panel-primary">
            <div class="panel-heading" style="background-color: #267356;">
              <h3 class="panel-title">Laporan Tunggakan</h3>
            </div>
            <div class="panel-body">
              <button type="button" class="btn btn-lg" style="background-color: #F23030;"><a href="laporan_tunggakan.php" target="_blank">cetak/print laporan tunggakan spp</a></button>
            </div>
          </div>
        </div><!-- /.col-sm-4 -->
        </div>
        <ul class="nav nav-pills nav-stacked">
            <li></li>
            <li></li>
            <li></li>
            <li></li>
            <li>
                <h3>Laporan Pembayaran</h3>
                    <div class="panel-heading" style="background-color: #267365; border-radius: 25px;">
                <form action="laporan_pembayaran.php" method="get">
                    <a style="margin: 15px; font-size: 18px;">Mulai Tanggal :</a><input type="date" name="tgl1" value="<?php echo date('Y-m-d'); ?>" />
                    <a style="margin: 15px; font-size:18px;">Sampai Tanggal </a><input type="date" name="tgl2" value="<?php echo date('Y-m-d'); ?>" />
                    <input class="btn" type="submit" value="Tampilkan" style="margin-left: 30px; background-color: #f23030; color: white; width: 200px; font-size: 18px;" />
                </form></div></div>
            </li>
        </ul>
    </div>

<?php include "footer.php"; ?>