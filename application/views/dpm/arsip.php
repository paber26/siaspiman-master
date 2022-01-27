<!-- Begin Page Content -->
<!-- Begin container-fluid -->
<div class="container-fluid">

    <?= $this->session->flashdata('message'); ?>
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800"><?= $title; ?></h1>
        
        <div class="row">
            <?php if($user['role_id'] == 1):?>
            <div class="col-lg-0 mr-0">
                <a href="" class="btn btn-primary mb-3" data-toggle="modal" data-target="#newDokumenModal">Tambah Dokumen</a>
            </div>
            <?php endif;?>
            <div class="col-lg ml-0">
                <!-- Topbar Search -->
                <form action="<?= base_url('dpm/sarsip'); ?>" method="post"
                    class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
                    <div class="input-group">
                        <input type="text" name="keyword" id="keyword" class="form-control bg-gray-200 border-0 small" placeholder="Search for..."
                            aria-label="Search" aria-describedby="basic-addon2">
                        <div class="input-group-append">
                            <button class="btn btn-primary" type="submit">
                                <i class="fas fa-search fa-sm"></i>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    
    <!-- Card Dokumen -->
    <div class="row">
        <?php foreach ($arsip as $a) : ?>
        <div class="col-xl-3 ">
            <div class="card-deck ">
                <div class="card shadow mb-4" style="height: 20rem;">
                    <div class="dropdown no-arrow dropright text-right m-1">
                        <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink"
                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in"
                            aria-labelledby="dropdownMenuLink">
                            <!-- <div class="dropdown-header">Dropdown Header:</div> -->
                            <a class="dropdown-item" href="<?= base_url() ?>dpm/downloadarsip/<?= $a['file'] ?>"><i class="fas fa-download fa-sm fa-fw text-gray-400 mr-2" ></i>Download</a>
                            <a class="dropdown-item" href="https://docs.google.com/viewerng/viewer?url=<?php echo base_url('assets/arsip/dokumen/'.$a['file']); ?>"><i class="fas fa-eye fa-sm fa-fw text-gray-400 mr-2"></i>View</a>
                            <?php if($user['role_id'] == 1):?>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="<?= base_url() ?>admin/hapusdokumen/<?= $a['id'] ?>" onclick= "return confirm('apakah anda yakin ingin menghapus dokumen?')"><i class="fas fa-trash-alt fa-sm fa-fw text-gray-400 mr-2"></i>Delete</a>
                            <?php endif; ?>
                        </div>
                    </div>
                    <i class="card-img-top <?= $a['img'];?> fa-fw fa-7x text-gray-300 mt-0" ></i>
                    <!-- <img class="card-img-top" src="<?php echo base_url('assets/img/pengumuman/default-img.jpg') ?>" alt="Card image cap"> -->
                    <div class="card-body">
                        <!-- <a class="card-title h6 font-weight-bold text-primary" href="#"><?=$a['file'];?></a> -->
                        <!-- <a class="card-title h6 font-weight-bold text-primary"  href="http://docs.google.com/gview?url=<?php echo base_url('assets/arsip/dokumen/'.$a['file']); ?>&embedded=true"><?=$a['file'];?></a> -->
                        <!-- <a class="card-title h5 font-weight-bold text-primary" href="https://view.officeapps.live.com/op/view.aspx?src=<?php echo base_url('assets/arsip/dokumen/'.$a['file']); ?>"><?=$a['file'];?></a> -->
                        <a class="card-title h5 font-weight-bold text-primary" href="https://docs.google.com/viewerng/viewer?url=<?php echo base_url('assets/arsip/dokumen/'.$a['file']); ?>"><?=$a['file'];?></a>
                        <p><?=$a['keterangan'];?></p>
                    </div>
                    <div class="card-footer text-muted">
                        <p class="card-text"><small class="text-muted">Dimuat pada <?= date("d F Y", strtotime($a['uploadAt'])); ?></small></p>
                    </div>
                </div>
            </div>
        </div>
        <?php endforeach ;?>
    </div>
    <br/>


</div>
</div>
<!-- /.container-fluid -->


<!-- End of Main Content -->

<!-- Modal -->
<div class="modal fade" id="newDokumenModal" tabindex="-1" role="dialog" aria-labelledby="newRoleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="newRoleModalLabel">Tambah Dokumen</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?= base_url('dpm/arsip'); ?>" method="post" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="form-group row">
                        <label for="keterangan" class="col-sm-3 col-form-label">Keterangan</label>
                        <div class="col-sm-9">
                            <textarea type="text" class="form-control" id="keterangan" name="keterangan" placeholder="Berikan keterangan dokumen"></textarea>
                            <?= form_error('keterangan', '<small class="text-danger pl-3">', '</small>'); ?>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="uploaddkmn" class="col-sm-3 col-form-label">Upload Dokumen</label>
                        <div class="col-sm-9">
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="uploaddkmn" name="uploaddkmn">
                                <label class="custom-file-label" for="uploaddkmn">Choose file</label>
                            </div>
                            <?= form_error('uploaddkmn', '<small class="text-danger pl-3">', '</small>'); ?>
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