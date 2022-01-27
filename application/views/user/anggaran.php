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
            Anggaran
        </button>
        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
            <a class="dropdown-item" href="#">Pengajuan</a>
            <a class="dropdown-item" href="#">Penganggaran</a>
            <a class="dropdown-item" href="#">UKM/Divisi</a>
            <a class="dropdown-item" href="#">Mahasiswa</a>
            <a class="dropdown-item" href="#">Laporan</a>
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

            <div class="row align-items-start">
                <table class="table col col mx-2">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Tanggal</th>
                            <th scope="col">Nomor</th>
                            <th scope="col">Keterangan</th>
                            <th scope="col">Masuk</th>
                            <th scope="col">Keluar</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <th scope="row"></th>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                    </tbody>
                </table>
                <div class="card col col-lg-3 x-2">
                    <div class="card-body">
                        <h5 class="card-title">Total Anggaran</h5>
                        <!-- <p class="card-text">Tahun -</p> -->
                    </div>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">Anggaran - </li>
                        <li class="list-group-item">Realisasi - </li>
                        <li class="list-group-item">Saldo - </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>


</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->
<!-- Modal -->