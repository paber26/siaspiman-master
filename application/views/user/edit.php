<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>


    <div class="row">
        <div class="col-lg-8">

            <?= form_open_multipart('user/edit'); ?>
            <div class="form-group row">
                <label for="email" class="col-sm-2 col-form-label">Email</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="email" name="email" value="<?= $user['email']; ?>" readonly>
                </div>
            </div>
            <div class="form-group row">
                <label for="name" class="col-sm-2 col-form-label">Full Name</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="name" name="name" value="<?= $user['name']; ?>">
                    <?= form_error('name', '<small class="text-danger pl-3">', '</small>'); ?>
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
                    <input type="text" class="form-control" id="kelas" name="kelas" value="<?= $user['kelas']; ?>">
                    <?= form_error('kelas', '<small class="text-danger pl-3">', '</small>'); ?>
                </div>
            </div>
            <div class="form-group row">
                <label for="nohp" class="col-sm-2 col-form-label">Nomor Handphone</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="nohp" name="nohp" value="<?= $user['nohp']; ?>">
                    <?= form_error('nohp', '<small class="text-danger pl-3">', '</small>'); ?>
                </div>
            </div>
            <?php if($user['role_id'] == 2) :?>
            <div class="form-group row">
                <label for="provider" class="col-sm-2 col-form-label">Provider</label>
                <div class="col-sm-10">
                <?php $provider = array("AXIS", "IM3 (Indosat Oredoo)", "TRI (3)", "XL");?>
                    <select name="provider" id="provider" class="form-control selectpicker">
                    <?php foreach($provider as $p): ?>
                        <?php if ( $user['provider'] == $p ):  ?>
                            <option value=<?= $p;?> selected><?=$p?></option>
                        <?php else : ?>
                            <option value=<?= $p;?> ><?=$p?></option>
                        <?php endif;?>
                    <?php endforeach; ?>
                    </select>
                    <?= form_error('provider', '<small class="text-danger pl-3">', '</small>'); ?>
                </div>
            </div>
            <?php endif; ?>
            <div class="form-group row">
                <div class="col-sm-2">Picture</div>
                <div class="col-sm-10">
                    <div class="row">
                        <div class="col-sm-3">
                            <img src="<?= base_url('assets/img/profile/') . $user['image'] ?>" class="img-thumbnail">
                        </div>
                        <div class="col-sm-9">
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="image" name="image">
                                <label class="custom-file-label" for="image">Choose file</label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="form-group row justify-content-end text-right">
                <div class="col-sm-10">
                    <button type="submit" class="btn btn-primary"><span class="ml-4 mr-4">Edit</span></button>
                </div>
            </div>

            </form>

        </div>
    </div>

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->
<script>
    $('select[name=provider]').val('<?=$user['provider'];?>');
    $('.selectpicker').selectpicker('refresh');
</script>