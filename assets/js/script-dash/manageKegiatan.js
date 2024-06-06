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

function detailKegiatan(a){
	var id = a.getAttribute('data-id');
    $("#myModal").modal("show");

    document.getElementById('myModalLabel').innerHTML = `Detail Kegiatan`;
	document.getElementById('modal-body').innerHTML = `
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
	<strong>Kebutuhan</strong>
	<p id="detail-kebutuhan"></p>
	</div>
	</div>
	<div class="col-8">
	<div class="mb-3">
	<strong>Status</strong>
	<p id="detail-status"></p>
	</div>
	</div>
	</div>
	`;
	getKegiatan(id);
}

function modalHapusKegiatan(a){
	var id_jadwal = a.getAttribute('data-id-jadwal');
	var id_kp = a.getAttribute('data-id-kp');
	var nama = a.getAttribute('data-name');

	$("#myModal").modal("show");

	document.getElementById("myModalLabel").innerHTML = "Hapus Data Kegiatan";
    document.getElementById("modal-body").innerHTML = `<p>Anda yakin ingin menghapus kegiatan `+nama+`? </p>`;
    document.getElementById('modal-footer').innerHTML = `<button type="button" class="btn btn-danger me-1" onclick="hapusKegiatan(`+id_jadwal+`,`+id_kp+`)">Hapus</button>`;
}

function getKegiatan(id){
	$.ajax({
        url:'ajaxLoadJadwalByID/'+id,
        dataType:"JSON",
        success: function(data){
            console.log(data)
            document.getElementById("detail-kegiatan").innerHTML = data['title'];
            document.getElementById("detail-kategori").innerHTML = convertCategory(data['kategori']);
            document.getElementById("detail-tanggal").innerHTML = data['tanggal'];
            document.getElementById("detail-jam").innerHTML = data['start']+' - '+data['end'];
            document.getElementById("detail-mk").innerHTML = data['nama_mk'];
            document.getElementById("detail-kelas").innerHTML = data['kelas'];
            document.getElementById("detail-sks").innerHTML = data['sks'];
            document.getElementById("detail-jumlahmhs").innerHTML = data['jumlah_mhs'];
            document.getElementById("detail-status").innerHTML = convertStatus(data['is_active']);
            document.getElementById("detail-kebutuhan").innerHTML = data['kebutuhan'];
            console.log(convertStatus(data['is_active']));
            console.log(data['is_active']);
            if (data['is_active'] != 1) {
            	document.getElementById('modal-footer').innerHTML = `
            		<div class="col-6 text-end">
                        <button type="button" class="btn btn-danger me-1" data-id="`+id+`" data-verif="2" onclick="verifikasi(this)">Tolak</button>
                        <button type="button" class="btn btn-success" data-id="`+id+`" data-verif="1" onclick="verifikasi(this)">Verifikasi</button>
                    </div>
            	`;
            }else{
            	document.getElementById('modal-footer').innerHTML = ``;
            }
        }
    })
}

function hapusKegiatan(id_jadwal,id_kp){
	$.ajax({
        url:"ajaxHapusJadwal",
        method: 'POST',
        data: {
            id_jadwal: id_jadwal,
            id_kp: id_kp
        },
    });
    location.reload();
}

function convertCategory(value){
	if (value == 1) {
		return 'Prodi IF';
	}else if( value == 2){
		return 'Luar Prodi';
	}else{
		return 'Lainnya';
	}
}

function convertStatus(value){
	if (value == 1) {
		return 'Aktif';
	}else if( value == 2){
		return 'Ditolak';
	}else{
		return 'Diajukan';
	}

}

function verifikasi(a){
	var id = a.getAttribute('data-id');
	var verif = a.getAttribute('data-verif');

	$.ajax({
        url:'verif_jadwal',
        dataType:"JSON",
        method: 'POST',
        data: {
            id_jadwal: id,
            status: verif
        },
    })
    location.reload();
}