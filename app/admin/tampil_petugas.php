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
            <li role="presentation"  style="background-color: #F23030; border-radius: 50px;"><a href="tampil_petugas.php">Data Petugas</a></li>
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

<div class="container">
    <div class="page-header">
        <h3>Data Petugas</h3>
    </div>
    <a class="btn" style="margin-bottom: 10px; background-color: #F23030;" href="tambah_petugas.php">Tambah Data</a>
    <table class="table table-bordered table-striped" style="background-color: #ebe6e6;">
        <tr>
            <th>No</th>
            <th>Nama Petugas</th>
            <th>Alamat</th>
            <th>Telepon</th>
            <th>Username</th>
            <th>Aksi</th>
        </tr>
        <?php 
            $sql = mysqli_query($konek, "SELECT * FROM tb_petugas WHERE level='petugas' ORDER BY id_petugas ASC");
            $no=1;
            while ($d=mysqli_fetch_array($sql)) {
                echo "
            <tr>
                <td width='40px' align='center'>$no</td>
                <td>$d[nama_petugas]</td>
                <td>$d[alamat]</td>
                <td>$d[telepon]</td>
                <td>$d[username]</td>
                <td width='60px'>";
                ?>
                    <a onclick="return confirm('Anda akan menghapusnya?')" title="Hapus" href="hapus_petugas.php?id=<?php echo $d['id_petugas']; ?>"><span class="glyphicon glyphicon-trash" aria-hidden="true" style="color: indianred;"></span></a> |
                    <a title="Edit" href="edit_petugas.php?id=<?php echo $d['id_petugas']; ?>"><span class="glyphicon glyphicon-pencil" aria-hidden="true" style="color: blue;"></span></a>
                <?php
                echo "</td>
            </tr>";
            $no++;
            }
        ?>
    </table>
</div>
    

<?php include "footer.php"; ?>
