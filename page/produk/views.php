<?php
include_once("../controller/Produk.php");

$halaman = 5;
$hasil = count(Index("SELECT * FROM produk order by kode_alternatif ASC"));
$total = ceil($hasil / $halaman);
$aktif = (isset($_GET["page"])) ? $_GET["page"] : 1;
$awal = ($halaman * $aktif) - $halaman;

$data = Index("SELECT * FROM produk LIMIT $awal,$halaman");
?>
<section class="section">
    <div class="container">
        <div class="row">
            <div class="columns">
                <div class="column">
                    <div class="card animate__animated animate__zoomIn">
                        <div class="card-header">
                            <p class="card-header-title">Table Produk</p>
                            <div class="buttons card-header-icon">
                                <a class="button is-link" href="index.php?halaman=tambahdataproduk">
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
                                            <th class="has-text-white">Kode Alternatif</th>
                                            <th class="has-text-white">Nama Produk</th>
                                            <th class="has-text-white">Satuan</th>
                                            <th class="has-text-white">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tfoot class="has-background-grey has-text-white">
                                        <tr>
                                            <th class="has-text-white">No</th>
                                            <th class="has-text-white">Kode Alternatif</th>
                                            <th class="has-text-white">Nama Produk</th>
                                            <th class="has-text-white">Satuan</th>
                                            <th class="has-text-white">Aksi</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        <?php $no = 1 + $awal ?>
                                        <?php foreach ($data as $row) : ?>
                                            <tr>
                                                <th><?= $no ?></th>
                                                <td><?= $row["kode_alternatif"] ?></td>
                                                <td><?= $row["nm_produk"] ?></td>
                                                <td><?= $row["satuan"] ?></td>
                                                <td>
                                                    <div class="buttons">
                                                        <a class="button is-success" href="index.php?halaman=editdataproduk&id=<?= $row['id_produk']; ?>">
                                                            <ion-icon name="create"></ion-icon> Edit
                                                        </a>
                                                        <button class="button is-danger" onclick="DeleteData()">
                                                            <ion-icon name="trash"></ion-icon> Hapus
                                                        </button>
                                                    </div>
                                                </td>
                                            </tr>
                                            <?php $no++ ?>
                                        <?php endforeach ?>
                                    </tbody>
                                </table>
                            </div>
                            <?php require '../controller/PaginationProduk.php'; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="section"></section>
<script>
    function DeleteData() {

        Swal.fire({
            title: 'Yakin mau hapus data ini?',
            // text: "",
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
                window.location.href = "index.php?halaman=hapusdataproduk&id=<?= $row['id_produk']; ?>";
            }
        })
    }
</script>