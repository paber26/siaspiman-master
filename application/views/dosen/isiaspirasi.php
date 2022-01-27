<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>
    <div class="row">
        <div class="col-lg">
            <?= $this->session->flashdata('message'); ?>
            <div class="row">
                <div class="col-lg">
                    <a href="<?= base_url('dosen/exportAspirasi/'); ?>" class="btn btn-primary mb-3">Ekspor Aspirasi Aspician</a>
                </div>
            </div>
            <table id="tabelsaya" class="table">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Waktu</th>
                        <th scope="col">NIM</th>
                        <th scope="col">Aspician</th>
                        <th scope="col">Untuk</th>
                        <th scope="col">Isi Sambatan</th>
                        <!-- <th scope="col">Action</th> -->

                    </tr>
                </thead>
                <tbody>
                    <?php $i = 1; ?>
                    <?php foreach ($sambat as $s) : ?>
                        <tr>
                            <th scope="row"><?= $i; ?></th>

                            <td><?= date('d F Y', $s['date_created']); ?></td>
                            <td><?= $s['nim']; ?></td>
                            <td><?= $s['dari']; ?></td>
                            <td><?= $s['untuk']; ?></td>
                            <td><?= $s['isi']; ?></td>
                            <!-- <td>
                                <a href="<?= base_url() ?>dosen/hapusaspirasi/<?= $s['id'] ?>" class="badge badge-danger" onclick="return confirm('yakin mau dihapus?') ">delete</a>
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