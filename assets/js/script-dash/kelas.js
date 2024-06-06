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

function inputKelas(){
    var action = 'input_kelas';
    $("#myModal").modal("show");
    load_select_dosen();
    document.getElementById("myModalLabel").innerHTML = "Tambah Kelas";
    document.getElementById("modal-body").innerHTML = `
        <form class="needs-validation" method="post" name="event-form" id="form-event" action="`+action+`" novalidate>
            <div class="col-md-8">
                <div class="mb-3">
                    <label class="form-label" for="mk">Nama Mata Kuliah</label>
                    <input class="form-control" type="text" name="mk" id="mk" required value="">
                    </select>
                </div>
            </div>

            <div class="col-md-8">
                <div class="mb-3">
                    <label class="form-label" for="dosen">Dosen</label>
                    <select class="form-control custom-select" name="dosen" id="dosen" required></select>
                </div>
            </div>

            <div class="row">
                <div class="col-4">
                    <div class="mb-3">
                        <label for="kodemk" class="form-label">Kode Mata Kuliah</label>
                        <input class="form-control" type="text" name="kodemk" id="kodemk"  required value="">
                    </div>
                </div>
                <div class="col-4">
                    <div class="mb-3">
                        <label class="form-label" for="kelas">Kelas</label>
                        <select class="form-control custom-select" name="kelas" id="kelas" required>
                        	<option selected value=""> Pilih Kelas </option>
                        	<option value="R">R</option>
                        	<option value="RA">RA</option>
                        	<option value="RB">RB</option>
                        	<option value="RC">RC</option>
                        	<option value="RD">RD</option>
                        </select>
                    </div>
                </div>
                <div class="col-4">
                    <div class="mb-3">
                        <label class="form-label" for="sks">SKS</label>
                        <input type="number" class="form-control" id="sks" name="sks" placeholder="" required>
                    </div>
                </div>
            </div>

            <div class="row mt-2">
		       	<div class="col-6" id="button-status">
		        </div>
		        <div class="col-6 text-end">
                	<button class="btn btn-primary" type="submit">Submit</button>
            	</div>
            </div>
        </form>
    `;
    document.getElementById('button-status').innerHTML = ``;
    validation();
}

function ubahKelas(a){
	inputKelas();
	validation();
	var idKP = a.getAttribute('data-id');
	var link = 'ubahStatusKelas/'+idKP;
	document.getElementById('button-status').innerHTML = `<a class="btn btn-secondary" href="`+link+`">Ubah Status</a>`;
    $.ajax({
        url:"ajaxLoadKPByID/"+idKP,
        dataType:"JSON",
        success: function(data){
            $("#myModal").modal("show")
            console.log(data)
            document.getElementById("dosen").value = data['id_dosen'];
            document.getElementById("mk").value = data['nama_mk'];
            document.getElementById("kodemk").value = data['kode_mk'];
            document.getElementById("kelas").value = data['kelas'];
            document.getElementById("sks").value = data['sks'];
            $('#form-event').attr('action', `ubah_kelas/`+idKP);
        }
    })
}

function hapusKelas(a){
    var id_kelas = a.getAttribute('data-id');
    var nama_kelas = a.getAttribute('data-name');
    var link = 'hapus_kelas/'+id_kelas;

    $("#myModal").modal("show");
    
    document.getElementById("myModalLabel").innerHTML = "Hapus Data Kelas";
    document.getElementById("modal-body").innerHTML = `
        <p>Anda yakin ingin menghapus data `+nama_kelas+`? </p>
        <div class="col text-end mt-3">
            <a class="btn btn-danger" href="`+link+`">Hapus</button>
        </div>`;
}

function load_select_dosen(){
	$.ajax({
        url:"ajaxLoadDosen",
        dataType:"JSON",
        success: function(data){
            document.getElementById("dosen").innerHTML = `<option selected value=""> Pilih Dosen </option>`;
            for (var i = 0; i < data.length; i++) {
                document.getElementById("dosen").innerHTML += `<option value="`+data[i].id_user+`">`+data[i].nama+`</option>`;
            }
        }
    });
}