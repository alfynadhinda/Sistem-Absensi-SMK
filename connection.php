<?php
    // koneksi database
    $connect = mysqli_connect("localhost", "root", "", "siarota_db");

    function query($query){
        global $connect;

        $result = mysqli_query($connect, $query);
        $rows = [];
        while($row = mysqli_fetch_assoc($result)){
            $rows[] = $row;
        }
        return $rows;
    }

    function tambah_guru($data){
        global $connect;

        // mengambil data dari form
        $nip = htmlspecialchars($data['nik_guru']);
        $nama = htmlspecialchars($data['nama_guru']);
        $alamat = htmlspecialchars($data['alamat_guru']);
        $tlp = htmlspecialchars($data['tlp_guru']);
        $pass = htmlspecialchars($data['pwd_guru']);

        // query insert
        $insert = "INSERT INTO siarota_guru VALUES ('$nip','$nama','$alamat','$tlp','$pass')";
        mysqli_query($connect, $insert);

        return mysqli_affected_rows($connect);
    }

    function tambah_admin($data){
        global $connect;

        // mengambil data dari form
        $kd_admin = htmlspecialchars($data['kd_admin']);
        $nama_admin = htmlspecialchars($data['nama_admin']);
        $username_admin = htmlspecialchars($data['username_admin']);
        $tlp_admin = htmlspecialchars($data['tlp_admin']);
        $pass_admin = htmlspecialchars($data['pwd_admin']);

        // query insert
        $insert = "INSERT INTO siarota_admin VALUES ('$kd_admin','$username_admin','$nama_admin','$tlp_admin','$pass_admin')";
        mysqli_query($connect, $insert);

        return mysqli_affected_rows($connect);
    }

    function tambah_siswa($datasiswa){
        global $connect;

        // mengambil data dari form
        $nis_siswa = $_POST['nis_siswa'];
        $nama_siswa = $_POST['nama_siswa'];
        $alamat_siswa = $_POST['alamat_siswa'];
        $lahir_siswa = $_POST['lahir_siswa'];
        $kelamin_siswa = $_POST['kelamin_siswa'];
        $id_kelas = $_POST['kelas'];
        $pwd_siswa = $_POST['pwd_siswa'];

        // query insert
        $insert_siswa = "INSERT INTO siarota_siswa VALUES ('$nis_siswa','$nama_siswa','$alamat_siswa','$lahir_siswa','$kelamin_siswa','$id_kelas','$pwd_siswa')";
        mysqli_query($connect, $insert_siswa);

        return mysqli_affected_rows($connect);
    }

    function edit_guru($edit){
        global $connect;

        $nip  = $edit['nik_guru'];
        $nama = $edit['nama_guru'];
        $alamat = $edit['alamat_guru'];
        $tlp =    $edit['tlp_guru'];
        $pass =   $edit['pwd_guru'];

        $update_guru = "UPDATE siarota_guru 
                        SET 
                        nama_guru = '$nama', 
                        alamat_guru = '$alamat',
                        tlp_guru = '$tlp', 
                        pwd_guru = '$pass'
                        WHERE nik_guru= '$nip'";
        mysqli_query($connect, $update_guru);

     return mysqli_affected_rows($connect);
    }


    function absen($absen){
        global $connect;

        // mengambil data dari form
        $nis = $_POST['nis_siswa'];
        $mapel = $_POST['mapel'];
        $pertemuan = $_POST['pertemuan'];
        $keterangan = $_POST['keterangan'];
        $semester = $_POST['semester'];
        $waktu = $_POST ['waktu'];
        // query insert
        $tambah_absen = "INSERT INTO siarota_absen VALUES ('','$nis','$mapel','$pertemuan','$keterangan','$semester','$waktu')";
        mysqli_query($connect, $tambah_absen);

        return mysqli_affected_rows($connect);
    }

    function tambah_kelas($data){
        global $connect;

        $kd_kelas = $_POST['kd_kelas'];
        $nama_kelas = $_POST['nama_kelas'];
        $walikelas = $_POST['nik_guru'];

        $query = "INSERT INTO siarota_kelas VALUES ('$kd_kelas','$nama_kelas','$walikelas')";
        mysqli_query($connect,$query);
        return mysqli_affected_rows($connect);
    }

    function tambah_mapel($data){
        global $connect;

        $kd_mapel = $_POST['kd_mapel'];
        $nama_mapel = $_POST['nama_mapel'];

        $insert_mapel = "INSERT INTO siarota_mapel VALUES  
                  ('$kd_mapel','$nama_mapel')";
        mysqli_query($connect,$insert_mapel);
        return mysqli_affected_rows($connect);
    }

    function tambah_pengumuman($data){
        global $connect;

        $id_pengumuman = $_POST['id_pengumuman'];
        $pengumuman = $_POST['pengumuman'];

        $insert_pengumuman = "INSERT INTO siarota_pengumuman VALUES  
                  ('$id_pengumuman','$pengumuman')";
        mysqli_query($connect,$insert_pengumuman);
        return mysqli_affected_rows($connect);
    }
?>