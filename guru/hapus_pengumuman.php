<?php

    require "../connection.php";

    $id_pengumuman = $_GET['id_pengumuman'];

	$hapus = mysqli_query($connect,"DELETE FROM siarota_pengumuman WHERE id_pengumuman ='$id_pengumuman'");
    if($hapus){
        echo "
            <script>
                alert('Berhasil Menghapus pengumuman');
                document.location.href = 'index.php?sukses';
            </script>";
    }
    else{
        echo "
            <script>
                alert('Gagal Menghapus pengumuman');
                document.location.href = 'index.php';
            </script>";
    }

?>