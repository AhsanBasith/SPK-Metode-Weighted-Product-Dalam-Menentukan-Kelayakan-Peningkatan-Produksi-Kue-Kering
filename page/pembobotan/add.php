<?php
require("../controller/Bobot.php");

$produk = Index("SELECT * FROM produk");
$kriteria = Index("SELECT * FROM kriteria");

if (isset($_POST["add"])) {
    if (Add("pembobotan", $_POST) > 0) {
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
            window.location.href = 'index.php?halaman=databobot';
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
            window.location.href = 'index.php?halaman=databobot';
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
                            <p class="card-header-title">Form Tambah pembobotan</p>
                            <div class="buttons card-header-icon">
                                <a class="button is-link" href="index.php?halaman=databobot">
                                    <ion-icon name="arrow-back-circle" class="mr-2"></ion-icon>Kembali
                                </a>
                            </div>
                        </div>
                        <div class="card-content">
                            <form action="" method="post">
                                <div class="field">
                                    <label class="label">Data produk</label>
                                    <div class="control has-icons-left">
                                        <div class="select">
                                            <select name="id_produk">
                                                <option selected disabled>Pilih produk</option>
                                                <?php foreach ($produk as $row) : ?>
                                                    <option value="<?= $row["id_produk"] ?>"><?= $row["nm_produk"] ?></option>
                                                <?php endforeach ?>
                                            </select>
                                        </div>
                                        <div class="icon is-small is-left">
                                            <ion-icon name="chevron-down"></ion-icon>
                                        </div>
                                    </div>
                                </div>
                                <div class="field">
                                    <label class="label">Data Kriteria</label>
                                    <div class="control has-icons-left">
                                        <div class="select">
                                            <select name="id_kriteria">
                                                <option selected disabled>Pilih Kriteria</option>
                                                <?php foreach ($kriteria as $row) : ?>
                                                    <option value="<?= $row["id_kriteria"] ?>"><?= $row["nm_kriteria"] ?></option>
                                                <?php endforeach ?>
                                            </select>
                                        </div>
                                        <div class="icon is-small is-left">
                                            <ion-icon name="chevron-down"></ion-icon>
                                        </div>
                                    </div>
                                </div>
                                <div class="field">
                                    <label class="label">Nilai</label>
                                    <div class="control has-icons-left">
                                        <input class="input" type="text" placeholder="Nilai untuk setiap produk" name="nilai">
                                        <span class="icon is-small is-left">
                                            <ion-icon name="barbell"></ion-icon>
                                        </span>
                                    </div>
                                </div>
                                <div class="buttons">
                                    <button class="button is-link" type="submit" name="add">
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