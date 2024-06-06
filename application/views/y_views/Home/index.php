<div class="jumbotron p-3 my-4" style="min-height: calc(80vh - 40px);">
	<div class="container-fluid">
		<div class="row p-3">
			<div class="col-6 offset-1">
			  <h1 class="display-5 my-3 text-primary">Sistem Penjadwalan dan Berita Acara Harian Laboratorium</h1>
			  <p class="lead text-muted" style="font-size: 35px;">Program studi Teknik Informatika ITERA </p>
			  <p class="col" style="font-size: 0.8rem;">Sistem Penjadwalan dan Berita Acara Harian Laboratorium program studi Teknik Informatika ITERA berfungsi untuk memfasilitasi penyampaian informasi terkait ruangan laboratorium yang berada dibawah naungan program studi Teknik Informatika ITERA.</p>
			</div>
		</div>
	</div>
</div>

<div class="bg-secondary" style="min-height: calc(100vh - 40px);">
	<div class="container-fluid p-4 mt-5">
		<div class="p-5" id="kalender">
			<h1 class="text-center text-primary mb-5"><strong>Jadwal Kegiatan Laboratorium</strong></h1>
			<div class="row">
				<div class="col-xl-3 mt-3">
					<div class="card" style="min-height: calc(50vh - 40px);">
						<div class="card-body">
							<h3 class="text-secondary mb-4">Daftar Laboratorium</h3>
							<?php foreach($lab as $lb):?>
								<div class="mb-2">
									<a class="tab-calendar" onclick="loadCalendar(`<?= $lb['nama_lab'];?>`)" style="font-size: 1rem; cursor: pointer;">
										<?= $lb['nama_lab'];?>
									</a>
								</div>
							<?php endforeach;?>
						</div>
					</div>
				</div>
				<div class="col-xl-9 mt-3">
                    <div class="card mt-4 mt-xl-0 mb-0" style="min-height: calc(50vh - 40px);">
                        <div class="card-body">
                            <div id="calendar"></div>

                        </div>
                    </div>
                </div> <!-- end col -->
			</div>
		</div>
	</div>
</div>

<div style="min-height: calc(100vh - 40px);">
	<div class="container-fluid p-4 mt-5">
		<div class="p-5 text-primary" id="tentang">
			<h1 class="text-center text-secondary mb-5"><strong>Tentang Laboratorium</strong></h1>
			<ul class="nav nav-tabs nav-tabs-custom" role="tablist">
				<?php foreach($lab as $lb):?>
				<li class="nav-item">
					<a class="tentang nav-link" data-bs-toggle="tab" href="#<?=str_replace(' ','_',$lb['nama_lab']);?>" role="tab">
						<span class="d-sm-block"><?=$lb['nama_lab'];?></span>
					</a>
				</li>
				<?php endforeach;?>
			</ul>
			<div class="tab-content">
				<?php foreach($lab as $lb):?>
				<div class="tentangTab tab-pane p-3" id="<?=str_replace(' ','_',$lb['nama_lab']);?>" role="tabpanel">
					<h3 class="mt-4"><?=$lb['nama_lab'];?></h3>
					<h4 class="mb-3">Laboratorium <?=$lb['jenis'];?></h4>
					<!-- carousel -->
					<div id="carousel<?=str_replace(' ','',$lb['nama_lab']);?>" class="carousel slide col-8 offset-2 mt-5 mb-3" data-bs-ride="carousel">
                        <div class="carousel-indicators">
	                        <?php for($i = 0; $i < count($gambar_lab[$lb['nama_lab']]); $i++):?>
	                        <?php if($i == 0):?>
	                        <button type="button" data-bs-target="#carousel<?=str_replace(' ','',$lb['nama_lab']);?>" data-bs-slide-to="<?=$i?>" class="active" aria-current="true" aria-label="Slide <?=$i;?>"></button>
	                        <?php else:?>
                            <button type="button" data-bs-target="#carousel<?=str_replace(' ','',$lb['nama_lab']);?>" data-bs-slide-to="<?=$i?>" aria-current="true" aria-label="Slide <?=$i;?>"></button>
                            <?php endif;?>
	                        <?php endfor;?>
                     	</div>
                        <div class="carousel-inner">
                        <?php for($i = 0; $i < count($gambar_lab[$lb['nama_lab']]); $i++):?>
                        	<?php if($i == 0):?>
                            <div class="carousel-item active">
                            <?php else:?>
                            <div class="carousel-item">
                            <?php endif;?>
                            	<img src="<?=base_url('assets/images/input/foto_lab/').$gambar_lab[$lb['nama_lab']][$i];?>" class="d-block w-100" alt="<?=$gambar_lab[$lb['nama_lab']][$i];?>">
                            </div>
                        <?php endfor;?>
                        </div>
                        <button class="carousel-control-prev" type="button" data-bs-target="#carousel<?=str_replace(' ','',$lb['nama_lab']);?>" data-bs-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                           	<span class="visually-hidden">Previous</span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#carousel<?=str_replace(' ','',$lb['nama_lab']);?>" data-bs-slide="next">
                        	<span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Next</span>
                        </button>
                    </div>
                    <!-- tabel spek -->
                    <h4 class="mb-3">Spesifikasi Laboratorium</h4>
                    <div class="row">
						<div class="col-6"> 
							<div class="table-responsive mb-5">
								<table class="table table-bordered mb-0">
									<thead>
										<tr class="text-center">
											<th>Gedung</th>
											<th>Jam Pelayanan</th>
											<th>Ukuran Ruangan</th>
											<th>Jumlah Peserta</th>
											<th>Jumlah PC</th>
										</tr>
									</thead>
									<tbody>
										<tr class="text-center">
											<th scope="row"><?=$lb['gedung'];?></th>
											<td><?= $lb['jam_awal'];?> - <?= $lb['jam_akhir'];?></td>
											<td><?= $lb['ukuran'];?></td>
											<td><?= $lb['peserta'];?></td>
											<td><?= $lb['pc'];?></td>
										</tr>
									</tbody>
								</table>
							</div>
							<div class="row">
								<div class="col-12 col-md-6">
									<p>Software yang tersedia</p>
									<p><?=$lb['software'];?></p>
								</div>
								<div class="col-12 col-md-6">
									<p>Spesifikasi Komputer</p>
									<p><?=$lb['spek_pc']?></p>
								</div>
							</div>
						</div>
						<div class="col-6"> 
							<div class="table-responsive mb-5">
								<table class="table table-bordered mb-0">
									<thead>
										<tr class="text-center">
											<th>Nama Barang</th>
											<th>Total Barang</th>
											<th>Keterangan</th>
										</tr>
									</thead>
									<tbody>
										<?php foreach($barang_lab as $bl):?>
										<?php if($lb['id_lab'] == $bl['id_ruang']):?>
										<tr class="text-center">
											<th scope="row"><?=$bl['nama_barang'];?></th>
											<td><?=$bl['total_barang'];?></td>
											<td><?=$bl['keterangan_barang'];?></td>
										</tr>
										<?php endif;?>
										<?php endforeach;?>
									</tbody>
								</table>
							</div>
						</div>
                    </div>
				</div>
				<?php endforeach;?>
			</div>
		</div>
	</div>
</div>