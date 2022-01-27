<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <?= $this->session->flashdata('message'); ?> 
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

    <?php if (count($kuota) >= 1):?>
    <!-- kalau sudah melapor -->
    <div class="row">
        <div class="alert alert-success ml-3" role="alert">Terimakasih, anda sudah melaporkan injeksi kuota</div>
    </div>
    <div class="row">
        <div class="card shadow mb-4 ml-3">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Progress Provider Kuota</h6>
            </div>
            <div class="card-body">
            <div class="row">
                    <div class="col-6">
                        <div class="card-body">
                            <p class="mb-0 font-weight-bold">AXIS</p>
                            <p class="mb-1 text-primary"><i class="fas fa-spinner fa-sm mr-2"></i>On Progress</span>
                            <p class="mb-0 font-weight-bold">IM3 (Indosat Oredoo)</p>
                            <p class="mb-1 text-primary"><i class="fas fa-spinner fa-sm mr-2"></i>On Progress</p>
                            <p class="mb-0 font-weight-bold">Tri (3)</p>
                            <p class="mb-1 text-danger"><i class="fas fa-times-circle fa-sm mr-2"></i>No Progress</p>
                            <p class="mb-0 font-weight-bold">XL</p>
                            <p class="mb-1 text-success"><i class="fas fa-check-circle fa-sm mr-2"></i>Complete</p>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="card-body">
                            <p class="mb-0 font-weight-bold">AXIS</p>
                            <p class="mb-1 text-primary"><i class="fas fa-spinner fa-sm mr-2"></i>On Progress</span>
                            <p class="mb-0 font-weight-bold">IM3 (Indosat Oredoo)</p>
                            <p class="mb-1 text-primary"><i class="fas fa-spinner fa-sm mr-2"></i>On Progress</p>
                            <p class="mb-0 font-weight-bold">Tri (3)</p>
                            <p class="mb-1 text-danger"><i class="fas fa-times-circle fa-sm mr-2"></i>No Progress</p>
                            <p class="mb-0 font-weight-bold">XL</p>
                            <p class="mb-1 text-success"><i class="fas fa-check-circle fa-sm mr-2"></i>Complete</p>
                        </div>
                    </div>
                </div>
            </div>    
        </div>
    </div>
    <?php else : ?>
    <!-- kalau belum melapor -->
    <div class="row">
        <div class="col-lg-4">
            <div class="card shadow mb-4">
                <div class="card-body">
                    <p>Fitur pelaporan kuota digunakan ketika anda <span class="font-weight-bold text-danger">belum</span> mendapatkan injeksi kuota 
                    terhitung hingga pada <span class="font-weight-bold">tanggal 10-15</span> bulan ini.
                    </p>
                    <p class="mb-0">
                    Silahkan mengecek data yang tertera pada <span class="font-weight-bold">"Form Pelaporan Kuota"</span>.
                    Jika terdapat perbedaan data, maka dapat melakukan update data pada menu <a href="<?= base_url('user/edit'); ?>">edit profile</a>
                    </p>
                </div>
            </div>
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Progress Provider Kuota</h6>
                </div>
                <div class="row">
                    <div class="col-6">
                        <div class="card-body">
                        <!-- untuk ganti logo
                            on progress :  <p class="mb-1 text-primary"><i class="fas fa-spinner fa-sm mr-2"></i>On Progress</p> 
                            No progress :  <p class="mb-1 text-danger"><i class="fas fa-times-circle fa-sm mr-2"></i>No Progress</p>
                            Complete    :  <p class="mb-1 text-success"><i class="fas fa-check-circle fa-sm mr-2"></i>Complete</p>
                             -->
                            <p class="mb-0 font-weight-bold">AXIS</p>
                            <p class="mb-1 text-primary"><i class="fas fa-spinner fa-sm mr-2"></i>On Progress</p>
                            <p class="mb-0 font-weight-bold">IM3 (Indosat Oredoo)</p>
                            <p class="mb-1 text-primary"><i class="fas fa-spinner fa-sm mr-2"></i>On Progress</p>
                            <p class="mb-0 font-weight-bold">Tri (3)</p>
                            <p class="mb-1 text-danger"><i class="fas fa-times-circle fa-sm mr-2"></i>No Progress</p>
                            <p class="mb-0 font-weight-bold">XL</p>
                            <p class="mb-1 text-success"><i class="fas fa-check-circle fa-sm mr-2"></i>Complete</p>
                        </div>
                    </div>
                    <?php if($user['role_id'] == 1):?>
                    <div class="col-6 align-self-end">
                        <a href="" class="btn btn-primary mb-3 vcenter" data-toggle="modal" data-target="#newProviderModal">Update Provider</a>
                    </div>
                    <?php endif; ?>
                </div>
            </div>

        </div>


        <div class="col-lg-8">           
            <!-- form lapor kuota -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Form Pelaporan Kuota</h6>
                </div>
                <div class="card-body">
                    <form action="" method="post">
                        <div class="form-group row">
                            <label for="nama" class="col-sm-2 col-form-label">Nama Lengkap</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="nama" name="nama" value="<?= $user['name']; ?>" readonly>
                                <?= form_error('nama', '<small class="text-danger pl-3">', '</small>'); ?>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="nim" class="col-sm-2 col-form-label">NIM</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="nim" name="nim" value="<?= $user['nim']; ?>" readonly>
                                <?= form_error('nim', '<small class="text-danger pl-3">', '</small>'); ?>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="kelas" class="col-sm-2 col-form-label">Kelas</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="kelas" name="kelas" value="<?= $user['kelas']; ?>" readonly>
                                <?= form_error('kelas', '<small class="text-danger pl-3">', '</small>'); ?>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="nohp" class="col-sm-2 col-form-label">Nomor Handphone</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="nohp" name="nohp" value="<?= $user['nohp']; ?>" readonly>
                                <?= form_error('nohp', '<small class="text-danger pl-3">', '</small>'); ?>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="nohp" class="col-sm-2 col-form-label">Provider</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="provider" name="provider" value="<?= $user['provider']; ?>" readonly>
                                <?= form_error('provider', '<small class="text-danger pl-3">', '</small>'); ?>
                            </div>
                        </div>

                        <div class="form-group">
                        <?php $today = date("d"); //set tanggal untuk waktu pelaporan kuota?>
                        <?php if((int)$today >= 10 and (int)$today <= 15) : ?>
                            <button type="submit" name="sambat" class="btn btn-primary float-right" onclick= "return confirm('Apakah anda ingin melaporkan belum adanya injeksi kuota bulan ini?') ">
                            mau lapor nih
                            </button>
                        <?php else : ?>
                            <button type="button" class="btn btn-primary float-right" disabled>
                            mau lapor nih
                            </button>
                        <?php endif; ?>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>
    <?php endif; ?>

</div>
<!-- /.container-fluid -->

<!-- Modal -->
<div class="modal fade" id="newProviderModal" tabindex="-1" role="dialog" aria-labelledby="newProviderModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="newRoleModalLabel">Update Provider</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
                <div class="form-group rowprovider">
                        <label for="untuk" class="col-sm-2 col-form-label">AXIS</label>
                        <div class="col-sm-10">
                            <select name="" id="" class="form-control">
                                <option value="ON PROGRESS">ON PROGRESS</option>
                                <option value="NO PROGRESS">NO PROGRESS</option>
                                <option value="COMPLETE">COMPLETE</option>
                            </select>
                        </div>
                        <label for="untuk" class="col-sm-2 col-form-label">IM3</label>
                        <div class="col-sm-10">
                            <select name="" id="" class="form-control">
                                <option value="ON PROGRESS">ON PROGRESS</option>
                                <option value="NO PROGRESS">NO PROGRESS</option>
                                <option value="COMPLETE">COMPLETE</option>
                            </select>
                        </div>
                        <label for="untuk" class="col-sm-2 col-form-label">TRI</label>
                        <div class="col-sm-10">
                            <select name="" id="" class="form-control">
                                <option value="ON PROGRESS">ON PROGRESS</option>
                                <option value="NO PROGRESS">NO PROGRESS</option>
                                <option value="COMPLETE">COMPLETE</option>
                            </select>
                        </div>
                        <label for="untuk" class="col-sm-2 col-form-label">XL</label>
                        <div class="col-sm-10">
                            <select name="" id="" class="form-control">
                                <option value="ON PROGRESS">ON PROGRESS</option>
                                <option value="NO PROGRESS">NO PROGRESS</option>
                                <option value="COMPLETE">COMPLETE</option>
                            </select>
                        </div>
                    </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Add</button>
                </div>
        </div>
    </div>
</div>
                        </div>
<!-- bug footer gaess -->

<!-- End of Main Content -->