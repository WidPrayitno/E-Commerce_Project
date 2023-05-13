<?php 
// impor database
require_once 'dbkoneksi.php';
// Tangkap id deletenya
$delete = $_GET['iddel'];
// bikin query
$sql = "DELETE FROM kategori_produk WHERE id=?";
// Siapin query
$st = $dbh->prepare($sql);
// Eksekusi query
$st->execute([$delete]);

header('location:list_kategori.php');

?>