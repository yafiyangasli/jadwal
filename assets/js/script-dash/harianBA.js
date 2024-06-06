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

function inputHarian(){
	var action = 'input_harianBA';
    $("#myModal").modal("show");
    load_lab_select();
	document.getElementById("myModalLabel").innerHTML = "Laporan Penggunaan";
    document.getElementById("modal-body").innerHTML = `
    <form class="needs-validation" name="event-form" method="post" id="form-event" action="`+action+`" enctype="multipart/form-data" novalidate>
                        <div class="col-md-8">
                            <div class="mb-3">
                                <label class="form-label" for="lab">Laboratorium</label>
                                <select class="form-control custom-select" name="lab"
                                id="lab" required onchange="load_kegiatan_select()"></select>
                            	<div class="invalid-feedback">Masukkan laboratorium!</div>
                        	</div>
                    	</div>
                        <div class="col-md-8">
                            <div class="mb-3">
                                <label class="form-label" for="namakegiatan">Nama Kegiatan</label>
                                <select class="form-control custom-select" name="namakegiatan"
                                id="namakegiatan" required disabled></select>
                                <div class="invalid-feedback">
                                    Masukkan nama kegiatan!
                                </div>
                            </div>
                        </div>
                    <div class="row">
                        <div class="col-6">
                            <div class="mb-3">
                                <label for="tanggal" class="form-label">Tanggal</label>
                                <input class="form-control" type="date" name="tanggal" id="tanggal"  required value="">
                                <div class="invalid-feedback">Masukkan tanggal dengan benar!</div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="mb-3">
                                <label class="form-label" for="jam">Jam</label>
                                <input type="time" class="form-control" id="jam" name="jam" placeholder="" required>
                                <div class="invalid-feedback">
                                    Masukkan jam!
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="mb-3">
                            <label class="form-label">Deskripsi Keluhan & Masukkan</label>
                            <textarea class="form-control" name="deskripsi" id="deskripsi" rows="3" placeholder="(Apabila tidak terdapat keluhan dapat menginputkan deskripsi kegiatan yang berjalan.)" required></textarea>
                            <div class="invalid-feedback">
                                Masukkan deskripsi!
                            </div>
                        </div>
                    </div>
                    <div class="col" id="input-file">
                        <label class="form-label">Lampiran</label>
                        <input name="file[]" id="file" type="file" class="form-control" multiple="multiple" accept="image/*, application/pdf">
                    	<div>*pdf or image file</div>
                    </div>
                    <div class="col text-end mt-3">
                        <button class="btn btn-primary" type="submit">Submit BAP</button>
                    </div>
                </form>`;
    validation();
}

function hapusHarian(a){
	var id_bah = a.getAttribute('data-id');
    var link = 'hapus_harianBA/'+id_bah;

    $("#myModal").modal("show");
    
    document.getElementById("myModalLabel").innerHTML = "Hapus Data Kegiatan Harian";
    document.getElementById("modal-body").innerHTML = `
        <p>Anda yakin ingin menghapus kegiatan ini? </p>
        <div class="col text-end mt-3">
            <a class="btn btn-danger" href="`+link+`">Hapus</button>
        </div>`;
}

function load_lab_select(){
	$.ajax({
        url:"ajaxLoadLab",
        dataType:"JSON",
        success: function(data){
            document.getElementById("lab").innerHTML = `<option selected value=""> Pilih Laboratorium </option>`;
            for (var i = 0; i < data.length; i++) {
            	document.getElementById("lab").innerHTML += `<option value="`+data[i].nama_lab+`">`+data[i].nama_lab+`</option>`;
            }
        }
    })
}

function load_kegiatan_select(){
    document.getElementById('namakegiatan').removeAttribute("disabled");
    var lab = document.getElementById('lab').value;

    if (lab != '') {
    	$.ajax({
            url:"ajaxLoadKP",
            dataType:"JSON",
            success: function(data){
            	console.log(data);
                document.getElementById("namakegiatan").innerHTML = `<option selected value=""> Pilih Kegiatan </option>`;
                for (var i = 0; i < data.length; i++) {
                	document.getElementById("namakegiatan").innerHTML += `<option value="`+data[i].nama_mk+`">`+data[i].nama_mk+` - `+data[i].kelas+`</option>`;
                }
                document.getElementById("namakegiatan").innerHTML += `<option value="Lainnya">Lainnya</option>`;
            }
        })  
    }
}

function testAjax(){
    $.ajax({
        url:"ajaxLoadJadwal/Lab Prodi 1",
        dataType:"JSON",
        success: function(data){
            console.log(data);
        }
    })
}