<div class="main-content">

    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-sm-6">
                    <div class="page-title-box">
                        <h4>Master Data</h4>
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item active">Kelas</li>
                        </ol>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="state-information d-none d-sm-block">
                        <div class="state-graph">
                            <button type="button" class="btn btn-primary btn-lg waves-effect waves-light" onclick="inputKelas()"><i class="mdi mdi-plus-circle-outline me-2"></i>Tambah Kelas</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Tabel Kelas Mata Kuliah</h4>

                        <div class="table-responsive">
                            <table class="table table-bordered mb-0">

                                <thead>
                                    <tr class="text-center">
                                        <th>Nama Mata Kuliah</th>
                                        <th>Dosen</th>
                                        <th>Kode Mata Kuliah</th>
                                        <th>Kelas</th>
                                        <th>SKS</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach($kelas as $kl):?>
                                    <tr class="text-center">
                                        <th scope="row"><?=$kl['nama_mk'];?></th>
                                        <td><?= $kl['nama_dosen'];?></td>
                                        <td><?= $kl['kode_mk'];?></td>
                                        <td><?= $kl['kelas'];?></td>
                                        <td><?= $kl['sks'];?></td>
                                        <td><?= $kl['is_active'];?></td>
                                        <td>
                                            <div class="row">
                                                <a href="#" class="col btn btn-success mx-2 mb-1" data-id="<?=$kl['id_kp'];?>" onclick="ubahKelas(this)">Edit</a>
                                                <a href="#" class="col btn btn-danger mx-2 mb-1" data-id="<?=$kl['id_kp'];?>" data-name="<?=$kl['nama_mk'];?>" onclick="hapusKelas(this)">Hapus</a>
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
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->
    </div>
</div>


