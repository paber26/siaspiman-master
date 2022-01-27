<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?> Politeknik Statistika STIS</h1>
    <div class="row">
        <div class="col-lg">
            <?= $this->session->flashdata('message'); ?>

            <div class="row">
                <div class="col-lg">
                    <a href="<?= '#uploadfile' ?>" class="btn btn-primary mb-3" data-toggle="modal">Upload File Database Mahasiswa</a>
                    <a href="<?= base_url('admin/exportMhs/'); ?>" class="btn btn-primary mb-3">Ekspor Data Mahasiswa</a>
                </div>
            </div>

            <table id="tabelsaya" class="table">

                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Nama</th>
                        <th scope="col">Email</th>
                        <th scope="col">NIM</th>
                        <th scope="col">Kelas</th>
                        <th scope="col">Nomor handphone</th>
                        <th scope="col">Action</th>

                    </tr>
                </thead>
                <tbody>
                    <?php $i = 1; ?>
                    <?php foreach ($database as $d) : ?>
                        <tr>
                            <th scope="row"><?= $i; ?></th>
                            <td><?= $d['name']; ?></td>
                            <td><?= $d['email']; ?></td>
                            <td><?= $d['nim']; ?></td>
                            <td><?= $d['kelas']; ?></td>
                            <td><?= $d['nohp']; ?></td>
                            <td>
                                <a href="<?= base_url() ?>admin/hapusdatabase/<?= $d['id'] ?>" class="badge badge-danger" onclick="return confirm('yakin mau dihapus?') ">delete</a>
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

<!-- modal upload file excel -->
<div class="modal fade" id="uploadfile" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="uploadfile">Upload File Database Mahasiswa</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="POST" action="<?= base_url('admin/upload') ?>" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="form-group">
                        <input type="file" name="userfile" class="form-control-file">
                    </div>
                    <!-- <small class="text-primary">*untuk membuat jadwal download file template dibawah</small>
                    <a href="<?= base_url('admin/exporttemplate/'); ?>" class="btn btn-secondary mb-3">Download File Template Jadwal</a> -->
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>