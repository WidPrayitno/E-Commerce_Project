<?php
require_once 'dbkoneksi.php';
?>
<?php
$_kode = $_POST['kode'];
$_nama = $_POST['nama'];
$_harga_beli = $_POST['harga_beli'];
$_stok = $_POST['stok'];
$_min_stok = $_POST['min_stok'];
$_deskripsi = $_POST['deskripsi'];
$_kategori_produk_id = $_POST['kategori_produk_id'];

$_proses = $_POST['proses'];

// array data
$ar_data[] = $_kode; 
$ar_data[] = $_nama;
$ar_data[] = 1.2 * $_harga_beli;
$ar_data[] = $_harga_beli;
$ar_data[] = $_stok;
$ar_data[] = $_min_stok;
$ar_data[] = $_deskripsi;
$ar_data[] = $_kategori_produk_id;


if ($_proses == "Simpan") {
   // data baru
   $sql = "INSERT INTO produk (kode,nama,harga_jual,harga_beli,stok,
   min_stok,deskripsi,kategori_produk_id) VALUES (?,?,?,?,?,?,?,?)";
} else if ($_proses == "Update") {
   $ar_data[] = $_POST['idedit']; // ? 8
   $sql = "UPDATE produk SET kode=?,nama=?,harga_jual=?,harga_beli=?,stok=?,
   min_stok=?,deskripsi=?,kategori_produk_id=? WHERE id=?";
}
if (isset($sql)) {
   $st = $dbh->prepare($sql);
   $st->execute($ar_data);
}

header('location:list_produk.php');
?>