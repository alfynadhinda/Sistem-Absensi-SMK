<?php
    require '../connection.php';

    if(isset($_POST["submit"])){

     
      $kd_mapel = $_POST['kd_mapel'];
      $nama_mapel = htmlspecialchars($_POST['nama_mapel']);
      

      $update = "UPDATE siarota_mapel SET 
              kd_mapel  = '$kd_mapel', 
              nama_mapel = '$nama_mapel' 
              WHERE kd_mapel = '$kd_mapel' ";
        $query = mysqli_query($connect, $update);
      
        //cekdata berhasil ditambahkan
        if($query){
            echo "
              <script>
              alert('Daftar Mata Pelajaran Berhasil diupdate');
              document.location='data_mapel.php?status=sukses';
              </script>";
          }
          else{
            echo "
              <script>
              alert('Daftar Mata Pelajaran Gagal diupdate');
              document.location='data_mapel.php?status=gagal';
              </script>";
          }
      
        }
?>