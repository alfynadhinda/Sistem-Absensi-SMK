<?php
    require '../connection.php';

    if(isset($_POST["ubah"])){

      $nis_siswa = $_POST['nis_siswa'];
      $nama_siswa =$_POST['nama_siswa'];
      $lahir_siswa = $_POST['lahir_siswa'];
      $kelamin_siswa = $_POST['kelamin_siswa'];
      $alamat_siswa = $_POST['alamat_siswa'];
      $pwd_siswa =$_POST['pwd_siswa'];
      $kelas_siswa =$_POST['kelas'];
  
      $update= "UPDATE siarota_siswa SET 
                nis_siswa = '$nis_siswa', 
                nama_siswa = '$nama_siswa', 
                lahir_siswa = '$lahir_siswa', 
                alamat_siswa = '$alamat_siswa',
                kelamin_siswa = '$kelamin_siswa',
                pwd_siswa = '$pwd_siswa',
                kelas = '$kelas_siswa'
                WHERE nis_siswa= '$nis_siswa' ";
      $query = mysqli_query($connect, $update);
        //cekdata berhasil ditambahkan
        if ($query) {
          echo "
            <script>
            alert('Data Siswa Berhasil diupdate');
            document.location='data_siswa.php?status=sukses';
            </script>";
        }
        else{
          echo "
            <script>
            alert('Data Siswa Gagal diupdate');
            document.location='data_siswa.php?status=gagal';
            </script>";
        }

      }
      ?>