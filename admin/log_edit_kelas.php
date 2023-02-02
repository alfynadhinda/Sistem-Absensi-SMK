<?php
    require '../connection.php';

    if(isset($_POST["submit"])){

     
      $kd_kelas = $_POST['kode_kelas'];
      $nama_kelas = $_POST['nama_kelas'];
      $walikelas = $_POST['guru_kelas'];
    

      $update= "UPDATE siarota_kelas SET 
              kd_kelas  = '$kd_kelas', 
              nama_kelas = '$nama_kelas', 
              wali_kelas	 = '$walikelas'
              WHERE kd_kelas = '$kd_kelas' ";
        $query = mysqli_query($connect, $update);
        //cekdata berhasil ditambahkan
        if($query){
            echo "
              <script>
              alert('Data Kelas Berhasil diupdate');
              document.location='data_kelas.php?status=sukses';
              </script>";
          }
          else{
            echo "
              <script>
              alert('Data Kelas Gagal diupdate');
              document.location='data_kelas.php?status=gagal';
              </script>";
          }
      
        }
?>