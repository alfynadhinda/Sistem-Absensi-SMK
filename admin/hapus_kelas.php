<?php

    require "../connection.php";

    $kd_kelas = $_GET['kode_kelas'];
    
	$hapus = mysqli_query($connect,"DELETE FROM siarota_kelas WHERE kd_kelas ='$kd_kelas'");
    if($hapus){
        echo "
            <script>
                alert('Berhasil Menghapus data');
                document.location.href = 'data_kelas.php?sukses';
            </script>";
    }
    else{
        echo "
            <script>
                alert('Gagal Menghapus data');
                document.location.href = 'data_kelas.php';
            </script>";
    }

?>