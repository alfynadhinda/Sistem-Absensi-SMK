<?php
//menyertakan file fpdf, file fpdf.php di dalam folder FPDF yang diekstrak
include "fpdf.php";

//membuat objek baru bernama pdf dari class FPDF
//dan melakukan setting kertas l : landscape, A4 : ukuran kertas
$pdf = new FPDF('l','mm','A4');
// membuat halaman baru
$pdf->AddPage();
// menyetel font yang digunakan, font yang digunakan adalah helvetica, bold dengan ukuran 16
$pdf->SetFont('helvetica','B',16);
// Kop Surat
$pdf->Image('../asset/img/logo.png',10, 7, 20, 20);
$pdf->Cell(250,7,'DINAS PENDIDIKAN & KEBUDAYAAN DAERAH JAWA TENGAH',0,1,'C');
$pdf->Cell(250,7,'SMK NEGERI 1 ROTA BAYAT',0,1,'C');
$pdf->SetFont('helvetica','',10);
$pdf->Cell(250,7,'Jl. Cawas - Bayat No.Km. 1, Kebu, Beluk, Kec. Bayat, Kabupaten Klaten, Jawa Tengah 57462',0,1,'C');
$pdf->Cell(275,0.6,'','0','1','C',true);
//kopsurat
//judul surat
$pdf->Cell(250,7,'REKAPITULASI ABSENSI SISWA',0,1,'C');
$pdf->Cell(50,6,'Kode Mata Pelajaran',0,0);
$pdf->Cell(10,6,': ',0,0);
$pdf->Cell(20,6,$_POST['mapel_siswa'],0,0);
$pdf->Cell(10,7,'',0,1);
$pdf->Cell(50,6,'Semester',0,0);
$pdf->Cell(10,6,': ',0,0);
$pdf->Cell(20,6,$_POST['semester'],0,0);

// Memberikan space kebawah agar tidak terlalu rapat
$pdf->Cell(25,10,'',0,1);

$pdf->SetFont('helvetica','B',10);
$pdf->Cell(8,6,'NO',1,0,'C');
$pdf->Cell(45,6,'NO INDUK',1,0,'C');
$pdf->Cell(80,6,'NAMA SISWA',1,0,'C');
$pdf->Cell(30,6,'PERTEMUAN',1,0,'C');
$pdf->Cell(40,6,'MATA PELAJARAN',1,0,'C');
$pdf->Cell(48,6,'KETERANGAN',1,1,'C');
 
$pdf->SetFont('Arial','',10);
 
// koneksi ke database
$mysqli = new mysqli("localhost","root","","siarota_db");
$no = 1;

$tampil = mysqli_query($mysqli, "SELECT siarota_absen.`nis_siswa`,siarota_absen.`mapel`,siarota_absen.`pertemuan`,siarota_absen.`keterangan`,siarota_absen.`waktu`,siarota_kelas.`nama_kelas`,siarota_siswa.`nama_siswa`,siarota_mapel.`nama_mapel` 
                                FROM siarota_absen JOIN siarota_siswa ON siarota_absen.`nis_siswa`=siarota_siswa.`nis_siswa` 
                                JOIN siarota_kelas ON siarota_siswa.`kelas` = siarota_kelas.`kd_kelas`
                                JOIN siarota_mapel ON siarota_absen.`mapel`= siarota_mapel.`kd_mapel`
                                WHERE siarota_mapel.`kd_mapel`='$_POST[mapel_siswa]' AND siarota_absen.`semester`='$_POST[semester]'");

while ($hasil = mysqli_fetch_array($tampil)){
    $pdf->Cell(8,6,$no++,1,0,'C');
    $pdf->Cell(45,6,$hasil['nis_siswa'],1,0);
    $pdf->Cell(80,6,$hasil['nama_siswa'],1,0);
    $pdf->Cell(30,6,$hasil['pertemuan'],1,0,'C');
    $pdf->Cell(40,6,$hasil['nama_mapel'],1,0,'C');
    $pdf->Cell(48,6,$hasil['keterangan'],1,1,'C'); 
}

 
$pdf->Output();


?>