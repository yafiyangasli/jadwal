function validation(){
	var forms = document.getElementsByClassName('needs-validation');
	        // Loop over them and prevent submission
	var validation = Array.prototype.filter.call(forms, function(form) {
	form.addEventListener('submit', function(event) {
		if (form.checkValidity() === false) {
	        event.preventDefault();
	        event.stopPropagation();
	   	}
	    form.classList.add('was-validated');
	    }, false);
	});
}

function inputLab(){
	var action = 'input_lab';
    $("#myModal").modal("show");
    document.getElementById("myModalLabel").innerHTML = "Data Ruangan";
    document.getElementById("modal-body").innerHTML = `
            <form class="needs-validation" name="event-form" method="post" id="form-event" action="`+action+`" enctype="multipart/form-data" novalidate>
                            <div class="col-md-8">
                                <div class="mb-3">
                                    <label class="form-label" for="lab">ID Ruangan</label>
                                    <input type="text" class="form-control" id="id_lab" name="id_lab" placeholder="" value="" required>
                                    <div class="invalid-feedback">
                                        Masukkan nama ID ruangan!
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-8">
                                <div class="mb-3">
                                    <label class="form-label" for="lab">Ruangan Lab</label>
                                    <input type="text" class="form-control" id="lab" name="lab" placeholder="" value="" required>
                                    <div class="invalid-feedback">
                                        Masukkan nama ruangan laboratorium!
                                    </div>
                                </div>
                            </div>
                            <!-- end col -->
                            <div class="col-md-8">
                                <div class="mb-3">
                                    <label class="form-label" for="gedung">Gedung</label>
                                    <select class="form-control custom-select" name="gedung"
                                    id="gedung" required>
                                    <option selected value=""> Pilih Gedung </option>
                                    <option value="GLT 1">GLT 1</option>
                                    <option value="GLT 2">GLT 2</option>
                                    <option value="GLT 3">GLT 3</option>
                                    </select>
                                    <div class="invalid-feedback">
                                        Masukkan gedung!
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-8">
                                <div class="mb-3">
                                    <label class="form-label" for="jenis">Jenis Laboratorium</label>
                                    <select class="form-control custom-select" name="jenis"
                                    id="jenis" required>
                                    <option selected value=""> Pilih Jenis Laboratorium </option>
                                    <option value="Pemrogramman & Basis Data">Pemrogramman & Basis Data</option>
                                    <option value="IOT dan Jaringan Komputer">IOT dan Jaringan Komputer</option>
                                </select>
                                <div class="invalid-feedback">
                                    Masukkan jenis laboratorium!
                                </div>
                            </div>
                            </div>

                            <label class="form-label">Waktu Layanan</label>
                            <div class="row">
                                <div class="col-6">
                                    <div class="mb-3">
                                        <p class="text-muted mb-1">Jam awal.</p>
                                        <input type="time" class="form-control" id="jam1" name="jam1" placeholder="" required>
                                        <div class="invalid-feedback">Masukkan jam awal!</div>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="mb-3">
                                        <p class="text-muted mb-1">Jam akhir.</p>
                                        <input type="time" class="form-control" id="jam2" name="jam2" placeholder="" required>
                                        <div class="invalid-feedback">
                                            Masukkan jam akhir!
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-4">
                                    <div class="mb-3">
                                        <label for="ukuran" class="form-label">Ukuran Ruangan</label>
                                        <input class="form-control" type="text" name="ukuran" id="ukuran"  required value="">
                                        <div class="invalid-feedback">Masukkan ukuran ruangan!</div>
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="mb-3">
                                        <label class="form-label" for="peserta">Jumlah Peserta</label>
                                        <input class="form-control" type="number" name="peserta" id="peserta"  required value="">
                                        <div class="invalid-feedback">
                                            Masukkan jumlah peserta!
                                        </div>
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="mb-3">
                                        <label class="form-label" for="pc">Jumlah PC</label>
                                        <input type="number" class="form-control" id="pc" name="pc" placeholder="" required>
                                        <div class="invalid-feedback">
                                            Masukkan jumlah PC!
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col">
                                <div class="mb-3">
                                    <label class="form-label">Software yang tersedia</label>
                                    <textarea class="form-control" name="software" id="software" rows="3" placeholder="" required></textarea>
                                    <div class="invalid-feedback">
                                        Masukkan software yang tersedia!
                                    </div>
                                </div>
                            </div>

                            <div class="col">
                                <div class="mb-3">
                                    <label class="form-label">Hardware yang tersedia</label>
                                    <textarea class="form-control" name="hardware" id="hardware" rows="3" placeholder="" required></textarea>
                                    <div class="invalid-feedback">
                                        Masukkan hardware yang tersedia!
                                    </div>
                                </div>
                            </div>

                            <div class="col" id="input-file">
                                <label class="form-label">Foto Lab</label>
                                <input name="file[]" id="file" type="file" class="form-control" multiple="multiple" accept="image/*">
                            </div>
                            <div class="col text-end mt-3">
                                <button class="btn btn-primary" type="submit">Simpan</button>
                            </div>
                        </form>`;
    validation();
}

function editLab(idLab){
    inputLab();
	validation();
    $.ajax({
        url:"ajaxLoadLabByID/"+idLab,
        dataType:"JSON",
        success: function(data){
            $("#myModal").modal("show")
            console.log(data)
            document.getElementById("id_lab").value = data['id_lab'];
            document.getElementById("lab").value = data['nama_lab'];
            document.getElementById("gedung").value = data['gedung'];
            document.getElementById("jenis").value = data['jenis'];
            document.getElementById("jam1").value = data['jam_awal'];
            document.getElementById("jam2").value = data['jam_akhir'];
            document.getElementById("ukuran").value = data['ukuran'];
            document.getElementById("peserta").value = data['peserta'];
            document.getElementById("pc").value = data['pc'];
            document.getElementById("software").value = data['software'];
            document.getElementById("hardware").value = data['spek_pc'];
            document.getElementById("input-file").innerHTML = '';
            $('#form-event').attr('action', `edit_lab/`+idLab);
            console.log(data['foto_lab'].split(','));
        }
    })
}

function hapusLab(a){
    var id_lab = a.getAttribute('data-id');
    var nama_lab = a.getAttribute('data-name');
    var link = 'hapus_laboratorium/'+id_lab;

    $("#myModal").modal("show");
    
    document.getElementById("myModalLabel").innerHTML = "Hapus Data Laboratorium";
    document.getElementById("modal-body").innerHTML = `
        <p>Anda yakin ingin menghapus data `+nama_lab+`? </p>
        <div class="col text-end mt-3">
            <a class="btn btn-danger" href="`+link+`">Hapus</button>
        </div>`;
}