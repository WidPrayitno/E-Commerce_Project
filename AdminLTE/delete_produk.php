<?php 
// impor database
require_once 'dbkoneksi.php';
// Tangkap id deletenya
$delete = $_GET['iddel'];
// bikin query
$sql = "DELETE FROM produk WHERE id=?";
// Siapin query
$st = $dbh->prepare($sql);
// Eksekusi query
$st->execute([$delete]);

header('location:list_produk.php');

?>