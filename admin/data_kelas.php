<?php 
    require '../connection.php';
    $koneksi = mysqli_connect("localhost",'root','','siarota_db');
    session_start();
    if($_SESSION['status']!="login"){
        header("location:../index.php?belum login");
    }

    $kelas = query ("SELECT * FROM siarota_kelas");
    $guru = query("SELECT * FROM siarota_guru");
    $kelass = query ("SELECT siarota_kelas.`kd_kelas`, siarota_kelas.`nama_kelas`, siarota_kelas.`wali_kelas`,
                    siarota_guru.`nik_guru`, siarota_guru.`nama_guru`
                    FROM siarota_kelas
                    JOIN siarota_guru on siarota_kelas.`wali_kelas` = siarota_guru.`nik_guru`");
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
    <title>Data Kelas | SMK NEGERI 1 ROTA BAYAT</title>
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
    <main class="mt-5 pt-3">
      <div class="container-fluid">
        <div class="row">
          <div class="col md-12 fw-bold fs-3 bi bi-easel"> Daftar Kelas</div>
        </div>
        <hr/>
        <!-- menampilkan nama user -->
        <div class="small fw-bold text-uppercase">Welcome <?php echo $_SESSION['nama_admin']; ?></div>
        <hr/>
        <!-- Btn Tambah data with Modal-->
        <!-- Button trigger modal -->
        <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#exampleModal">
        <i class="bi bi-plus"></i>
          Tambah Data
        </button>

        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog modal-dialog-scrollable">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Data Kelas</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                <!-- Form tambah data -->
                <?php
                if(isset($_POST["submit"])){
                  //cekdata berhasil ditambahkan
                  if (tambah_kelas($_POST) >0) {
                    echo "
                      <script>
                      alert('Kelas Berhasil Ditambahkan');
                      document.location='data_kelas.php?status=sukses';
                      </script>";
                  }
                  else{
                    echo "
                      <script>
                      alert(Kelas Gagal Ditambahkan');
                      document.location='data_kelas.php?status=gagal';
                      </script>";
                  }
                }
                ?>
                <form action=" " method="POST">
                  <div class="mb-3">
                    <label for="id_kelas" class="form-label">Kode Kelas</label>
                    <input type="text" class="form-control" id="id_kelas" name="kd_kelas" aria-describedby="idkelas" placeholder="Kode Kelas">
                  </div>
                  <div class="mb-3">
                    <label for="nama_kelas" class="form-label">Nama Kelas</label>
                    <input type="text" class="form-control" id="nama_kelas" name="nama_kelas" aria-describedby="namakelas" placeholder="Nama Kelas">
                  </div>
                  <div class="mb-3">
                    <label for="nik_guru" class="form-label">Wali Kelas</label>
                    <select id="nik_guru" name="nik_guru" class="form-select" name="walikelas" aria-label="Default select example">
                    <option selected>Nama Guru</option>
                    <?php
                      foreach ($guru as $row) :
                    ?>
                    <option value="<?= $row['nik_guru']?>"><?= $row['nama_guru']?></option>
                    <?php
                    endforeach
                    ?>
                  </select>
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
        <table class="table text-center align-middle table-bordered table-striped table-hover">
          <tr>
            <th scope="col">No</th>
            <!-- <th scope="col">Kode Kelas</th> -->
            <th scope="col">Nama Kelas</th>
            <th scope="col">Wali Kelas</th>
            <th scope="col">Action</th>
          </tr>
          </thead>
          <tbody>
          <?php $i=1; ?>
          <?php
             foreach ($kelass as $row) :
          ?>
            <tr>
              <th scope="row"><?= $i; ?></th>
              <!-- <td><?= $row['kd_kelas']?></td> -->
              <td><?= $row['nama_kelas']?></td>
              <td><?= $row['nama_guru']?></td>
              <td>
                  <a href="edit_kelas.php?kode_kelas=<?= $row['kd_kelas']?>" type="button" class="btn btn-warning btn-sm">
                    <i class="bi bi-pencil-square"></i>
                    Ubah
                  </a>
                  <a href="hapus_kelas.php?kode_kelas=<?= $row['kd_kelas']?>"  onclick="return confirm('Apakah Anda ingin menghapus data ini ?')" type="button" class="btn btn-danger btn-sm">
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