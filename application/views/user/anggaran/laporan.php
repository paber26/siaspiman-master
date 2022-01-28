<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="row">
        <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>
        <div class="col-lg text-right">
            <!-- <a href="" class="btn btn-primary mb-3" data-toggle="modal" data-target="#newSubMenuModal">Tambahkan Anggaran</a> -->
        </div>
    </div>

    <div class="dropdown">
        <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-expanded="false">
            Laporan
        </button>
        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
            <a class="dropdown-item" href="<?= base_url('user/anggaranpengajuan'); ?>">Pengajuan</a>
            <a class="dropdown-item" href="<?= base_url('user/anggaranpenganggaran'); ?>">Penganggaran</a>
            <a class="dropdown-item" href="<?= base_url('user/anggaranukmdivisi'); ?>">UKM/Divisi</a>
            <a class="dropdown-item" href="<?= base_url('user/anggaranmahasiswa'); ?>">Mahasiswa</a>
            <a class="dropdown-item" href="<?= base_url('user/anggaranlaporan'); ?>">Laporan</a>
        </div>
    </div>

    <div class="row mt-3">
        <div class="col-lg">
            <?php if (validation_errors()) : ?>
                <div class="alert alert-danger" role="alert">
                    <?= validation_errors(); ?>
                </div>
            <?php endif; ?>

            <?= $this->session->flashdata('message'); ?>

            <h1>Masih Kosong</h1>

        </div>
    </div>


</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->
<!-- Modal -->