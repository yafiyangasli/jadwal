<div class="main-content">

    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-sm-6">
                    <div class="page-title-box">
                        <h4>Master Data</h4>
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item active">Laboratorium</li>
                        </ol>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="state-information d-none d-sm-block">
                        <div class="state-graph">
                            <button type="button" class="btn btn-primary btn-lg waves-effect waves-light" onclick="inputLab()"><i class="mdi mdi-plus-circle-outline me-2"></i>Tambah Laboratorium</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Tabel Ruangan Laboratorium</h4>

                        <div class="table-responsive">
                            <table class="table table-bordered mb-0">

                                <thead>
                                    <tr class="text-center">
                                        <th>No</th>
                                        <th>Ruangan Lab</th>
                                        <th>Gedung</th>
                                        <th>Jenis</th>
                                        <th>Waktu Pelayanan</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $i=1;?>
                                    <?php foreach($lab as $lb):?>
                                    <tr class="text-center">
                                        <th scope="row" class="col-1"><?=$i;?></th>
                                        <td><?= $lb['nama_lab'];?></td>
                                        <td><?= $lb['gedung'];?></td>
                                        <td><?= $lb['jenis'];?></td>
                                        <td><?= $lb['jam_awal'];?> - <?= $lb['jam_akhir'];?></td>
                                        <td>
                                            <div class="row">
                                                <a href="<?=base_url('dashboard/laboratorium/detail_laboratorium/').$lb['id_lab'];?>" class="col btn btn-secondary mx-2 mb-1">Detail</a>
                                                <a href="#" class="col btn btn-success mx-2 mb-1" onclick="editLab(`<?=$lb['id_lab'];?>`)">Edit</a>
                                                <a href="#" class="col btn btn-danger mx-2 mb-1" data-id="<?=$lb['id_lab'];?>" data-name="<?=$lb['nama_lab'];?>" onclick="hapusLab(this)">Hapus</a>
                                            </div>
                                        </td>
                                    </tr>
                                    <?php $i++;?>
                                <?php endforeach;?>
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </div>
        <!-- sample modal content -->
        <div id="myModal" class="modal fade" tabindex="-1" role="dialog"
        aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title mt-0" id="myModalLabel">
                        </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                    </div>
                    <div class="modal-body" id="modal-body">
                    </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->
    </div>
</div>


