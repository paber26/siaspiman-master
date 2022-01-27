<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <?= $this->session->flashdata('message'); ?>
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?>/Sambatan</h1>

    <div class="row">
        <div class="col-lg-4">
        <div class="card shadow mb-4">
                <div class="card-body">
                    <p>Fitur Aspirasi merupakan wadah bagi mahasiswa untuk memberikan <span class="font-weight-bold">sambatan</span> 
                    terbaik mereka. Sambatan itu sendiri merupakan kritik atau saran yang ditujukan kepada <span class="font-weight-bold">"Kampus, Ormawa, Pengurus Tingkat, dan Lainnya"</span>.
                    </p>
                    <p>Silahkan mengisi <span class="font-weight-bold">"Form Sambatan"</span> dengan harapan kritik yang diberikan dapat membangun atau memberikan
                    dampak positif bagi kita semua.
                    </p>
                    <p>
                    <span class="font-weight-bold" style="color:mediumblue;">Selamat bersambat-ria!</span>
                    </p>
                </div>
            </div>
        </div>

        <div class="col-lg-8">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Form Sambatan</h6> 
                </div>
                <div class="card-body">

                        <form action="" method="post">
                            <div class="form-group row">
                                <label for="dari" class="col-sm-2 col-form-label">Nama Pengirim</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="dari" name="dari" placeholder="boleh nama samaran">
                                    <?= form_error('dari', '<small class="text-danger pl-3">', '</small>'); ?>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="untuk" class="col-sm-2 col-form-label">Di tujukan kepada</label>
                                <div class="col-sm-10">
                                    <select name="untuk" id="untuk" class="form-control">
                                        <option value="Kampus">Kampus</option>
                                        <option value="Ormawa">Ormawa</option>
                                        <option value="Pengurus Tingkat">Pengurus Tingkat</option>
                                        <option value="Lainnya">Lainnya</option>
                                    </select>
                                    <!-- <input type="text" class="form-control" id="untuk" name="untuk"> -->
                                    <?= form_error('untuk', '<small class="text-danger pl-3">', '</small>'); ?>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="isi" class="col-sm-2 col-form-label">Isi Sambatan</label>
                                <div class="col-sm-10">
                                    <textarea type="text" class="form-control" id="isi" name="isi"></textarea>
                                    <?= form_error('isi', '<small class="text-danger pl-3">', '</small>'); ?>
                                </div>
                            </div>
                            <div class="form-group">
                                <button type="submit" name="sambat" class="btn btn-primary float-right" onclick= "return confirm('apakah anda yakin ingin sambat tentang hal tersebut?')">
                                Yuk sambat
                                </button>
                            </div>
                        </form>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
<!-- /.container-fluid -->


<!-- End of Main Content -->