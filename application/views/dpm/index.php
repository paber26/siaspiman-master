<!-- Begin Page Content -->
<!-- Begin container-fluid -->
<div class="container-fluid">
	<!-- Page Heading -->
	<div class="d-sm-flex align-items-center justify-content-between mb-4">
		<h1 class="h3 mb-0 text-gray-800">Beranda</h1>
	</div>

	<!-- Carousel gambar -->
	<div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
		<ol class="carousel-indicators">
			<li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
			<li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
			<li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
		</ol>
		<div class="carousel-inner">
			<div class="carousel-item active">
				<img class="d-block w-100 tales" src="<?= base_url('assets/img/profile/luffy.jpg') ?>"
					alt="First slide">
				<div class="carousel-caption d-none d-md-block">
					<h5>DPM</h5>
					<p>Dewan Perwakilan Mahasiswa (DPM) merupakan Some quick example text to
						build on the card title and make up the bulk of the card's content.</p>
				</div>
			</div>
			<div class="carousel-item">
				<img class="d-block w-100 tales" src="<?= base_url('assets/img/profile/luffy1.jpg') ?>"
					alt="Second slide">
				<div class="carousel-caption d-none d-md-block">
					<h5>...</h5>
					<p>...</p>
				</div>
			</div>
			<div class="carousel-item">
				<img class="d-block w-100 tales" src="<?= base_url('assets/img/profile/luffy.jpg') ?>"
					alt="Third slide">
				<div class="carousel-caption d-none d-md-block">
					<h5>...</h5>
					<p>...</p>
				</div>
			</div>
		</div>
		<a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
			<span class="carousel-control-prev-icon" aria-hidden="true"></span>
			<span class="sr-only">Previous</span>
		</a>
		<a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
			<span class="carousel-control-next-icon" aria-hidden="true"></span>
			<span class="sr-only">Next</span>
		</a>
	</div>
	<br />

	<!-- Card Content -->
	<div class="row">
		<!-- Anggaran imapolstat -->
		<div class="col-xl-3 col-md-6 mb-4">
			<div class="card border-left-primary shadow h-100 py-2">
				<div class="card-body">
					<div class="row no-gutters align-items-center">
						<div class="col mr-2">
							<div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
								Anggaran Imapolstat</div>
							<div class="h5 mb-0 font-weight-bold text-gray-800">Rp 40,000,000</div>
						</div>
						<div class="col-auto">
							<i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
						</div>
					</div>
				</div>
			</div>
		</div>

		<!-- Total Sambat -->
		<div class="col-xl-3 col-md-6 mb-4">
			<div class="card border-left-success shadow h-100 py-2">
				<div class="card-body">
					<div class="row no-gutters align-items-center">
						<div class="col mr-2">
							<div class="text-xs font-weight-bold text-success text-uppercase mb-1">
								Total Sambatan</div>
							<div class="h5 mb-0 font-weight-bold text-gray-800"><?= $summarySambat['totalSambat'];?>
							</div>
						</div>
						<div class="col-auto">
							<i class="fas fa-bell fa-2x text-gray-300"></i>
						</div>
					</div>
				</div>
			</div>
		</div>

		<!-- Persentase Kuota?? -->
		<?php 
        $kuotabagi = count($kuota)*100/$summaryUser['jmlhMhs'];
        $formatKuota = number_format($kuotabagi, 1, '.', '');
        ?>
		<div class="col-xl-3 col-md-6 mb-4">
			<div class="card border-left-info shadow h-100 py-2">
				<div class="card-body">
					<div class="row no-gutters align-items-center">
						<div class="col mr-2">
							<div class="text-xs font-weight-bold text-info text-uppercase mb-1">Belum Dapat Kuota
							</div>
							<div class="row no-gutters align-items-center">
								<div class="col-auto">
									<div class="h5 mb-0 mr-3 font-weight-bold text-gray-800"><?=$formatKuota;?>%</div>
								</div>
								<div class="col">
									<div class="progress progress-sm mr-2">
										<div class="progress-bar bg-info" role="progressbar"
											style="width: <?=$formatKuota;?>%" aria-valuenow="50" aria-valuemin="0"
											aria-valuemax="100"></div>
									</div>
								</div>
							</div>
						</div>
						<div class="col-auto">
							<i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
						</div>
					</div>
				</div>
			</div>
		</div>

		<!-- Belum tau aapa -->
		<div class="col-xl-3 col-md-6 mb-4">
			<div class="card border-left-warning shadow h-100 py-2">
				<div class="card-body">
					<div class="row no-gutters align-items-center">
						<div class="col mr-2">
							<div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
								Info Progres Kuota</div>
							<div class="h5 mb-0 font-weight-bold text-gray-800">
								<a href="<?=base_url()?>user/laporkuota">Selengkapnya..</a>
							</div>
						</div>
						<div class="col-auto">
							<i class="fas fa-sim-card fa-2x text-gray-300"></i>
						</div>
					</div>
				</div>
			</div>
		</div>

	</div>
	<!-- Timeline DPM -->
	<h3>Timeline</h3>
	<div class="row text-center">
		<p class="col-lg-4">isi timeline DPM periode 2020/2021</p>
	</div>

	<!-- Card Pengumuman -->
	<h3>Pengumuman</h3>
	<div class="row">
		<?php foreach ($pengumuman as $data) : ?>
		<div class="col-12">
			<div class="card-deck"> <?php //Pengumuman, ini tolong di limitin aja jadi yg tampil 3-5 card doang ?>
				<div class="card shadow mb-4">
					<div class="row">
						<div class="col-3">
							<img class="card-img-top align-self-center"
								src="<?php echo base_url('assets/img/pengumuman/'.$data['img']) ?>"
								alt="Card image cap">
						</div>
						<div class="col-9">
							<div class="card-body">
								<h1 class="card-title font-weight-bold text-primary"><?=$data['judul']; ?></h1>
								<p class="card-text"><small class="text-muted">Dimuat pada
										<?= date("d F Y", strtotime($data['createdAt'])); ?></small></p>
								<p class="card-text"><?= $this->pengumuman_model->cut_text($data['isi'], 500) ?></p>
								<?php //dikasih limit katanya berapa trus kasih akses lanjut buat di klik ?>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<?php endforeach; ?>
	</div>
	<br />


</div>

<!-- /.container-fluid -->


<!-- End of Main Content -->
