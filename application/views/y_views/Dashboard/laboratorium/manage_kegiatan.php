<div class="main-content">

    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-sm-6">
                    <div class="page-title-box">
                        <h4>Master Data</h4>
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item active">Kegiatan</li>
                        </ol>
                    </div>
                </div>
            </div>
            <div class="col-lg">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Tabel Kegiatan</h4>

                        <div class="table-responsive">
                            <table class="table table-bordered mb-0">

                                <thead>
                                    <tr class="text-center">
                                        <th>Nama Kegiatan</th>
                                        <th>Tanggal</th>
                                        <th>Jam</th>
                                        <th>Rentang Waktu</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach($kegiatan as $kg):?>
                                    <tr class="text-center">
                                        <th scope="row"><?=$kg['title'];?></th>
                                        <td><?= $kg['tanggal'];?></td>
                                        <td><?= $kg['start'];?> - <?= $kg['end'];?></td>
                                        <td><?= $kg['rentang_waktu'];?> Minggu</td>
                                        <td><?= $kg['is_active'];?></td>
                                        <td>
                                            <div class="row">
                                                <a href="#" class="col btn btn-secondary mx-2 mb-1" data-id="<?=$kg['id_jadwal'];?>" onclick="detailKegiatan(this)">Detail</a>
                                                <!-- <a href="#" class="col btn btn-success mx-2 mb-1" data-id="" onclick="">Edit</a> -->
                                                <a href="#" class="col btn btn-danger mx-2 mb-1" data-id-jadwal="<?=$kg['id_jadwal'];?>" data-id-kp="<?=$kg['id_kp'];?>" data-name="<?=$kg['title'];?>" onclick="modalHapusKegiatan(this)">Hapus</a>
                                            </div>
                                        </td>
                                    </tr>
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
                    <div class="modal-footer" id="modal-footer">
                    </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->
    </div>
</div>


