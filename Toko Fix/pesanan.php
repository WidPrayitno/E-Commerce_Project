<?php
require_once 'dbkoneksi.php';

$sql = "SELECT * FROM pesanan";
$rs = $dbh->query($sql);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pesanan</title>
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
            <a class="navbar-brand" href="index.php">Toko Online</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav mr-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link" href="index.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="produk.php">Produk</a>
                    </li>
                    <li class="nav-item">
                        <form action="produk.php" method="get">
                            <div class="input-group">
                                <input type="text" class="form-control" placeholder="Cari produk" aria-label="Cari produk" aria-describedby="basic-addon2" name="keyword">
                                <div class="input-group-append">
                                    <button class="btn btn-info" type="submit">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                                            <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z" />
                                        </svg> Telusuri</button>
                                </div>
                            </div>
                        </form>
                    </li>
                </ul>
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link active" href="pesanan.php">
                            <svg xmlns="http://www.w3.org/2000/svg" width="23" height="23" fill="currentColor" class="bi bi-cart4" viewBox="0 0 16 16">
                                <path d="M0 2.5A.5.5 0 0 1 .5 2H2a.5.5 0 0 1 .485.379L2.89 4H14.5a.5.5 0 0 1 .485.621l-1.5 6A.5.5 0 0 1 13 11H4a.5.5 0 0 1-.485-.379L1.61 3H.5a.5.5 0 0 1-.5-.5zM3.14 5l.5 2H5V5H3.14zM6 5v2h2V5H6zm3 0v2h2V5H9zm3 0v2h1.36l.5-2H12zm1.11 3H12v2h.61l.5-2zM11 8H9v2h2V8zM8 8H6v2h2V8zM5 8H3.89l.5 2H5V8zm0 5a1 1 0 1 0 0 2 1 1 0 0 0 0-2zm-2 1a2 2 0 1 1 4 0 2 2 0 0 1-4 0zm9-1a1 1 0 1 0 0 2 1 1 0 0 0 0-2zm-2 1a2 2 0 1 1 4 0 2 2 0 0 1-4 0z" />
                            </svg> Pesanan
                        </a>

                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../AdminLTE/index.php">
                            <svg xmlns="http://www.w3.org/2000/svg" width="23" height="23" fill="currentColor" class="bi bi-person-circle" viewBox="0 0 16 16">
                                <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0z" />
                                <path fill-rule="evenodd" d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8zm8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1z" />
                            </svg> Admin
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container py-5">
        <h3>Daftar Transaksi</h3>

        <div class="row justify-content-md-center card card-body">
            <?php
            foreach ($rs as $row) {
                // Produk
                $id = $row['produk_id'];

                $sqlproduk = "SELECT * FROM produk WHERE id = :id";
                $stmt = $dbh->prepare($sqlproduk);
                $stmt->bindParam(':id', $id);
                $stmt->execute();
                $rowproduk = $stmt->fetch(PDO::FETCH_ASSOC);


                // Harga
                $format_harga = $rowproduk['harga_jual'];
                $harga = "Rp " . number_format($format_harga, 0, ',', '.');
                $hitung = $rowproduk['harga_jual'] * $row['jumlah_pesanan'];
                $format_harga = $hitung;
                $total = "Rp " . number_format($format_harga, 0, ',', '.');
            ?>
                <div class="card mt-2 w-100">
                    <div class="card-body">
                        <p>
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-bag" viewBox="0 0 16 16">
                                <path d="M8 1a2.5 2.5 0 0 1 2.5 2.5V4h-5v-.5A2.5 2.5 0 0 1 8 1zm3.5 3v-.5a3.5 3.5 0 1 0-7 0V4H1v10a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V4h-3.5zM2 5h12v9a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1V5z" />
                            </svg>
                            Belanja
                            <?= $row['tanggal'] ?>
                        </p>
                        <div class="row">
                            <div class="col">
                                <img class="img-fluid img-thumbnail" src="../AdminLTE/dist/img/prod-5.jpg" alt="" srcset="">
                            </div>
                            <div class="col-lg-8 align-self-center">
                                <h5 class="card-title"><?= $rowproduk['nama'] ?></h5>
                                <p class="card-text"><?= $row['jumlah_pesanan'] ?> barang x <?= $harga ?></p>
                            </div>
                            <div class="col align-self-center">
                                <div class="border-left">
                                    <p>Total Belanja</p>
                                    <h5><?= $total ?></h5>
                                </div>
                            </div>
                        </div>
                        <div class="text-right">
                            <button class="btn btn-info" type="button" data-toggle="collapse" data-target="#collapseExample<?= $row['id'] ?>" aria-expanded="false" aria-controls="collapseExample">
                                Lihat Detail Transaksi
                            </button>
                        </div>

                        <!-- Collapse Detail Transaksi -->
                        <div class="collapse mt-4" id="collapseExample<?= $row['id'] ?>">
                            <div class="card card-footer">
                                <h5>Detail Produk</h5>

                                <div class="row row-cols-2">
                                    <div class="col-lg-3">
                                        <div>SKU</div>
                                        <div>Nama Produk</div>
                                        <div>Harga</div>
                                        <div>Kategori Produk</div>
                                    </div>
                                    <div class="col">
                                        <div>: <?= $rowproduk['kode'] ?></div>
                                        <div>: <?= $rowproduk['nama'] ?></div>
                                        <div>: <?= $harga ?></div>
                                        <div>: <?php
                                                $id = $rowproduk['kategori_produk_id'];

                                                $sqlproduk = "SELECT * FROM kategori_produk WHERE id = :id";
                                                $stmt = $dbh->prepare($sqlproduk);
                                                $stmt->bindParam(':id', $id);
                                                $stmt->execute();
                                                $rowproduk = $stmt->fetch(PDO::FETCH_ASSOC);
                                                ?>
                                            <?= $rowproduk['nama'] ?></div>
                                    </div>
                                </div>
                                <hr class="mt-2">
                                <h5>Detail Transaksi</h5>

                                <div class="row row-cols-2">
                                    <div class="col-lg-3">
                                        <div>Tanggal Pembelian</div>
                                        <div>Nama Pemesan</div>
                                        <div>Alamat</div>
                                        <div>No Hp</div>
                                        <div>Email</div>
                                        <div>Catatan</div>
                                    </div>
                                    <div class="col">
                                        <div>: <?= $row['tanggal'] ?></div>
                                        <div>: <?= $row['nama_pemesan'] ?></div>
                                        <div>: <?= $row['alamat_pemesan'] ?></div>
                                        <div>: <?= $row['no_hp'] ?></div>
                                        <div>: <?= $row['email'] ?></div>
                                        <div>: <?= $row['deskripsi'] ?></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            <?php } ?>
        </div>
    </div>



    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous"></script>
    <script src="../fontawesome-free-6.4.0-web/js/all.js"></script>
</body>

<?php require_once 'footer.php' ?>

</html>