<?php
require("../controller/Kriteria.php");

$halaman = 5;
$hasil = count(Index("SELECT * FROM kriteria"));
$total = ceil($hasil / $halaman);
$aktif = (isset($_GET["page"])) ? $_GET["page"] : 1;
$awal = ($halaman * $aktif) - $halaman;

$data = Index("SELECT * FROM kriteria LIMIT $awal,$halaman");
?>
<section class="section">
    <div class="container">
        <div class="row">
            <div class="columns">
                <div class="column">
                    <div class="card animate__animated animate__zoomIn">
                        <div class="card-header">
                            <p class="card-header-title">Table Kriteria</p>
                            <div class="buttons card-header-icon">
                                <a class="button is-link" href="index.php?halaman=tambahdatakriteria">
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
                                            <th class="has-text-white">Kode Kriteria</th>
                                            <th class="has-text-white">Nama kriteria</th>
                                            <th class="has-text-white">Bobot</th>
                                            <th class="has-text-white">Status</th>
                                            <th class="has-text-white">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tfoot class="has-background-grey">
                                        <tr>
                                            <th class="has-text-white">No</th>
                                            <th class="has-text-white">Kode Kriteria</th>
                                            <th class="has-text-white">Nama kriteria</th>
                                            <th class="has-text-white">Bobot</th>
                                            <th class="has-text-white">Status</th>
                                            <th class="has-text-white">Aksi</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        <?php $i = 1 + $awal ?>
                                        <?php foreach ($data as $row) : ?>
                                            <tr>
                                                <th><?= $i ?></th>
                                                <td><?= $row["kode_kriteria"] ?></td>
                                                <td><?= $row["nm_kriteria"] ?></td>
                                                <td><?= $row["bobot"] ?></td>
                                                <th><?= $row["status"] ?></th>
                                                <td>
                                                    <div class="buttons">
                                                        <a class="button is-success" href="index.php?halaman=editdatakriteria&id=<?= $row['id_kriteria']; ?>">
                                                            <ion-icon name="create"></ion-icon> Edit
                                                        </a>
                                                        <button class="button is-danger" onclick="DeleteData()">
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
                            <?php require '../controller/PaginationKriteria.php'; ?>
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
                window.location.href = "index.php?halaman=hapusdatakriteria&id=<?= $row['id_kriteria']; ?>";
            }
        })
    }
</script>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        // Functions to open and close a modal
        function openModal($el) {
            $el.classList.add('is-active');
        }

        function closeModal($el) {
            $el.classList.remove('is-active');
        }

        function closeAllModals() {
            (document.querySelectorAll('.modal') || []).forEach(($modal) => {
                closeModal($modal);
            });
        }

        // Add a click event on buttons to open a specific modal
        (document.querySelectorAll('.modal-detail') || []).forEach(($trigger) => {
            const modal = $trigger.dataset.target;
            const $target = document.getElementById(modal);
            console.log($target);

            $trigger.addEventListener('click', () => {
                openModal($target);
            });
        });

        // Add a click event on various child elements to close the parent modal
        (document.querySelectorAll('.modal-background, .modal-close, .modal-card-head .delete, .modal-card-foot .button') || []).forEach(($close) => {
            const $target = $close.closest('.modal');

            $close.addEventListener('click', () => {
                closeModal($target);
            });
        });

        // Add a keyboard event to close all modals
        document.addEventListener('keydown', (event) => {
            const e = event || window.event;

            if (e.keyCode === 27) { // Escape key
                closeAllModals();
            }
        });
    });
</script>