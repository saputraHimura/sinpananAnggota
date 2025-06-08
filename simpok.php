<?php
if (isset($_GET["id"])) {
    $id = (int) $_GET["id"];
    $getfile = file_get_contents('data/anggota.json');
    $jsonfile = json_decode($getfile, true);
    $jsonfile = $jsonfile["anggota"];
    $jsonfile = $jsonfile[$id];
}

if (isset($_POST["id"])) {
    $id = (int) $_POST["id"];
    $getfile = file_get_contents('data/anggota.json');
    $all = json_decode($getfile, true);
    $jsonfile = $all["anggota"];
    $jsonfile = $jsonfile[$id];

    $post["surat"] = isset($_POST["surat"]) ? $_POST["surat"] : "";
    $post["nama"] = isset($_POST["nama"]) ? $_POST["nama"] : "";
    $post["pokok"] = isset($_POST["pokok"]) ? $_POST["pokok"] : "";
    $post["wajib"] = isset($_POST["wajib"]) ? $_POST["wajib"] : "";

    if ($jsonfile) {
        unset($all["anggota"][$id]);
        $all["anggota"][$id] = $post;
        $all["anggota"] = array_values($all["anggota"]);
        file_put_contents("data/anggota.json", json_encode($all));
    }
   
}
// fungsi rupiah 
function rupiah ($angka) {
  $hasil =  number_format($angka, 0, "", ".");
  return $hasil;
}
// fungsi terbilang 
function penyebut($nilai) {
  $nilai = abs($nilai);
  $huruf = array("", "satu", "dua", "tiga", "empat", "lima", "enam", "tujuh", "delapan", "sembilan", "sepuluh", "sebelas");
  $temp = "";
  if ($nilai < 12) {
    $temp = " ". $huruf[$nilai];
  } else if ($nilai <20) {
    $temp = penyebut($nilai - 10). " belas";
  } else if ($nilai < 100) {
    $temp = penyebut($nilai/10)." puluh". penyebut($nilai % 10);
  } else if ($nilai < 200) {
    $temp = " seratus" . penyebut($nilai - 100);
  } else if ($nilai < 1000) {
    $temp = penyebut($nilai/100) . " ratus" . penyebut($nilai % 100);
  } else if ($nilai < 2000) {
    $temp = " seribu" . penyebut($nilai - 1000);
  } else if ($nilai < 1000000) {
    $temp = penyebut($nilai/1000) . " ribu" . penyebut($nilai % 1000);
  } else if ($nilai < 1000000000) {
    $temp = penyebut($nilai/1000000) . " juta" . penyebut($nilai % 1000000);
  } else if ($nilai < 1000000000000) {
    $temp = penyebut($nilai/1000000000) . " milyar" . penyebut(fmod($nilai,1000000000));
  } else if ($nilai < 1000000000000000) {
    $temp = penyebut($nilai/1000000000000) . " trilyun" . penyebut(fmod($nilai,1000000000000));
  }     
  return $temp;
}

function terbilang($nilai) {
  if($nilai<0) {
    $hasil = "minus ". trim(penyebut($nilai));
  } else {
    $hasil = trim(penyebut($nilai));
  }         
  return $hasil;
}
?>


<!doctype html>
  <html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Posisi Simpanan Anggota Kopkar BYB Des'23</title>
    <link rel="stylesheet" href="css/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
  </head>
  <body>
    <header>
      <div class="container mt-1">
        <img id="logo" src="img/logo.png" alt="" >
      </div>
    </header>
    <div class="container">
     <!-- <hr class="garis1"> -->
     <br>
     <div class="row ms-4">
        <?php if (isset($_GET["id"])): 
          $pokok = $jsonfile["pokok"];
          $wajib = $jsonfile["wajib"];
          $jumlah = $pokok + $wajib;

          ?>
       <div class="row">
        <div class="col">
           <input type="hidden" value="<?php echo $id; ?>" name="id"/>
          <p class="text-start">Nomor : <span> <?= $jsonfile["surat"]; ?> </span>/KOPKAR-BYB/I/2024</p>
        </div>
        <div class="col">
          <p class="text-end">Jakarta, 27 Mei 2024</p>
        </div>
      </div>
      <div class="row">
        <p class="lh-1">Kepada Yth.</p>
        <p class="lh-1">Bapak/Ibu</p>
        <p class="fw-bold lh-1">Anggota Kopkar BYB</p>
        <p class="fw-bold lh-1">an. <span><?= $jsonfile["nama"]; ?> </span></p>
        <p class="fw-bold lh-1">di</p>
        <p class="fw-bold lh-1 ms-2">Tempat</p>
      </div>
      <div class="row">
        <p>Perihal &nbsp&nbsp: &nbsp&nbsp&nbsp<span class="text-decoration-underline fw-bold">Posisi Simpanan Pokok & Wajib di Kopkar BYB per 31 Desember 2023</span></p>
      </div>
      <div class="row mt-3">
        <p>Dengan Hormat,</p>
      </div>
      <div class="row">
        <p class="text-break">Dengan ini disampaikan Posisi Simpanan Pokok dan Wajib Bapak/Ibu di Kopkar BYB per tanggal 31 Desember 2023 yaitu sebagai berikut :</p>
      </div>
      <!-- nominal simpanan -->
      <table class="table table-borderless">
        <tbody>
          <tr>
            <th scope="row">1</th>
            <td>Simpanan Pokok</td>
            <td>Rp</td>
            <td><?= rupiah ($jsonfile["pokok"]); ?></td>

          </tr>
          <tr>
            <th scope="row">2</th>
            <td>Simpanan Wajib</td>
            <td>Rp</td>
            <td><?= rupiah ($jsonfile["wajib"]);; ?></td>
          </tr>
          <tr>
            <th scope="row"></th>
            <th scope="col">Total</th>
            <th scope="col">Rp</th>
            <th scope="col"><?= rupiah ($jumlah); ?> </th>
          </tr>
        </tbody>
      </table>
      <!-- end -->
      <!-- terbilang -->
      <!-- <table class="table table-borderless">
       <thead>
        <tr>
          <th scope="col"></th>
        </tr>
      </thead>
    </table> -->
    <!-- end -->
     <?php endif; ?> 
    <p>Demikian disampaikan untuk menjadi periksa</p>
    <p></p>
    <p></p>
    <div class="row">
      <p class="fw-bold text-center lh-1">KOPERASI KARYAWAN</p>
      <P class="fw-bold text-center lh-1">BANK YUDHA BHAKTI</P>
    </div>
    <!-- tandatangan pengurus -->
    <div class="d-flex justify-content-evenly">
      <img src="img/qr-code-pak ahmad.png" width="80px">
      <img src="img/qr-code-pak puji.png" width="80px">
    </div>
    <div class="d-flex justify-content-evenly">
      <span class="fw-bold">Ahmad Syafardi</span>
      <span class="fw-bold"> Puji Purnomo</span>
    </div>
    <div class="d-flex justify-content-evenly">
      <span >Ketua</span>
      <span>&nbsp &nbsp &nbsp &nbsp Bendahara</span>
    </div>
    <!-- end -->
    <br><br>
    <!-- Footer -->
    <footer class="text-center text-lg-start bg-white text-muted">
      <div class="text-sm-center p-4" style="background-color: rgba(0, 0, 0, 0.025);">
        Gedung Gozco Jl. Raya Pasar Minggu Kav.32 Jakarta Selatan email :
        <a class="text-reset fw-bold" href="">kopkarbyb@gmail.com</a>
      </div>
    </footer>
    <!-- end -->
    <div class="d-grid gap-2 col-6 mx-auto mt-4">
      <button class="btn btn-primary" type="button" onclick="cetak()">CETAK ATAU UNDUH</button>
    </div>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
<script>
  function cetak() {
    window.print();
  }
</script>
</body>
</html>