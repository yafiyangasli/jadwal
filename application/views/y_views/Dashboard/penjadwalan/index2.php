<div class="main-content">
	<div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-sm-6">
                    <div class="page-title-box">
                        <h4>Penjadwalan</h4>
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item active">Penjadwalan</li>
                        </ol>
                    </div>
                </div>
            </div>
			
			<div class="row mb-4">
                <div class="col-xl-3">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-grid">
                                <button class="btn btn-primary" id="btn-new-event" onclick=""><i class="mdi mdi-plus-circle-outline"></i> Buat Jadwal Baru</button>
                            </div>

                            <div id="external-events">
                                <br>
                                <p class="text-muted">Drag and drop your event or click in the calendar</p>
                                <div class="external-event fc-event bg-success" data-class="bg-success">
                                    <i class="mdi mdi-checkbox-blank-circle font-size-11 me-2"></i>Prodi IF
                                </div>
                                <div class="external-event fc-event bg-info" data-class="bg-info">
                                    <i class="mdi mdi-checkbox-blank-circle font-size-11 me-2"></i>Luar Prodi
                                </div>
                            </div>
                        </div>
                    </div>
                </div> <!-- end col-->

                <div class="col-xl-9">
                    <div class="card mt-4 mt-xl-0 mb-0">
                        <div class="card-body">
                            <div id="calendar"></div>

                        </div>
                    </div>
                </div> <!-- end col -->

            </div>
            <!-- end row -->
		</div>
	</div>