<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <?= $this->session->flashdata('message'); ?>
    <div class="row">
        <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>
        <div class="col-lg text-right">
            <a href="" class="btn btn-primary mb-3" data-toggle="modal" data-target="#newPengumumanModal">Tambah Pengumuman</a>
        </div>
    </div>
    <br/>

    <div class="row">
        <div class="col-lg">
            <table id="tabelsaya" class="table">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Tanggal</th>
                        <th scope="col">Judul</th>
                        <th scope="col">Dibuat Oleh</th>
                        <th scope="col">Isi</th>
                        <th scope="col">Gambar</th>
                        <th scope="col">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i = 1; ?>
                    <?php foreach ($pengumuman as $p) : ?>
                        <tr>
                            <th scope="row"><?= $i; ?></th>

                            <td><?= date("d F Y", strtotime($p['createdAt'])); ?></td>
                            <td><?= $p['judul']; ?></td>
                            <td><?= $p['createdBy']; ?></td>
                            <td><?= $p['isi']; ?></td>
                            <td>
                                <img src="<?php echo base_url('assets/img/pengumuman/'.$p['img']) ?>" width="64" />
                                <br/>
                                <?= $p['img']; ?>
                            </td>
                            <td>
                                <a href="<?= base_url() ?>admin/hapuspengumuman/<?= $p['id'] ?>" class="badge badge-danger" onclick="return confirm('yakin mau dihapus?') ">delete</a>
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

<!-- Modal -->
<div class="modal fade" id="newPengumumanModal" tabindex="-1" role="dialog" aria-labelledby="newRoleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="newRoleModalLabel">Tambah Pengumuman</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?= site_url('admin/isipengumuman'); ?>" method="post" enctype="multipart/form-data">
                <div class="modal-body">
                     <div class="form-group row">
                        <label for="judul" class="col-sm-3 col-form-label">Judul</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="judul" name="judul" placeholder="Masukan Judul">
                            <?= form_error('judul', '<small class="text-danger pl-3">', '</small>'); ?>
                        </div>
                    </div>
            
                    <div class="form-group row">
                        <label for="isi" class="col-sm-3 col-form-label">Isi Pengumuman</label>
                        <div class="col-sm-9">
                            <textarea type="text" rows="5" class="form-control" id="isi" name="isi" placeholder="Masukan Isi Pengemumuman"></textarea>
                            <?= form_error('isi', '<small class="text-danger pl-3">', '</small>'); ?>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="upload" class="col-sm-3 col-form-label">Upload Gambar</label>
                        <div class="col-sm-9">
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="uploadimage" name="uploadimage">
                                <label class="custom-file-label" for="image">Choose file</label>
                            </div>
                            
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Add</button>
                </div>
            </form>
        </div>
    </div>
</div>