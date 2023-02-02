<?php 
    require '../connection.php';
    $koneksi = mysqli_connect("localhost",'root','','siarota_db');
    session_start();
    if($_SESSION['status']!="login"){
        header("location:../index.php?belum login");
    }

    // Melihat data
    $siswa = mysqli_query($koneksi, "SELECT * FROM siarota_siswa");
    $kelas = mysqli_query($koneksi, "SELECT * FROM siarota_kelas");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    
    <!-- bootstrap -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous" />
    <!-- icon -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css"/>
    <!-- icon head -->
    <link rel="icon" href="../asset/img/logo.png" type="image/x-icon"/>
    <title>Data Siswa | SMK NEGERI 1 ROTA BAYAT</title>
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
                                <li><a class="dropdown-item" href="data_admin.php">Data Admin</a></li>
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
                                <li><a class="dropdown-item" href="data_kelas.php">Kelas</a></li>
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
                                <?php echo $_SESSION['nama_admin']; ?>
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
                <div class="col md-12 fw-bold fs-3 bi bi-mortarboard-fill"> Data Siswa</div>
            </div>
            <hr/>
            <!-- menampilkan nama user -->
            <div class="small fw-bold text-uppercase">Welcome <?php echo $_SESSION['nama_admin']; ?></div>
            <hr/>
            <!-- button tambah data menggunakan modal & trigger modal -->
            <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#exampleModal">
                <i class="bi bi-plus"></i>
                Tambah Data
            </button>
            
            <!-- modal -->
            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-scrollable">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Tambah Data Siswa</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">

                            <!-- Form tambah data -->
                            <?php
                            if(isset($_POST["submit"])){
                                //cek data berhasil ditambahkan
                                if (tambah_siswa($_POST) >0) {
                                    echo "
                                    <script>
                                    alert('Data Siswa Berhasil Ditambahkan');
                                    document.location='data_siswa.php?sukses';
                                    </script>";
                                }
                                else{
                                    echo "
                                    <script>
                                    alert('Data Siswa Gagal Ditambahkan');
                                    document.location='data_siswa.php?gagal';
                                    </script>";
                                }
                            }
                            ?>
                            <form action="" method="POST">
                                <div class="mb-3">
                                    <label for="nis_siswa" class="form-label">NIS Siswa</label>
                                    <input type="text" class="form-control" id="nis_siswa" name="nis_siswa" aria-describedby="nissiswa" placeholder="Nomor Induk Siswa">
                                </div>
                                <div class="mb-3">
                                    <label for="nama_siswa" class="form-label">Nama Lengkap</label>
                                    <input type="text" class="form-control" id="nama_siswa" name="nama_siswa" aria-describedby="namasiswa" placeholder="Nama Lengkap">
                                </div>
                                <div class="mb-3">
                                    <label for="tanggal_lahir" class="form-label">Tanggal Lahir</label>
                                    <input type="date" class="form-control" id="tanggal_lahir" name="lahir_siswa" aria-describedby="lahirguru">
                                </div>
                                <div class="mb-3">
                                    <label for="alamat_siswa" class="form-label">Alamat Lengkap</label>
                                    <input type="text" class="form-control" id="alamat_siswa" name="alamat_siswa" aria-describedby="alamat" placeholder="Alamat Lengkap siswa">
                                </div>
                                <div class="mb-3">
                                    <label for="kelamin_siswa" class="form-label">Jenis Kelamin</label>
                                    <select id="kelamin_siswa" name="kelamin_siswa" class="form-select" aria-label="Default select example">
                                        <option selected>Pilih Jenis Kelamin</option>
                                        <option value="Laki-Laki">Laki-Laki</option>
                                        <option value="Perempuan">Perempuan</option>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="kelas" class="form-label">Kelas Siswa</label>
                                    <select id="kelas" name="kelas" class="form-select" aria-label="Default select example">
                                        <option selected>Cari Kode</option>
                                            <?php
                                                foreach ($kelas as $row) :
                                            ?>
                                        <option value="<?= $row['kd_kelas']?>"><?=$row['nama_kelas']?></option>
                                            <?php
                                                endforeach
                                            ?>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="exampleInputPassword1" class="form-label">Password</label>
                                    <input type="password" class="form-control" id="exampleInputPassword1" name="pwd_siswa">
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
            <!-- Btn Tambah Data with Modal -->
            <!-- Tabel Guru -->
            <table class="table table-bordered table-striped table-hover">
            <thead class="text-center">
                <tr>
                    <th scope="col">No</th>
                    <th scope="col">NIS Siswa</th>
                    <th scope="col">Nama Siswa</th>
                    <th scope="col">Alamat</th>
                    <th scope="col">Tanggal Lahir</th>
                    <th scope="col">Jenis Kelamin</th>
                    <th scope="col">Password</th>
                    <th scope="col">Kelas Siswa</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
            <?php $i=1; ?>
            <?php
                foreach ($siswa as $row) :
                ?>
                <tr>
                    <th scope="row" class="text-center"><?= $i; ?></th>
                    <td><?= $row['nis_siswa']?></td>
                    <td><?= $row['nama_siswa']?></td>
                    <td><?= $row['alamat_siswa']?></td>
                    <td><?= $row['lahir_siswa']?></td>
                    <td><?= $row['kelamin_siswa']?></td>
                    <td><?= $row['pwd_siswa']?></td>
                    <td><?= $row['kelas']?></td>
                    <td>
                        <a href="edit_murid.php?nis_siswa=<?= $row['nis_siswa']?>" type="button" class="mb-1 btn btn-warning btn-sm">
                            <i class="bi bi-pencil-square"></i>
                            Ubah
                        </a>
                        <a href="hapus_data_murid.php?nis_siswa=<?= $row['nis_siswa']?>" onclick="return confirm('Apakah Anda ingin menghapus data ini ?')" type="button" class="btn btn-danger btn-sm">
                            <i class="bi bi-trash3-fill"></i>
                            Hapus
                        </a>
                    </td>
                </tr>
                    <?php $i++; ?>
                    <?php endforeach; ?>
                </tbody>
                </table>
        </div>
    </main>
    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>
</html>