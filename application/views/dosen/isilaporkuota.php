<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>
    <div class="row">
        <div class="col-lg">
            <?= $this->session->flashdata('message'); ?>
            <div class="row">
                <div class="col-lg">
                    <a href="<?= base_url('dosen/exportLaporKuota/'); ?>" class="btn btn-primary mb-3">Ekspor Pelaporan Kuota</a>
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
                        <!-- <th scope="col">Action</th> -->

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
                            <!-- <td>
                                <a href="<?= base_url() ?>dosen/hapuslaporankuota/<?= $k['id'] ?>" class="badge badge-danger" onclick="return confirm('yakin menghapus data?')">delete</a>
                            </td> -->

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