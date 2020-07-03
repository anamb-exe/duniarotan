<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <title>Login &mdash; Stisla</title>

    <!-- General CSS Files -->
    <link rel="stylesheet" href="<?php echo base_url() ?>/assets/modules/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo base_url() ?>/assets/modules/fontawesome/css/all.min.css">

    <!-- CSS Libraries -->
    <link rel="stylesheet" href="<?php echo base_url() ?>/assets/modules/bootstrap-social/bootstrap-social.css">

    <!-- Template CSS -->
    <link rel="stylesheet" href="<?php echo base_url() ?>/assets/css/style.css">
    <link rel="stylesheet" href="<?php echo base_url() ?>/assets/css/components.css">
    <!-- Start GA -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-94034622-3"></script>
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }
        gtag('js', new Date());

        gtag('config', 'UA-94034622-3');
    </script>
    <!-- /END GA -->
</head>

<body>
    <div id="app">
        <section class="section">
            <div class="container mt-5">
                <div class="row">
                    <div class="col-12 col-sm-8 offset-sm-2 col-md-6 offset-md-3 col-lg-6 offset-lg-3 col-xl-4 offset-xl-4">
                        <div class="login-brand">
                            <img src="http://localhost/stisla-codeigniter/assets/img/stisla-fill.svg" alt="logo" width="100" class="shadow-light rounded-circle">
                        </div>

                        <div class="card card-primary">
                            <div class="card-header">
                                <h4>Scan-Qr</h4>
                            </div>
                            <form action="<?php echo base_url('Scanqr/aksi_scan'); ?>" method="post">
                                <div class="card-body">
                                        <div class="form-group">
                                            <center><canvas></canvas></center>
                                        </div>
                                        <div class="form-group">
                                            <div class="d-block">
                                                <label for="decodeqr" class="control-label">Kode Meja</label>
                                            </div>
                                            <input id="decodeqr" type="text" class="form-control" name="decodeqr" tabindex="2" disabled
                                        </div>
                                        <div class="form-group">
                                            <div class="d-block">
                                                <label for="password" class="control-label">Nama</label>
                                            </div>
                                            <input id="password" type="text" class="form-control" name="nama" tabindex="2" required>
                                            <div class="invalid-feedback">
                                                please fill in your password
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <button type="submit" class="btn btn-primary btn-lg btn-block" tabindex="4">
                                                Pesan Sekarang
                                            </button>
                                        </div>
                                    </form>
                                    <div class="col-xs-8">
                                        <?php echo $this->session->flashdata('message'); ?>
                                    </div>
                                </div>
                        </div>
                        <div class="mt-5 text-muted text-center">
                            Ada masalah login? <a href="#">Hubungi admin</a>
                        </div>
                        <div class="simple-footer">
                            Copyright &copy; Stisla 2018
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

    <!-- General JS Scripts -->
    <script src="<?php echo base_url() ?>assets/modules/jquery.min.js"></script>
    <script src="<?php echo base_url() ?>assets/modules/popper.js"></script>
    <script src="<?php echo base_url() ?>assets/modules/tooltip.js"></script>
    <script src="<?php echo base_url() ?>assets/modules/bootstrap/js/bootstrap.min.js"></script>
    <script src="<?php echo base_url() ?>assets/modules/nicescroll/jquery.nicescroll.min.js"></script>
    <script src="<?php echo base_url() ?>assets/modules/moment.min.js"></script>
    <script src="<?php echo base_url() ?>assets/js/stisla.js"></script>

    <!-- JS Libraies -->
    <script type="text/javascript" src="<?php echo base_url() ?>assets/scanqr/js/qrcodelib.js"></script>
    <script type="text/javascript" src="<?php echo base_url() ?>assets/scanqr/js/webcodecamjquery.js"></script>
    <script type="text/javascript">
        var arg = {
            resultFunction: function(result) {
                $('#decodeqr').val(result.code);
                console.log(result.code);
            }
        };
        $("canvas").WebCodeCamJQuery(arg).data().plugin_WebCodeCamJQuery.play();
    </script>
    <!-- Page Specific JS File -->

    <!-- Template JS File -->
    <script src="<?php echo base_url() ?>/assets/js/scripts.js"></script>
    <script src="<?php echo base_url() ?>/assets/js/custom.js"></script>
</body>

</html>