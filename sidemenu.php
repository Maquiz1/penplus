<?php
require_once 'php/core/init.php';
$user = new User();
$override = new OverideData();
$email = new Email();
$random = new Random();
$users = $override->getData('user');
if ($user->isLoggedIn()) {
    if ($user->data()->power == 1) {
        // $registered = $override->getCount('clients', 'status', 1);
        $not_screened = $override->countData('clients', 'status', 1, 'screened', 0);
        $all = $override->getNo('clients');
        $deleted = $override->getCount('clients', 'status', 0);
    } else {
        // $registered = $override->countData('clients', 'status', 1, 'site_id', $user->data()->site_id);
        $not_screened = $override->countData2('clients', 'status', 1, 'screened', 0, 'site_id', $user->data()->site_id);
        $all = $override->getCount('clients', 'site_id', $user->data()->site_id);
        $deleted = $override->countData('clients', 'status', 0, 'site_id', $user->data()->site_id);
    }


    if (Input::exists('post')) {

        if (Input::get('search_by_site')) {
            $validate = new validate();
            $validate = $validate->check($_POST, array(
                'site_id' => array(
                    'required' => true,
                ),
            ));
            if ($validate->passed()) {

                $url = 'index1.php?&site_id=' . Input::get('site_id');
                Redirect::to($url);
                $pageError = $validate->errors();
            }
        }
    }


    $staff_all = $override->getNo('user');
    $staff_active = $override->getDataStaffCount('user', 'status', 1, 'power', 0, 'count', 4, 'id');
    $staff_inactive = $override->getDataStaffCount('user', 'status', 0, 'power', 0, 'count', 4, 'id');
    $staff_lock_active = $override->getDataStaff1Count('user', 'status', 1, 'power', 0, 'count', 4, 'id');
    $staff_lock_inactive = $override->getDataStaff1Count('user', 'status', 0, 'power', 0, 'count', 4, 'id');



    if ($user->data()->power == 1 || $user->data()->accessLevel == 1 || $user->data()->accessLevel == 2) {
        if ($_GET['site_id'] != null) {
            // $kap = $override->getCount1('kap', 'status', 1, 'site_id', $_GET['site_id']);
            // $histroy = $override->getCount1('history', 'status', 1, 'site_id', $_GET['site_id']);
            // $results = $override->getCount1('results', 'status', 1, 'site_id', $_GET['site_id']);
            // $classification = $override->getCount1('classification', 'status', 1, 'site_id', $_GET['site_id']);
            // $outcome = $override->getCount1('outcome', 'status', 1, 'site_id', $_GET['site_id']);
            // $economic = $override->getCount1('economic', 'status', 1, 'site_id', $_GET['site_id']);
            $visit = $override->getCount1('visit', 'status', 1, 'site_id', $_GET['site_id']);

            $registered = $override->getCount1('clients', 'status', 1, 'site_id', $_GET['site_id']);
            // $screened = $override->getCount1('history', 'status', 1, 'site_id', $_GET['site_id']);
            // $eligible = $override->getCount1('history', 'eligible', 1, 'site_id', $_GET['site_id']);
            // $enrolled = $override->getCount1('history', 'eligible', 1, 'site_id', $_GET['site_id']);
            $end = $override->getCount1('clients', 'status', 0, 'site_id', $_GET['site_id']);
        } else {
            // $kap = $override->getCount('kap', 'status', 1);
            // $history = $override->getCount('history', 'status', 1);
            // $results = $override->getCount('results', 'status', 1);
            // $classification = $override->getCount('classification', 'status', 1);
            // $outcome = $override->getCount('outcome', 'status', 1);
            // $economic = $override->getCount('economic', 'status', 1);
            $visit = $override->getCount('visit', 'status', 1);

            $registered = $override->getCount('clients', 'status', 1);
            // $screened = $override->getCount('history', 'status', 1);
            // $eligible = $override->getCount('history', 'eligible', 1);
            // $enrolled = $override->getCount('history', 'eligible', 1);
            $end = $override->getCount('clients', 'status', 0);
        }
    } else {
        // $kap = $override->getCount1('kap', 'status', 1, 'site_id', $user->data()->site_id);
        // $histroy = $override->getCount1('history', 'status', 1, 'site_id', $user->data()->site_id);
        // $results = $override->getCount1('results', 'status', 1, 'site_id', $user->data()->site_id);
        // $classification = $override->getCount1('classification', 'status', 1, 'site_id', $user->data()->site_id);
        // $outcome = $override->getCount1('outcome', 'status', 1, 'site_id', $user->data()->site_id);
        // $economic = $override->getCount1('economic', 'status', 1, 'site_id', $user->data()->site_id);
        $visit = $override->getCount1('visit', 'status', 1, 'site_id', $user->data()->site_id);

        $registered = $override->getCount1('clients', 'status', 1, 'site_id', $user->data()->site_id);
        // $screened = $override->getCount1('history', 'status', 1, 'site_id', $user->data()->site_id);
        // $eligible = $override->getCount1('history', 'eligible', 1, 'site_id', $user->data()->site_id);
        // $enrolled = $override->getCount1('history', 'eligible', 1, 'site_id', $user->data()->site_id);
        $end = $override->getCount1('clients', 'status', 0, 'site_id', $user->data()->site_id);
    }
} else {
    Redirect::to('index.php');
}
?>

<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index1.php" class="brand-link">
        <img src="dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">PenPlus Database</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="#" class="d-block"><?= $user->data()->firstname ?></a>
            </div>
        </div>

        <!-- SidebarSearch Form -->
        <div class="form-inline">
            <div class="input-group" data-widget="sidebar-search">
                <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
                <div class="input-group-append">
                    <button class="btn btn-sidebar">
                        <i class="fas fa-search fa-fw"></i>
                    </button>
                </div>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
                <li class="nav-item menu-open">
                    <a href="#" class="nav-link active">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            Dashboard
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="./index1.php" class="nav-link active">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Dashboard v1</p>
                            </a>
                        </li>
                        <!-- <li class="nav-item">
                            <a href="./index2.php" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Dashboard v2</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="./index3.php" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Dashboard v3</p>
                            </a>
                        </li> -->
                    </ul>
                </li>
                <?php if ($user->data()->power == 1 || $user->data()->accessLevel == 1 || $user->data()->accessLevel == 2) {
                ?>

                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-copy"></i>
                            <span class="badge badge-info right"><?= $staff_all; ?></span>
                            <p>
                                Staff <i class="fas fa-angle-left right"></i>

                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="add.php?id=1" class="nav-link">
                                    <i class="nav-icon fas fa-th"></i>
                                    <p>
                                        Register
                                        <span class="right badge badge-danger">New Staff</span>
                                    </p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="info.php?id=1&status=1" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <span class="badge badge-info right"><?= $staff_active; ?></span>
                                    <p>Active</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="info.php?id=1&status=2" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <span class="badge badge-info right"><?= $staff_inactive; ?></span>
                                    <p>Inactive</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="info.php?id=1&status=3" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <span class="badge badge-info right"><?= $staff_lock_active; ?></span>
                                    <p>Locked And Active</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="info.php?id=1&status=4" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <span class="badge badge-info right"><?= $staff_lock_inactive; ?></span>
                                    <p>Locked And Inactive</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                <?php } ?>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-copy"></i>
                        <span class="badge badge-info right"><?= $registered; ?></span>
                        <p>
                            Registration <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="add.php?id=4" class="nav-link">
                                <i class="nav-icon fas fa-th"></i>
                                <p>
                                    Register
                                    <span class="right badge badge-danger">New Client</span>
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="info.php?id=3&status=5" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <span class="badge badge-info right"><?= $registered; ?></span>
                                <p>Registered</p>
                            </a>
                        </li>
                    </ul>
                </li>


                <!-- <li class="nav-item">
                    <a href="add.php?id=4" class="nav-link">
                        <i class="nav-icon fas fa-th"></i>
                        <p>
                            Register
                            <span class="right badge badge-danger">New Client</span>
                        </p>
                    </a>
                </li> -->
                <li class="nav-item">
                    <!-- <a href="info.php?id=3&status=5" class="nav-link">
                        <i class="nav-icon fas fa-copy"></i>
                        <p>
                            Total registered
                            <i class="fas fa-angle-left right"></i>
                            <span class="badge badge-info right"><?= $registered ?></span>
                        </p>
                    </a> -->
                    <ul class="nav nav-treeview">
                        <?php foreach ($override->getData('site') as $site) { ?>
                            <!-- <li class="nav-item">
                                <a href="info.php?id=3&status=5&site_id=<?= $site['id']; ?>" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p><?= $site['name'] ?></p>
                                    <span class="badge badge-info right">
                                        <?= $override->countData('clients', 'status', 1, 'site_id', $site['id']) ?>
                                    </span>
                                </a>
                            </li> -->
                        <?php } ?>
                        <!-- <li class="nav-item">
                            <a href="pages/layout/boxed.html" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Boxed</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="pages/layout/fixed-sidebar.html" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Fixed Sidebar</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="pages/layout/fixed-sidebar-custom.html" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Fixed Sidebar <small>+ Custom Area</small></p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="pages/layout/fixed-topnav.html" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Fixed Navbar</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="pages/layout/fixed-footer.html" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Fixed Footer</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="pages/layout/collapsed-sidebar.html" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Collapsed Sidebar</p>
                            </a>
                        </li> -->
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="info.php?id=8" class="nav-link">
                        <i class="nav-icon fas fa-copy"></i>
                        <p>
                            Medications <i class="fas fa-angle-left right"></i>

                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="add.php?id=5&btn=Add" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Add New Medication</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="add.php?id=6&btn=Add" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Add New Batch</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="info.php?id=8" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Medication list
                                    <span class="badge badge-info right"><?= $override->getCount('medications', 'status', 1) ?></span>
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="info.php?id=10" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Batch / Serial list
                                    <span class="badge badge-info right"><?= $override->getCount('batch', 'status', 1) ?></span>
                                </p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="info.php?id=8" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Expired Batches</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <!-- <a href="info.php?id=3&status=5" class="nav-link">
                        <i class="nav-icon fas fa-copy"></i>
                        <p>
                            Tests
                            <i class="fas fa-angle-left right"></i>
                            <span class="badge badge-info right"><?= $override->getCount('test_list', 'status', 1) ?></span>
                        </p>
                    </a> -->
                    <ul class="nav nav-treeview">
                        <?php foreach ($override->getData('site') as $test_list) { ?>
                            <li class="nav-item">
                                <a href="info.php?id=3&status=5&site_id=<?= $test_list['id']; ?>" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p><?= $test_list['name'] ?></p>
                                    <span class="badge badge-info right">
                                        <?= $override->getCount('test_list', 'status', 1) ?>
                                    </span>
                                </a>
                            </li>
                        <?php } ?>
                    </ul>
                </li>
                <li class="nav-item">
                    <!-- <a href="info.php?id=3&status=5" class="nav-link">
                        <i class="nav-icon fas fa-copy"></i>
                        <p>
                            Log book
                            <i class="fas fa-angle-left right"></i>
                            <span class="badge badge-info right"><?= $override->getCount('test_list', 'status', 1) ?></span>
                        </p>
                    </a> -->
                    <ul class="nav nav-treeview">
                        <?php foreach ($override->getData('site') as $log_book) { ?>
                            <li class="nav-item">
                                <a href="info.php?id=3&status=5&site_id=<?= $log_book['id']; ?>" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p><?= $log_book['name'] ?></p>
                                    <span class="badge badge-info right">
                                        <?= $override->getCount('test_list', 'status', 1) ?>
                                    </span>
                                </a>
                            </li>
                        <?php } ?>
                    </ul>
                </li>

                <?php
                if ($user->data()->position == 1 || $user->data()->position == 2) {
                ?>

                    <li class="nav-item">
                        <a href="info.php?id=8" class="nav-link">
                            <i class="nav-icon fas fa-copy"></i>
                            <p>
                                Lab Section <i class="fas fa-angle-left right"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="add_test_category.php" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <span class="badge badge-info right">
                                        <?= $override->countData('category', 'status', 1, 'delete_flag', 0) ?>
                                    </span>
                                    <p>List of Category </p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="add_test_sub_category.php" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <span class="badge badge-info right">
                                        <?= $override->countData('sub_category', 'status', 1, 'delete_flag', 0) ?>
                                    </span>
                                    <p>List of Sub Category </p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="add_test_list.php" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <span class="badge badge-info right">
                                        <?= $override->countData('test_list', 'status', 1, 'delete_flag', 0) ?>
                                    </span>
                                    <p>List of Tests
                                        <span class="badge badge-info right"></span>
                                    </p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="pending_doctor_confirmation.php?status=1" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <span class="badge badge-info right">
                                        <?= $override->getCount1('screening', 'ncd', 2, 'doctor_confirm', 0) ?>
                                    </span>
                                    <p>Pending Doctor Confirmations
                                    </p>
                                </a>
                            </li>

                            <li class="nav-item">
                                <a href="appointments.php?status=1" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <span class="badge badge-info right">
                                        <?= $override->getCount('appointment_list', 'status', 1) ?> </span>
                                    <p>View Completed Lab Requests</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="appointments.php?status=0" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <span class="badge badge-info right">
                                        <?= $override->getCount('appointment_list', 'status', 1) ?> </span>
                                    <p>View Pending Lab Requests </p>
                                </a>
                            </li>
                        </ul>
                    </li>
                <?php } ?>

                <li class="nav-item">
                    <!-- <a href="info.php?id=3&status=5" class="nav-link">
                        <i class="nav-icon fas fa-copy"></i>
                        <p>
                            Log book
                            <i class="fas fa-angle-left right"></i>
                            <span class="badge badge-info right"><?= $override->getCount('test_list', 'status', 1) ?></span>
                        </p>
                    </a> -->
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="info.php?id=3&status=5&site_id=<?= $log_book['id']; ?>" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p><?= $log_book['name'] ?></p>
                                <span class="badge badge-info right">
                                    <?= $override->getCount('test_list', 'status', 1) ?>
                                </span>
                            </a>
                        </li>
                    </ul>
                </li>

                <?php
                if ($user->data()->position == 1 || $user->data()->position == 2) {
                ?>

                    <li class="nav-item">
                        <a href="info.php?id=8" class="nav-link">
                            <i class="nav-icon fas fa-copy"></i>
                            <p>
                                Summary Reports <i class="fas fa-angle-left right"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="reports.php" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Overall </p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="reports1.php" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>All Diseases </p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="reports2.php" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Cardiac </p>
                                </a>
                            </li>
                            <!--  <li class="nav-item">
                                <a href="reports.php" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Overall summary </p>
                                </a>
                            </li>

                            <li class="nav-item">
                                <a href="reports.php" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Overall summary </p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="reports.php" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Overall summary </p>
                                </a>
                            </li> -->
                        </ul>
                    </li>
                <?php } ?>

            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>