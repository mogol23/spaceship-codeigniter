        <nav id="sidebar" class="sidebar" role="navigation">
            <!-- need this .js class to initiate slimscroll -->
            <div class="js-sidebar-content">
                <!-- seems like lots of recent admin template have this feature of user info in the sidebar.
                     looks good, so adding it and enhancing with notifications -->
                <div class="sidebar-status d-md-none">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <span class="thumb-sm avatar float-right">
                            <img class="rounded-circle" src="<?= base_url('assets/img/ninja.png') ?>" alt="...">
                        </span>
                        <!-- .circle is a pretty cool way to add a bit of beauty to raw data.
                             should be used with bg-* and text-* classes for colors -->
                        <?= user('username'); ?>
                        <b class="caret"></b>
                    </a>

                        <ul class="dropdown-menu dropdown-menu-right animated fadeInUp" style="margin-top: 25% ">
                            <li><a class="dropdown-item" href="profile.html"><i class="glyphicon glyphicon-user"></i> &nbsp; Pengaturan Akun</a></li>
                            <li class="dropdown-divider"></li>
                            <li><a class="dropdown-item" href="<?= base_url('admin/auth/signout') ?>"><i class="fa fa-sign-out"></i> &nbsp; Keluar</a></li>
                        </ul>
                    <!-- #notifications-dropdown-menu goes here when screen collapsed to xs or sm -->
                </div>
                <!-- main notification links are placed inside of .sidebar-nav -->
                <ul class="sidebar-nav">
                    <li  class=" active ">
                        <!-- an example of nested submenu. basic bootstrap collapse component -->
                        <a href="<?= base_url('admin') ?>">
                            <span class="icon">
                                <i class="fi flaticon-home"></i>
                            </span>
                            Dashboard
                        </a>
                    </li>
                </ul>
                <!-- every .sidebar-nav may have a title -->
                <h5 class="sidebar-nav-title">Template <a class="action-link" href="#"><i class="glyphicon glyphicon-refresh"></i></a></h5>
                <ul class="sidebar-nav">
                    <li>
                        <!-- an example of nested submenu. basic bootstrap collapse component -->
                        <a href="typography.html">
                            <span class="icon">
                                <i class="fi flaticon-controls"></i>
                            </span>
                            Typography
                        </a>
                    </li>
                    <li class="">
                        <!-- an example of nested submenu. basic bootstrap collapse component -->
                        <a href="tables.html">
                            <span class="icon">
                                <i class="fi flaticon-equal-1"></i>
                            </span>
                            Tables
                        </a>
                    </li>
                    <li class="">
                        <!-- an example of nested submenu. basic bootstrap collapse component -->
                        <a href="notifications.html">
                            <span class="icon">
                                <i class="fi flaticon-alarm"></i>
                            </span>
                            Notifications
                        </a>
                    </li>
                    <li class="">
                        <a class="collapsed" href="#sidebar-ui" data-toggle="collapse" data-parent="#sidebar">
                            <span class="icon">
                                <i class="fi flaticon-layers"></i>
                            </span>
                            Auth
                            <i class="toggle fa fa-angle-down"></i>
                        </a>
                        <ul id="sidebar-ui" class="collapse ">
                            <li class=""><a href="<?= base_url('admin/auth/users') ?>">User</a></li>
                        </ul>
                    </li>
                </ul>
                <h5 class="sidebar-nav-title">Labels <a class="action-link" href="#"><i class="glyphicon glyphicon-plus"></i></a></h5>
                <!-- some styled links in sidebar. ready to use as links to email folders, projects, groups, etc -->
                <ul class="sidebar-labels">
                    <li>
                        <a href="#">
                            <!-- yep, .circle again -->
                            <i class="fa fa-circle text-warning mr-xs"></i>
                            <span class="label-name">My Recent</span>
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <i class="fa fa-circle text-gray mr-xs"></i>
                            <span class="label-name">Starred</span>
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <i class="fa fa-circle text-danger mr-xs"></i>
                            <span class="label-name">Background</span>
                        </a>
                    </li>
                </ul>
                <h5 class="sidebar-nav-title">Projects</h5>
                <!-- A place for sidebar notifications & alerts -->
                <div class="sidebar-alerts">
                    <div class="alert">
                        <a href="#" class="close" data-dismiss="alert" aria-hidden="true">&times;</a>
                        <span class="fw-normal">Sales Report</span> <br>
                        <div class="progress progress-xs mt-2">
                            <div class="progress-bar progress-bar-gray-light" role="progressbar" style="width: 16%" aria-valuenow="16" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                        <small>Calculating x-axis bias... 65%</small>
                    </div>
                    <div class="alert">
                        <a href="#" class="close" data-dismiss="alert" aria-hidden="true">&times;</a>
                        <span class="fw-normal">Personal Responsibility</span> <br>
                        <div class="progress progress-xs mt-2">
                            <div class="progress-bar bg-danger" role="progressbar" style="width: 23%" aria-valuenow="23" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                        <small>Provide required notes</small>
                    </div>
                </div>
            </div>
        </nav>