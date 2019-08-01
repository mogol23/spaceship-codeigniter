<!DOCTYPE html>
<html>
    <head>
        <title>Login</title>
        <link href="<?= base_url('assets/css/application-dark.min.css') ?>" rel="stylesheet">
        <?php 
            if (isset($load_css) && is_array($load_css)):
                foreach ($load_css as $key => $value):
                    echo "<link href=".$value." rel=\"stylesheet\">";
                endforeach;
            endif;
        ?>
        <!-- as of IE9 cannot parse css files with more that 4K classes separating in two files -->
        <!--[if IE 9]>
        <link href="css/application-ie9-part2.css" rel="stylesheet">
        <![endif]-->
        <link rel="shortcut icon" href="<?= base_url('assets/img/fav.png') ?>">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
        <meta name="description" content="Codeigniter Single Login Ion Auth HMVC. Template by Sing App - Bootstrap 4 Admin Dashboard">
        <meta name="keywords" content="codeigniter, ion auth, codeigniter template, bootstrap admin template,admin template,admin dashboard,admin dashboard template,admin,dashboard,bootstrap,template">
        <meta name="author" content="Ahmad Habib">
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <script>
            /* yeah we need this empty stylesheet here. It's cool chrome & chromium fix
            chrome fix https://code.google.com/p/chromium/issues/detail?id=167083
            https://code.google.com/p/chromium/issues/detail?id=332189
            */
        </script>
    </head>
    <body class="login-page">
        <div class="container">
            <!-- main page content. the place to put widgets in. usually consists of .row > .col-lg-* > .widget.  -->
            <main id="content" class="widget-login-container" role="main">
                <!-- Page content -->
                <div class="row justify-content-center">
                    <div class="col-xl-5 col-md-6 col-10">
                        <h3 class="widget-login-logo animated fadeInUp">
                            <span class="text-warning">PHP</span> Spaceship
                        </h3>
                        <section class="widget widget-login animated fadeInUp">
                            <div class="widget-body">
                                <form class="login-form mt-lg">
                                    <div class="form-group">
                                        <input type="text" class="form-control" id="identity" name="identity" placeholder="Pengguna">                                
                                    </div>
                                    <div class="form-group">
                                        <input class="form-control" id="pswd" type="Password" name="password" placeholder="Kata Sandi">
                                    </div>
                                    <div class="clearfix">
                                        <div class="btn-toolbar float-right">
                                            <!-- <button type="button" class="btn btn-default btn-sm">Create an Account</button> -->
                                            <button class="btn btn-inverse btn-sm" type="submit">Masuk</button>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6 col-md-push-6">
                                            <div class="clearfix">
                                                <div class="abc-checkbox widget-login-info">
                                                    <input type="checkbox" id="checkbox1" name="remember" value="1">
                                                    <label for="checkbox1">Ingat saya </label>
                                                </div>
                                            </div>
                                        </div>

                                       <!--  <div class="col-md-6 col-md-pull-6">
                                            <a class="mr-n-lg" href="#">Trouble with account?</a>
                                        </div> -->
                                    </div>
                                </form>
                            </div>
                        </section>
                    </div>
                </div>
            </main>
        </div>


       <!-- common libraries. required for every page-->
        <script src="<?= base_url('assets/vendor/jquery/dist/jquery.min.js') ?>"></script>
        <script src="<?= base_url('assets/vendor/jquery-pjax/jquery.pjax.js') ?>"></script>
        <script src="<?= base_url('assets/vendor/popper.js/dist/umd/popper.js') ?>"></script>
        <script src="<?= base_url('assets/vendor/bootstrap/dist/js/bootstrap.js') ?>"></script>
        <script src="<?= base_url('assets/vendor/bootstrap/js/dist/util.js') ?>"></script>
        <script src="<?= base_url('assets/vendor/slimScroll/jquery.slimscroll.js') ?>"></script>
        <script src="<?= base_url('assets/vendor/widgster/widgster.js') ?>"></script>
        <script src="<?= base_url('assets/vendor/pace.js/pace.js') ?>" data-pace-options='{ "target": ".content-wrap", "ghostTime": 1000 }'></script>
        <script src="<?= base_url('assets/vendor/hammerjs/hammer.js') ?>"></script>
        <script src="<?= base_url('assets/vendor/jquery-hammerjs/jquery.hammer.js') ?>"></script>
        <script src="<?= base_url('assets/vendor/messenger/build/js/messenger.js') ?>"></script>
        <script src="<?=  base_url('assets/vendor/messenger/build/js/messenger-theme-flat.js') ?>"></script>


        <!-- common app js -->
        <script src="<?= base_url('assets/js/settings.js') ?>"></script>
        <script src="<?= base_url('assets/js/app.js') ?>"></script>
        <!-- Page scripts -->
        <script src="<?= base_url('assets/js/notifications.js') ?>"></script>
        <script type="text/javascript">
            $(function () {
                var url = '<?= base_url() ?>';
                $('form').submit(function(e) {
                    e.preventDefault();
                    $.post(url+'admin/auth/signin', $('form').serialize(), function(rs) {
                        if (rs.success != true) {
                            Messenger().post({
                                message: rs.msg,
                                type: 'error',
                                showCloseButton: true
                            });
                        } else {
                            Messenger().post({
                                message: rs.msg,
                                type: 'success',
                                showCloseButton: true
                            });

                            window.location.replace(url+'admin/auth')
                        }
                    });
                });
            })
        </script>
    </body>
</html>