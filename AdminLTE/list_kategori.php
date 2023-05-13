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
                    <h1>Kategori Produk</h1>
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
                                <button type="button" class="btn btn-success" data-toggle="modal" data-target="#TambahKategori">
                                    Tambah Kategori
                                </button>

                                <!-- Modal -->
                                <div class="modal fade" id="TambahKategori" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="staticBackdropLabel">Form Tambah Kategori</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">

                                                <?php
                                                require_once 'dbkoneksi.php';
                                                if (!empty($row['id'])) {
                                                    $edit = $row['id'];
                                                    // Nampilin data pakai select
                                                    $sql = "SELECT * FROM kategori_produk WHERE id=?";
                                                    $st = $dbh->prepare($sql);
                                                    // Menjalankan
                                                    $st->execute([$edit]);
                                                    // Menampilkan baris di setiap data
                                                    $row = $st->fetch();
                                                } else {
                                                    // Jalanin fungsi create (buat data baru)
                                                    $row = [];
                                                };

                                                ?>

                                                <form method="POST" action="proses_kategori.php">
                                                    <div class="form-group row">
                                                        <label for="nama" class="col-4 col-form-label">Nama Kategori</label>
                                                        <div class="col-8">
                                                            <input id="nama" name="nama" type="text" class="form-control">
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
                            </div>
                        </div>
                        <div class="card-body">
                            <?php
                            require_once 'dbkoneksi.php';
                            ?>
                            <?php
                            $sql = "SELECT * FROM kategori_produk";
                            $rs = $dbh->query($sql);
                            ?>
                            <table class="table" width="100%" border="1" cellspacing="2" cellpadding="2">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama</th>
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
                                            <td><?= $row['nama'] ?></td>

                                            <td>
                                                <!-- Button trigger modal -->
                                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#EditKategori<?= $row['id'] ?>">
                                                    Edit
                                                </button>
                                                <!-- Button trigger modal -->
                                                <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#DeleteKategori<?= $row['id'] ?>">
                                                    Delete
                                                </button>
                                            </td>
                                        </tr>



                                        <!-- Modal -->
                                        <div class="modal fade" id="EditKategori<?= $row['id'] ?>" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="staticBackdropLabel">Form Edit Kategori</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <?php
                                                    require_once 'dbkoneksi.php';
                                                    if (!empty($row['id'])) {
                                                        $edit = $row['id'];
                                                        // Nampilin data pakai select
                                                        $sql = "SELECT * FROM kategori_produk WHERE id=?";
                                                        $st = $dbh->prepare($sql);
                                                        // Menjalankan
                                                        $st->execute([$edit]);
                                                        // Menampilkan baris di setiap data
                                                        $row = $st->fetch();
                                                    } else {
                                                        // Jalanin fungsi create (buat data baru)
                                                        $row = [];
                                                    };

                                                    ?>

                                                    <form method="POST" action="proses_kategori.php">
                                                        <div class="modal-body">

                                                            <div class="form-group row">
                                                                <label for="nama" class="col-4 col-form-label">Nama Kategori</label>
                                                                <div class="col-8">
                                                                    <input id="nama" name="nama" type="text" class="form-control">
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



                                        <!-- Modal -->
                                        <div class="modal fade" id="DeleteKategori<?= $row['id'] ?>" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="staticBackdropLabel">Delete Kategori</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        Anda Yakin Hapus Kategori Produk <?= $row['nama'] ?>?
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                        <a class="btn btn-danger" href="delete_kategori.php?iddel=<?= $row['id'] ?>">Delete</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
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
    <!-- Tambah content -->
    <section class="content">

        <div class="container-fluid">
            <div>




            </div>
        </div>
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<?php
require_once 'footer.php';
?>