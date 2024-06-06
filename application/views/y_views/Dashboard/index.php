<!-- ============================================================== -->
<!-- Start right Content here -->
<!-- ============================================================== -->
<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
            
            <!-- start page title -->
            <div class="row">
                <div class="col-sm-6">
                    <div class="page-title-box">
                        <h4>Dashboard</h4>
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item active">Dashboard</li>
                        </ol>
                    </div>
                </div>
            </div>
            <!-- end page title -->

            <div class="row" id="mini-stat">
                <div class="col-xl-3 col-sm-6">
                    <div class="card mini-stat bg-primary" style="min-height: 150px;">
                        <div class="card-body mini-stat-img">
                            <div class="mini-stat-icon">
                            </div>
                            <div class="text-white">
                                <h6 class="text-uppercase mb-3 font-size-16 text-white"></h6>
                                <h2 class="inner-text mb-4 text-white"></h2>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-sm-6">
                    <div class="card mini-stat bg-primary" style="min-height: 150px;">
                        <div class="card-body mini-stat-img">
                            <div class="mini-stat-icon">
                                <i class="mdi mdi-buffer float-end"></i>
                            </div>
                            <div class="text-white">
                                <h6 class="text-uppercase mb-3 font-size-16 text-white"></h6>
                                <h2 class="inner-text mb-4 text-white"></h2>
                            </div>
                        </div>
                    </div>
                </div>
                <?php if($this->session->userdata('role_id') != 1):?>
                <div class="col-xl-3 col-sm-6">
                    <div class="card mini-stat bg-primary" style="min-height: 150px;">
                        <div class="card-body mini-stat-img">
                            <div class="mini-stat-icon">
                                <i class="mdi mdi-tag-text-outline float-end"></i>
                            </div>
                            <div class="text-white">
                                <h6 class="text-uppercase mb-3 font-size-16 text-white"></h6>
                                <h2 class="inner-text mb-4 text-white"></h2>
                            </div>
                        </div>
                    </div>
                </div>
                <?php endif;?>
            </div>

            <div class="row">
                <div class="col-xl-4 col-lg-6">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title mb-3" id="inbox-title"></h4>
                            <div class="inbox-wid">
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <!-- container-fluid -->
    </div>
    <!-- End Page-content -->
