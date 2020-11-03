<?php

session_start();
require_once 'function/functions.php';

$data['judul'] = 'Halaman tambah data';

if (isset($_POST['submit'])) {
  if (tambah($_POST) > 0) {
    set_flashdata('berhasil', 'ditambahkan', 'success');
    
    header('Location: index.php');
    exit;
  } else {
    set_flashdata('gagal', 'ditambahkan', 'danger');
    
    header('Location: index.php');
    exit;
  }
}

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
    <div class="col-md-10">
      
      <div class="error-container">
        <?= userdata(); ?>
      </div>

      <div class="card">
        <div class="card-header">
          <small class="fab fa-fw fa-wpforms mr-1 text-primary"></small>
          <small class="text-black-50">form tambah data</small>
        </div>
        <div class="card-body">
          <form action="" method="post" enctype="multipart/form-data">
            <div class="form-group">
              <label for="nama"><small class="text-primary">Nama</small></label>
              <input type="text" name="nama" class="form-control" id="nama" placeholder="nama" autocomplete="off">
              <div class="invalid-feedback">
                <small class="text-danger">...</small>
              </div>
            </div>
            <div class="form-group">
              <label for="umur"><small class="text-primary">Umur</small></label>
              <input type="text" name="umur" class="form-control" id="umur" placeholder="umur" autocomplete="off">
              <div class="invalid-feedback">
                <small class="text-danger">...</small>
              </div>
            </div>
            <div class="form-group">
              <label for="alamat"><small class="text-primary">Alamat</small></label>
              <input type="text" name="alamat" class="form-control" id="alamat" placeholder="alamat" autocomplete="off">
              <div class="invalid-feedback">
                <small class="text-danger">...</small>
              </div>
            </div>
            <div class="form-group">
              <label for="email"><small class="text-primary">Email</small></label>
              <input type="text" name="email" class="form-control" id="email" placeholder="example@example.com" autocomplete="off">
              <div class="invalid-feedback">
                <small class="text-danger">...</small>
              </div>
            </div>
            <div class="form-group">
              <label for="gambar"><small class="text-primary">Gambar</small></label>
              <div class="custom-file">
                <input type="file" name="gambar" class="custom-file-input" id="gambar">
                <label class="custom-file-label" for="gambar">pilih file</label>
              </div>
            </div>
            <button type="submit" name="submit" class="btn btn-primary text-light">
              <small class="fas fa-fw fa-plus mr-1"></small>
              <small>tambah data</small>
            </button>
          </form>
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
