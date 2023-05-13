<?php
require_once 'header.php';
require_once 'sidebar.php';
?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-8">
                    <h1>Katalog Produk</h1>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>


    <!-- Main content -->
    <section class="content">

        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <!-- Default box -->
                    <div class="card">
                        <div class="card-header">
                            <div class="col-sm-8 row mb-2">

                                <!-- Button trigger modal -->
                                <button type="button" class="btn btn-success" data-toggle="modal" data-target="#TambahProduk">
                                    Tambah Produk
                                </button>

                                <!-- Modal -->
                                <div class="modal fade" id="TambahProduk" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-lg modal-dialog-center">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="staticBackdropLabel">Form Tambah Produk</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <?php
                                            if (!empty($row['id'])) {
                                                $edit = $row['id'];
                                                $sql = "SELECT * FROM produk WHERE id=?";
                                                $st = $dbh->prepare($sql);
                                                $st->execute([$edit]);
                                                $row = $st->fetchAll();
                                            } else {
                                                $row = [];
                                            }

                                            ?>
                                            <form method="POST" action="proses_produk.php">
                                                <div class="modal-body">
                                                    <div class="container">
                                                        <div class="form-group row">
                                                            <label for="kode" class="col-4 col-form-label">kode</label>
                                                            <div class="col-8">
                                                                <input id="kode" name="kode" type="text" class="form-control">
                                                            </div>
                                                        </div>
                                                        <div class="form-group row">
                                                            <label for="nama" class="col-4 col-form-label">Nama Produk</label>
                                                            <div class="col-8">
                                                                <input id="nama" name="nama" type="text" class="form-control">
                                                            </div>
                                                        </div>
                                                        <div class="form-group row">
                                                            <label for="harga_beli" class="col-4 col-form-label">Harga Beli</label>
                                                            <div class="col-8">
                                                                <input id="harga_beli" name="harga_beli" type="text" class="form-control">
                                                            </div>
                                                        </div>
                                                        <div class="form-group row">
                                                            <label for="stok" class="col-4 col-form-label">Stok</label>
                                                            <div class="col-8">
                                                                <input id="stok" name="stok" type="text" class="form-control">
                                                            </div>
                                                        </div>
                                                        <div class="form-group row">
                                                            <label for="min_stok" class="col-4 col-form-label">Minimum Stok</label>
                                                            <div class="col-8">
                                                                <input id="min_stok" name="min_stok" type="text" class="form-control">
                                                            </div>
                                                        </div>
                                                        <div class="form-group row">
                                                            <label for="deskripsi" class="col-4 col-form-label">Deskripsi</label>
                                                            <div class="col-8">
                                                                <textarea id="deskripsi" name="deskripsi" cols="40" rows="5" class="form-control"></textarea>
                                                            </div>
                                                        </div>
                                                        <div class="form-group row">
                                                            <label for="kategori_produk_id" class="col-4 col-form-label">Jenis Produk</label>
                                                            <div class="col-8">
                                                                <?php
                                                                require_once 'dbkoneksi.php';
                                                                $sqlkategori_produk_id = "SELECT * FROM kategori_produk";
                                                                $rskategori_produk_id = $dbh->query($sqlkategori_produk_id);
                                                                ?>
                                                                <select id="kategori_produk_id" name="kategori_produk_id" class="custom-select">
                                                                    <?php
                                                                    foreach ($rskategori_produk_id as $rowkategori_produk_id) {
                                                                    ?>
                                                                        <option value="<?= $rowkategori_produk_id['id'] ?>"><?= $rowkategori_produk_id['nama'] ?></option>
                                                                    <?php
                                                                    }
                                                                    ?>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                    <!-- Validasi -->
                                                    <?php
                                                    $button = (empty($edit)) ? "Simpan" : "Update";
                                                    ?>
                                                    <input type="submit" name="proses" type="submit" class="btn btn-primary" value="<?= $button ?>" />
                                                    <input type="hidden" name="idedit" value="<?= $edit; ?>" />
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <!-- End-Modal -->
                            </div>
                        </div>
                        <div class="card-body">
                            <?php
                            require_once 'dbkoneksi.php';
                            ?>
                            <?php
                            $sql = "SELECT * FROM produk";
                            $rs = $dbh->query($sql);
                            ?>
                            <table class="table" width="100%" border="1" cellspacing="2" cellpadding="2">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Kode</th>
                                        <th>Nama</th>
                                        <th>Harga Jual</th>
                                        <th>Harga Beli</th>
                                        <th>Stok</th>
                                        <th>Min Stok</th>
                                        <th>Deskripsi</th>
                                        <th>Kategori Produk</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $nomor  = 1;
                                    foreach ($rs as $row) {
                                    ?>
                                        <tr>
                                            <td><?= $nomor ?></td>
                                            <td><?= $row['kode'] ?></td>
                                            <td><?= $row['nama'] ?></td>
                                            <td><?= $row['harga_jual'] ?></td>
                                            <td><?= $row['harga_beli'] ?></td>
                                            <td><?= $row['stok'] ?></td>
                                            <td><?= $row['min_stok'] ?></td>
                                            <td><?= $row['deskripsi'] ?></td>
                                            <td>
                                                <?php
                                                $id = $row['kategori_produk_id'];

                                                $sqlproduk = "SELECT * FROM kategori_produk WHERE id = :id";
                                                $stmt = $dbh->prepare($sqlproduk);
                                                $stmt->bindParam(':id', $id);
                                                $stmt->execute();
                                                $rowproduk = $stmt->fetch(PDO::FETCH_ASSOC);
                                                ?>
                                                <?= $rowproduk['nama'] ?>
                                            </td>

                                            <td>
                                                <!-- Button trigger modal -->
                                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#UbahProduk<?= $row['id'] ?>">
                                                    Edit
                                                </button>
                                                <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#DeleteProduk<?= $row['id'] ?>">
                                                    Delete
                                                </button>
                                            </td>
                                        </tr>

                                        <!-- Modal -->
                                        <div class="modal fade" id="DeleteProduk<?= $row['id'] ?>" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="staticBackdropLabel">Delete Produk</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        Anda Yakin Hapus Data Produk <?= $row['nama'] ?>?
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                        <a class="btn btn-danger" href="delete_produk.php?iddel=<?= $row['id'] ?>">Delete </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Modal -->
                                        <div class="modal fade" id="UbahProduk<?= $row['id'] ?>" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-lg modal-dialog-center">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="staticBackdropLabel">Form Edit Produk</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <?php
                                                    if (!empty($row['id'])) {
                                                        $edit = $row['id'];
                                                        $sql = "SELECT * FROM produk WHERE id=?";
                                                        $st = $dbh->prepare($sql);
                                                        $st->execute([$edit]);
                                                        $row = $st->fetchAll();
                                                    } else {
                                                        $row = [];
                                                    }

                                                    ?>
                                                    <form method="POST" action="proses_produk.php">
                                                        <div class="modal-body">
                                                            <div class="container">
                                                                <div class="form-group row">
                                                                    <label for="kode" class="col-4 col-form-label">kode</label>
                                                                    <div class="col-8">
                                                                        <input id="kode" name="kode" type="text" class="form-control">
                                                                    </div>
                                                                </div>
                                                                <div class="form-group row">
                                                                    <label for="nama" class="col-4 col-form-label">Nama Produk</label>
                                                                    <div class="col-8">
                                                                        <input id="nama" name="nama" type="text" class="form-control">
                                                                    </div>
                                                                </div>
                                                                <div class="form-group row">
                                                                    <label for="harga_beli" class="col-4 col-form-label">Harga Beli</label>
                                                                    <div class="col-8">
                                                                        <input id="harga_beli" name="harga_beli" type="text" class="form-control">
                                                                    </div>
                                                                </div>
                                                                <div class="form-group row">
                                                                    <label for="stok" class="col-4 col-form-label">Stok</label>
                                                                    <div class="col-8">
                                                                        <input id="stok" name="stok" type="text" class="form-control">
                                                                    </div>
                                                                </div>
                                                                <div class="form-group row">
                                                                    <label for="min_stok" class="col-4 col-form-label">Minimum Stok</label>
                                                                    <div class="col-8">
                                                                        <input id="min_stok" name="min_stok" type="text" class="form-control">
                                                                    </div>
                                                                </div>
                                                                <div class="form-group row">
                                                                    <label for="deskripsi" class="col-4 col-form-label">Deskripsi</label>
                                                                    <div class="col-8">
                                                                        <textarea id="deskripsi" name="deskripsi" cols="40" rows="5" class="form-control"></textarea>
                                                                    </div>
                                                                </div>
                                                                <div class="form-group row">
                                                                    <label for="kategori_produk_id" class="col-4 col-form-label">Jenis Produk</label>
                                                                    <div class="col-8">
                                                                        <?php
                                                                        require_once 'dbkoneksi.php';
                                                                        $sqlkategori_produk_id = "SELECT * FROM kategori_produk";
                                                                        $rskategori_produk_id = $dbh->query($sqlkategori_produk_id);
                                                                        ?>
                                                                        <select id="kategori_produk_id" name="kategori_produk_id" class="custom-select">
                                                                            <?php
                                                                            foreach ($rskategori_produk_id as $rowkategori_produk_id) {
                                                                            ?>
                                                                                <option value="<?= $rowkategori_produk_id['id'] ?>"><?= $rowkategori_produk_id['nama'] ?></option>
                                                                            <?php
                                                                            }
                                                                            ?>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                            <!-- Validasi -->
                                                            <?php
                                                            $button = (empty($edit)) ? "Simpan" : "Update";
                                                            ?>
                                                            <input type="submit" name="proses" type="submit" class="btn btn-primary" value="<?= $button ?>" />
                                                            <input type="hidden" name="idedit" value="<?= $edit; ?>" />
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- End-Modal -->
                                    <?php
                                        $nomor++;
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
            </div>
        </div>
    </section>

    <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<?php
require_once 'footer.php';
?>