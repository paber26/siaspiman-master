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
            Pengajuan
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

            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">NIM</th>
                        <th scope="col">Nama</th>
                        <th scope="col">Kelas</th>
                        <th scope="col">Okt</th>
                        <th scope="col">Nov</th>
                        <th scope="col">...</th>
                        <th scope="col">...</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <th scope="row"></th>
                        <td>1</td>
                        <td>2218</td>
                        <td>Ruth</td>
                        <td>4SI1</td>
                        <td>Lunas</td>
                        <td>Lunas</td>
                        <td>-</td>
                        <td>-</td>
                    </tr>
                    <tr>
                        <th scope="row"></th>
                        <td>2</td>
                        <td>2218</td>
                        <td>Ntah</td>
                        <td>4SI1</td>
                        <td>Belum Lunas</td>
                        <td>Belum Lunas</td>
                        <td>-</td>
                        <td>-</td>
                    </tr>
                </tbody>
            </table>

        </div>
    </div>


</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->
<!-- Modal -->