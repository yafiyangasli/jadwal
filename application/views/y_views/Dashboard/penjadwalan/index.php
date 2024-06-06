<div class="main-content">

    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-sm-6">
                    <div class="page-title-box">
                        <h4>Penjadwalan</h4>
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item active"><?=$lab['nama_lab'];?></li>
                        </ol>
                    </div>
                </div>
            </div>
            <!-- end page title -->

            <div class="row mb-4">
                <div class="col-xl-3">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-grid">
                                <button class="btn btn-primary" id="btn-new-event"><i class="mdi mdi-plus-circle-outline"></i> Buat Jadwal Baru</button>
                            </div>

                            <div id="external-events">
                                <br>
                                <div class="external-event fc-event bg-success" data-class="bg-success">
                                    <i class="mdi mdi-checkbox-blank-circle font-size-11 me-2"></i>Prodi IF
                                </div>
                                <div class="external-event fc-event bg-info" data-class="bg-info">
                                    <i class="mdi mdi-checkbox-blank-circle font-size-11 me-2"></i>Luar Prodi
                                </div>
                                <div class="external-event fc-event bg-warning" data-class="bg-warning">
                                    <i class="mdi mdi-checkbox-blank-circle font-size-11 me-2"></i>Lainnya
                                </div>
                                <br>
                                <p class="text-muted" style="font-size: 0.7rem;">Kamu dapat menggunakan kategori lainnya untuk kegiatan diluar praktikum.</p>
                            </div>
                            <div class="mt-5">
                                <h5 class="font-size-14 mb-4">Aktifitas Terbaru</h5>
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


            <!-- Add New Event MODAL -->
            <!-- Add New Event MODAL -->
            <div class="modal fade" id="event-modal" tabindex="-1">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header py-3 px-4 border-bottom">
                            <h5 class="modal-title" id="modal-title">Event</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                            aria-hidden="true"></button>
                        </div>
                        <div class="modal-body p-4">
                            <form class="needs-validation" name="event-form" id="form-event" novalidate>
                                <div class="col-8">
                                    <div class="mb-3">
                                        <label class="form-label">Nama Kegiatan</label>
                                        <input class="form-control" placeholder=""
                                        type="text" name="title" id="event-title" required value="" />
                                    </div>
                                </div>
                                <div class="col-8">
                                    <div class="mb-3">
                                        <label class="form-label">Kategori</label>
                                        <select class="form-control custom-select" name="category" id="event-category" required oninput="inputModalKelas()">
                                            <option selected value=""> Pilih Kategori </option>
                                            <option value="1">Prodi IF</option>
                                            <option value="2">Luar Prodi</option>
                                            <option value="3">Lainnya</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-5">
                                    <div class="mb-3">
                                        <label for="event-date" class="form-label">Tanggal Mulai</label>
                                        <input class="form-control" type="date" name="date" id="event-date" required>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-6">
                                        <div class="mb-3">
                                        <label class="form-label">Jumlah Mahasiswa</label>
                                        <input class="form-control" type="number" name="jumlahMHS" id="jumlahMHS" required value=""/>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="mb-3">
                                            <label for="event-date" class="form-label">Rentang Waktu</label>
                                            <div class="input-group">
                                                <input class="form-control" type="number" name="rentang" id="rentang"  required value="">
                                                <div class="input-group-text">Minggu</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-6">
                                        <label for="event-date" class="form-label">Jam Mulai</label>
                                        <input class="form-control" type="time" name="jmulai" id="jmulai"  required value="" min="<?=$lab['jam_awal']?>" max="<?=$lab['jam_akhir']?>" onchange="batasAwalSelesai()">
                                        <div class="invalid-feedback"></div>
                                    </div>
                                    <div class="col-6">
                                        <label for="event-date" class="form-label">Jam Selesai</label>
                                        <input class="form-control" type="time" name="jselesai" id="jselesai"  required value="" min="" max="<?=$lab['jam_akhir']?>">
                                        <div class="invalid-feedback"></div>
                                    </div>
                                    <div class="col text-muted mt-1 mb-3" style="font-size: 12px;">
                                        Waktu pelayanan dari <?=$lab['nama_lab']?> dimulai dari jam <?=$lab['jam_awal']?> s/d <?=$lab['jam_akhir']?>
                                    </div>
                                </div>
                                <div id="jenis-kelas"></div>
                                <div class="col">
                                    <div class="mb-2">
                                        <label class="form-label">Software / Alat yang dibutuhkan</label>
                                        <textarea class="form-control" name="kebutuhan" id="kebutuhan" rows="3"></textarea>
                                    </div>
                                </div>
                                <p class="text-muted" id="modal-event-note" style="font-size: 10px;"></p>
                                <div class="row mt-2">
                                    <div class="col-6">
                                        <button type="button" class="btn btn-danger" id="btn-delete-event">Hapus</button>
                                    </div>
                                    <div class="col-6 text-end">
                                        <button type="button" class="btn btn-light me-1" data-bs-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-success" id="btn-save-event">Simpan</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div> <!-- end modal-content-->
                </div> <!-- end modal dialog-->
            </div>
        <!-- end modal-->

        <div class="modal fade" id="modal-detail" tabindex="-1">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header py-3 px-4 border-bottom-0">
                        <h5 class="modal-title" id="modal-title-flex">Detail Kegiatan</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
                    </div>
                    <div class="modal-body p-4" id="modal-body-detail">
                        <div class="col-8">
                            <div class="mb-3">
                                <strong>Nama Kegiatan</strong>
                                <p id="detail-kegiatan"></p>
                            </div>
                        </div>
                        <div class="col-8">
                            <div class="mb-3">
                                <strong>Kategori</strong>
                                <p id="detail-kategori"></p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <div class="mb-3">
                                    <strong>Tanggal</strong>
                                    <p id="detail-tanggal"></p>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="mb-3">
                                    <strong>Jam</strong>
                                    <p id="detail-jam"></p>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <div class="mb-3">
                                    <strong>Nama Mata Kuliah</strong>
                                    <p id="detail-mk"></p>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="mb-3">
                                    <strong>Kelas</strong>
                                    <p id="detail-kelas"></p>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="mb-3">
                                    <strong>SKS</strong>
                                    <p id="detail-sks"></p>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="mb-3">
                                    <strong>Jumlah Mahasiswa</strong>
                                    <p id="detail-jumlahmhs"></p>
                                </div>
                            </div>
                        </div>
                        <div class="col-8">
                            <div class="mb-3">
                                <strong>Status</strong>
                                <p id="detail-status"></p>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer" id="modal-footer-detail">
                        <button type="button" class="btn btn-light me-1" data-bs-dismiss="modal">Close</button>
                    </div>
                </div> <!-- end modal-content-->
            </div> <!-- end modal dialog-->
        </div>

        <div class="modal fade" id="modal-confirm-hapus" tabindex="-1">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header py-3 px-4 border-bottom-0">
                        <h5 class="modal-title">Hapus Kegiatan</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
                    </div>
                    <div class="modal-body p-4">
                        <p>Anda yakin ingin menghapus kegiatan ini?</p>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-danger" id="btn-confirm-delete">Hapus</button>
                    </div>
                </div> <!-- end modal-content-->
            </div> <!-- end modal dialog-->
        </div>

        <div class="modal fade" id="modal-flex" tabindex="-1">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header py-3 px-4 border-bottom-0">
                        <h5 class="modal-title" id="modal-title-flex"></h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
                    </div>
                    <div class="modal-body p-4" id="modal-body-flex">
                    </div>
                    <div class="modal-footer" id="modal-footer-flex">
                    </div>
                </div> <!-- end modal-content-->
            </div> <!-- end modal dialog-->
        </div>


        </div>
        <!-- container-fluid -->
    </div>