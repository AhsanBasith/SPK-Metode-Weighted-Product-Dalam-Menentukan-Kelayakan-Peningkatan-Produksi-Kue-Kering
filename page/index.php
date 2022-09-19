<?php
require("../controller/Login.php");

session_start();

if (!isset($_SESSION['login'])) {
    header("Location: ../index.php");
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>WP</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css">
    <link rel="stylesheet" href="../asset/css/bulma.min.css">
    <link rel="stylesheet" href="../asset/css/animate.min.css">
    <link rel="stylesheet" href="../asset/css/fontawesome.min.css">
    <link rel="stylesheet" href="../asset/css/styles.css">
    <!-- DataTables -->
    <link rel="stylesheet" href="../asset/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="../asset/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
    <link rel="stylesheet" href="../asset/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">


    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
</head>

<body>
    <!--=============== HEADER ===============-->
    <header class="header" id="header">
        <nav class="nav container ">
            <a href="#" class="nav__logo" style="font-size: 20px;">WP</a>

            <div class="nav__menu" id="nav-menu">
                <ul class="nav__list">
                    <li class="nav__item">
                        <a href="index.php?halaman=home" class="nav__link">
                            <i class='bx bx-home-alt nav__icon'></i>
                            <span class="nav__name">Home</span>
                        </a>
                    </li>

                    <li class="nav__item">
                        <a href="index.php?halaman=dataproduk" class="nav__link">
                            <i class='bx bx-package nav__icon'></i>
                            <span class="nav__name">Produk</span>
                        </a>
                    </li>

                    <li class="nav__item">
                        <a href="index.php?halaman=datakriteria" class="nav__link">
                            <i class='bx bx-pie-chart nav__icon'></i>
                            <span class="nav__name">Kriteria</span>
                        </a>
                    </li>

                    <li class="nav__item">
                        <a href="index.php?halaman=databobot" class="nav__link">
                            <i class='bx bx-layer nav__icon'></i>
                            <span class="nav__name">Pembobotan</span>
                        </a>
                    </li>

                    <li class="nav__item">
                        <a href="index.php?halaman=datahasil" class="nav__link">
                            <i class='bx bx-message-square-detail nav__icon'></i>
                            <span class="nav__name">Hasil</span>
                        </a>
                    </li>
                    <!-- <li class="nav__item">
                        <a class="js-modal-trigger nav__link" data-target="modal-js-example">
                            <i class='bx bx-log-out has-text-danger nav__icon'></i>
                            <span class="nav__name has-text-danger">Logout</span>
                        </a>
                    </li> -->
                </ul>
            </div>

            <a class="js-modal-trigger" data-target="modal-js-example">
                <i class='bx bx-log-out has-text-danger' style="font-weight: bold;"></i>
                <span class="has-text-danger" style="font-weight: bold;">Logout</span>
            </a>
        </nav>
    </header>

    <!-- HALAMAN -->
    <?php require '../controller/Menu.php' ?>
    <!-- AKHIR HALAMAN -->

    <!-- MODAL LOGOUT    -->

    <div id="modal-js-example" class="modal ">
        <div class="modal-background"></div>
        <div class="modal-card animate__animated animate__zoomIn">
            <header class="modal-card-head">
                <p class="modal-card-title">Logout</p>
                <button class="delete" aria-label="close"></button>
            </header>
            <section class="modal-card-body">
                Yakin ingin Logout? </section>
            <footer class="modal-card-foot">
                <a class="button is-danger" href="../logout.php">Logout</a>
                <button class="button">Cancel</button>
            </footer>
        </div>
    </div>


    <!-- JAVASCRIPT -->
    <script src="../asset/js/main.js"></script>
    <script src="https://unpkg.com/boxicons@2.1.2/dist/boxicons.js"></script>
    <script src="https://unpkg.com/ionicons@5.2.3/dist/ionicons.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/core-js/2.4.1/core.js"></script>
    <script src="asset/js/main.js"></script>
    <script src="https://kit.fontawesome.com/9195575601.js" crossorigin="anonymous"></script>
    <!-- jQuery -->
    <script src="../asset/plugins/jquery/jquery.min.js"></script>
    <!-- DataTables  & Plugins -->
    <script src="../asset/plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="../asset/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
    <script src="../asset/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
    <script src="../asset/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
    <script src="../asset/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
    <script src="../asset/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
    <script src="../asset/plugins/jszip/jszip.min.js"></script>
    <script src="../asset/plugins/pdfmake/pdfmake.min.js"></script>
    <script src="../asset/plugins/pdfmake/vfs_fonts.js"></script>
    <script src="../asset/plugins/datatables-buttons/js/buttons.html5.min.js"></script>
    <script src="../asset/plugins/datatables-buttons/js/buttons.print.min.js"></script>
    <script src="../asset/plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
    <script>
        $(function() {
            $("#example1").DataTable({
                "responsive": true,
                "lengthChange": true,
                "autoWidth": true,
                "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
            }).buttons().container().appendTo('#example1_wrapper .col-md-12:eq(0)');
            $('#example2').DataTable({
                "paging": true,
                "lengthChange": true,
                "searching": false,
                "ordering": true,
                "info": true,
                "autoWidth": true,
                "responsive": true,
            });
        });
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', () => {

            // Get all "navbar-burger" elements
            const $navbarBurgers = Array.prototype.slice.call(document.querySelectorAll('.navbar-burger'), 0);

            // Check if there are any navbar burgers
            if ($navbarBurgers.length > 0) {

                // Add a click event on each of them
                $navbarBurgers.forEach(el => {
                    el.addEventListener('click', () => {

                        // Get the target from the "data-target" attribute
                        const target = el.dataset.target;
                        const $target = document.getElementById(target);

                        // Toggle the "is-active" class on both the "navbar-burger" and the "navbar-menu"
                        el.classList.toggle('is-active');
                        $target.classList.toggle('is-active');

                    });
                });
            }

        });
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
            (document.querySelectorAll('.js-modal-trigger') || []).forEach(($trigger) => {
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

    <script>
        const tabs = document.querySelectorAll('.tabs li');
        const tabContentBoxes = document.querySelectorAll('#tab-content > div');

        tabs.forEach((tab) => {
            tab.addEventListener('click', () => {
                tabs.forEach(item => item.classList.remove('is-active'))
                tab.classList.add('is-active');

                const target = tab.dataset.target;
                tabContentBoxes.forEach(box => {
                    if (box.getAttribute('id') === target) {
                        box.classList.remove('is-hidden');
                    } else {
                        box.classList.add('is-hidden');
                    }
                });
            })
        })
    </script>

</body>

</html>