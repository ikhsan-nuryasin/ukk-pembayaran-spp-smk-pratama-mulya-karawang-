<?php
    include "inc/koneksi.php";
   
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login - Aplikasi Pembayaran SPP SMK Pratama Mulya</title>
    <style>
        body {
            background-image: url(assets/img/bg-1.jpg);
            background-size: cover;
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .container {
            width: 100%;
            max-width: 400px;
            background: #ffffff;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            padding: 20px;
        }

        .panel-heading {
            text-align: center;
            margin-bottom: 20px;
        }

        .panel-heading h4 {
            margin: 0;
            font-size: 20px;
            color: #1565c0;
        }

        .panel-heading p {
            margin: 5px 0 0;
            font-size: 14px;
            color: #555;
        }

        .form-group {
            margin-bottom: 15px;
        }

        .form-group label {
            display: block;
            margin-bottom: 5px;
            color: #555;
            font-size: 14px;
        }

        .form-control {
            width: 90%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            font-size: 14px;
        }

        .btn {
            width: 95.5%;
            padding: 10px;
            border: none;
            border-radius: 4px;
            font-size: 14px;
            cursor: pointer;
        }

        .btn-primary {
            background-color: #1565c0;
            color: #fff;
        }

        .btn-primary:hover {
            background-color: #0d47a1;
        }

        .btn-success {
            background-color: #28a745;
            color: #fff;
            text-decoration: none;
            display: inline-block;
            text-align: center;
            width: 91%;
        }

        .btn-success:hover {
            background-color: #218838;
        }

        .alert {
            padding: 10px;
            background-color: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
            border-radius: 4px;
            margin-top: 15px;
        }

        .alert.center {
            text-align: center;
        }

        footer {
            margin-top: 20px;
            text-align: center;
            font-size: 12px;
            color: #888;
        }
    </style>
</head>
<body>

    <div class="container">
        <div class="panel-heading">
            <img src="assets/img/logo.png" style="width: 120px; padding: 30px;">
            <h4>Login Aplikasi Pembayaran SPP</h4>
            <p>SMK Pratama Mulya</p>
        </div>
        <div class="panel-body">
            <form action="" method="post">
                <div class="form-group">
                    <label for="password">NISN</label>
                   <input class="form-control" type="text" name="nisn" placeholder="Masukkan NISN" aria-describedby="basic-addon1" required="required">
                </div>
                <div class="form-group">
                    <input class="btn btn-primary" type="submit" value="Login">
                </div>
                <div class="form-group">
                    <a class="btn btn-success" href="index.php">Kembali</a>
                </div>
            </form>
                    <?php
                        if ($_SERVER['REQUEST_METHOD']=='POST') {
                            $nisn = $_POST['nisn'];

                            if ($nisn=='') {
                                echo "Form Belum Lengkap!";
                            }else {
                                include "inc/koneksi.php";
                                $sqlLogin = mysqli_query($konek, "SELECT * FROM tb_siswa WHERE nisn='$nisn'");
                                $jml = mysqli_num_rows($sqlLogin);
                                $d = mysqli_fetch_array($sqlLogin);

                                if ($jml > 0) {
                                    session_start();
                                    $_SESSION['login'] = true;
                                    $_SESSION['id'] = $d['nisn'];
                                    $_SESSION['nama'] = $d['nama'];

                                    header('location:index_siswa.php');
                                }else {
                                    ?>
                                    <br>
                                    <div class="alert alert-danger" role="alert">
                                        <center>
                                            NISN anda tidak terdaftar ! <br>
                                             Silahkan hubungi Admin <br>
                                             085721485664
                                        </center>
                                    </div>
                                    <?php
                                    // echo "Username dan Password Anda Salah";
                                }
                            }
                        }
                    ?>
                </div>
            </div>
        </div>
        
        
        
    </div>
    

    
    <!-- Bootstrap core JavaScript
    ================================================== -->
    <script src="./assets/js/jquery.js"></script>
    <script src="./assets/js/bootstrap.min.js"></script>
</body>
</html>