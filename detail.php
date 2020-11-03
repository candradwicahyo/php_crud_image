<?php

require 'function/functions.php';

$data['judul'] = 'Halaman detail data';
$id = trim(rtrim(mysqli_real_escape_string($conn, $_GET['id'])));
$row = query("SELECT * FROM data WHERE id = '$id'")[0];

?>

<!DOCTYPE html>
<html>

<head>

  <!-- meta -->
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <!-- end of meta -->

  <title><?= $data['judul']; ?></title>

  <!-- css -->
  <link rel="stylesheet" href="assets/css/style.css">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.1/css/all.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/8.11.8/sweetalert2.min.css">
  <link href="https://fonts.googleapis.com/css2?family=Grenze+Gotisch:wght@600&display=swap" rel="stylesheet">
  <!-- end of css -->

</head>
<body>

<div class="container mt-4 mb-4">
  <div class="row">
    <div class="col-md-8">

      <div class="card shadow rounded">
        <img class="card-img-top" src="assets/image/<?= $row['gambar']; ?>" alt="Card image cap">
        <div class="card-body">
          <h3 class="text-primary mt-4 text-grenze"><?= $row['nama']; ?></h3>
          <small class="text-muted d-block">umur : <?= $row['umur']; ?> tahun</small>
          <small class="text-muted d-block mb-4">alamat : <?= $row['alamat']; ?></small>
          <small class="text-black-50 d-block">email : <?= $row['email']; ?></small>
          <a href="index.php" class="btn btn-primary text-light mt-3">
            <small class="fas fa-fw fa-arrow-left mr-1"></small>
            <small>kembali</small>
          </a>
        </div>
      </div>

    </div>
  </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/8.11.8/sweetalert2.min.js"></script>
</body>
</html>
