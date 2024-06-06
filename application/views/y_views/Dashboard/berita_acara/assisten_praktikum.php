<div class="main-content">

    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-sm-6">
                    <div class="page-title-box">
                        <h4>Berita Acara</h4>
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item active">Assisten Praktikum</li>
                        </ol>
                    </div>
                </div>
                <?php if($this->session->userdata('role_id') == 3):?>
                <div class="col-sm-6">
                    <div class="state-information d-none d-sm-block">
                        <div class="state-graph">
                            <button type="button" class="btn btn-primary btn-lg waves-effect waves-light" onclick="inputAsprakBA()"><i class="mdi mdi-book-plus-multiple-outline me-2"></i>Upload BAP</button>
                        </div>
                    </div>
                </div>
                <?php endif;?>
            </div>
            <div class="col-lg">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Tabel BAP Asisten Praktikum</h4>
                        <p class="card-title-desc">Data BAP asisten praktikum.</p>    

                        <div class="table-responsive">
                            <table class="table table-bordered mb-0">

                                <thead>
                                    <tr>
                                        <th>Waktu</th>
                                        <th>NIM</th>
                                        <th>Nama</th>
                                        <th>Mata Kuliah</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach($ba_asprak as $bap):?>
                                    <tr>
                                        <th scope="row"><?=$bap['waktu'];?></th>
                                        <td><?=$bap['id_user'];?></td>
                                        <td><?=$bap['nama'];?></td>
                                        <td><?=$bap['nama_mk'];?></td>
                                        <td><?=$bap['is_valid'];?></td>
                                        <td>
                                            <div class="row">
                                                <a href="#" class="col btn btn-secondary mx-2 mb-1" data-id="<?=$bap['id_bap'];?>" onclick="modalDetail(this)">Detail</a>
                                                <?php if(($bap['is_valid'] == 'Diterima')):?>
                                                <a href="<?=base_url('dashboard/printBAP/').$bap['id_bap'];?>" target="<?=base_url('dashboard/printBAP/').$bap['id_bap'];?>" class="col btn btn-warning mx-2 mb-1">Download</a>
                                                <?php endif;?>
                                                <?php if(($this->session->userdata('role_id') == 1) || ($this->session->userdata('role_id') == 3)):?>
                                                <a href="#" class="col btn btn-danger mx-2 mb-1" data-id="<?=$bap['id_bap'];?>" onclick="hapusAsprakBA(this)">Hapus</a>
                                                <?php endif;?>
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

<script type="text/javascript">

</script>