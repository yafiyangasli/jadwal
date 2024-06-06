<div class="main-content">

    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-sm-6">
                    <div class="page-title-box">
                        <h4>Berita Acara</h4>
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item active">Penggunaan Harian</li>
                        </ol>
                    </div>
                </div>
                <?php if($this->session->userdata('role_id') == 3):?>
                <div class="col-sm-6">
                    <div class="state-information d-none d-sm-block">
                        <div class="state-graph">
                            <button type="button" class="btn btn-primary btn-lg waves-effect waves-light" onclick="inputHarian()"><i class="mdi mdi-comment-plus-outline me-2"></i>Upload Laporan Penggunaan</button>
                        </div>
                    </div>
                </div>
                <?php endif;?>
            </div>
            <div class="col-lg">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Tabel Penggunaan Harian</h4>
                        <p class="card-title-desc">Penggunaan harian ruangan laboratorium.</p>    

                        <div class="table-responsive">
                            <table class="table table-bordered mb-0">

                                <thead>
                                    <tr>
                                        <th>Waktu</th>
                                        <th>NIM</th>
                                        <th>Nama</th>
                                        <th>Kegiatan</th>
                                        <th>Laboratorium</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php foreach($ba_harian as $bah):?>
                                    <tr>
                                        <th scope="row"><?=$bah['waktu'];?></th>
                                        <td><?=$bah['id_user'];?></td>
                                        <td><?=$this->session->userdata('nama');?></td>
                                        <td><?=$bah['kegiatan'];?></td>
                                        <td><?=$bah['laboratorium'];?></td>
                                        <td>
                                            <div class="row">
                                                <a href="<?=base_url('dashboard/penggunaan_harian/detail_penggunaan_harian/').$bah['id_bah'];?>" class="col btn btn-secondary mx-2 mb-1">Detail</a>
                                                <a href="#" class="col btn btn-danger mx-2 mb-1" data-id="<?=$bah['id_bah'];?>"onclick="hapusHarian(this)">Hapus</a>
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
                        <h5 class="modal-title mt-0" id="myModalLabel"></h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"aria-label="Close"></button>
                    </div>
                    <div class="modal-body" id="modal-body">    
                    </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->
    </div>
</div>