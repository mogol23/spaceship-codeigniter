        <nav class="page-controls navbar navbar-dashboard">
           
            <div class="container-fluid">
                <!-- .navbar-header contains links seen on xs & sm screens -->
                <div class="navbar-header mr-md-3">
                    <ul class="nav navbar-nav">
                        <li class="nav-item">
                            <!-- whether to automatically collapse sidebar on mouseleave. If activated acts more like usual admin templates -->
                            <a class="d-none d-lg-block nav-link" id="nav-state-toggle" href="javascript:void(0)">
                                <i class="la la-bars"></i>
                            </a>
                            <!-- shown on xs & sm screen. collapses and expands navigation -->
                            <a class="d-lg-none nav-link" id="nav-collapse-toggle" href="javascript:void(0)">
                                <span class="square square-lg bg-gray text-white d-md-none"><i class="la la-bars"></i></span>
                                <i class="la la-bars d-none d-md-block"></i>
                            </a>
                        </li>
                    </ul>
                    <!-- xs & sm screen logo -->
                    <a class="navbar-brand d-md-none" href="javascript:void(0)">
                        <span class="text-warning">PHP</span> Spaceship                    
                    </a>
                </div>
        
                <!-- this part is hidden for xs screens -->
                <div class="navbar-header mobile-hidden">
                    <!-- site id | page title -->
                    <ul class="nav navbar-nav pull-xs-left">
                        <li class="dropdown nav-item">
                            <a href="javascript:void(0)" class="nav-link">
                                <span class="text-warning">PHP</span> <strong>Spaceship</strong>
                            </a>
                        </li>
                    </ul>
                    <ul class="nav navbar-nav float-right">
                        <li class="dropdown nav-item">
                            <a href="javascript:void(0)" class="dropdown-toggle dropdown-toggle-notifications nav-link" data-toggle="dropdown">
                                <span class="thumb-sm avatar float-left">
                                    <img class="rounded-circle" src="<?= base_url('assets/img/ninja.png') ?>" alt="...">
                                </span>
                                &nbsp;<?= user('username') ?>&nbsp;
                                <b class="caret"></b>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-right">
                                <li><a class="dropdown-item" href="profile.html"><i class="glyphicon glyphicon-user"></i> &nbsp; Pengaturan Akun</a></li>
                                <li class="dropdown-divider"></li>
                                <li><a class="dropdown-item" href="<?= base_url('admin/auth/signout') ?>"><i class="fa fa-sign-out"></i> &nbsp; Keluar</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>