<!-- Begin container-fluid -->
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="row">
        <p class="h3 mb-4 ml-2 text-gray-800"><?= $title; ?></p>
        <div class="col text-right">
                <div class="dropdown mb-4">
                    <button class="btn btn-primary dropdown-toggle" type="button"
                    id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true"
                    aria-expanded="false">
                    Pilih Galeri
                    </button>   
                <div class="dropdown-menu animated--fade-in"
                aria-labelledby="dropdownMenuButton">
                <a class="dropdown-item" href="<?= base_url() ?>dpm/galeri">Semua</a>
                <a class="dropdown-item" href="<?= base_url() ?>dpm/sgaleri/a">A</a>
                <a class="dropdown-item" href="<?= base_url() ?>dpm/sgaleri/b">B</a>
                <a class="dropdown-item" href="<?= base_url() ?>dpm/sgaleri/c">C</a>
            </div>
        </div>
    </div>

    </div>

    <div class="container gallery-container">
        
        <div class="tz-gallery">
            <div class="card-columns">
            <?php foreach ($galeri as $g) : ?>
                <div class="card shadow mb-4">
                <a class="lightbox" href="<?php echo base_url('assets/img/galeri/'.$g['folder'].'/'.$g['file']); ?> ">
                    <img class="card-img" src="<?php echo base_url('assets/img/galeri/'.$g['folder'].'/'.$g['file']); ?> "  alt="Card image">
                </a>
                </div>
            <?php endforeach; ?>
            </div>
        </div>

    </div>
<!-- End of container-fluid -->
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/baguettebox.js/1.8.1/baguetteBox.min.js"></script>
<script>
    baguetteBox.run('.tz-gallery');
</script>