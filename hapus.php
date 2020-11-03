<?php

session_start();
require_once 'function/functions.php';

$id = trim(rtrim(mysqli_real_escape_string($conn, $_GET['id'])));

if (hapus($id) > 0) {
  set_flashdata('berhasil', 'dihapus', 'success');
  
  header('Location: index.php');
  exit();
} else {
  set_flashdata('gagal', 'dihapus', 'danger');
  
  header('Location: index.php');
  exit();
}
