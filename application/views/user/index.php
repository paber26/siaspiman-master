<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

    <div class="row">
        <div class="col-lg-6">
            <?= $this->session->flashdata('message'); ?>
        </div>
    </div>

    <div class="card shadow mb-3" style="max-width: 540px;">
        <div class="row no-gutters">
            <div class="col-md-4">
                <img src="<?= base_url('assets/img/profile/') . $user['image']; ?>" class="card-img img-fluid" style="background-image: cover;">
            </div>
            <div class="col-md-8">
                <div class="card-body">
                    <h5 class="card-title font-weight-bold text-primary"><?= $user['name']; ?></h5>
                    <p class="card-text"><i class="fas fa-id-card mr-3"></i><?= $user['nim']; ?></p>
                    <p class="card-text"><i class="fas fa-users mr-3"></i><?= $user['kelas']; ?></p>
                    <p class="card-text"><i class="fas fa-envelope mr-3"></i><?= $user['email']; ?></p>
                    <p class="card-text"><i class="fas fa-phone mr-3"></i><?= $user['nohp']; ?></p>
                </div>
            </div>
        </div>

    </div>
    <!-- /.container-fluid -->

</div>
<!-- End of Main Content -->