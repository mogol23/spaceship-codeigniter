<!DOCTYPE html>
<html>
    <head>
        <title><?= $title ?></title>
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
            var base_url = '<?= base_url() ?>' ;
        </script>
    </head>
    <body class="">
        <!--
          Main sidebar seen on the left. may be static or collapsing depending on selected state.
        
            * Collapsing - navigation automatically collapse when mouse leaves it and expand when enters.
            * Static - stays always open.
        -->
        <?php (isset($sidebar)) ? $this->load->view($sidebar): false; ?>
                   
        <!-- This is the white navigation bar seen on the top. A bit enhanced BS navbar. See .page-controls in _base.scss. -->
        <?php (isset($topbar)) ? $this->load->view($topbar): false; ?>
        

        <div class="content-wrap">
            <!-- main page content. the place to put widgets in. usually consists of .row > .col-lg-* > .widget.  -->
            <?php (isset($content)) ? $this->load->view($content): false; ?>
        </div>
        <!-- The Loader. Is shown when pjax happens -->
        <div class="loader-wrap hiding hide">
            <i class="fa fa-circle-o-notch fa-spin-fast"></i>
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
        <script src="<?= base_url('assets/vendor/messenger/build/js/messenger-theme-flat.js') ?>"></script>


        <!-- common app js -->
        <script src="<?= base_url('assets/js/settings.js') ?>"></script>
        <script src="<?= base_url('assets/js/app.js') ?>"></script>
        <script src="<?= base_url('assets/js/notifications.js') ?>"></script>

        <!-- Page scripts -->
        <?php 
            if (isset($load_js) && is_array($load_js)):
                foreach ($load_js as $key => $value):
                    echo "<script src=".$value." defer></script>";
                endforeach;
            endif;
        ?>
    </body>
</html>