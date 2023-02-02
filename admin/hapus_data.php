<?php

    require "../connection.php";

    $nip = $_GET['nik_guru'];
    
	$hapus = mysqli_query($connect,"DELETE FROM siarota_guru WHERE nik_guru ='$nip'");
    if($hapus){
        echo "
            <script>
                alert('Berhasil Menghapus data');
                document.location.href = 'data_guru.php?sukses';
            </script>";
    }
    else{
        echo "
            <script>
                alert('Gagal Menghapus data');
                document.location.href = 'data_guru.php';
            </script>";
    }

?>