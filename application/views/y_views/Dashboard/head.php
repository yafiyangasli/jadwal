<!doctype html>
<html lang="en">

<head>

    <meta charset="utf-8" />
    <title>Dashboard</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- App favicon -->
    <link rel="shortcut icon" href="<?=base_url('assets/images/favicon.ico');?>">

    <?php if($page == 'penjadwalan'):?>
    <link href="<?=base_url('assets/libs/@fullcalendar/core/main.min.css');?>" rel="stylesheet" type="text/css" />
    <link href="<?=base_url('assets/libs/@fullcalendar/daygrid/main.min.css');?>" rel="stylesheet" type="text/css" />
    <link href="<?=base_url('assets/libs/@fullcalendar/bootstrap/main.min.css');?>" rel="stylesheet" type="text/css" />
    <link href="<?=base_url('assets/libs/@fullcalendar/timegrid/main.min.css');?>" rel="stylesheet" type="text/css" />
    <?php elseif($page == 'penjadwalan2'):?>
    <link href="<?=base_url('assets/libs/@fullcalendar/core/main.min.css');?>" rel="stylesheet" type="text/css" />
    <link href="<?=base_url('assets/libs/@fullcalendar/daygrid/main.min.css');?>" rel="stylesheet" type="text/css" />
    <link href="<?=base_url('assets/libs/@fullcalendar/bootstrap/main.min.css');?>" rel="stylesheet" type="text/css" />
    <link href="<?=base_url('assets/libs/@fullcalendar/timegrid/main.min.css');?>" rel="stylesheet" type="text/css" />
    <?php elseif($page == 'penggunaan_harian'):?>
    <link href="<?=base_url('assets/libs/dropzone/min/dropzone.min.css');?>" rel="stylesheet" type="text/css" />
    <?php elseif($page == 'assisten_praktikum'):?>
    <link href="<?=base_url('assets/libs/dropzone/min/dropzone.min.css');?>" rel="stylesheet" type="text/css" />
    <?php elseif($page == 'laboratorium'):?>
    <link href="<?=base_url('assets/libs/dropzone/min/dropzone.min.css');?>" rel="stylesheet" type="text/css" />
    <?php endif;?>
    <!-- Bootstrap Css -->
    <link href="<?=base_url('assets/css/bootstrap.min.css');?>" id="bootstrap-style" rel="stylesheet" type="text/css" />
    <!-- Icons Css -->
    <link href="<?=base_url('assets/css/icons.min.css');?>" rel="stylesheet" type="text/css" />
    <!-- App Css-->
    <link href="<?=base_url('assets/css/app.min.css');?>" id="app-style" rel="stylesheet" type="text/css" />
    <script src="<?=base_url('assets/libs/jquery/jquery.min.js');?>"></script>
    <script src="<?=base_url('assets/libs/bootstrap/js/bootstrap.bundle.min.js');?>"></script>
</head>


<body data-sidebar="dark">

    <!-- <body data-layout="horizontal" data-topbar="colored"> -->

        <!-- Begin page -->
        <div id="layout-wrapper">

            <header id="page-topbar">
                <div class="navbar-header">
                    <div class="d-flex">
                        <!-- LOGO -->
                        <div class="navbar-brand-box">
                            
                        </div>

                        <button type="button" class="btn btn-sm px-3 font-size-24 header-item waves-effect vertical-menu-btn">
                            <i class="mdi mdi-menu"></i>
                        </button>
                    </div>

            <div class="d-flex">

                


        <div class="dropdown d-inline-block">
            <button type="button" class="btn header-item waves-effect" id="page-header-user-dropdown"
            data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <img class="rounded-circle header-profile-user" src="<?=base_url('assets/images/users/user-4.jpg');?>"
            alt="Header Avatar">
        </button>
        <div class="dropdown-menu dropdown-menu-end">
            <!-- item-->
            <a class="dropdown-item" href="<?=base_url('home');?>"><i class="mdi mdi-home-circle-outline font-size-17 text-muted align-middle me-1"></i> Beranda</a>
            <a class="dropdown-item text-danger" href="<?=base_url('auth/logout');?>"><i class="mdi mdi-power font-size-17 text-muted align-middle me-1 text-danger"></i> Logout</a>
        </div>
    </div>
</div>
</div>
</header>