<!doctype html>
<html lang="en">

<head>

    <meta charset="utf-8" />
    <title>Dashboard</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- App favicon -->
    <link rel="shortcut icon" href="<?=base_url('assets/images/favicon.ico');?>">
    <!-- Bootstrap Css -->
    <link href="<?=base_url('assets/css/bootstrap.min.css');?>" id="bootstrap-style" rel="stylesheet" type="text/css" />
    <!-- Icons Css -->
    <link href="<?=base_url('assets/css/icons.min.css');?>" rel="stylesheet" type="text/css" />
    <!-- App Css-->
    <link href="<?=base_url('assets/css/app.min.css');?>" id="app-style" rel="stylesheet" type="text/css" />
</head>
<body>
	<nav class="navbar navbar-expand-lg navbar-light bg-light">
	  <div class="container-fluid">
		    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
		      <span class="navbar-toggler-icon"></span>
		    </button>
		    <div class="collapse navbar-collapse" id="navbarSupportedContent">
		      <ul class="navbar-nav mx-auto mb-2 mb-lg-0">
		        <li class="nav-item">
		          <a class="nav-link" aria-current="page" href="<?=base_url('home');?>">Beranda</a>
		        </li>
		        <li class="nav-item">
		          <a class="nav-link" href="<?=base_url('home');?>">Kalender</a>
		        </li>
		        <li class="nav-item">
		          <a class="nav-link" href="<?=base_url('home');?>">Tentang</a>
		        </li>
		      </ul>
		    </div>
	  	</div>
</nav>

<div class="container-fluid" style="min-height: calc(80vh - 40px);">
	<div class="card-login col-lg-3 col-md-6 offset-lg-8 offset-md-3" style="margin-top: 100px; border-radius: 5px; background-color: #4995b6; min-height: calc(40vh - 40px);">
		<div class="p-4">
			<h2 class="text-white">Login</h2>
			<div class="mt-5">
				<form class="form-horizontal needs-validation mt-4" method="post" action="<?=base_url('auth/login')?>" novalidate>
					<div class="mb-3">
						<label for="username">Email</label>
						<input type="text" class="form-control" name="email" id="email" placeholder="Enter username" required>
						<div class="invalid-feedback">Masukkan username!</div>
					</div>
					<div class="mb-3">
						<label for="userpassword">Password</label>
						<input type="password" class="form-control" name="password" id="password" placeholder="Enter password" required>
						<div class="invalid-feedback">Masukkan password!</div>
					</div>

					<div class="col-6 text-end offset-6">
						<button class="btn btn-primary w-md waves-effect waves-light" type="submit">Masuk</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
<div id="myModal" class="modal fade" tabindex="-1" role="dialog"
        aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title mt-0" id="myModalLabel">Login Gagal</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"aria-label="Close"></button>
                    </div>
                    <div class="modal-body" id="modal-body">    
                    	<p>Silahkan masukkan username dan password dengan benar!</p>
                    </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->

<footer style="border-top: solid 2px #5f606a; ">
	<p class="text-center mt-1 mb-0" style="font-weight: 700;"><label class="text-secondary"><i class="far fa-fw fa-copyright"></i>2024 </label> Sistem Informasi Laboratorium Program Studi Teknik Informatika ITERA Tim</p>
</footer>
<script src="<?=base_url('assets/libs/jquery/jquery.min.js');?>"></script>
<script src="<?=base_url('assets/libs/bootstrap/js/bootstrap.bundle.min.js');?>"></script>
<script src="<?=base_url('assets/libs/metismenu/metisMenu.min.js');?>"></script>
<script src="<?=base_url('assets/libs/simplebar/simplebar.min.js');?>"></script>
<script src="<?=base_url('assets/libs/node-waves/waves.min.js');?>"></script>
<script src="<?=base_url('assets/libs/jquery-sparkline/jquery.sparkline.min.js');?>"></script>
<script src="<?=base_url('assets/js/form-validation.init.js');?>"></script>
</body>
</html>