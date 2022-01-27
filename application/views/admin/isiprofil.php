<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <?= $this->session->flashdata('message'); ?>
    <div class="row">
        <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>
        <div class="col-lg text-right">
            <a href="" class="btn btn-primary mb-3" data-toggle="modal" data-target="#newProfilModal">Tambah Struktur</a>
        </div>
    </div>
    <br/>

    <div class="row">
        <div class="col-lg">
            <table id="tabelsaya" class="table">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Jabatan</th>
                        <th scope="col">Nama</th>
                        <th scope="col">NIM</th>
                        <th scope="col">Kelas</th>
                        <th scope="col">Foto</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i = 1; ?>
                    <?php foreach ($struktur as $s) : ?>
                        <tr>
                            <th scope="row"><?= $i; ?></th>

                            <td><?= $s['jabatan']; ?></td>
                            <td><?= $s['nama']; ?></td>
                            <td><?= $s['nim']; ?></td>
                            <td><?= $s['kelas']; ?></td>
                            <td>
                                <img src="<?php echo base_url('assets/img/struktur/'.$s['img']) ?>" width="64" />
                                <br/>
                                <?= $s['img']; ?>
                            </td>
                            <td>
                                <a href="<?= base_url() ?>admin/hapusprofil/<?= $s['id'] ?>" class="badge badge-danger" onclick="return confirm('yakin mau dihapus?') ">delete</a>
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
<div class="modal fade" id="newProfilModal" tabindex="-1" role="dialog" aria-labelledby="newRoleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="newRoleModalLabel">Tambah Struktur</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?= site_url('admin/isiprofil'); ?>" method="post" enctype="multipart/form-data">
                <div class="modal-body">
                     <div class="form-group row">
                        <label for="nama" class="col-sm-3 col-form-label">Nama</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="nama" name="nama" placeholder="Masukan Nama">
                            <?= form_error('nama', '<small class="text-danger pl-3">', '</small>'); ?>
                        </div>
                    </div>
            
                    <div class="form-group row">
                        <label for="isi" class="col-sm-3 col-form-label">NIM</label>
                        <div class="col-sm-9">
                            <input type="text" rows="5" class="form-control" id="nim" name="nim" placeholder="Masukan NIM">
                            <?= form_error('nim', '<small class="text-danger pl-3">', '</small>'); ?>
                        </div>
                    </div>


                    <div class="form-group row">
                        <label for="isi" class="col-sm-3 col-form-label">Kelas</label>
                        <div class="col-sm-9">
                            <input type="text" rows="5" class="form-control" id="kelas" name="kelas" placeholder="Masukan Kelas">
                            <?= form_error('kelas', '<small class="text-danger pl-3">', '</small>'); ?>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="jbt" class="col-sm-3 col-form-label">Jabatan</label>
                        <div class="col-sm-9">
                            <select id="jbt" name="jbt" class="form-control">
                                <option value=2>Ketua DPM</option>
                                <option value=2>Wakil Ketua DPM</option>
                                <option value=3>Sekretaris</option>
                                <option value=4>Bendahara</option>
                                <option value=51>Ketua Komisi I</option>
                                <option value=52>Ketua Komisi II</option>
                                <option value=53>Ketua Komisi III</option>
                                <option value=54>Ketua Komisi IV</option>
                                <option value=60>Ketua Pubdok</option>
                            </select>
                            <?= form_error('jbtn', '<small class="text-danger pl-3">', '</small>'); ?>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="upload" class="col-sm-3 col-form-label">Upload Foto</label>
                        <div class="col-sm-9">
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="uploadimg" name="uploadimg">
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
