<?php
require("../controller/Produk.php");

$id = $_GET["id"];

$query = Index("SELECT * FROM produk WHERE id_Produk = $id");
foreach ($query as $row) {
    $row["kode_alternatif"];
    $row["nm_produk"];
}

if (isset($_POST["edit"])) {
    if (Edit("produk", $_POST) > 0) {
        echo "<script>
        Swal.fire({
            icon: 'success',
            title: 'Berhasil',
            text: 'Data berhasil masuk kedalam database',
            showClass: {
                popup: 'animate__animated animate__fadeInDown'
            },
            hideClass: {
                popup: 'animate__animated animate__fadeOutUp'
            }
        }).then(function() {
            window.location.href = 'index.php?halaman=dataproduk';
        });
        </script>";
    } else {
        echo "<script>
        Swal.fire({
            icon: 'error',
            title: 'Gagal',
            text: 'Data gagal masuk kedalam database',
            showClass: {
                popup: 'animate__animated animate__fadeInDown'
            },
            hideClass: {
                popup: 'animate__animated animate__fadeOutUp'
            }
        }).then(function() {
            window.location.href = 'index.php?halaman=dataproduk';
        });
        </script>";
    }
}
?>
<section class="section">
    <div class="container">
        <div class="row">
            <div class="columns">
                <div class="column">
                    <div class="card">
                        <div class="card-header">
                            <p class="card-header-title">Form Ubah Data Produk</p>
                            <div class="buttons card-header-icon">
                                <a class="button is-link" href="index.php?halaman=dataproduk">
                                    <ion-icon name="arrow-back-circle" class="mr-2"></ion-icon>Kembali
                                </a>
                            </div>
                        </div>
                        <div class="card-content">
                            <form action="" method="post">
                                <div class="field">
                                    <label class="label">Kode Alternatif</label>
                                    <div class="control has-icons-left">
                                        <input type="hidden" value="<?= $row["id_produk"]; ?>" name="id_produk">
                                        <input class="input" type="text" placeholder="Nama Produk" name="kode_alternatif" value="<?= $row["kode_alternatif"] ?>">
                                        <span class="icon is-small is-left">
                                            <ion-icon name="qr-code"></ion-icon>
                                        </span>
                                    </div>
                                </div>
                                <div class="field">
                                    <label class="label">Nama Produk</label>
                                    <div class="control has-icons-left">
                                        <input class="input" type="text" placeholder="Nama Prosuk" name="nm_produk" value="<?= $row["nm_produk"]; ?>">
                                        <span class="icon is-small is-left">
                                            <ion-icon name="home"></ion-icon>
                                        </span>
                                    </div>
                                </div>
                                <div class="field">
                                    <label class="label">Satuan</label>
                                    <div class="control has-icons-left">
                                        <input class="input" type="text" placeholder="Satuan" name="satuan" value="<?= $row["satuan"]; ?>">
                                        <span class="icon is-small is-left">
                                            <ion-icon name="home"></ion-icon>
                                        </span>
                                    </div>
                                </div>
                                <div class="buttons">
                                    <button class="button is-link" type="submit" name="edit">
                                        <ion-icon name="save" class="mr-2"></ion-icon>Simpan
                                    </button>
                                    <button class="button is-link" type="reset">
                                        <ion-icon name="refresh-circle" class="mr-2"></ion-icon>Reset
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>