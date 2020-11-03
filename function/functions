<?php

$conn = mysqli_connect('localhost', 'root', '', 'db_crud');

function query($param) {
  global $conn;
  $result = mysqli_query($conn, $param);
  $rows = [];
  if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
      $rows[] = $row;
    }
  }
  return $rows;
}

function view($target, $data = []) {
  //panggil file tertentu sesuai isi dari parameter $target

  require_once $target . '.php';
}

function set_flashdata($param1, $param2, $param3) {
  $pesan = trim(htmlspecialchars($param1));
  $aksi = trim(htmlspecialchars($param2));
  $tipe = trim(rtrim(htmlspecialchars($param3)));

  $_SESSION['flash'] = [
    'pesan' => $pesan,
    'aksi' => $aksi,
    'tipe' => $tipe
  ];
}

function flashdata() {
  if (isset($_SESSION['flash'])) {
    echo '<div class="alert alert-'. $_SESSION['flash']['tipe'] .' alert-dismissible fade show" role="alert">
            data <strong>'. $_SESSION['flash']['pesan'] .'</strong> '. $_SESSION['flash']['aksi'] .'
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>';

    unset($_SESSION['flash']);
  }
}

function set_userdata($param1, $param2) {
  $pesan = trim(htmlspecialchars($param1));
  $tipe = trim(rtrim(htmlspecialchars($param2)));

  $_SESSION['error'] = [
    'pesan' => $pesan,
    'tipe' => $tipe
  ];
}

function userdata() {
  if (isset($_SESSION['error'])) {
    echo '<div class="alert alert-'. $_SESSION['error']['tipe']  .' alert-dismissible fade show" role="alert">
            '. $_SESSION['error']['pesan']  .'
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>';

    unset($_SESSION['error']);
  }
}

function tambah($data) {
  global $conn;

  $nama = trim(htmlspecialchars($data['nama']));
  $umur = trim(rtrim(htmlspecialchars($data['umur'])));
  $alamat = trim(htmlspecialchars($data['alamat']));
  $email = trim(rtrim(htmlspecialchars(mysqli_real_escape_string($conn, $data['email']))));
  $gambar = upload();

  if (!validation($nama, $umur, $alamat, $email) || !$gambar) {
    header('Location: tambah.php');
    exit();
  } else {
    $cek_email = mysqli_query($conn, "SELECT email FROM data WHERE email = '$email'");

    //cek apakah email sudah pernah dipakai sebelumnya
    if (mysqli_num_rows($cek_email) > 0) {
      set_userdata('email sudah pernah dipakai sebelumnya', 'danger');

      header('Location: tambah.php');
      exit();
    } else {
      //tambahkan data ke database
      mysqli_query($conn, "INSERT INTO data VALUES(NULL, '$nama', '$umur', '$alamat', '$email', '$gambar')");
      return mysqli_affected_rows($conn);
    }
  }
}

function validation($nama, $umur, $alamat, $email) {
  if (empty($nama) || empty($umur) || empty($alamat) || empty($email)) {
    set_userdata('isi input yang masih kosong terlebih dahulu', 'danger');
    return false;
  } else if (strlen($nama) <= 3) {
    set_userdata('nama terlalu pendek', 'danger');
    return false;
  } else if (strlen($alamat) <= 5) {
    set_userdata('alamat terlalu pendek', 'danger');
    return false;
  } else if (!filter_var($umur, FILTER_VALIDATE_INT)) {
    set_userdata('umur hanya boleh diisi dengan angka', 'danger');
    return false;
  } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    set_userdata('bukan berupa email yang valid', 'danger');
    return false;
  } else {
    //kembalikan nilai true jika lolos dari uji validasi

    return true;
  }
}

function upload() {
  $nama_file = $_FILES['gambar']['name'];
  $ukuran_file = $_FILES['gambar']['size'];
  $error = $_FILES['gambar']['error'];
  $tmp_name = $_FILES['gambar']['tmp_name'];

  //jika tidak mengupload file apapun
  if ($error === 4) {
    set_userdata('upload file gambar terlebih dahulu', 'danger');
    return false;
  }

  $kumpulan_ekstensi = ['jpg',
    'jpeg',
    'png',
    'gif'];
  $ekstensi_gambar = explode('.', $nama_file);
  $ekstensi_gambar = strtolower(end($ekstensi_gambar));

  //jika yang diupload bukan berupa file gambar
  if (!in_array($ekstensi_gambar, $kumpulan_ekstensi)) {
    set_userdata('yang anda upload bukan berupa file gambar', 'danger');
    return false;
  }

  //jika ukuran file yang diupload terlau besar
  if ($ukuran_file > 2000000) {
    set_userdata('ukuran file yang anda upload terlalu besar', 'danger');
    return false;
  }

  $nama_file_baru = uniqid();
  $nama_file_baru .= '.';
  $nama_file_baru .= $ekstensi_gambar;

  move_uploaded_file($tmp_name, 'assets/image/' . $nama_file_baru);
  return $nama_file_baru;
}

function hapus($id) {
  global $conn;

  $query = "DELETE FROM data WHERE id = '$id'";

  mysqli_query($conn, $query);
  return mysqli_affected_rows($conn);
}

function ubah($data, $id, $email_lama, $gambar_lama) {
  global $conn;

  $nama = trim(htmlspecialchars($data['nama']));
  $umur = trim(rtrim(htmlspecialchars($data['umur'])));
  $alamat = trim(htmlspecialchars($data['alamat']));
  $email = trim(rtrim(htmlspecialchars(mysqli_real_escape_string($conn, $data['email']))));

  if (!validation($nama, $umur, $alamat, $email)) {
    header('Location: ubah.php?id=' . $id);
    exit();
  } else {
    if ($email === $email_lama) {
      $result = ($_FILES['gambar']['error'] === 4) ? $gambar = $gambar_lama : $gambar = upload();
      query_update($nama, $umur, $alamat, $email, $result, $id);

      return mysqli_affected_rows($conn);
    }

    if ($email !== $email_lama) {
      //cek apakah email pernah digunakan sebelumnya
      $cek_email = mysqli_query($conn, "SELECT email FROM data WHERE email = '$email'");

      //jika benar ada
      if (mysqli_num_rows($cek_email) > 0) {
        set_userdata('email sudah pernah digunakan sebelumnya', 'danger');

        header('Location: ubah.php?id=' . $id);
        exit();
      } else {
        $result = ($_FILES['gambar']['error'] === 4) ? $gambar = $gambar_lama : $gambar = upload();
        query_update($nama, $umur, $alamat, $email, $result, $id);

        return mysqli_affected_rows($conn);
      }
    }
  }
}

function query_update($nama, $umur, $alamat, $email, $gambar, $id) {
  global $conn;

  $query = "UPDATE data SET
                  nama = '$nama',
                  umur = '$umur',
                  alamat = '$alamat',
                  email = '$email',
                  gambar = '$gambar'
                WHERE id = '$id'";

  mysqli_query($conn, $query);
}

function cari_data($keyword) {
  $query = "SELECT * FROM data WHERE
              nama LIKE '%$keyword%' OR
              umur LIKE '%$keyword%' OR
              alamat LIKE '%$keyword%' OR
              email LIKE '%$keyword%' ORDER BY id DESC";
              
  return query($query);
}
