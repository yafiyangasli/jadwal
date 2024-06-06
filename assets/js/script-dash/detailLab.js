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

function tambahFotoLab(a){
	var idLab = a.getAttribute('data-id');
	var action = 'ubah_foto_laboratorium/'+idLab+'/tambah';
	var formFoto = '';

	$("#myModal").modal("show");
	document.getElementById("myModalLabel").innerHTML = "Tambah Foto Lab";
	validation();

	formFoto = `<form class="needs-validation" name="event-form" method="post" id="form-event" action="`+action+`" enctype="multipart/form-data" novalidate>`
	formFoto += `<div class="col" id="input-file">
                       	<label class="form-label">Foto Lab</label>
                        <input name="file[]" id="file" type="file" class="form-control" multiple="multiple" accept="image/*">
                     </div>`;
    formFoto += `
		<div class="col text-end mt-3">
            <button class="btn btn-success" type="submit">Simpan</button>
        </div>
	</form>`
	document.getElementById('modal-body').innerHTML = formFoto;
}

function ubahFotoLab(a){
	var idLab = a.getAttribute('data-id');
	var add = a.getAttribute('data-name');
	var action = 'ubah_foto_laboratorium/'+idLab+'/ubah';
	var formFoto = '';

	$("#myModal").modal("show");
	document.getElementById("myModalLabel").innerHTML = "Ubah Foto Lab";
	validation();
	
	formFoto = `<form class="needs-validation" name="event-form" method="post" id="form-event" action="`+action+`" enctype="multipart/form-data" novalidate>`
	
	formFoto = `<form class="needs-validation" name="event-form" method="post" id="form-event" action="`+action+`" enctype="multipart/form-data" novalidate>`
	formFoto += `<div class="col" id="input-file">
                       	<label class="form-label">Foto Lab</label>
                        <input name="file" id="file" type="file" class="form-control" accept="image/*">
                     </div>`;
    formFoto += `
		<div class="col text-end mt-3">
            <button class="btn btn-success" name="gambar" type="submit" value="`+add+`">Simpan</button>
        </div>
	</form>`
	document.getElementById('modal-body').innerHTML = formFoto;
}

function hapusFotoLab(a){
	var idLab = a.getAttribute('data-id');
	var add = a.getAttribute('data-name');
	var action = 'ubah_foto_laboratorium/'+idLab+'/hapus';
	var formFoto = '';

	$("#myModal").modal("show");
	document.getElementById("myModalLabel").innerHTML = "Ubah Foto Lab";
	validation();

	formFoto = `<form class="needs-validation" name="event-form" method="post" id="form-event" action="`+action+`" enctype="multipart/form-data" novalidate>`
	formFoto += `<p>Anda yakin ingin menghapus data foto ini? </p>`;
    formFoto += `
		<div class="col text-end mt-3">
            <button class="btn btn-danger" name="gambar" type="submit" value="`+add+`">Hapus</button>
        </div>
	</form>`
	document.getElementById('modal-body').innerHTML = formFoto;
}

