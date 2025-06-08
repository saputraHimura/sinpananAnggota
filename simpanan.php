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
 <title>Data Anggota</title>
 <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
 <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">

</head>
<body>
  <div class="container">
      <img src="img/logo.png" width="250" height="60">
  </div>
<br>
<div class="container">
 <div class="jumbotron">
  <h3>Data Simpanan Anggota Per 31 Desember 2023</h3>      
  <h5>Anggota Aktif</h5>      
 </div>
</div>

<?php $jml_pokok = 0; ?>
<?php $jml_wajib = 0; ?>
<?php $total = 0; ?>

    <?php $no=0;foreach ($jsonfile->anggota as $index => $obj): ;  
        $pokok = $obj->pokok;
        $wajib = $obj->wajib;
        $jumlah = $pokok + $wajib;
        $jml_pokok = $jml_pokok + $pokok;
        $jml_wajib = $jml_wajib + $wajib;
        $total = $total + $jumlah;
      
    ?>
    <?php endforeach; ?>
    <br>
<div class="container">
  <div class="row">
   <div class="col-md-4">
      <div class="card">
    <div class="card-body">
    <h5 class="card-title">Jumlah Simpanan Pokok</h5>
    <h3 class="card-text">Rp . <?php echo rupiah ($jml_pokok); ?>,-</h3>  
    </div>
   </div>
   </div> 
   <div class="col-md-4">
      <div class="card">
    <div class="card-body">
    <h5 class="card-title">Jumlah Simpanan Wajib</h5>
    <h3 class="card-text">Rp . <?php echo rupiah ($jml_wajib); ?>,-</h3>  
    </div>
   </div>
   </div> 
   <div class="col-md-4">
      <div class="card">
    <div class="card-body">
    <h5 class="card-title">Total (Wajib + Pokok)</h5>
    <h3 class="card-text">Rp . <?php echo rupiah ($total); ?>,-</h3>  
    </div>
   </div>
   </div> 
  </div>

 </div>



<br>
<br>
<div class="container">
 <div class ="row">
  <div class="col-md-12">
   <table class="table table-striped table-bordered table-hover">
    <tr>
     <th>No.</th>
     <th>Location</th>
     <th>No. Surat</th>
     <th>Nama</th>
     <th>Pokok</th>
     <th>Wajib</th>
     <th>Jumlah</th>
    </tr>  
    <?php $jml_pokok = 0; ?>
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
    </tr>
    <?php endforeach; ?>
   </table>
  </div> 
 </div>
</div>
</body>
</html>