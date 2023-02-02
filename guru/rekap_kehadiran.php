<?php 
    require '../connection.php';
    $koneksi = mysqli_connect("localhost",'root','','siarota_db');
    session_start();
    if($_SESSION['status']!="login"){
        header("location:../index.php?belum login");
    }

    // Melihat data
    // $kelas = mysqli_query($koneksi, "SELECT * FROM siarota_kelas");
    $absen = query ("SELECT siarota_absen.`nis_siswa`,siarota_absen.`mapel`,siarota_absen.`pertemuan`,siarota_absen.`keterangan`,siarota_absen.`waktu`,siarota_kelas.`nama_kelas`,siarota_siswa.`nama_siswa`,siarota_mapel.`nama_mapel` 
    FROM siarota_absen JOIN siarota_siswa ON siarota_absen.`nis_siswa`=siarota_siswa.`nis_siswa` 
    JOIN siarota_kelas ON siarota_siswa.`kelas` = siarota_kelas.`kd_kelas`
    JOIN siarota_mapel ON siarota_absen.`mapel`= siarota_mapel.`kd_mapel` ");
    $siswa = query ("SELECT * FROM siarota_siswa");
    $kelas = query("SELECT * FROM siarota_kelas");
    $mapel = query("SELECT * FROM siarota_mapel");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    
    <!-- bootstrap -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous" />
    <!-- icon -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.2/font/bootstrap-icons.css">
    <!-- icon head -->
    <link rel="icon" href="../asset/img/logo.png" type="image/x-icon"/>
    <title>Rekap Kehadiran | SMK NEGERI 1 ROTA BAYAT</title>
    <style>	
		body {
		    font-family: 'Century Gothic' ,'Poppins' ,Montserrat ,Georgia, times new roman, Times, Merriweather, Cambria, Times, serif;
		    background-color: #f4f4f4; 
		}
	</style>	
</head>
<body>
    <!-- navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary fixed-top">
        <div class="container-fluid">
            <!-- offcanvas trigger -->
            <a class="navbar-brand fw-bold text-uppercase me-auto" href="index.php">SMK NEGERI 1 ROTA BAYAT | </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" href="index.php">Dashboard</a>
                    </li>
                    <ul class="navbar-nav mb-2 mb-lg-0">
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Data Master
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                <li><a class="dropdown-item" href="data_guru.php">Data Guru</a></li>
                                <li><a class="dropdown-item" href="data_siswa.php">Data Siswa</a></li>
                            </ul>
                        </li>
                    </ul>
                    <ul class="navbar-nav mb-2 mb-lg-0">
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Akademik
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                <li><a class="dropdown-item" href="data_mapel.php">Mata Pelajaran</a></li>
                                <li><a class="dropdown-item" href="data_absen.php">Absensi</a></li>
                            </ul>
                        </li>
                    </ul>
                    <ul class="navbar-nav mb-2 mb-lg-0">
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Rekap Data
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                <li><a class="dropdown-item" href="rekap_kehadiran.php">Absensi Siswa</a></li>
                            </ul>
                        </li>
                    </ul>
                </ul>
                <ul class="navbar-nav mb-2 mb-lg-0 ms-auto">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="bi bi-person-circle"></i>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                            <div class="dropdown-item fw-bold text-uppercase ps-3">
                                <?php echo $_SESSION['nama_guru']; ?>
                            </div>
                            <li><a class="dropdown-item bi bi-person-fill" href="profil.php"> Profile</a></li>
                            <li><a class="dropdown-item bi bi-power" href="../exit.php"> Logout</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <!-- Offcanvas -->
    <main class="mt-5 pt-3">
      <div class="container-fluid">
        <div class="row">
          <div class="col md-12 fw-bold fs-3 mb-2">
            <i class="bi bi-file-earmark-spreadsheet"></i>
            Rekap Kehadiran
          </div>
        </div>
        
        <!-- Tabel Guru -->
        <div class="shadow p-3 mb-5 bg-body rounded">
        <form action="../laporan/cetak.php" method="POST">
          <div class="mb-3">
            <select id="semester" name="semester" class="form-select" aria-label="Default select example">
              <option selected>Pilih Semester</option>
              <option value="1">1</option>
              <option value="2">2</option>
            </select>
          </div>
          <div class="mb-3">
            <select id="mapel_siswa" name="mapel_siswa" class="form-select" aria-label="Default select example">
              <option selected>Cari Mata Pelajaran</option>
              <?php
                  foreach ($mapel as $row) :
                ?>
              <option value="<?= $row['kd_mapel']?>"><?=$row['nama_mapel']?></option>
                <?php
                  endforeach
                ?>
            </select>
          </div>
          
          <button type="submit" name="tampil" class="btn btn-outline-success">
            <i class="bi bi-printer"></i>
            Cetak
          </button>
        </form>
        </div>
        <!-- logic search -->
        <?php
          if( isset($_GET['tampil'] )){
            $smt = $_GET['semester'];
            $kls = $_GET['nama_mapel'];

            $absen = query("SELECT siarota_absen.`nis_siswa`,siarota_absen.`mapel`,siarota_absen.`pertemuan`,siarota_absen.`keterangan`,siarota_absen.`waktu`,siarota_kelas.`nama_kelas`,siarota_siswa.`nama_siswa`,siarota_mapel.`nama_mapel` 
            FROM siarota_absen JOIN siarota_siswa ON siarota_absen.`nis_siswa`=siarota_siswa.`nis_siswa` 
            JOIN siarota_kelas ON siarota_siswa.`kelas` = siarota_kelas.`kd_kelas`
            JOIN siarota_mapel ON siarota_absen.`mapel`= siarota_mapel.`kd_mapel`
            WHERE siarota_kelas.`kd_kelas` LIKE '%$kls' AND siarota_absen.`semester` LIKE '%$smt' ");
          
          }
           
          else{
            $absen = query("SELECT siarota_absen.`nis_siswa`,siarota_absen.`mapel`,siarota_absen.`pertemuan`,siarota_absen.`keterangan`,siarota_absen.`waktu`,siarota_kelas.`nama_kelas`,siarota_siswa.`nama_siswa`,siarota_mapel.`nama_mapel` 
            FROM siarota_absen JOIN siarota_siswa ON siarota_absen.`nis_siswa`=siarota_siswa.`nis_siswa` 
            JOIN siarota_kelas ON siarota_siswa.`kelas` = siarota_kelas.`kd_kelas`
            JOIN siarota_mapel ON siarota_absen.`mapel`= siarota_mapel.`kd_mapel` ");
          }
        ?>
        <!-- Form Search -->
        <?php
          if( isset($_POST['submit'] )){

            if (absen($_POST) >0) {
              echo "
                <script>
                alert('Absen Berhasil Ditambahkan');
                document.location='data_absen.php?status=sukses';
                </script>";
            }
            else{
              echo "
                <script>
                alert('Absen Gagal Ditambahkan');
                document.location='data_absen.php?status=gagal';
                </script>";
            }
          }
        ?>
        <!-- Tabel Guru -->
        <div class="shadow-sm p-3 mb-2 bg-body rounded mt-1 border rounded pb-0">
          <table class="table text-center">
            <tr>
              <th scope="col">No</th>
              <th scope="col">NIS Siswa</th>
              <th scope="col">Nama Siswa</th>
              <th scope="col">Kelas</th>
              <th scope="col">Keterangan</th>
            </tr>
            </thead>
            <tbody>
            <?php $i=1; ?>
            <?php
              foreach ($absen as $row) :
            ?>
              <tr>
                <th scope="row"><?= $i; ?></th>
                <td><?= $row['nis_siswa']?></td>
                <td><?= $row['nama_siswa']?></td>
                <td><?= $row['nama_kelas']?></td>
                <td><?= $row['keterangan']?></td>
              </tr>
              <?php $i++; ?>
              <?php endforeach; ?>
            </tbody>
          </table>
        </div>
      </div>
    </main>
    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>
</html>