<?php
    require '../connection.php';

    if(isset($_POST["submit"])){

            $nip  = $_POST['nik_guru'];
            $nama = $_POST['nama_guru'];
            $alamat = $_POST['alamat_guru'];
            $tlp =    $_POST ['tlp_guru'];
            $pass =   $_POST['pwd_guru'];

            $update= "UPDATE siarota_guru SET 
                        nik_guru = '$nip', 
                        nama_guru = '$nama', 
                        alamat_guru = '$alamat',
                        tlp_guru = '$tlp', 
                        pwd_guru = '$pass'
                        WHERE nik_guru= '$nip' ";
           $query = mysqli_query($connect, $update);
        //cekdata berhasil ditambahkan
        if ($query) {
          echo "
            <script>
            alert('Data Guru Berhasil diupdate');
            document.location='data_guru.php?status=sukses';
            </script>";
        }
        else{
          echo "
            <script>
            alert('Data Guru Gagal diupdate');
            document.location='data_guru.php?status=gagal';
            </script>";
        }

      }
      ?>