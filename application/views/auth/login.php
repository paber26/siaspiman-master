<div class="container">

    <!-- Outer Row -->
    <div class="row justify-content-center">

        <div class="col-lg-7">

            <div class="card o-hidden border-0 shadow-lg my-5">
                <div class="card-body p-0">
                    <!-- Nested Row within Card Body -->
                    <div class="row">
                        <div class="col-lg">
                            <div class="p-5">
                                <div class="text-center">
                                    <h1 class="h4 text-gray-900 mb-4">Login Website DPM</h1>
                                </div>

                                <?= $this->session->flashdata('message'); ?>

                                <form class="user" method="post" action="<?= base_url('auth') ?>">
                                    <div class="form-group">
                                        <input type="text" class="form-control form-control-user" id="email" name="email" placeholder="Enter Email Address..." value="<?= set_value('email'); ?>">
                                        <?= form_error('email', '<small class="text-danger pl-3">', '</small>'); ?>
                                    </div>
                                    <div class="form-group">
                                        <input type="password" class="form-control form-control-user" id="password" name="password" placeholder="Password">
                                        <?= form_error('password', '<small class="text-danger pl-3">', '</small>'); ?>
                                    </div>
                                    <button type="submit" class="btn btn-google btn-user btn-block">
                                        Login
                                    </button>
                                    <hr>
                                    <button type="button" onclick="open_window_sipadu()" class="btn btn-primary btn-user btn-block">
                                        <img src="https://stis.ac.id/sipadu/mahasiswa//images/logo.png" style="width:25px; height: auto" class="mr-2"> Login with Sipadu
                                    </button>
                                </form>
                                <hr>
                                <div class="text-center">
                                    <a class="small" href="<?= base_url('auth/forgotpassword'); ?>">Forgot Password?</a>
                                </div>
                                <!-- <div class="text-center">
                                    <a class="small" href="<?= base_url('auth/registration');  ?>">Create an Account!</a>
                                </div> -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </div>

</div>

<script type="text/javascript">
    function open_window_sipadu() {
        sipadu_window = window.open("<?= base_url() ?>oauth/redirector", "sipadu", "height=700,width=700,status=no,titlebar=no,menubar=no,top=10,left=300", true);
    }

    function verification(data1, data2) {
        sipadu_window.close();
        $.ajax({
            url: "<?= base_url() ?>auth/verifSipadu",
            type: "POST",
            data: {
                'data1': data1,
                'data2': data2
            },
            global: false,
            async: false,
            success: function(result) {
                if (result) {
                    window.location = "<?= base_url() ?>user";
                }
            }
        });
    }

    if ('-' == 1) {
        open_window_sipadu();
    }
</script>