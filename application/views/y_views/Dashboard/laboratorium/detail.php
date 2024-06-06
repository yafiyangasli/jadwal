<div class="main-content">

    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-sm-6">
                    <div class="page-title-box">
                        <h4>Detail Laboratorium</h4>
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item">Laboratorium</li>
                            <li class="breadcrumb-item active"><?=$lab['nama_lab'];?></li>
                        </ol>
                    </div>
                </div>
            </div>

            <div class="col-lg">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title"><?=$lab['nama_lab'];?></h4>
                        
                        <p class="card-title-desc"><?=$lab['jenis'];?></p>

                        <div id="carouselGambarLab" class="carousel slide col-8 offset-2 mb-3" data-bs-ride="carousel">
                            <div class="carousel-indicators">
                                <?php for($i = 0; $i < count($gambar_lab) - 1; $i++):?>
                                    <?php if($i == 0):?>
                                        <button type="button" data-bs-target="#carouselGambarLab" data-bs-slide-to="<?=$i?>" class="active" aria-current="true" aria-label="Slide <?=$i+1;?>"></button>
                                        <?php else:?>
                                            <button type="button" data-bs-target="#carouselGambarLab" data-bs-slide-to="<?=$i;?>" aria-label="Slide <?=$i+1;?>"></button>
                                        <?php endif;?>
                                    <?php endfor;?>
                                </div>
                                <div class="carousel-inner">
                                    <?php for($i = 0; $i < count($gambar_lab) - 1; $i++):?>
                                        <?php if($i == 0):?>
                                            <div class="carousel-item active">
                                                <?php else:?>
                                                    <div class="carousel-item">
                                                    <?php endif;?>
                                                    <img src="<?=base_url('assets/images/input/foto_lab/').$gambar_lab[$i];?>" class="d-block w-100" alt="<?=$gambar_lab[$i];?>">
                                                    <div class="carousel-caption d-none d-md-block">
                                                        <p>
                                                            <a href="#" class="col-4 btn btn-success waves-effect waves-light mx-2 mb-1" data-id="<?=$lab['id_lab'];?>" data-name="<?=$gambar_lab[$i];?>" onclick="ubahFotoLab(this)">Edit</a>
                                                            <a href="#" class="col-4 btn btn-danger waves-effect waves-light mx-2 mb-1" data-id="<?=$lab['id_lab'];?>" data-name="<?=$gambar_lab[$i];?>" onclick="hapusFotoLab(this)">Hapus</a>
                                                        </p>
                                                    </div>
                                                </div>
                                            <?php endfor;?>
                                        </div>
                                        <button class="carousel-control-prev" type="button" data-bs-target="#carouselGambarLab" data-bs-slide="prev">
                                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                            <span class="visually-hidden">Previous</span>
                                        </button>
                                        <button class="carousel-control-next" type="button" data-bs-target="#carouselGambarLab" data-bs-slide="next">
                                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                            <span class="visually-hidden">Next</span>
                                        </button>
                                    </div>

                                    <button type="button" class="btn btn-primary waves-effect waves-light mb-5" onclick="tambahFotoLab(this)" data-id="<?=$lab['id_lab']?>"><i class="mdi mdi-plus-circle-outline me-2"></i>Tambah Foto Lab</button>
                                    <div class="col">
                                        <div class="table-responsive mb-5">
                                            <table class="table table-bordered mb-0">
                                                <thead>
                                                    <tr class="text-center">
                                                        <th>Gedung</th>
                                                        <th>Jam Awal Pelayanan</th>
                                                        <th>Jam Akhir Pelayanan</th>
                                                        <th>Ukuran Ruangan</th>
                                                        <th>Jumlah Peserta</th>
                                                        <th>Jumlah PC</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr class="text-center">
                                                        <th scope="row"><?=$lab['gedung'];?></th>
                                                        <td><?= $lab['jam_awal'];?></td>
                                                        <td><?= $lab['jam_akhir'];?></td>
                                                        <td><?= $lab['ukuran'];?></td>
                                                        <td><?= $lab['peserta'];?></td>
                                                        <td><?= $lab['pc'];?></td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                        <div class="row">
                                            <div class="col-12 col-md-6">
                                                <p>Software yang tersedia</p>
                                                <p><?=$lab['software'];?></p>
                                            </div>
                                            <div class="col-12 col-md-6">
                                                <p>Spesifikasi Komputer</p>
                                                <p><?=$lab['spek_pc']?></p>
                                            </div>
                                        </div>
                                        <div class="col mt-3">
                                            <h4>Data Barang</h4> 
                                            <div class="table-responsive mb-5">
                                                <table class="table table-bordered mb-0">
                                                    <thead>
                                                        <tr class="text-center">
                                                            <th>Nama Barang</th>
                                                            <th>Total Barang</th>
                                                            <th>Keterangan</th>
                                                            <th>Deskripsi</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php foreach($barang_lab as $bl):?>
                                                        <?php if($lab['id_lab'] == $bl['id_ruang']):?>
                                                        <tr class="text-center">
                                                            <th scope="row"><?=$bl['nama_barang'];?></th>
                                                            <td><?=$bl['total_barang'];?></td>
                                                            <td><?=$bl['keterangan_barang'];?></td>
                                                            <td><?=$bl['deskripsi'];?></td>
                                                        </tr>
                                                        <?php endif;?>
                                                        <?php endforeach;?>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

                <div id="myModal" class="modal fade" tabindex="-1" role="dialog"aria-labelledby="myModalLabel" aria-hidden="true">
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