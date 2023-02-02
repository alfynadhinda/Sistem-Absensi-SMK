<?php

    require "../connection.php";

    $kd_mapel = $_GET['kd_mapel'];
    
	$hapus = mysqli_query($connect,"DELETE FROM siarota_mapel WHERE kd_mapel ='$kd_mapel'");
    if($hapus){
        echo "
            <script>
                alert('Berhasil Menghapus data');
                document.location.href = 'data_mapel.php?sukses';
            </script>";
    }
    else{
        echo "
            <script>
                alert('Gagal Menghapus data');
                document.location.href = 'data_mapel.php';
            </script>";
    }

?>