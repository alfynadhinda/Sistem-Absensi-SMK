<?php 
    require '../connection.php';
    $koneksi = mysqli_connect("localhost",'root','','siarota_db');
    session_start();
    if($_SESSION['status']!="login"){
        header("location:../index.php?belum login");
    }

    // Mengambil data dari tabel siswa
    
    $absen = query("SELECT siarota_absen.`nis_siswa`,siarota_absen.`mapel`,siarota_absen.`pertemuan`,siarota_absen.`keterangan`,siarota_absen.`waktu`,siarota_kelas.`nama_kelas`,siarota_siswa.`nama_siswa`,siarota_mapel.`nama_mapel` 
    FROM siarota_absen JOIN siarota_siswa ON siarota_absen.`nis_siswa`=siarota_siswa.`nis_siswa` 
    JOIN siarota_kelas ON siarota_siswa.`kelas` = siarota_kelas.`kd_kelas`
    JOIN siarota_mapel ON siarota_absen.`mapel`= siarota_mapel.`kd_mapel`");
    $siswa = query("SELECT * FROM siarota_siswa");
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
    <title>Data Absen | SMK NEGERI 1 ROTA BAYAT</title>
    <style>	
		body {
		    font-family: 'Century Gothic' ,'Poppins' ,Montserrat ,Georgia, times new roman, Times, Merriweather, Cambria, Times, serif;
		    background-color: #f4f4f4; 
		}
        .bdr {
            border-radius: 6px;
            overflow: hidden;
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
    <main class="mt-5 pt-4">
        <div class="container-fluid">
            <div class="row">
                <div class="col md-12 fw-bold fs-3 bi bi-journal-check"> Daftar Kehadiran</div>
            </div>
            <hr/>
            <!-- menampilkan nama user -->
            <div class="small fw-bold text-uppercase">Welcome <?php echo $_SESSION['nama_guru']; ?></div>
            <hr/>
            <!-- button tambah data menggunakan modal & trigger modal -->
            <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#exampleModal">
                <i class="bi bi-plus"></i>
                Tambah Absensi
            </button>
            <div class="shadow p-3 mt-2 mb-2 bg-body rounded">
                <form method="GET">
                    <div class="mb-2 col-5">
                    <select id="semester" name="semester" class="form-select" aria-label="Default select example">
                        <option selected>Pilih Semester</option>
                        <option value="1">1</option>
                        <option value="2">2</option>
                    </select>
                    </div>
                    <div class="mb-1 col-5">
                        <select id="kelas_siswa" name="kelas_siswa" class="form-select" aria-label="Default select example">
                            <option selected>Cari Kode Kelas</option>
                            <?php
                                foreach ($mapel as $row) :
                            ?>
                            <option value="<?= $row['kd_mapel']?>"><?=$row['nama_mapel']?></option>
                            <?php
                                endforeach
                            ?>
                        </select>
                    </div>
                    <button type="submit" name="tampil" class="btn btn-outline-secondary my-0 mb-2">
                    Tampil
                    </button>
                </form>
            </div>
            <?php
                if( isset($_GET['tampil'] )){
                    
                    
                    $absen = query("SELECT siarota_absen.`nis_siswa`,siarota_absen.`mapel`,siarota_absen.`pertemuan`,siarota_absen.`keterangan`,siarota_absen.`waktu`,siarota_kelas.`nama_kelas`,siarota_siswa.`nama_siswa`,siarota_mapel.`nama_mapel` 
                    FROM siarota_absen JOIN siarota_siswa ON siarota_absen.`nis_siswa`=siarota_siswa.`nis_siswa` 
                    JOIN siarota_kelas ON siarota_siswa.`kelas` = siarota_kelas.`kd_kelas`
                    JOIN siarota_mapel ON siarota_absen.`mapel`= siarota_mapel.`kd_mapel`
                    WHERE siarota_mapel.`kd_mapel`='$_GET[kelas_siswa]' AND siarota_absen.`semester`='$_GET[semester]'");
                }
                
                else{
                    $absen = query("SELECT siarota_absen.`nis_siswa`,siarota_absen.`mapel`,siarota_absen.`pertemuan`,siarota_absen.`keterangan`,siarota_absen.`waktu`,siarota_kelas.`nama_kelas`,siarota_siswa.`nama_siswa`,siarota_mapel.`nama_mapel` 
                    FROM siarota_absen JOIN siarota_siswa ON siarota_absen.`nis_siswa`=siarota_siswa.`nis_siswa` 
                    JOIN siarota_kelas ON siarota_siswa.`kelas` = siarota_kelas.`kd_kelas`
                    JOIN siarota_mapel ON siarota_absen.`mapel`= siarota_mapel.`kd_mapel`");
                }
            ?>
                <!-- Logic search -->
                
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
            <!-- Modal -->
            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-scrollable">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="">Tambah Absensi</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <!-- Form tambah data -->
                            <form method="POST">
                                <div class="mb-3">
                                    <label for="nis_siswa" class="form-label">NIS Siswa</label>
                                    <select id="nis_siswa" name="nis_siswa" class="form-select" aria-label="Default select example">
                                    <option selected>NIS Siswa</option>
                                    <?php
                                        foreach ($siswa as $row) :
                                    ?>
                                    <option value="<?= $row['nis_siswa']?>"><?= $row['nis_siswa']?>-<?= $row['nama_siswa']?></option>
                                    <?php
                                        endforeach
                                    ?>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="mapel" class="form-label">Mata Pelajaran </label>
                                    <select id="mapel" name="mapel" class="form-select" aria-label="Default select example">
                                    <option selected>Pilih Mata Pelajaran</option>
                                    <?php
                                        foreach ($mapel as $row):
                                    ?>
                                    <option value="<?=$row['kd_mapel']?>"><?= $row['kd_mapel']?>-<?= $row['nama_mapel']?></option>
                                    <?php
                                        endforeach
                                    ?>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="waktu" class="form-label">Waktu </label>
                                    <?php
                                        date_default_timezone_set('Asia/Jakarta');
                                        $jam=date("H:i:s");
                                    ?>
                                    <input type="time" readonly class="form-control" id="waktu" name="waktu" value="<?=$jam?>">
                                </div>
                                <div class="mb-3">
                                    <label for="pertemuan" class="form-label">Pertemuan </label>
                                    <input type="text" class="form-control" id="pertemuan" name="pertemuan" aria-describedby="namamapel" placeholder="Contoh : 1">
                                </div>
                                <div class="mb-3">
                                    <label for="keterangan" class="form-label">Keterangan</label>
                                    <select id="keterangan" name="keterangan" class="form-select" aria-label="Default select example">
                                    <option selected>Pilih Keterangan</option>
                                    <option value="Hadir">Hadir</option>
                                    <option value="Izin">Izin</option>
                                    <option value="Sakit">Sakit</option>
                                    <option value="Alpa">Alpa</option>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="semester" class="form-label">Semester </label>
                                    <input type="text" class="form-control" id="semester" name="semester" aria-describedby="semester" placeholder="Contoh : 1">
                                </div>
                                <button type="submit" name="submit" class="btn btn-primary mt-1">Submit</button>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Btn Tambah Data with Modal -->
            <!-- Tabel Guru -->
            <div class="shadow-sm p-3 mt-2 bg-body rounded mt-1 border rounded">
                <table class="table table-hover">
                    <thead>
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">NIS Siswa</th>
                        <th scope="col">Nama Siswa</th>
                        <th scope="col">Mata Pelajaran</th>
                        <th scope="col">Waktu Absen</th>
                        <th scope="col">Kelas</th>
                        <th scope="col">Pertemuan</th>
                        <th scope="col">Keterangan</th>
                        <th scope="col">Action</th>
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
                        <td><?= $row['nama_mapel']?></td>
                        <td class="text-center align-middle"><?= $row['waktu']?></td>
                        <td class="text-center align-middle"><?= $row['nama_kelas']?></td>
                        <td class="text-center align-middle"><?= $row['pertemuan']?></td>
                        <td class="text-center align-middle"><?= $row['keterangan']?></td>
                        <td>
                        <a href="edit_absen.php?nis_siswa=<?= $row['nis_siswa']?>" type="button" class="btn btn-warning btn-sm">
                            <i class="bi bi-pencil-square"></i>
                            Ubah
                        </a>
                        </td>
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