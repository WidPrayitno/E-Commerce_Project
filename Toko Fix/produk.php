<?php

require_once 'dbkoneksi.php';

// Mencari produk dengan keyword search
if (isset($_GET['keyword'])) {
    $keyword = $_GET['keyword'];
    $stmt = $dbh->prepare("SELECT * FROM produk WHERE nama LIKE ?");
    $stmt->execute(["%$keyword%"]);
    $results = $stmt->fetchAll();

// Mencari produk berdasarkan kategori produk
} elseif (isset($_GET['kategori'])) {
    // Mencari id dari kategori produk
    $GetkategoriId = $_GET['kategori'];
    $stmt = $dbh->prepare("SELECT * FROM kategori_produk WHERE nama LIKE ?");
    $stmt->execute(["$GetkategoriId"]);
    $GetkategoriId = $stmt->fetchAll();
    $id = $GetkategoriId[0]['id'];

    // Mencari produk yang sama dengan id kategori_produk
    $stmt = $dbh->prepare("SELECT * FROM produk WHERE kategori_produk_id= ?");
    $stmt->execute([$id]);
    $results = $stmt->fetchAll();

// Menampilkan semua produk yang ada
} else {
    $stmt = $dbh->prepare("SELECT * FROM produk");
    $stmt->execute();
    $results = $stmt->fetchAll();
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Produk</title>
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
                        <a class="nav-link active" href="produk.php">Produk</a>
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
                        <a class="nav-link" href="pesanan.php">
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

    <!-- Breadcumb -->
    <div class="container mt-5">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item active"><a href="index.php">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Produk</li>
            </ol>
        </nav>
    </div>

    <div class="container py-5">
        <div class="row">
            <!-- Kategori Produk -->
            <div class="col-lg-3 mb-5">
                <h3>Kategori Produk</h3>
                <ul class="list-group">
                    <?php
                    // Kategori Produk
                    $sql = "SELECT * FROM kategori_produk";
                    $rs = $dbh->query($sql);

                    foreach ($rs as $row) {
                    ?>
                        <a href="produk.php?kategori=<?= $row['nama'] ?>">
                            <li class="list-group-item" style="color: black;"><?= $row['nama'] ?></li>
                        </a>
                    <?php } ?>
                </ul>
            </div>

            <!-- Menampilkan produk -->
            <div class="col-lg-9">
                <h3 class="text-center mb-3">Produk</h3>

                <div class="row mt-5">
                    <?php
                    if (!empty($results)) {
                        foreach ($results as $row) {
                            // Mengubah format harga
                            $format_harga = $row['harga_jual'];
                            $harga = "Rp" . number_format($format_harga, 0, ',', '.');
                    ?>
                            <div class="col-sm-6 col-md-4 mb-4">
                                <div class="card h-100 highlighted-kategori">
                                    <!-- Product image-->
                                    <img class="card-img-top" src="../AdminLTE/dist/img/prod-5.jpg" alt="..." />
                                    <!-- Product details-->
                                    <div class="card-body p-4">
                                        <div class="text-center">
                                            <!-- Product name-->
                                            <h4 class="fw-bolder"><?= $row['nama'] ?></h5>
                                                <!-- Product Desc -->
                                                <p class="card-text text-truncate"><?= $row['deskripsi'] ?></p>
                                                <!-- Product price-->
                                                <p class="card-text"><?= $harga ?></p>
                                        </div>
                                    </div>
                                    <!-- Product actions-->
                                    <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
                                        <div class="text-center"><a class="btn btn-outline-dark mt-auto" href="detail_produk.php?nama=<?= $row['nama'] ?>">Detail Produk</a></div>
                                    </div>
                                </div>
                            </div>
                        <?php }
                    } else {
                        ?>
                        <h5 class="text-center">Mohon maaf, Produk yang anda cari tidak ditemukan.</h5>
                        <p class="text-center">Silakan coba kata kunci lain atau pilih kategori yang tersedia.</p>
                    <?php } ?>
                </div>
            </div>
        </div>



        <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous"></script>
        <script src="../fontawesome-free-6.4.0-web/js/all.js"></script>
</body>

<?php require_once 'footer.php' ?>