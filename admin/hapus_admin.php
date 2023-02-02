<?php

    require "../connection.php";

    $kd_admin = $_GET['kd_admin'];

	$hapus = mysqli_query($connect,"DELETE FROM siarota_admin WHERE kd_admin ='$kd_admin'");
    if($hapus){
        echo "
            <script>
                alert('Berhasil Menghapus data');
                document.location.href = 'data_admin.php?sukses';
            </script>";
    }
    else{
        echo "
            <script>
                alert('Gagal Menghapus data');
                document.location.href = 'data_admin.php';
            </script>";
    }

?>