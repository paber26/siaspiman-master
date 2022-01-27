<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

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
                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $summarySambat['totalSambat'];?></div>
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
        // var_dump($kuota);
        // echo $summaryUser['jmlhMhs'];
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

    <!-- Content Row -->
    <div class="row">
        <div class="col-xl-8 col-lg-7">
            <!-- Bar Chart -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Tujuan Sambatan</h6>
                </div>
                <div class="card-body">
                    <div class="chart-bar">
                        <canvas id="myBarChart"></canvas>
                        <script type="text/javascript">
                            var sSambat = <?php echo json_encode($summarySambat); ?>;
                        </script>
                    </div>
                    <hr>
                    Barplot Tujuan Sambat Kepada
                    <code>Kampus, Ormawa, Pengurus Tingkat, Lainnya</code>
                </div>
            </div>
        </div>

        <!-- Pie Chart -->
        <div class="col-xl-4 col-lg-5">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Alokasi Provider</h6>
                </div>
                <!-- Card Body -->
                <div class="card-body">
                    <div class="chart-pie pt-4 pb-2">
                        <canvas id="myPieChart"></canvas>
                        <!-- <p><?= var_dump($summaryUser)?></p> -->
                        <script type="text/javascript">
                            var sProvider = <?php echo json_encode($summaryUser); ?>;
                        </script>
                    </div>
                    <div class="mt-4 text-center small">
                        <span class="mr-2">
                            <i class="fas fa-circle text-primary"></i> Axis
                        </span>
                        <span class="mr-2">
                            <i class="fas fa-circle text-success"></i> IM3/Indosat
                        </span>
                        <span class="mr-2">
                            <i class="fas fa-circle text-info"></i> 3(Tri)
                        </span>
                        <span class="mr-2">
                            <i class="fas fa-circle text-danger"></i> XL
                        </span>
                    </div>
                    <hr>
                    Pie Chart
                    <code>Alokasi Provider</code>
                </div>
            </div>
        </div>

    </div>


</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->

<!-- Page level plugins -->
<script src="<?= base_url('assets/'); ?>vendor/chart.js/Chart.min.js"></script>

<!-- Page level custom scripts -->
<script src="<?= base_url('assets/'); ?>js/demo/chart-area-demo.js"></script>
<script src="<?= base_url('assets/'); ?>js/demo/chart-pie-provider.js"></script>
<script src="<?= base_url('assets/'); ?>js/demo/chart-bar-tsambat.js"></script>
