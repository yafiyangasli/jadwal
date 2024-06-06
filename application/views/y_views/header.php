<!doctype html>
<html lang="en">

<head>

    <meta charset="utf-8" />
    <title>Dashboard</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- App favicon -->
    <link rel="shortcut icon" href="<?=base_url('assets/images/favicon.ico');?>">
    <?php if($page == 'home'):?>
    <link href="<?=base_url('assets/libs/@fullcalendar/core/main.min.css');?>" rel="stylesheet" type="text/css" />
    <link href="<?=base_url('assets/libs/@fullcalendar/daygrid/main.min.css');?>" rel="stylesheet" type="text/css" />
    <link href="<?=base_url('assets/libs/@fullcalendar/bootstrap/main.min.css');?>" rel="stylesheet" type="text/css" />
    <link href="<?=base_url('assets/libs/@fullcalendar/timegrid/main.min.css');?>" rel="stylesheet" type="text/css" />
	<?php endif;?>
    <!-- Bootstrap Css -->
    <link href="<?=base_url('assets/css/bootstrap.min.css');?>" id="bootstrap-style" rel="stylesheet" type="text/css" />
    <!-- Icons Css -->
    <link href="<?=base_url('assets/css/icons.min.css');?>" rel="stylesheet" type="text/css" />
    <!-- App Css-->
    <link href="<?=base_url('assets/css/app.min.css');?>" id="app-style" rel="stylesheet" type="text/css" />
    <script src="<?=base_url('assets/libs/jquery/jquery.min.js');?>"></script>
</head>
<body>
	<nav class="navbar navbar-expand-lg navbar-light bg-light">
	  <div class="container-fluid">
		    <a class="navbar-brand py-0 ms-5" href="#"></a>
		    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
		      <span class="navbar-toggler-icon"></span>
		    </button>
		    <div class="collapse navbar-collapse" id="navbarSupportedContent">
		      <ul class="navbar-nav mx-auto mb-2 mb-lg-0">
		        <li class="nav-item">
		          <a class="nav-link" aria-current="page" href="<?=base_url('');?>">Beranda</a>
		        </li>
		        <li class="nav-item">
		          <a class="nav-link" href="#kalender">Kalender</a>
		        </li>
		        <li class="nav-item">
		          <a class="nav-link" href="#tentang">Tentang</a>
		        </li>
		      </ul>
		      <?php if ($this->session->userdata('email') == NULL):?>
		      <a href="<?=base_url('auth');?>" class="btn btn-primary btn-lg px-4">Login</a>
		      <?php else:?>
		      	<div class="dropdown d-inline-block">
		            <button type="button" class="btn header-item waves-effect" id="page-header-user-dropdown"
		            data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
		            <img class="rounded-circle header-profile-user" src="<?=base_url('assets/images/users/user-4.jpg');?>"
		            alt="Header Avatar">
		        </button>
		        <div class="dropdown-menu dropdown-menu-end">
		            <!-- item-->
		            <a class="dropdown-item" href="<?=base_url('dashboard');?>"><i class="mdi mdi-desktop-mac-dashboard font-size-17 text-muted align-middle me-1"></i> Dashboard</a>
		            <a class="dropdown-item text-danger" href="<?=base_url('auth/logout');?>"><i class="mdi mdi-power font-size-17 text-muted align-middle me-1 text-danger"></i> Logout</a>
		        </div>
		    </div>
			<?php endif;?>
		    </div>
	  	</div>
</nav>
