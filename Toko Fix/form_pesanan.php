<?php
require_once 'dbkoneksi.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pesan Produk</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../fontawesome-free-6.4.0-web/css/all.css">
</head>

<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-md navbar-dark bg-clr-elegan-hitam">
        <div class="container-fluid">
            <a class="navbar-brand">Toko Online</a>
        </div>
    </nav>

    <div class="container py-5">
        <h3>Checkout</h3>

        <div class="row">
            <!-- Form Detail Pemesan -->
            <div class="col-lg-9 mb-5">
                <form action="proses_pesanan.php" method="POST">
                    <div class="form-group row">
                        <label for="nama_pemesan" class="col-4 col-form-label">Nama Penerima</label>
                        <div class="col-8">
                            <input id="nama_pemesan" name="nama_pemesan" type="text" class="form-control">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="alamat_pemesan" class="col-4 col-form-label">Alamat Penerima</label>
                        <div class="col-8">
                            <textarea id="alamat_pemesan" name="alamat_pemesan" cols="40" rows="2" class="form-control"></textarea>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="no_hp" class="col-4 col-form-label">Nomor HP</label>
                        <div class="col-8">
                            <input id="no_hp" name="no_hp" type="text" class="form-control">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="email" class="col-4 col-form-label">Email</label>
                        <div class="col-8">
                            <input id="email" name="email" type="text" class="form-control">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="jumlah_pesanan" class="col-4 col-form-label">Jumlah Pesanan</label>
                        <div class="input-group col-3">
                            <div class="input-group-prepend" id="button-addon3">
                                <button type="button" onclick="kurang()" class="btn btn-info">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-dash-circle" viewBox="0 0 16 16">
                                        <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z" />
                                        <path d="M4 8a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7A.5.5 0 0 1 4 8z" />
                                    </svg>
                                </button>
                            </div>
                            <input id="jumlah_pesanan" name="jumlah_pesanan" type="number" class="form-control text-center" value="1">
                            <div class="input-group-append" id="button-addon4">
                                <button type="button" onclick="tambah()" class="btn btn-info">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-plus-circle" viewBox="0 0 16 16">
                                        <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z" />
                                        <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z" />
                                    </svg>
                                </button>
                            </div>
                            <script>
                                function tambah() {
                                    var input = document.getElementById("jumlah_pesanan");
                                    var value = parseInt(input.value);
                                    value++;
                                    input.value = value;
                                }

                                function kurang() {
                                    var input = document.getElementById("jumlah_pesanan");
                                    var value = parseInt(input.value);
                                    if (value > 1) {
                                        value--;
                                        input.value = value;
                                    }
                                }
                            </script>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="deskripsi" class="col-4 col-form-label">Tambah Catatan</label>
                        <div class="col-8">
                            <textarea id="deskripsi" name="deskripsi" cols="40" rows="5" class="form-control"></textarea>
                        </div>
                    </div>
                    <input id="tanggal" name="tanggal" type="hidden" class="form-control" value="<?php echo date('Y-m-d'); ?>">
                    <input type="hidden" name="produk_id" value="<?= $_POST['id'] ?>">
                    <div class="form-group row">
                        <div class="offset-4 col-8">
                            <input name="proses" type="submit" class="btn btn-outline-dark flex-shrink-0" value="Simpan">
                        </div>
                    </div>
                </form>
            </div>

            <!-- Review Produk -->
            <div class="col-lg-3">
                <h5>Produk Yang Dipilih</h5>

                <div class="row mt-2">
                    <?php
                    // Menangkap id produk
                    $id = $_POST['id'];

                    $sql = $dbh->prepare("SELECT * FROM produk WHERE id= ?");
                    $sql->execute([$id]);
                    $results = $sql->fetchAll();


                    // Perulangan
                    foreach ($results as $row) {
                        $format_harga = $row['harga_jual'];
                        $harga = "Rp " . number_format($format_harga, 0, ',', '.');
                    ?>
                        <div class="col">
                            <div class="card h-100 highlighted-kategori">
                                <!-- Product image-->
                                <img class="card-img-top" src="../AdminLTE/dist/img/prod-5.jpg" alt="..." />
                                <!-- Product details-->
                                <div class="card-body">
                                    <div class="text-left">
                                        <!-- Product name-->
                                        <p>Nama Produk : <?= $row['nama'] ?></p>
                                        <!-- Produk stock -->
                                        <p>Stok Tersedia : <?= $row['stok'] ?></p>
                                        <!-- Product price-->
                                        <p>Harga : <?= $harga ?></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div>

    </div>



    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous"></script>
    <script src="../fontawesome-free-6.4.0-web/js/all.js"></script>
</body>

</html>