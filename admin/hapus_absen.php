<?php

    require "../connection.php";

    $nis = $_GET['nis_siswa'];

	$hapus = mysqli_query($connect,"DELETE FROM siarota_absen WHERE nis_siswa ='$nis'");
    if($hapus){
        echo "
            <script>
                alert('Berhasil Menghapus data');
                document.location.href = 'data_absen.php?sukses';
            </script>";
    }
    else{
        echo "
            <script>
                alert('Gagal Menghapus data');
                document.location.href = 'data_absen.php';
            </script>";
    }

?>