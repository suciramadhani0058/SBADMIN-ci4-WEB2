<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title><?= $title ?? 'Dashboard' ?></title>

    <!-- SB Admin CSS -->
    <link href="<?= base_url('sbadmin/vendor/fontawesome-free/css/all.min.css') ?>" rel="stylesheet">
    <link href="<?= base_url('sbadmin/css/sb-admin-2.min.css') ?>" rel="stylesheet">
</head>

<body id="page-top">

<div id="wrapper">

    <?= $this->include('partials/sidebar') ?>

    <div id="content-wrapper" class="d-flex flex-column">
        <div id="content">

            <?= $this->include('partials/topbar') ?>

            <div class="container-fluid">
                <?= $this->renderSection('content') ?>
            </div>

        </div>

        <?= $this->include('partials/footer') ?>
    </div>

</div>

<!-- JS -->
<script src="<?= base_url('sbadmin/vendor/jquery/jquery.min.js') ?>"></script>
<script src="<?= base_url('sbadmin/vendor/bootstrap/js/bootstrap.bundle.min.js') ?>"></script>
<script src="<?= base_url('sbadmin/js/sb-admin-2.min.js') ?>"></script>

<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap4.min.js"></script>

<script>
    $(document).ready(function () {
        $('#dataTable').DataTable({
            "language": {
                "search": "Cari:",
                "lengthMenu": "Tampilkan _MENU_ data",
                "info": "Menampilkan _START_ sampai _END_ dari _TOTAL_ data",
                "paginate": {
                    "next": "Next",
                    "previous": "Previous"
                },
                "zeroRecords": "Data tidak ditemukan"
            },
            "columnDefs": [
                { "orderable": false, "targets": 4 } // kolom Aksi tidak bisa di-sort
            ]
        });
    });
</script>

</body>
</html>
