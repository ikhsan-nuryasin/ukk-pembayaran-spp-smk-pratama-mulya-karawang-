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
       td{
        font-weight: bold;
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
            <li role="presentation" class="" style="background-color: #F23030; border-radius: 50px;"><a href="tampil_siswa.php">Data Siswa</a></li>
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
    <div class="container">
        <div class="page-header">
            <h3 style="font-weight: bold; font-size: 30px;">Data Siswa</h3>
        </div>
        <div class="col-md-8">
          <?php
                $qjumlah = mysqli_query($konek, "SELECT * FROM tb_siswa");
                $jumlah = mysqli_num_rows($qjumlah);
            ?>
          <a class="btn" style="background-color:  #F23030;" href="tambah_siswa.php">Tambah Data</a>
          <button class="btn btn-md btn-default">Jumlah Data <span class="badge"><?php echo $jumlah; ?></span></button>
          <a href="?menu=data_pegawai" class="btn btn-md" style="background-color:  #F23030">Refresh</a>
        </div>
        <div class="col-md-4">
          <form method="post">
                <div class="input-group">
                    <input name="inputan" type="text" class="form-control" placeholder="Cari Siswa">
                    <span class="input-group-btn">
                        <input name="cari" class="btn btn-default" value="Cari" type="submit">
                    </span>
                </div><!-- /input-group -->
          </form>
        </div>
        <table class="table table-bordered table-striped" style="background-color: #ebe6e6;">
            <tr>
                <th>No</th>
                <th>NISN</th>
                <th>NIS</th>
                <th>Nama Siswa</th>
                <th>Kelas</th>
                <th>Alamat</th>
                <th>Telepon</th>
                <th>Aksi</th>
            </tr>
<!-- disini -->
<?php
            //paging
            $batas = 5;
            $hal = ceil($jumlah / $batas);
            $page = (isset($_GET['hal'])) ? $_GET['hal']:1;
            $posisi = ($page - 1) * $batas;
            $no = 1 + $posisi;
            $inputan = isset($_POST['inputan']) ? $_POST['inputan'] : '';
if (isset($_POST['cari'])) {
    if ($inputan == "") {
        $q = mysqli_query($konek, "SELECT tb_siswa.*, tb_kelas.* 
        FROM tb_siswa 
        INNER JOIN tb_kelas ON tb_kelas.id_kelas = tb_siswa.id_kelas 
        ORDER BY tb_kelas.nama_kelas, tb_kelas.kompetensi_keahlian 
        LIMIT $posisi, $batas");
    } else {
        $q = mysqli_query($konek, "SELECT tb_siswa.*, tb_kelas.* 
        FROM tb_siswa 
        INNER JOIN tb_kelas ON tb_kelas.id_kelas = tb_siswa.id_kelas 
        WHERE tb_siswa.nama LIKE '%$inputan%' 
        ORDER BY tb_kelas.nama_kelas, tb_kelas.kompetensi_keahlian 
        LIMIT $posisi, $batas");
    }
} else {
    $q = mysqli_query($konek, "SELECT tb_siswa.*, tb_kelas.* 
    FROM tb_siswa 
    INNER JOIN tb_kelas ON tb_kelas.id_kelas = tb_siswa.id_kelas 
    ORDER BY tb_kelas.nama_kelas, tb_kelas.kompetensi_keahlian 
    LIMIT $posisi, $batas");
}

                $cek = mysqli_num_rows($q);

                if($cek < 1){
                    ?>
                    <tr>
                        <td colspan="7">
                            <center>
                                Data tidak tersedia !
                                <p href="" class="btn btn-sm btn-success"><span class="glyphicon glyphicon-refresh"></span></a>
                            </center>
                        </td>
                    </tr>
                    <?php
                }
                else{
                    
            while($data = mysqli_fetch_array($q)){
                
            
        ?>
            <tr>
                <td><?php echo $no++; ?></td>
                <td><?php echo $data['nisn']; ?></td>
                <td><?php echo $data['nis']; ?></td>
                <td><?php echo $data['nama']; ?></td>
                <td><?php echo $data['nama_kelas']; ?></td>
                <td><?php echo $data['alamat']; ?></td>
                <td><?php echo $data['no_hp']; ?></td>
                <td>
                    <a onclick="return confirm('Menghapus data siswa juga mengahapus transaksi?')" title="Hapus" href="hapus_siswa.php?id=<?php echo $d['nisn']; ?>"><span class="glyphicon glyphicon-trash" aria-hidden="true" style="color: indianred;"></span></a> |
                    <a title="Edit" href="edit_siswa.php?id=<?php echo $data['nisn']; ?>"><span class="glyphicon glyphicon-pencil" aria-hidden="true" style="color: blue;"></span></a>
                </td>
            </tr>
            <?php
                    }
                }
            ?>

        </table>
        <nav>
            <ul class="pagination">
                <?php
                    for ($i=1; $i <= $hal ; $i++) { 
                        ?>
                        <li <?php if ($page==$i) {
                            echo "class='active'";
                        } ?>><a href="?menu=data_pegawai&hal=<?php echo $i; ?>"><?php echo $i; ?></a></li>
                        <?php
                    }
                ?>
            </ul>
        </nav>
    </div>

<?php include "footer.php"; ?>