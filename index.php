<?php
$getfile = file_get_contents('data/anggota.json');
$jsonfile = json_decode($getfile);

// fungsi rupiah 
function rupiah ($angka) {
  $hasil =  number_format($angka, 0, "", ".");
  return $hasil;
}

    
?>
<!DOCTYPE html>
<html>
<head>
 <meta charset="utf-8">
 <meta name="viewport" content="width=device-width, initial-scale=1.0">
 <title>Tambah Data Anggota</title>
 <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">

</head>
<body>
<br><br>
<div class="container">
 <div class="jumbotron">
  <h3>Data Simpanan Anggota Per 31 Desember 2023</h3>      
  <p>Anggota Aktif</p>      
 </div>
</div>
<div class="container">
 <div class="btn-toolbar">
  <a class="btn btn-primary" href="simpan.php"><i class="icon-plus"></i> Tambah Data</a>
  <div class="btn-group"> </div>
 </div>
</div>
<br>
<br>
<div class="container">
 <div class ="row">
  <div class="col-md-9">
   <table class="table table-striped table-bordered table-hover">
    <tr>
     <th>No.</th>
     <th>Location</th>
     <th>No. Surat</th>
     <th>Nama</th>
     <th>Pokok</th>
     <th>Wajib</th>
     <th>Jumlah</th>
     <th>Action</th>
    </tr>  
    <?php $no=0;foreach ($jsonfile->anggota as $index => $obj): $no++;  
        $pokok = $obj->pokok;
        $wajib = $obj->wajib;
        $jumlah = $pokok + $wajib;
    ?>
    <tr>
     <td><?php echo $no; ?></td>
     <td><?php echo $obj->lokasi; ?></td>
     <td><?php echo $obj->surat; ?></td>
     <td><?php echo $obj->nama; ?></td>
     <td><?php echo rupiah ($obj->pokok); ?></td>
     <td><?php echo rupiah ($obj->wajib); ?></td>
     <td><?php echo rupiah ($jumlah); ?></td>
     <td>
      <a class="btn btn-xs btn-primary" href="simpok.php?id=<?php echo $index; ?>">Kirim</a>
      
     </td>
    </tr>
    <?php endforeach; ?>
   </table>
  </div> 
 </div>
</div>
</body>
</html>