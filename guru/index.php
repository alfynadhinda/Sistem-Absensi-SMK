<?php 
    require '../connection.php';
    $koneksi = mysqli_connect("localhost",'root','','siarota_db');
    session_start();
    if($_SESSION['status']!="login"){
        header("location:../index.php?belum login");
    }

    // Melihat data
    $guru = mysqli_query($koneksi, "SELECT * FROM siarota_guru");
    $siswa = mysqli_query($koneksi, "SELECT * FROM siarota_siswa");
    $jumlah_guru = mysqli_num_rows($guru);
    $jumlah_siswa = mysqli_num_rows($siswa);
    $pengumuman = mysqli_query($koneksi,"SELECT * FROM siarota_pengumuman ORDER BY tanggal DESC");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    
    <!-- bootstrap -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous" />
    <!-- icon -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.2/font/bootstrap-icons.css"/>
    <!-- icon head -->
    <link rel="icon" href="../asset/img/logo.png" type="image/x-icon"/>
    <title>Dashboard | SMK NEGERI 1 ROTA BAYAT</title>
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
    <main class="mt-5 pt-4">
        <div class="container-fluid">
            <div class="row">
                <div class="col md-12 fw-bold fs-3 bi bi-speedometer2"> Dashboard</div>
            </div>
            <hr/>
            <!-- menampilkan nama user -->
            <div class="small fw-bold text-uppercase">Welcome <?php echo $_SESSION['nama_guru']; ?></div>
            <hr/>
            <!-- menampilkan jumlah siswa -->
            <div class="row pt-3 ps-4">    
                <div class="col-md-3">
                    <div class="card text-white bg-warning mb-3" style="max-width: 15rem;">
                        <div class="card-header text-center">Jumlah Siswa</div>
                        <div class="card-body">
                            <div class="row justify-content-start text-center">
                                <div class="col-5">
                                    <i class="bi bi-mortarboard-fill fs-1 opacity-75"></i>
                                </div>
                                <div class="col-5 fs-1"><?php echo $jumlah_siswa; ?></div>
                            </div>
                        </div>
                    </div>
                </div>
                
             <!-- menampilkan jumlah guru -->
                <div class="col-md-3">
                    <div class="card text-white bg-success mb-3" style="max-width: 15rem;">
                        <div class="card-header text-center">Jumlah Guru</div>
                        <div class="card-body">
                            <div class="row justify-content-start text-center">
                                <div class="col-5">
                                    <i class="bi bi-person-badge-fill fs-1 opacity-75"></i>
                                </div>
                                <div class="col-5 fs-1"><?php echo $jumlah_guru; ?></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container-fluid">
            <hr/>
            <!-- menampilkan nama user -->
            <div class="small fw-bold text-uppercase text-center">Pengumuman</div>
            <hr/>
            <!-- Tabel Admin -->
            <table class="table table-bordered table-striped table-hover">
                <thead class="text-center align-middle">
                <tr>
                    <th scope="col">No</th>
                    <th scope="col">Pengumuman</th>
                    <th scope="col">Update terakhir</th>
                    <th scope="col">Action</th>
                </tr>
                </thead>
                <tbody>
                    <?php $i=1; ?>
                    <?php
                    foreach ($pengumuman as $row) :
                    ?>
                    <tr class="align-middle">
                    <th scope="row" class="text-center"><?= $i; ?></th>
                    <td><?= $row['pengumuman'] ?></td>
                    <td class="text-center"><?= $row['tanggal'] ?></td>
                    <td class="text-center">
                        <a href="hapus_pengumuman.php?id_pengumuman=<?= $row['id_pengumuman']?>" onclick="return confirm('Apakah Anda ingin menghapus data ini ?')" type="button" class="btn btn-danger btn-sm">
                        <i class="bi bi-trash3-fill"></i>
                        Hapus
                        </a>
                    </td>
                    </tr>
                    <?php $i++; ?>
                    <?php endforeach; ?>
                </tbody>
            </table>
            <!-- Btn Tambah Data with Modal -->
            <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#exampleModal">
                <i class="bi bi-plus"></i>
                Tambah Pengumuman
            </button>
            <!-- modal -->
            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-scrollable">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Tambah Pengumuman</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">

                            <!-- Form tambah data -->
                            <?php
                            if(isset($_POST["submit"])){
                                //cek data berhasil ditambahkan
                                if (tambah_pengumuman($_POST) >0) {
                                    echo "
                                    <script>
                                    alert('Admin Berhasil Ditambahkan');
                                    document.location='index.php?sukses';
                                    </script>";
                                }
                                else{
                                    echo "
                                    <script>
                                    alert('Admin Gagal Ditambahkan');
                                    document.location='index.php?gagal';
                                    </script>";
                                }
                            }
                            ?>
                            <form action="" method="post">
                                <div class="mb-3">
                                    <label for="id_pengumuman" class="form-label">ID Pengumuman</label>
                                    <input type="text" class="form-control" id="id_pengumuman" name="id_pengumuman" aria-describedby="id_pengumuman" placeholder="Contoh : Fis01" required>
                                </div>
                                <div class="mb-3">
                                    <label for="Pengumuman" class="form-label">Pengumuman</label>
                                    <input type="text" class="form-control" id="pengumuman" name="pengumuman" aria-describedby="pengumuman" placeholder="Tulis Pengumuman" required>
                                </div>
                                
                                <button type="submit" name="submit" class="btn btn-primary">Submit</button>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                        </div>
                    </div>
                </div>
            </div>
    </main>
    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>
</html>