!function($) {
    "use strict";

    var CalendarPage = function() {};

    CalendarPage.prototype.init = function() {
        let url = window.location.href, getLab = url.split("="), getLab2 = getLab[1].split("%20");
        console.log(getLab2);
        var lab = '';
        for (var i = 0; i < getLab2.length; i++) {
            if (i == getLab2.length-1) {
                lab += getLab2[i];
            } else{
                lab += getLab2[i] + " ";
            }
        }
        //var lab = getLab2[0] + " " + getLab2[1] + " " + getLab2[2];  
        console.log(lab)         
        var addEvent=$("#event-modal");
        var modalTitle = $("#modal-title");
        var formEvent = $("#form-event");
        var inputHourStart = $("#jmulai");
        var selectedEvent = null;
        var newEventData = null;
        var forms = document.getElementsByClassName('needs-validation');
        var selectedEvent = null;
        var newEventData = null;
        var eventObject = null;
        var modalEventNote = document.getElementById('modal-event-note');
        var extraFeedbackJam = $('#extra-feedback');
        /* initialize the calendar */

        var date = new Date();
        var d = date.getDate();
        var m = date.getMonth();
        var y = date.getFullYear();
        var Draggable = FullCalendarInteraction.Draggable;
        var externalEventContainerEl = document.getElementById('external-events');
            // init dragable
            new Draggable(externalEventContainerEl, {
                itemSelector: '.external-event',
                eventData: function (eventEl) {
                    return {
                        title: eventEl.innerText,
                        className: $(eventEl).data('class')
                    };
                }
            });
            var defaultEvents = 'ajaxLoadJadwal/'+lab;

            var draggableEl = document.getElementById('external-events');
            var calendarEl = document.getElementById('calendar');

            function addNewEvent(info) {
                addEvent.modal('show');
                formEvent.removeClass("was-validated");
                selectedEvent = null;
                inputModalKelas();
                formEvent[0].reset();
                $("#event-title").val();
                $('#event-category').val();
                $('#event-date').val(convertDate(info.date));
                modalTitle.text('Tambah Kegiatan');
                modalEventNote.innerHTML = ``;
                newEventData = info;
            }
            
            var calendar = new FullCalendar.Calendar(calendarEl, {
                plugins: [ 'bootstrap', 'interaction', 'dayGrid', 'timeGrid'],
                locale : 'id',
                editable: true,
                droppable: true,
                selectable: true,
                defaultView: 'dayGridMonth',
                themeSystem: 'bootstrap',
                header: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'dayGridMonth,timeGridWeek,timeGridDay,listMonth'
                },
                eventClick: function(info) {
                    selectedEvent = info.event;
                    if (((selectedEvent.extendedProps.is_active == 0) || (selectedEvent.extendedProps.is_active == 2)) && (selectedEvent.extendedProps.id_user == user_id)) {
                        addEvent.modal('show');
                        formEvent[0].reset();
                        $("#event-title").val(selectedEvent.title);
                        $('#event-category').val(convertCategory('class',selectedEvent.classNames[0]));
                        $('#event-date').val(convertDate(selectedEvent.start));
                        inputModalKelas();
                        document.getElementById('jmulai').value = selectedEvent.start.toLocaleTimeString('en-US', { hour12: false });
                        document.getElementById('jselesai').value = selectedEvent.end.toLocaleTimeString('en-US', { hour12: false });
                        $('#rentang').val(selectedEvent.extendedProps.rentang);
                        $('#kebutuhan').val(selectedEvent.extendedProps.kebutuhan);
                        $('#jumlahMHS').val(selectedEvent.extendedProps.jumlah_mhs);
                        if (selectedEvent.classNames[0] == 'bg-info' || selectedEvent.classNames[0] == 'bg-success') {
                            var dataKP = getKP(selectedEvent.extendedProps.id_kp);
                            if (selectedEvent.classNames[0] == 'bg-success') {
                                $('#mk').val(dataKP.id_mk);
                                document.getElementById('mk').value = selectedEvent.extendedProps.id_kp;
                            } else {
                                $('#mk').val(dataKP.nama_mk);
                                $('#kodemk').val(dataKP.kode_mk);
                                $('#kelas').val(dataKP.kelas);
                                $('#sks').val(dataKP.sks);
                            }
                        }
                        checkVerif(selectedEvent.extendedProps.is_active);
                        modalEventNote.innerHTML = `<strong>Note</strong><br>Kamu dapat mengubah dan menghapus data kegiatan selama pihak laboratorium belum melakukan verifikasi.`;
                        newEventData = null;
                        modalTitle.text('Ubah Kegiatan');
                        newEventData = null;
                    } else {
                        if (selectedEvent.extendedProps.id_jadwal == null) {
                            addEvent.modal('show');
                            formEvent[0].reset();
                            $("#event-title").val(selectedEvent.title);
                            $('#event-category').val(convertCategory('class',selectedEvent.classNames[0]));
                            $('#event-date').val(convertDate(selectedEvent.start));
                            inputModalKelas();
                            modalEventNote.innerHTML = ``;
                            newEventData = null;
                            modalTitle.text('Tambah Kegiatan');
                            newEventData = null;
                        }else{
                            console.log(convertDate2(selectedEvent.start));
                            var dataKP = getKP(selectedEvent.extendedProps.id_kp);
                            $("#modal-detail").modal('show');
                            document.getElementById('detail-kegiatan').innerHTML = selectedEvent.title;
                            document.getElementById('detail-kategori').innerHTML = convertCategory('text',selectedEvent.classNames[0]);
                            document.getElementById('detail-tanggal').innerHTML = convertDate2(selectedEvent.start);
                            document.getElementById('detail-jam').innerHTML = selectedEvent.start.toLocaleTimeString('en-US', { hour12: false }) +` - `+selectedEvent.end.toLocaleTimeString('en-US', { hour12: false });
                            document.getElementById('detail-mk').innerHTML = dataKP.kode_mk +` - `+ dataKP.nama_mk;
                            document.getElementById('detail-kelas').innerHTML = dataKP.kelas;
                            document.getElementById('detail-sks').innerHTML = dataKP.sks;
                            document.getElementById('detail-jumlahmhs').innerHTML = selectedEvent.extendedProps.jumlah_mhs;
                            if (selectedEvent.extendedProps.is_active == 1) {
                                document.getElementById('detail-status').innerHTML = 'Berjalan';
                            } else {
                                document.getElementById('detail-status').innerHTML = 'Diajukan';
                            }                            
                        }
                        //modalDetailJadwal(selectedEvent.extendedProps.id_kp);
                    }
                },
                dateClick: function(info) {
                    addNewEvent(info);
                },
                events : defaultEvents
            });
            calendar.render();
            /*Add new event*/
            // Form to add new event

            $(formEvent).on('submit', function(ev) {
                ev.preventDefault();
                var inputs = $('#form-event :input');
                var updatedTitle = $("#event-title").val();
                var updatedCategory =  $('#event-category').val();
                var updatedDate =  $('#event-date').val();
                var rentangWaktu = $('#rentang').val();
                var jMulaiInput =  $('#jmulai').val();
                var jSelesaiInput =  $('#jselesai').val();
                var jmlMHSInput = $('#jumlahMHS').val();
                var mkInput =  $('#mk').val();
                var kebutuhanInput = $('#kebutuhan').val();
                if (updatedCategory == 2) {
                    var kodemkInput =  $('#kodemk').val();
                    var sksInput = $('#sks').val();
                    var kelasInput = $('#kelas').val();
                }
                var newStart = new Date(updatedDate + " " + jMulaiInput);
                var newEnd = new Date(updatedDate + " " + jSelesaiInput);

                console.log(document.getElementById('jmulai').valid);
                console.log(selectedEvent);
                // validation
                if (forms[0].checkValidity() === false) { //cek validasi form input
                    event.preventDefault();
                    event.stopPropagation();
                    setErrorMessageWaktu();
                    forms[0].classList.add('was-validated');
                } else {
                    var rangeBetweenDatetime = cekInputRangeBetweenTime(updatedDate,jMulaiInput,jSelesaiInput,rentangWaktu,lab);
                    if(rangeBetweenDatetime > 0){
                        addEvent.modal('hide');
                        modalErrorDatetimeBetween();
                    }else{
                        if(selectedEvent){ //edit
                            if (selectedEvent.extendedProps.id_jadwal == null) { //tambah jadwal tapi draggable event
                                console.log(selectedEvent)
                                selectedEvent.remove();
                                selectedEvent = null;
                                var idForExProps = inputJadwal(lab);
                                var cnvrtCategory = convertCategory('value',updatedCategory);
                                console.log(idForExProps)
                                var newEvent = {
                                    title: updatedTitle,
                                    start: newStart,
                                    end: newEnd,
                                    className: cnvrtCategory,
                                    id_jadwal: idForExProps.id_jadwal,
                                    id_kp: idForExProps.id_kp,
                                    id_user: user_id,
                                    rentang: rentangWaktu,
                                    kebutuhan: kebutuhanInput,
                                    jumlah_mhs: jmlMHSInput,
                                    is_active: 0
                                }
                                calendar.addEvent(newEvent);
                                addEvent.modal('hide');
                                modalTambahKegiatan();
                            } else { //edit sesungguhnya
                                var dataUbah = ubahJadwal(selectedEvent.extendedProps.id_jadwal,selectedEvent.extendedProps.id_kp);
                                selectedEvent.setProp("title", updatedTitle);
                                selectedEvent.setProp("classNames", [convertCategory('value',updatedCategory)]);
                                selectedEvent.setStart(newStart);
                                selectedEvent.setEnd(newEnd);
                                selectedEvent.setExtendedProp("rentang", rentangWaktu);
                                selectedEvent.setExtendedProp("kebutuhan", kebutuhanInput);
                                selectedEvent.setExtendedProp("jumlahMHS", jmlMHSInput);
                            }
                            console.log(selectedEvent)
                            addEvent.modal('hide');
                        } else { //input baru
                            var idForExProps = inputJadwal(lab);
                            var cnvrtCategory = convertCategory('value',updatedCategory);
                            var newEvent = {
                                title: updatedTitle,
                                start: newStart,
                                end: newEnd,
                                className: cnvrtCategory,
                                id_jadwal: idForExProps.id_jadwal,
                                id_kp: idForExProps.id_kp,
                                id_user: user_id,
                                rentang: rentangWaktu,
                                kebutuhan: kebutuhanInput,
                                jumlah_mhs: jmlMHSInput,
                                is_active: 0
                            }
                            calendar.addEvent(newEvent);
                            addEvent.modal('hide');
                            modalTambahKegiatan();
                        }
                    }
                }
            });

$("#btn-delete-event").on('click', function(e) {
    addEvent.modal('hide');
    $("#modal-confirm-hapus").modal("show");
    console.log(selectedEvent)
});

$("#btn-confirm-delete").on('click', function(e) {
    console.log(selectedEvent);
    if (selectedEvent) {
        hapusJadwal(selectedEvent.extendedProps.id_jadwal,selectedEvent.extendedProps.id_kp);
        selectedEvent.remove();
        selectedEvent = null;
        console.log(selectedEvent)
        $("#modal-confirm-hapus").modal('hide');
    }
});

$("#btn-new-event").on('click', function(e) {
    addNewEvent({date: new Date()});
});

},
    //init
    $.CalendarPage = new CalendarPage, $.CalendarPage.Constructor = CalendarPage
}(window.jQuery),

//initializing 
function($) {
    "use strict";
    $.CalendarPage.init()
}(window.jQuery);

function modalTambahKegiatan(){
    $("#modal-flex").modal('show');
    document.getElementById('modal-title-flex').innerHTML = `Tambah Kegiatan`;
    document.getElementById('modal-body-flex').innerHTML = `<p>Kegiatan berhasil ditambahkan!<br>Silahkan tunggu verifikasi dari pihak laboratorium.</p>`;
    document.getElementById('modal-footer-flex').innerHTML = `<button type="button" class="btn btn-light me-1" data-bs-dismiss="modal">Close</button>`;
}

function modalDetailJadwal(id_kp){
    var dataKP = getKP(id_kp);
    console.log(dataKP)
    $("#modal-flex").modal('show');
    document.getElementById('modal-title-flex').innerHTML = `Detail Kegiatan`;
    document.getElementById('modal-body-flex').innerHTML = '';
    document.getElementById('modal-footer-flex').innerHTML = `<button type="button" class="btn btn-light me-1" data-bs-dismiss="modal">Close</button>`;
}

function modalErrorDatetimeBetween(){
    $("#modal-flex").modal('show');
    document.getElementById('modal-title-flex').innerHTML = `Tambah Kegiatan`;
    document.getElementById('modal-body-flex').innerHTML = `<p>Terdapat kegiatan yang berjalan dengan waktu yang didaftarkan.<br>Silahkan melakukan pendaftaran jadwal kembali.</p>`;
    document.getElementById('modal-footer-flex').innerHTML = `<button type="button" class="btn btn-light me-1" data-bs-dismiss="modal">Close</button>`;
}

function inputModalKelas(){
    var valueKategori = document.getElementById('event-category').value;
    console.log(valueKategori);
    if (valueKategori == 1) {
        selectMK();
        document.getElementById('jenis-kelas').innerHTML =`
        <div class="col-8">
        <div class="mb-3">
        <label class="form-label">Mata Kuliah</label>
        <select class="form-control custom-select" name="mk" id="mk" required>  
        </select>
        </div>
        </div>
        `;
    } else if (valueKategori == 2){
        document.getElementById('jenis-kelas').innerHTML = `
        <div class="col-8">
        <div class="mb-3">
        <label class="form-label">Nama MK</label>
        <input class="form-control" placeholder=""
        type="text" name="mk" id="mk" required value="" />
        </div>
        </div>
        <div class="row">
        <div class="col-4">
        <div class="mb-3">
        <label class="form-label">SKS</label>
        <input class="form-control" type="number" name="sks" id="sks" required value=""/>
        </div>
        </div>
        <div class="col-4">
        <div class="mb-3">
        <label class="form-label">Kelas</label>
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
        <label class="form-label">Kode MK</label>
        <input class="form-control" placeholder=""
        type="text" name="kodemk" id="kodemk" required value="" />
        </div>
        </div>
        </div>
        `;
    }else{
        document.getElementById('jenis-kelas').innerHTML = ``;
    }
}

function selectMK(){
    $.ajax({
        url:"ajaxLoadKP",
        dataType:"JSON",
        success: function(data){
            document.getElementById('mk').innerHTML = `<option selected value=""> Pilih Mata Kuliah </option>`;
            for (var i = 0; i < data.length; i++) {
                document.getElementById('mk').innerHTML += `<option value="`+data[i].id_kp+`">`+data[i].kode_mk+` - `+data[i].nama_mk+` - `+data[i].kelas+`</option>`;
            }
        }
    });
}

function getKP(id){
    let result = null;
    $.ajax({
        url:"ajaxLoadKPByID/"+id,
        dataType:"JSON",
        async : false,
    }).done(function(response){
            result = response
    }).fail(function(error){
            console.log(error)
    });
    return result;
}

function inputJadwal(lab){
    console.log(lab)
    let result = null;
    if (document.getElementById('event-category').value == 1) {
        var a = {
            lab: lab,
            id_kp: document.getElementById('mk').value,
            title: document.getElementById('event-title').value,
            start: document.getElementById('event-date').value + " " + document.getElementById('jmulai').value,
            end: document.getElementById('event-date').value + " " + document.getElementById('jselesai').value,
            rentang_waktu: document.getElementById('rentang').value,
            kategori: document.getElementById('event-category').value,
            jumlah_mhs: document.getElementById('jumlahMHS').value,
            kebutuhan: document.getElementById('kebutuhan').value}; 
    }else if (document.getElementById('event-category').value == 2){
        var a = {
            lab: lab,
            title: document.getElementById('event-title').value,
            start: document.getElementById('event-date').value + " " + document.getElementById('jmulai').value,
            end: document.getElementById('event-date').value + " " + document.getElementById('jselesai').value,
            rentang_waktu: document.getElementById('rentang').value,
            kategori: document.getElementById('event-category').value,
            jumlah_mhs: document.getElementById('jumlahMHS').value,
            kebutuhan: document.getElementById('kebutuhan').value,
            nama_mk: document.getElementById('mk').value,
            kode_mk: document.getElementById('kodemk').value,
            sks: document.getElementById('sks').value,
            kelas: document.getElementById('kelas').value};
            
    }else{
        var a = {
            lab: lab,
            title: document.getElementById('event-title').value,
            start: document.getElementById('event-date').value + " " + document.getElementById('jmulai').value,
            end: document.getElementById('event-date').value + " " + document.getElementById('jselesai').value,
            rentang_waktu: document.getElementById('rentang').value,
            kategori: document.getElementById('event-category').value,
            jumlah_mhs: document.getElementById('jumlahMHS').value,
            kebutuhan: document.getElementById('kebutuhan').value};
    }
    $.ajax({
        url: 'ajaxInputJadwal',
        method: 'POST',
        dataType: 'JSON',
        data: a,
        async : false,
    }).done(function(response){
            result = response
    }).fail(function(error){
            console.log(error)
    });
    return result;
}

function cekInputRangeBetweenTime(tanggal,start,end,rentang,lab){
    let result = null;
    $.ajax({
        url: 'ajaxCekInputDatetimeBetween',
        method: 'POST',
        dataType: 'JSON',
        data: {
            tanggal: tanggal,
            start: start,
            end: end,
            rentang: rentang,
            lab: lab
        },
        async : false,
    }).done(function(response){
            result = response
    }).fail(function(error){
            console.log(error)
    });
    return result;
}

function ubahJadwal(id_jadwal,id_kp){
    let result = null;

    if (document.getElementById('event-category').value == 1 || document.getElementById('event-category').value == 3) {
        var a = {
            id_jadwal: id_jadwal,
            id_kp: id_kp,
            title: document.getElementById('event-title').value,
            start: document.getElementById('event-date').value + " " + document.getElementById('jmulai').value,
            end: document.getElementById('event-date').value + " " + document.getElementById('jselesai').value,
            rentang_waktu: document.getElementById('rentang').value,
            kategori: document.getElementById('event-category').value,
            jumlah_mhs: document.getElementById('jumlahMHS').value,
            kebutuhan: document.getElementById('kebutuhan').value}; 
    }else if (document.getElementById('event-category').value == 2){
        var a = {
            id_jadwal: id_jadwal,
            id_kp: id_kp,
            title: document.getElementById('event-title').value,
            start: document.getElementById('event-date').value + " " + document.getElementById('jmulai').value,
            end: document.getElementById('event-date').value + " " + document.getElementById('jselesai').value,
            rentang_waktu: document.getElementById('rentang').value,
            kategori: document.getElementById('event-category').value,
            jumlah_mhs: document.getElementById('jumlahMHS').value,
            kebutuhan: document.getElementById('kebutuhan').value,
            nama_mk: document.getElementById('mk').value,
            kode_mk: document.getElementById('kodemk').value,
            sks: document.getElementById('sks').value,
            kelas: document.getElementById('kelas').value};
            
    }
    $.ajax({
        url: 'ajaxUbahJadwal',
        method: 'POST',
        dataType: 'JSON',
        data: a,
        async : false,
    }).done(function(response){
        result = response
    }).fail(function(error){
        console.log(error)
    })
    return result;
}

function hapusJadwal(id_jadwal,id_kp){
    $.ajax({
        url:"ajaxHapusJadwal",
        method: 'POST',
        data: {
            id_jadwal: id_jadwal,
            id_kp: id_kp
        },
    });
}

function batasAwalSelesai(){
    var a = document.getElementById('jmulai').value;
    console.log(a);

    document.getElementById('jselesai').setAttribute("min", a);
}

function setErrorMessageWaktu(){
    var errorField = document.getElementsByClassName('invalid-feedback');
    if (document.getElementById('jmulai').validity.rangeOverflow || document.getElementById('jmulai').validity.rangeUnderflow) {
        errorField[0].innerHTML = `Diluar waktu pelayanan.`;
    }
    if (document.getElementById('jselesai').validity.rangeOverflow) {
        errorField[1].innerHTML = `Diluar waktu pelayanan.`;
    }
    if (document.getElementById('jselesai').validity.rangeUnderflow) {
        errorField[1].innerHTML = `Masukkan waktu dengan benar!`;
    }
}

function convertDate(a){
    const input = a;
    const inputDate = new Date(input);

    const year = inputDate.getFullYear();
    const month = (inputDate.getMonth() + 1).toString().padStart(2, "0");
    const day = inputDate.getDate().toString().padStart(2, "0");

    const formattedDate = `${year}-${month}-${day}`;
    return formattedDate;
}

function convertDate2(a){
    const input = a;
    const inputDate = new Date(input);

    const year = inputDate.getFullYear();
    const month = (inputDate.getMonth() + 1).toString().padStart(2, "0");
    const day = inputDate.getDate().toString().padStart(2, "0");

    const formattedDate = `${day}-${month}-${year}`;
    return formattedDate;
}

function convertCategory(konversi,value){
    if (konversi === 'class') {
        if (value == 'bg-success') {
            return 1;
        }else if(value == 'bg-info'){
            return 2;
        }else{
            return 3;
        }
    }else if (konversi === 'value'){
        if (value == 1) {
            return 'bg-success';
        }else if( value == 2){
            return 'bg-info';
        }else{
            return 'bg-warning';
        }
    }else{
        if (value == 'bg-success') {
            return 'Prodi IF';
        }else if(value == 'bg-info'){
            return 'Luar Prodi';
        }else{
            return 'Lainnya';
        }
    }
}

function checkVerif(stat){
    if (stat == 0) {
        console.log(stat)
    }else{
        console.log('stat')
    }
}
