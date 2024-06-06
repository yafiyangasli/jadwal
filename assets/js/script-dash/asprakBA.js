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

function inputAsprakBA(){
    var action = 'input_asprakBA';
    $("#myModal").modal("show");
    load_kelas_select();
    load_lab_select()
    document.getElementById("myModalLabel").innerHTML = "Upload BAP Asisten Praktikum";
    document.getElementById("modal-body").innerHTML = `
        <form class="needs-validation" method="post" name="event-form" id="form-event" action="`+action+`" enctype="multipart/form-data" novalidate>
            <div class="col-md-8">
                <div class="mb-3">
                    <label class="form-label" for="mk">Mata Kuliah Praktikum - Kelas</label>
                    <select class="form-control custom-select" name="mk" id="mk" required onchange="load_dosen_input()">
                    </select>
                    <div class="invalid-feedback">Masukkan mata kuliah praktikum & kelas!</div>
                </div>
            </div>

            <div class="col-md-8">
                <div class="mb-3">
                    <label class="form-label" for="dosen">Dosen PJ</label>
                    <input class="form-control" type="text" name="dosen" id="dosen" required value="" readonly>
                    <div class="invalid-feedback">
                        Masukkan dosen PJ!
                    </div>
                </div>
            </div>

            <div class="col-md-8">
                <div class="mb-3">
                    <label class="form-label" for="dosen">Judul Modul</label>
                    <input class="form-control" type="text" name="modul" id="modul" required value="">
                    <div class="invalid-feedback">
                        Masukkan judul modul!
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-4">
                    <div class="mb-3">
                        <label for="pertemuan" class="form-label">Pertemuan ke-</label>
                        <select class="form-control custom-select" name="pertemuan" id="pertemuan" required>
                        </select>
                        <div class="invalid-feedback">Masukkan pertemuan!</div>
                    </div>
                </div>
                <div class="col-4">
                    <div class="mb-3">
                        <label class="form-label" for="tanggal">Tanggal</label>
                        <input class="form-control" type="date" name="tanggal" id="tanggal"  required value="">
                        <div class="invalid-feedback">
                            Masukkan tanggal!
                        </div>
                    </div>
                </div>
                <div class="col-4">
                    <div class="mb-3">
                        <label class="form-label" for="jam">Jam</label>
                        <input type="time" class="form-control" id="jam" name="jam" placeholder="" required>
                        <div class="invalid-feedback">
                            Masukkan jam!
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-6">
                    <div class="mb-3">
                        <label for="hadir" class="form-label">Peserta Hadir</label>
                        <input class="form-control" type="number" name="hadir" id="hadir"  required value="">
                        <div class="invalid-feedback">Masukkan jumlah peserta hadir!</div>
                    </div>
                </div>
                <div class="col-6">
                    <div class="mb-3">
                        <label for="thadir" class="form-label">Peserta Tidak Hadir</label>
                        <input class="form-control" type="number" name="thadir" id="thadir"  required value="">
                        <div class="invalid-feedback">Masukkan jumlah peserta tidak hadir!</div>
                    </div>
                </div>
            </div>

            <div class="col-md-8">
                <div class="mb-3">
                    <label class="form-label" for="lab">Laboratorium</label>
                    <select class="form-control custom-select" name="lab" id="lab" required></select>
                    <div class="invalid-feedback">Masukkan laboratorium!</div>
                </div>
            </div>

            <div class="col">
                <div class="mb-3">
                    <label class="form-label">Deskripsi & Materi Praktikum</label>
                    <textarea class="form-control" name="deskripsi" id="deskripsi" rows="3" required></textarea>
                    <div class="invalid-feedback">
                        Masukkan deskripsi!
                    </div>
                </div>
            </div>

            <div class="col" id="input-file">
                <label class="form-label">Dokumentasi</label>
                <input name="file[]" id="file" type="file" class="form-control" multiple="multiple" accept="image/jpeg, image/jpg" required>
                <div>*jpg/jpeg image file only</div>
            </div>
            
            <div class="col text-end mt-3">
                <button class="btn btn-primary" type="submit">Submit form</button>
            </div>
        </form>
    `;
    validation();
}

function modalDetail(a){
    $("#myModal").modal("show");
    var id_bap = a.getAttribute('data-id');
    document.getElementById("myModalLabel").innerHTML = "Detail BAP Asisten Praktikum";
    $.ajax({
        url:"ajaxLoadBAPByID/"+id_bap,
        dataType:"JSON",
        success: function(data){
            console.log(data);
            $.ajax({
                url:"ajaxLoadKPByID/"+data.id_kp,
                dataType:"JSON",
                success: function(data2){
                    console.log(data2)
                    var dokumentasi = data.dokumentasi.split(",");
                    var linkAssets = `http://localhost/talaby/assets/images/input/dokumentasi_asprak/`;
                    document.getElementById("modal-body").innerHTML = `
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <strong>Mata Kuliah Praktikum - Kelas</strong>
                                    <p>`+data2.nama_mk+` - `+ data2.kelas+`</p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <strong>Hari, Tanggal</strong>
                                    <p>`+data.hari+`, `+data.tanggal+`</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-8">
                            <div class="mb-3">
                                <strong>Dosen PJ</strong>
                                <p>`+data.nama_dosen+`</p>
                            </div>
                        </div>

                       <div class="col-md-8">
                            <div class="mb-3">
                            <strong>Ruangan Praktikum</strong>
                            <p>`+data.lokasi_prak+`</p>
                            </div>
                        </div>

                        <div class = "row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <strong>Pertemuan & Modul</strong>
                                    <p>`+data.pertemuan+` - `+data.modul+`</p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <strong>Jam</strong>
                                    <p>`+data.jam+`</p>
                                </div>
                            </div>
                        </div>

                        <div class = "row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <strong>Peserta Hadir</strong>
                                    <p>`+data.hadir+`</p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <strong>Peserta Tidak Hadir</strong>
                                    <p>`+data.tidak_hadir+`</p>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-10">
                            <div class="mb-3">
                            <strong>Deskripsi & Materi Praktikum</strong>
                            <p>`+data.deskripsi+`</p>
                            </div>
                        </div>

                        <div class="col-md-10">
                            <div class="mb-3">
                            <strong>Catatan</strong>
                            <p>`+data.catatan+`</p>
                            </div>
                        </div>
                        <div class="col-md-8">
                            <div class="mb-3">
                                <p><strong>Dokumentasi</strong>`
                        for (var i = 0; i < dokumentasi.length -1; i++) {
                        document.getElementById("modal-body").innerHTML += 
                                `<a href="`+linkAssets+dokumentasi[i]+`"" target='`+linkAssets+dokumentasi[i]+`'>`+`Dokumentasi `+[i+1]+`</a><br>`;
                    }     
                    document.getElementById("modal-body").innerHTML +=
                            `</p>
                            </div>
                        </div>
                    `;
                    if (data.is_valid == 0 && user_role == 1) {
                        document.getElementById("modal-body").innerHTML +=`<div class="col">
                            <div class="mb-3">
                                <label class="form-label">Catatan</label>
                                <textarea class="form-control" name="catatan" id="catatan" rows="3"></textarea>
                            </div>
                        </div>`;
                        document.getElementById("modal-footer").innerHTML = `
                            <div class="col-6 text-end">
                                <button type="button" class="btn btn-danger me-1" data-id="`+id_bap+`" data-verif="2" onclick="verifikasi(this)">Tolak</button>
                                <button type="button" class="btn btn-success" data-id="`+id_bap+`" data-verif="1" onclick="verifikasi(this)">Verifikasi</button>
                            </div>
                        `;
                    }
                }
            })
        }
    })
}

function verifikasi(a){
    var catatan = document.getElementById('catatan').value;
    var id = a.getAttribute('data-id');
    var verif = a.getAttribute('data-verif');

    $.ajax({
        url:'verif_bap',
        dataType:"JSON",
        method: 'POST',
        data: {
            id_bap: id,
            status: verif,
            catatan: catatan
        },
    })
    location.reload();
}

function hapusAsprakBA(a){
    var id_bap = a.getAttribute('data-id');
    var link = 'hapus_asprakBA/'+id_bap;

    $("#myModal").modal("show");
    
    document.getElementById("myModalLabel").innerHTML = "Hapus Data BAP Asprak";
    document.getElementById("modal-body").innerHTML = `
        <p>Anda yakin ingin menghapus BAP ini? </p>
        <div class="col text-end mt-3">
            <a class="btn btn-danger" href="`+link+`">Hapus</button>
        </div>`;
}

function load_kelas_select(){
    $.ajax({
        url:"ajaxLoadKP",
        dataType:"JSON",
        success: function(data){
            document.getElementById("mk").innerHTML = `<option selected value=""> Pilih Mata Kuliah & Kelas </option>`;
            for (var i = 0; i < data.length; i++) {
                document.getElementById("mk").innerHTML += `<option value="`+data[i].id_kp+`">`+data[i].nama_mk+` - `+data[i].kelas+`</option>`;
            }
        }
    })
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


function load_dosen_input(){
    var id_mk = document.getElementById('mk').value;

    $.ajax({
        url:"ajaxLoadKPByID/"+id_mk,
        dataType:"JSON",
        success: function(data){
            $.ajax({
                url:"ajaxLoadDosenByID/"+data.id_dosen,
                dataType:"JSON",
                success: function(data2){
                    document.getElementById("dosen").value = data2.nama;
                    $.ajax({
                        url:"ajaxLoadPertemuan/"+id_mk,
                        dataType:"JSON",
                        success: function(data3){
                            const arr1 = data3.pertemuan1, arr2 = data3.pertemuan2;
                            const pertemuan = arrayDiff(arr2,arr1);
                            document.getElementById("pertemuan").innerHTML = `<option selected value=""> Pilih Pertemuan </option>`;
                            for (var i = 0; i < pertemuan.length; i++) {
                                document.getElementById("pertemuan").innerHTML += `<option value="`+pertemuan[i]+`">`+pertemuan[i]+`</option>`;
                            }
                        }
                    })
                }
            })
        }
    })
}

function arrayDiff(a, b) {
    let difference = [];
    for (let i = 0; i < a.length; i++) {
        if (b.indexOf(a[i]) === -1) {
            difference.push(a[i]);
        }
    }
    return difference;
};