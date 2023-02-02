<?php
    require '../connection.php';

    if(isset($_POST["submit"])){

            $kd_admin  = $_POST['kd_admin'];
            $username_admin = $_POST['username_admin'];
            $nama_admin = $_POST['nama_admin'];
            $tlp_admin =    $_POST ['tlp_admin'];
            $pass_admin =   $_POST['pwd_admin'];
            
            $update= "UPDATE siarota_admin SET 
                      kd_admin = '$kd_admin',
                      username_admin = '$username_admin',
                      nama_admin = '$nama_admin',
                      tlp_admin = '$tlp_admin',
                      pwd_admin = '$pass_admin'
                      WHERE kd_admin = '$kd_admin'";
           $query = mysqli_query($connect, $update);
        //cekdata berhasil ditambahkan
        if ($query) {
          echo "
            <script>
            alert('Data Admin Berhasil diupdate');
            document.location='data_admin.php?status=sukses';
            </script>";
        }
        else{
          echo "
            <script>
            alert('Data Admin Gagal diupdate');
            document.location='data_admin.php?status=gagal';
            </script>";
        }

      }
      ?>