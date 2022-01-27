<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>
    <div class="row">
        <div class="col-lg">
            <?= $this->session->flashdata('message'); ?>
            <div class="row">
                <div class="col-lg">
                    <a href="<?= base_url('admin/exportLaporKuota/'); ?>" class="btn btn-primary mb-3">Ekspor Pelaporan Kuota</a>
                    <!-- <a href="<?= base_url('admin/bukakuota/'); ?>" class="btn btn-info mb-3" onclick="return confirm('apakah anda ingin buka pelaporan kuota?')">Buka Pelaporan Kuota</a> -->
                </div>
                <div class="col-lg text-right">
                    <a href="<?= base_url('admin/resetkuota/'); ?>" class="btn btn-danger mb-3" onclick="return confirm('yakin reset data kuota bulan ini?')">Reset Data</a>
                </div>
            </div>
            <table id="tabelsaya" class="table">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Waktu</th>
                        <th scope="col">Nama Pelapor</th>
                        <th scope="col">NIM</th>
                        <th scope="col">Kelas</th>
                        <th scope="col">No handphone</th>
                        <th scope="col">Provider</th>
                        <th scope="col">Action</th>

                    </tr>
                </thead>
                <tbody>
                    <?php $i = 1; ?>
                    <?php foreach ($kuota as $k) : ?>
                        <tr>
                            <th scope="row"><?= $i; ?></th>

                            <td><?= date('d F Y', $k['date_created']); ?></td>
                            <td><?= $k['nama']; ?></td>
                            <td><?= $k['nim']; ?></td>
                            <td><?= $k['kelas']; ?></td>
                            <td><?= $k['nohp']; ?></td>
                            <td><?= $k['provider']; ?></td>
                            <td>
                                <a href="<?= base_url() ?>admin/hapuslaporankuota/<?= $k['id'] ?>" class="badge badge-danger" onclick="return confirm('yakin menghapus data?')">delete</a>
                            </td>

                        </tr>
                        <?php $i++; ?>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->