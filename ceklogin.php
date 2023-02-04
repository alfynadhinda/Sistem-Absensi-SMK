<?php
    session_start();
    include 'connection.php';

    // menangkap data dari login
    $username = $_POST['username'];
    $password = $_POST['password'];
    $lvl = $_POST['level'];

    // menyeleksi level login
    if ($lvl == 'guru'){
        $data = mysqli_query($connect, "SELECT * FROM siarota_guru WHERE nik_guru = '$username' and pwd_guru = '$password'");
    
        // menghitung jumlah data yang ditemukan
        $cek = mysqli_fetch_assoc($data);

        if ($cek > 0) {
            $_SESSION['username'] = $username;
            $_SESSION['status'] = "login";
            $_SESSION['nama_guru'] = $cek['nama_guru'];
            header("location:guru/");
        }
        else {
            // header("location:index.php?pesan:gagal");
            echo "
                <script>
                alert('Username atau password salah');
                document.location='index.php?gagal';
                </script>";
        }
    }
    elseif ($lvl == 'admin'){
        $data1 = mysqli_query($connect, "SELECT * FROM siarota_admin WHERE username_admin = '$username' and pwd_admin = '$password'");
    
        // menghitung jumlah data yang ditemukan
        $cek = mysqli_fetch_assoc($data1);

        if ($cek > 0) {
            $_SESSION['username'] = $username;
            $_SESSION['status'] = "login";
            $_SESSION['nama_admin'] = $cek['nama_admin'];
            header("location:admin/");
        }
        else {
            // header("location:index.php?gagal login");
            echo "
                <script>
                alert('Username atau password salah');
                document.location='index.php?gagal';
                </script>";
        }
    }
    elseif ($lvl == 'siswa') {
        $data4 = mysqli_query($connect, "SELECT * FROM siarota_siswa WHERE nis_siswa='$username' and pwd_siswa='$password'");
 
    // menghitung jumlah data yang ditemukan
        $cek = mysqli_fetch_assoc($data4);
 
        if($cek > 0){
            $_SESSION['username'] = $username;
            $_SESSION['status'] = "login";
            $_SESSION['nama_siswa']= $cek['nama_siswa'];
            // $_SESSION['nis_siswa']= $cek['nis_siswa'];
            header("location:siswa/");
        }
        else{
            // header("location:index.php?pesan:gagal");
            echo "
                <script>
                alert('Username atau password salah');
                document.location='index.php?gagal';
                </script>";
        }
    }
    else {
        // header("location:index.php?pesan:gagal");
        echo "
                <script>
                alert('Username atau password salah');
                document.location='index.php?gagal';
                </script>";
    }
?>