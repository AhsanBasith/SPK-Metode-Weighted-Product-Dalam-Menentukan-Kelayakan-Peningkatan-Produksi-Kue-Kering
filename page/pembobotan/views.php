<?php
require("../controller/Bobot.php");

$halaman = 5;
$hasil = count(Index("SELECT * FROM pembobotan"));
$total = ceil($hasil / $halaman);
$aktif = (isset($_GET["page"])) ? $_GET["page"] : 1;
$awal = ($halaman * $aktif) - $halaman;

$data = Index("SELECT * FROM pembobotan LIMIT $awal,$halaman");
$banding1 = Index("SELECT * FROM produk");
$banding2 = Index("SELECT * FROM kriteria");
?>
<section class="section">
    <div class="container">
        <div class="row">
            <div class="columns">
                <div class="column">
                    <div class="card animate__animated animate__zoomIn">
                        <div class="card-header">
                            <p class="card-header-title">Table Pembobotan</p>
                            <div class="buttons card-header-icon">
                                <a class="button is-link" href="index.php?halaman=tambahdatabobot">
                                    <ion-icon name="add-circle" class="mr-2"></ion-icon>Tambah Data
                                </a>
                            </div>
                        </div>
                        <div class="card-content">
                            <div class="table-container">
                                <table class="table is-fullwidth">
                                    <thead class="has-background-grey">
                                        <tr>
                                            <th class="has-text-white">No</th>
                                            <th class="has-text-white">Kriteria</th>
                                            <th class="has-text-white">Produk</th>
                                            <th class="has-text-white">Nilai</th>
                                            <th class="has-text-white">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tfoot class="has-background-grey has-text-white">
                                        <tr>
                                            <th class="has-text-white">No</th>
                                            <th class="has-text-white">Kriteria</th>
                                            <th class="has-text-white">Produk</th>
                                            <th class="has-text-white">Nilai</th>
                                            <th class="has-text-white">Aksi</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        <?php $i = 1 + $awal ?>
                                        <?php foreach ($data as $row) : ?>
                                            <tr>
                                                <th><?= $i ?></th>
                                                <td>
                                                    <?php foreach ($banding2 as $hasil) : ?>
                                                        <?php if ($row["id_kriteria"] == $hasil["id_kriteria"]) : ?>
                                                            <?= $hasil["nm_kriteria"] ?>
                                                        <?php endif ?>
                                                    <?php endforeach ?>
                                                </td>
                                                <td>
                                                    <?php foreach ($banding1 as $result) : ?>
                                                        <?php if ($row["id_produk"] == $result["id_produk"]) : ?>
                                                            <?= $result["nm_produk"] ?><sub>/<?= $result["satuan"] ?></sub>
                                                        <?php endif ?>
                                                    <?php endforeach ?>
                                                </td>
                                                <td>
                                                    <?php if ($row["nilai"] > 1000000) : ?>
                                                        <?= "Rp " . number_format($row["nilai"], 2, ',', '.'); ?></td>
                                            <?php else : ?>
                                                <?= $row["nilai"] ?>
                                            <?php endif ?>
                                            <td>
                                                <div class="buttons">
                                                    <a class="button is-success" href="index.php?halaman=editdatabobot&id=<?= $row['id_nilai']; ?>">
                                                        <ion-icon name="create"></ion-icon> Edit
                                                    </a>
                                                    <button class="button is-danger" onclick="archiveFunction()">
                                                        <ion-icon name="trash"></ion-icon> Delete
                                                    </button>
                                                </div>
                                            </td>
                                            </tr>
                                            <?php $i++ ?>
                                        <?php endforeach ?>
                                    </tbody>
                                </table>
                            </div>
                            <?php require '../controller/PaginationBobot.php'; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="container">
    <div class="container">
        <div class="card-header">
            <p class="card-header-title">Keterangan Nilai Bobot Kriteria</p>
        </div>
        <div class="card-content">
            <div class="content">
                <div class="tile is-ancestor">
                    <div class="tile">
                        <div class="tile is-parent">
                            <article class="tile is-child notification is-primary">
                                <p class="subtitle">Harga Produk</p>
                                <hr>
                                <p class="subtitle">
                                <table class="table is-fullwidth  is-bordered">
                                    <thead>
                                        <tr>

                                            <th>Harga</th>
                                            <th>Nilai</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>≤20k</td>
                                            <td>1</td>
                                        </tr>
                                        <tr>
                                            <td>50k-100k</td>
                                            <td>3</td>
                                        </tr>
                                        <tr>
                                            <td>≥150k</td>
                                            <td>5</td>
                                        </tr>
                                    </tbody>
                                </table>
                                <a class="button js-modal-trigger" data-target="modal-detail-harga">view details</a>
                            </article>

                        </div>
                    </div>
                    <div class="tile">
                        <div class="tile is-parent">
                            <article class="tile is-child notification is-info">
                                <p class="subtitle">Kualitas </p>
                                <hr>
                                <table class="table is-fullwidth  is-bordered">
                                    <thead>
                                        <tr>

                                            <th>Kualitas</th>
                                            <th>Nilai</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>Buruk</td>
                                            <td>1</td>
                                        </tr>
                                        <tr>
                                            <td>Cukup</td>
                                            <td>3</td>
                                        </tr>
                                        <tr>
                                            <td>Baik</td>
                                            <td>5</td>
                                        </tr>
                                    </tbody>
                                </table><br>
                                <a class="button js-modal-trigger" data-target="modal-detail-kualitas">view details</a>
                            </article>
                        </div>
                    </div>
                    <div class="tile">
                        <div class="tile is-parent">
                            <article class="tile is-child notification is-warning">
                                <p class="subtitle">Rasa</p>
                                <hr>
                                <table class="table is-fullwidth  is-bordered">
                                    <thead>
                                        <tr>

                                            <th>Rasa</th>
                                            <th>Nilai</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>Tidak Enak</td>
                                            <td>1</td>
                                        </tr>
                                        <tr>
                                            <td>Lumayan</td>
                                            <td>3</td>
                                        </tr>
                                        <tr>
                                            <td>Enak</td>
                                            <td>5</td>
                                        </tr>
                                    </tbody>
                                </table>
                                <a class="button js-modal-trigger" data-target="modal-detail-rasa">view details</a>
                            </article>
                        </div>
                    </div>
                    <div class="tile">
                        <div class="tile is-parent">
                            <article class="tile is-child notification is-danger">
                                <p class="subtitle">Penjualan</p>
                                <hr>
                                <table class="table is-fullwidth  is-bordered">
                                    <thead>
                                        <tr>

                                            <th>Penjualan</th>
                                            <th>Nilai</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>0</td>
                                            <td>1</td>
                                        </tr>
                                        <tr>
                                            <td>1-50</td>
                                            <td>3</td>
                                        </tr>
                                        <tr>
                                            <td>≥50</td>
                                            <td>5</td>
                                        </tr>
                                    </tbody>
                                </table><br>
                                <a class="button js-modal-trigger" data-target="modal-detail-penjualan">view details</a>
                            </article>
                        </div>
                    </div>
                    <div class="tile">
                        <div class="tile is-parent">
                            <article class="tile is-child notification is-black">
                                <p class="subtitle">Biaya Produksi</p>
                                <hr>
                                <table class="table is-fullwidth  is-bordered">
                                    <thead>
                                        <tr>

                                            <th>Penjualan</th>
                                            <th>Nilai</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>≤50k</td>
                                            <td>1</td>
                                        </tr>
                                        <tr>
                                            <td>50k-100k</td>
                                            <td>3</td>
                                        </tr>
                                        <tr>
                                            <td>≥100k</td>
                                            <td>5</td>
                                        </tr>
                                    </tbody>
                                </table><br>
                                <a class="button js-modal-trigger" data-target="modal-detail-biaya">view details</a>
                            </article>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="section"></section>


<!-- Modal Detail Harga -->

<div id="modal-detail-harga" class="modal">
    <div class="modal-background"></div>

    <div class="modal-card animate__animated animate__zoomIn has-text-centered" style="margin-top: 10px;">
        <header class="modal-card-head">
            <p class="modal-card-title">Detail Kriteria Harga</p>
            <button class="delete" aria-label="close"></button>
        </header>
        <section class="modal-card-body" style="height: 350px;">

            <table class="table is-fullwidth is-bordered">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Produk</th>
                        <th>Harga</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <th>1</th>
                        <td>Pia Coklat</td>
                        <td>Rp.1000</td>
                    </tr>
                    <tr>
                        <th>2</th>
                        <td>Pia Keju</td>
                        <td>Rp.1000</td>
                    </tr>
                    <tr>
                        <th>1</th>
                        <td>Pia Coklat Kacang</td>
                        <td>Rp.1000</td>
                    </tr>
                    <tr>
                        <th>3</th>
                        <td>Pia Kacang Ijo</td>
                        <td>Rp.1000</td>
                    </tr>
                    <tr>
                        <th>4</th>
                        <td>Pia Coklat</td>
                        <td>Rp.1000</td>
                    </tr>
                    <tr>
                        <th>5</th>
                        <td>Pia Coklat</td>
                        <td>Rp.1000</td>
                    </tr>
                    <tr>
                        <th>6</th>
                        <td>Putri Salju</td>
                        <td>Rp.350.000</td>
                    </tr>
                    <tr>
                        <th>7</th>
                        <td>Nastar</td>
                        <td>Rp.350.000</td>
                    </tr>
                    <tr>
                        <th>8</th>
                        <td>Silver Queen</td>
                        <td>Rp.350.000</td>
                    </tr>
                    <tr>
                        <th>9</th>
                        <td>COklat Keju Batang</td>
                        <td>Rp.350.000</td>
                    </tr>
                    <tr>
                        <th>10</th>
                        <td>Curuti</td>
                        <td>Rp.90.000</td>
                    </tr>
                    <tr>
                        <th>11</th>
                        <td>Selai Daun</td>
                        <td>Rp.350.000</td>
                    </tr>
                    <tr>
                        <th>12</th>
                        <td>Selai Bulat</td>
                        <td>Rp.350.000</td>
                    </tr>
                    <tr>
                        <th>13</th>
                        <td>Spekulasi</td>
                        <td>Rp.275.000</td>
                    </tr>
                    <tr>
                        <th>14</th>
                        <td>Sultana</td>
                        <td>Rp.350.000</td>
                    </tr>
                </tbody>

            </table>

        </section>
        <footer class="modal-card-foot ">
            <button class="button is-danger">Tutup</button>
        </footer>
    </div>

    <button class="modal-close is-large" aria-label="close"></button>
</div>

<!-- Modal Detail Kualitas -->
<div id="modal-detail-kualitas" class="modal">
    <div class="modal-background"></div>

    <div class="modal-card animate__animated animate__zoomIn has-text-centered " style="margin-top: 10px;">
        <header class=" modal-card-head">
            <p class="modal-card-title">Detail Kriteria Kualitas</p>
            <button class="delete" aria-label="close"></button>
        </header>
        <section class="modal-card-body" style="height: 350px;">
            <p>Menurut Hasil survey yang telah dilakukan, hasil yang didapat untuk menilai kualitas produk adalah sebagai berikut :</p><br>
            <table class="table is-fullwidth is-bordered">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Produk</th>
                        <th>Buruk</th>
                        <th>Cukup</th>
                        <th>Baik</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <th>1</th>
                        <td>Pia Coklat</td>
                        <td>0</td>
                        <td>3</td>
                        <td>22</td>
                    </tr>
                    <tr>
                        <th>2</th>
                        <td>Pia Keju</td>
                        <td>0</td>
                        <td>4</td>
                        <td>21</td>
                    </tr>
                    <tr>
                        <th>3</th>
                        <td>Pia Coklat Kacang</td>
                        <td>0</td>
                        <td>10</td>
                        <td>15</td>
                    </tr>
                    <tr>
                        <th>4</th>
                        <td>Pia Pandan</td>
                        <td>0</td>
                        <td>6</td>
                        <td>19</td>
                    </tr>
                    <tr>
                        <th>5</th>
                        <td>Pia Kacang Ijo</td>
                        <td>0</td>
                        <td>25</td>
                        <td>0</td>
                    </tr>
                    <tr>
                        <th>6</th>
                        <td>Putri Salju</td>
                        <td>0</td>
                        <td>3</td>
                        <td>22</td>
                    </tr>
                    <tr>
                        <th>7</th>
                        <td>Nastar</td>
                        <td>0</td>
                        <td>2</td>
                        <td>23</td>
                    </tr>
                    <tr>
                        <th>8</th>
                        <td>Silver Queen</td>
                        <td>0</td>
                        <td>2</td>
                        <td>24</td>
                    </tr>
                    <tr>
                        <th>9</th>
                        <td>Coklat Keju Batang</td>
                        <td>0</td>
                        <td>0</td>
                        <td>25</td>
                    </tr>
                    <tr>
                        <th>10</th>
                        <td>Curuti</td>
                        <td>0</td>
                        <td>9</td>
                        <td>16</td>
                    </tr>
                    <tr>
                        <th>11</th>
                        <td>Selai Daun</td>
                        <td>0</td>
                        <td>1</td>
                        <td>24</td>
                    </tr>
                    <tr>
                        <th>12</th>
                        <td>Selai Bulat</td>
                        <td>0</td>
                        <td>2</td>
                        <td>23</td>
                    </tr>
                    <tr>
                        <th>13</th>
                        <td>Spekulasi</td>
                        <td>0</td>
                        <td>5</td>
                        <td>20</td>
                    </tr>
                    <tr>
                        <th>14</th>
                        <td>Sultana</td>
                        <td>0</td>
                        <td>8</td>
                        <td>17</td>
                    </tr>
                </tbody>

            </table>
        </section>
        <footer class="modal-card-foot">
            <button class="button is-danger">Close</button>
        </footer>
    </div>

    <button class="modal-close is-large" aria-label="close"></button>
</div>

<!-- Modal Detail Rasa -->
<div id="modal-detail-rasa" class="modal">
    <div class="modal-background"></div>

    <div class="modal-card animate__animated animate__zoomIn has-text-centered" style="margin-top: 10px;">
        <header class="modal-card-head">
            <p class="modal-card-title">Detail Kriteria Rasa</p>
            <button class="delete" aria-label="close"></button>
        </header>
        <section class="modal-card-body" style="height: 350px;">
            <p>Menurut Hasil survey yang telah dilakukan dapat dinilai rasa dari produk sebagai berikut :</p><br>
            <table class="table is-fullwidth is-bordered">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Produk</th>
                        <th>TIdak Enak</th>
                        <th>Lumayan</th>
                        <th>Enak</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <th>1</th>
                        <td>Pia Coklat</td>
                        <td>6.420</td>
                        <td>4.954</td>
                        <td>4.230</td>
                    </tr>
                    <tr>
                        <th>2</th>
                        <td>Pia Keju</td>
                        <td>3.910</td>
                        <td>3.133</td>
                        <td>3.159</td>
                    </tr>
                    <tr>
                        <th>3</th>
                        <td>Pia Coklat Kacang</td>
                        <td>1.527</td>
                        <td>2.230</td>
                        <td>1979</td>
                    </tr>
                    <tr>
                        <th>4</th>
                        <td>Pia Pandan</td>
                        <td>2.875</td>
                        <td>2.549</td>
                        <td>1.908</td>
                    </tr>
                    <tr>
                        <th>5</th>
                        <td>Pia Kacang Ijo</td>
                        <td>0</td>
                        <td>0</td>
                        <td>0</td>
                    </tr>
                    <tr>
                        <th>6</th>
                        <td>Putri Salju</td>
                        <td>0</td>
                        <td>0</td>
                        <td>0</td>
                    </tr>
                    <tr>
                        <th>7</th>
                        <td>Nastar</td>
                        <td>0</td>
                        <td>0</td>
                        <td>0</td>
                    </tr>
                    <tr>
                        <th>8</th>
                        <td>Silver Queen</td>
                        <td>0</td>
                        <td>0</td>
                        <td>0</td>
                    </tr>
                    <tr>
                        <th>9</th>
                        <td>Coklat Keju Batang</td>
                        <td>0</td>
                        <td>0</td>
                        <td>0</td>
                    </tr>
                    <tr>
                        <th>10</th>
                        <td>Curuti</td>
                        <td>0</td>
                        <td>0</td>
                        <td>2</td>
                    </tr>
                    <tr>
                        <th>11</th>
                        <td>Selai Daun</td>
                        <td>0</td>
                        <td>0</td>
                        <td>0</td>
                    </tr>
                    <tr>
                        <th>12</th>
                        <td>Selai Bulat</td>
                        <td>0</td>
                        <td>0</td>
                        <td>0</td>
                    </tr>
                    <tr>
                        <th>13</th>
                        <td>Spekulasi</td>
                        <td>0</td>
                        <td>0</td>
                        <td>0</td>
                    </tr>
                    <tr>
                        <th>14</th>
                        <td>Sultana</td>
                        <td>0</td>
                        <td>1</td>
                        <td>0</td>
                    </tr>
                </tbody>

            </table>
        </section>
        <footer class="modal-card-foot">
            <button class="button is-danger">Close</button>
        </footer>
    </div>

    <button class="modal-close is-large" aria-label="close"></button>
</div>

<!-- Modal Detail Penjualan -->
<div id="modal-detail-penjualan" class="modal">
    <div class="modal-background"></div>

    <div class="modal-card animate__animated animate__zoomIn has-text-centered" style="margin-top: 10px;">
        <header class="modal-card-head">
            <p class="modal-card-title">Detail Kriteria Penjualan</p>
            <button class="delete" aria-label="close"></button>
        </header>
        <section class="modal-card-body" style="height: 350px;">
            <table class="table is-fullwidth is-bordered">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Produk</th>
                        <th>Januari</th>
                        <th>Februari</th>
                        <th>Maret</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <th>1</th>
                        <td>Pia Coklat</td>
                        <td>6.420</td>
                        <td>4.954</td>
                        <td>4.230</td>
                    </tr>
                    <tr>
                        <th>2</th>
                        <td>Pia Keju</td>
                        <td>3.910</td>
                        <td>3.133</td>
                        <td>3.159</td>
                    </tr>
                    <tr>
                        <th>3</th>
                        <td>Pia Coklat Kacang</td>
                        <td>1.527</td>
                        <td>2.230</td>
                        <td>1979</td>
                    </tr>
                    <tr>
                        <th>4</th>
                        <td>Pia Pandan</td>
                        <td>2.875</td>
                        <td>2.549</td>
                        <td>1.908</td>
                    </tr>
                    <tr>
                        <th>5</th>
                        <td>Pia Kacang Ijo</td>
                        <td>0</td>
                        <td>0</td>
                        <td>0</td>
                    </tr>
                    <tr>
                        <th>6</th>
                        <td>Putri Salju</td>
                        <td>0</td>
                        <td>0</td>
                        <td>0</td>
                    </tr>
                    <tr>
                        <th>7</th>
                        <td>Nastar</td>
                        <td>0</td>
                        <td>0</td>
                        <td>0</td>
                    </tr>
                    <tr>
                        <th>8</th>
                        <td>Silver Queen</td>
                        <td>0</td>
                        <td>0</td>
                        <td>0</td>
                    </tr>
                    <tr>
                        <th>9</th>
                        <td>Coklat Keju Batang</td>
                        <td>0</td>
                        <td>0</td>
                        <td>0</td>
                    </tr>
                    <tr>
                        <th>10</th>
                        <td>Curuti</td>
                        <td>0</td>
                        <td>0</td>
                        <td>2</td>
                    </tr>
                    <tr>
                        <th>11</th>
                        <td>Selai Daun</td>
                        <td>0</td>
                        <td>0</td>
                        <td>0</td>
                    </tr>
                    <tr>
                        <th>12</th>
                        <td>Selai Bulat</td>
                        <td>0</td>
                        <td>0</td>
                        <td>0</td>
                    </tr>
                    <tr>
                        <th>13</th>
                        <td>Spekulasi</td>
                        <td>0</td>
                        <td>0</td>
                        <td>0</td>
                    </tr>
                    <tr>
                        <th>14</th>
                        <td>Sultana</td>
                        <td>0</td>
                        <td>1</td>
                        <td>0</td>
                    </tr>
                </tbody>

            </table>
        </section>
        <footer class="modal-card-foot">
            <button class="button is-danger">Close</button>
        </footer>
    </div>

    <button class="modal-close is-large" aria-label="close"></button>
</div>

<!-- Modal Detail Biaya Produksi -->
<div id="modal-detail-biaya" class="modal">
    <div class="modal-background"></div>

    <div class="modal-card animate__animated animate__zoomIn has-text-centered" style="margin-top: 10px;">
        <header class="modal-card-head">
            <p class="modal-card-title">Detail Kriteria Biaya Produksi</p>
            <button class="delete" aria-label="close"></button>
        </header>
        <section class="modal-card-body" style="height: 350px;">
            <p class="article">Dari hasil wawancara terhadap owner toko cocolips dikatakan detail perincian biaya produksi sebagai berikut :</p><br>
            <table class="table is-fullwidth is-bordered">
                <thead>
                    <tr>
                        <th>Produk</th>
                        <th>Persentase</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Jenis Pia</td>
                        <td>65%</td>
                    </tr>
                    <tr>
                        <td>Jenis Lainnya</td>
                        <td>55%</td>
                    </tr>
                </tbody>
            </table>

            <p>Dari persentase diatas dapat disimpulkan biaya produksi sebagai berikut :</p><br>

            <table class="table is-fullwidth is-bordered">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Produk</th>
                        <th>Biaya Produksi</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <th>1</th>
                        <td>Pia Coklat</td>
                        <td>65/100x1000 = 650/pcs</td>
                    </tr>
                    <tr>
                        <th>2</th>
                        <td>Pia Keju</td>
                        <td>65/100x1000 = 650/pcs</td>
                    </tr>
                    <tr>
                        <th>3</th>
                        <td>Pia Coklat Kacang</td>
                        <td>65/100x1000 = 650/pcs</td>
                    </tr>
                    <tr>
                        <th>4</th>
                        <td>Pia Pandan</td>
                        <td>65/100x1000 = 650/pcs</td>
                    </tr>
                    <tr>
                        <th>5</th>
                        <td>Pia Kacang Ijo</td>
                        <td>65/100x1000 = 650/pcs</td>
                    </tr>
                    <tr>
                        <th>6</th>
                        <td>Putri Salju</td>
                        <td>55/100x350000 = 192.500/toples</td>
                    </tr>
                    <tr>
                        <th>7</th>
                        <td>Nastar</td>
                        <td>55/100x350000 = 192.500/toples</td>
                    </tr>
                    <tr>
                        <th>8</th>
                        <td>Silver Queen</td>
                        <td>55/100x350000 = 192.500/toples</td>
                    </tr>
                    <tr>
                        <th>9</th>
                        <td>Coklat Keju Batang</td>
                        <td>55/100x350000 = 192.500/toples</td>
                    </tr>
                    <tr>
                        <th>10</th>
                        <td>Curuti</td>
                        <td>55/100x90000 = 49.500/toples</td>
                    </tr>
                    <tr>
                        <th>11</th>
                        <td>Selai Daun</td>
                        <td>55/100x350000 = 192.500/toples</td>
                    </tr>
                    <tr>
                        <th>12</th>
                        <td>Selai Bulat</td>
                        <td>55/100x350000 = 192.500/toples</td>
                    </tr>
                    <tr>
                        <th>13</th>
                        <td>Spekulasi</td>
                        <td>55/100x275000 = 151.250/toples</td>
                    </tr>
                    <tr>
                        <th>14</th>
                        <td>Sultana</td>
                        <td>55/100x350000 = 192.500/toples</td>
                    </tr>
                </tbody>

            </table>
        </section>
        <footer class="modal-card-foot">
            <button class="button is-danger">Close</button>
        </footer>
    </div>

    <button class="modal-close is-large" aria-label="close"></button>
</div>



<script>
    function archiveFunction() {
        // event.preventDefault(); // prevent form submit
        Swal.fire({
            title: 'Yakin mau hapus data ini?',
            text: "kalo sudah dihapus, tidak bisa dibalikin ya!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#276CDA',
            cancelButtonColor: '#F03A5F',
            confirmButtonText: 'Iya, hapus aja',
            showClass: {
                popup: 'animate__animated animate__fadeInDown'
            },
            hideClass: {
                popup: 'animate__animated animate__fadeOutUp'
            }
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = "index.php?halaman=hapusdatabobot&id=<?= $row['id_nilai']; ?>";
            }
        })
    }
</script>