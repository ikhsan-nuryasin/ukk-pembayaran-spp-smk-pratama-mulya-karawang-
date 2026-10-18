<?php
    session_start();
    if($_SESSION['id']==""){
      header('location:../login.php');
    }
    if($_SESSION['status']=="admin"){
      header('location:../admin/index.php');
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
 
    <title>Pembayaran SPP SMK Patama Mulya Karawang - PETUGAS</title>

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
      td{
        font-weight: bold;
      }
    </style>
</head>
<body>
     <nav class="navbar navbar-default navbar-fixed-top" style="border-radius: 0px 0px 50px 50px; border-color: black; background-color:  #267365;">
      <div class="container">
        <div class="navbar-header" style="margin-top: 20px;">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="./" style="color: white;">PETUGAS - (<?php echo $profil['nama_petugas']; ?>)</a>
        </div>
        <div style="margin-top: 25px; margin-bottom: 10px;">
         <ul class="nav nav-pills" role="tablist">
            <li role="presentation"  ><a href="transaksi.php">Transaksi</a></li>
            <li role="presentation"><a href="riwayat.php">History pembayaran</a></li>
            <li role="presentation" style="background-color: #F23030; border-radius: 50px;"><a href="profile.php">Profile</a></li>
            <li role="presentation"><a href="../inc/logout.php">Keluar</a></li>
      </ul>
        </div><!--/.nav-collapse -->
      </div>
    </nav> 
   
    <div class="container" style=" margin-top: 5%;">
        <div class="page-header">
            <h3>Edit Profile Saya</h3>
        </div>
        
        <form action="" method="post">
            <table class="table">
                <tr>
                    <td>Nama Petugas</td>
                    <td><input class="form-control" type="text" name="nama" value="<?php echo $profil['nama_petugas']; ?>"></td>
                </tr>
                <tr>
                    <td>Alamat</td>
                    <td><textarea class="form-control" name="alamat"><?php echo $profil['alamat']; ?></textarea></td>
                </tr>
                <tr>
                    <td>Telepon</td>
                    <td><input class="form-control" type="number" name="telp" value="<?php echo $profil['telepon']; ?>"></td>
                </tr>
                <tr>
                    <td></td>
                    <td>
                    <input class="btn btn-success" type="submit" value="Simpan">  
                        <a class="btn btn-info" href="profile.php">Kembali</a>
                    </td>
                </tr>
            </table>
        </form>

        <?php 
            if ($_SERVER['REQUEST_METHOD']=='POST') {
                $nama = $_POST['nama'];
                $alamat = $_POST['alamat'];
                $telp = $_POST['telp'];
                
                if ($nama=='' || $alamat=='' || $telp=='') {
                    echo "Form belum lengkap!";
                }else {
                    $edit = mysqli_query($konek, "UPDATE tb_petugas SET nama_petugas='$nama', alamat='$alamat', telepon='$telp' 
                    WHERE id_petugas='$_SESSION[id]'");
                    if (!$edit) {
                        echo "Simpan data gagal!";
                    }else {
                        ?>
                        <script type="text/javascript">
                            alert(' Berhasil Edit Profile !');
                            document.location.href="profile.php";
                        </script>
                        <?php
                    }
                }
            }
        ?>
    
    </div>

<?php include "footer.php"; ?>
