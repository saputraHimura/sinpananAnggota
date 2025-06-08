<?php 
    if ( !empty($_POST)) { 
        
        $lokasi = $_POST['lokasi'];
        $surat = $_POST['surat'];
        $nama = $_POST['nama'];
        $pokok = $_POST['pokok'];
        $wajib = $_POST['wajib'];
        
      
  $file = file_get_contents('data/anggota.json');
  $data = json_decode($file, true);
  unset($_POST["add"]);
  $data["anggota"] = array_values($data["anggota"]);
  array_push($data["anggota"], $_POST);
  file_put_contents("data/anggota.json", json_encode($data));
  header("Location: index.php");
    }

  // fungsi rupiah 
  function rupiah ($angka) {
  $hasil =  number_format($angka, 0, "", ".");
  return $hasil;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
 <meta charset="utf-8">
 <meta name="viewport" content="width=device-width, initial-scale=1.0">
 <title>Tambah Data Anggota Kopkar BYB</title>
 <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">

 <!-- <link rel="stylesheet" href="assets/css/bootstrap.min.css"> -->
 <style type="text/css">
 .navbar-default {
  background-color: #3b5998;
  font-size:18px;
  color:#ffffff;
 }
 </style>
</head>
<body>
<nav class="navbar navbar-default">
  <div class="container">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>                        
      </button>
      <h4>Tambah Data Anggota Kopkar BYB</h4>
    </div>
    <div class="collapse navbar-collapse" id="myNavbar">
    </div>
  </div>
</nav>
<!-- /.navbar -->
<div class="container">
  <h4 class="text-center">Input Anggota Kopkar BYB</h4>
    <br>
    <div class="row">
      <div class="col">
        <form method="POST" action="">
          <div class="row mb-3">
            <label for="lokasi" class="col-sm-2 col-form-label">Lokasi</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" id="lokasi" name="lokasi">
            </div>
          </div>
          <div class="row mb-3">
            <label for="surat" class="col-sm-2 col-form-label">Nomor Surat</label>
            <div class="col-sm-10">
              <input type="number" class="form-control" id="surat" name="surat">
            </div>
          </div>
           <div class="row mb-3">
            <label for="nama" class="col-sm-2 col-form-label">Nama</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" id="nama" name="nama">
            </div>
          </div>
           <div class="row mb-3">
            <label for="pokok" class="col-sm-2 col-form-label">Simpanan Pokok</label>
            <div class="col-sm-10">
              <input type="number" class="form-control" id="pokok" name="pokok" value="50000">
            </div>
          </div>
           <div class="row mb-3">
            <label for="wajib" class="col-sm-2 col-form-label">Simpanan Wajib</label>
            <div class="col-sm-10">
              <input type="number" class="form-control" id="wajib" name="wajib">
            </div>
          </div>
          
          <button type="submit" class="btn btn-primary" id="simpan">Simpan</button>
          <a class="btn btn btn-default" href="index.php">Back</a>
        </form>
      </div>
    </div>       
</div>
</body>
</html>