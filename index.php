<?php

session_start();
require_once 'function/functions.php';

$data['judul'] = 'Halaman utama';
$rows = query("SELECT * FROM data ORDER BY id DESC");

if (isset($_POST['submit'])) {
  $keyword = trim(htmlspecialchars(mysqli_real_escape_string($conn, $_POST['keyword'])));
  $rows = cari_data($keyword);
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
      <div class="col-md-8">

        <div class="flasher-container">
          <?= flashdata(); ?>
        </div>

        <a href="tambah.php" class="btn btn-primary text-light mb-3">
          <small class="fas fa-fw fa-plus mr-1"></small>
          <small>tambah data</small>
        </a>

        <form action="" method="post">
          <div class="input-group mb-3">
            <input type="text" name="keyword" class="form-control" placeholder="cari data..." autocomplete="off" autofocus>
            <div class="input-group-append">
              <button class="btn btn-primary" type="submit" name="submit" id="button-addon2">
                <small class="fas fa-fw fa-search mr-1"></small>
                <small>cari</small>
              </button>
            </div>
          </div>
        </form>

      </div>
    </div>
    <div class="row">
      <div class="col">

        <div class="table-responsive">
          <table class="table table-striped">
            <thead>
              <tr>
                <th>#</th>
                <th>Nama</th>
                <th>Email</th>
                <th>Opsi</th>
              </tr>
            </thead>
            <tbody>
              <?php if (empty($rows)) : ?>
              <tr>
                <td colspan="4">
                  <div class="alert alert-danger" role="alert">
                    <span>data <strong>tidak ditemukan</strong></span>
                  </div>
                </td>
              </tr>
              <?php endif; ?>
              <?php $no = 1; ?>
              <?php foreach ($rows as $row) : ?>
              <tr>
                <td><small class="text-muted"><?= $no++; ?></small></td>
                <td><small class="text-black-50"><?= $row['nama']; ?></small></td>
                <td><small class="text-black-50"><?= $row['email']; ?></small></td>
                <td>
                  <div class="d-flex justify-content-center">
                    <a href="detail.php?id=<?= $row['id']; ?>" class="badge badge-primary p-2 text-light mr-1">
                      <small class="fas fa-fw fa-eye mr-1"></small>
                      <small>detail</small>
                    </a>
                    <a href="ubah.php?id=<?= $row['id']; ?>" class="badge badge-success p-2 text-light mr-1">
                      <small class="fas fa-fw fa-edit mr-1"></small>
                      <small>ubah</small>
                    </a>
                    <a href="" class="badge badge-danger p-2 text-light badges-hapus" data-target="hapus.php?id=<?= $row['id']; ?>">
                      <small class="fas fa-fw fa-trash-alt mr-1"></small>
                      <small>hapus</small>
                    </a>
                  </div>
                </td>
              </tr>
              <?php endforeach; ?>
            </tbody>
          </table>
        </div>

      </div>
    </div>
  </div>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/8.11.8/sweetalert2.min.js"></script>
  <script src="assets/js/script.js"></script>
</body>
</html>
