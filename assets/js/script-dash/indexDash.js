document.addEventListener('DOMContentLoaded', function(a) {
    console.log(user_role);
    if (user_role == 1) {
        $.ajax({
            url:"dashboard/ajaxLoadDashAdmin",
            dataType:"JSON",
            success: function(data){
                console.log(data.jadwal)
                //box atas 1
                document.getElementsByClassName('mini-stat-icon')[0].innerHTML = '<i class="mdi mdi-calendar-alert float-end" id="icon"></i>';
                document.getElementsByClassName('text-uppercase')[0].innerHTML = 'Pengajuan Kegiatan';
                document.getElementsByClassName('inner-text')[0].innerHTML = data.jadwal.length;
                //box atas 2
                document.getElementsByClassName('mini-stat-icon')[1].innerHTML = '<i class="mdi mdi-file-alert-outline float-end" id="icon"></i>';
                document.getElementsByClassName('text-uppercase')[1].innerHTML = 'Pengajuan BAP Asprak';
                document.getElementsByClassName('inner-text')[1].innerHTML = data.ba_asprak.length;

                document.getElementById('inbox-title').innerHTML = 'Berita Acara Penggunaan Harian';
                document.getElementsByClassName('inbox-wid')[0].innerHTML = ``;
                console.log(data.ba_harian.length)
                for (var i = 0; i < data.ba_harian.length; i++) {
                    var time = convertDate(data.ba_harian[i].waktu)
                    document.getElementsByClassName('inbox-wid')[0].innerHTML += `
                    <a href="http://localhost/talaby/dashboard/penggunaan_harian/detail_penggunaan_harian/`+data.ba_harian[i].id_bah+`" class="text-dark">
                    <div class="inbox-item">
                    <h6 class="inbox-item-author mb-1 font-size-16">`+data.ba_harian[i].laboratorium+`</h6>
                    <p class="inbox-item-text text-muted mb-0">`+getUserName(data.ba_harian[i].id_user)+`</p>
                    <p class="inbox-item-date text-muted">`+time+`</p>
                    </div>
                    </a>`;
                }
            }
        });
    } else if(user_role == 2){
        $.ajax({
            url:"dashboard/ajaxLoadDashDosen",
            dataType:"JSON",
            success: function(data){
                console.log(data.jadwal.is_active)

                //box atas 1
                document.getElementsByClassName('mini-stat-icon')[0].innerHTML = '<i class="mdi mdi-calendar-month-outline float-end" id="icon"></i>';
                document.getElementsByClassName('text-uppercase')[0].innerHTML = 'Kegiatan Berjalan';
                document.getElementsByClassName('inner-text')[0].innerHTML = countJadwal(data.jadwal,1);
                //box atas 2
                document.getElementsByClassName('mini-stat-icon')[1].innerHTML = '<i class="mdi mdi-calendar-question float-end" id="icon"></i>';
                document.getElementsByClassName('text-uppercase')[1].innerHTML = 'Kegiatan Diajukan';
                document.getElementsByClassName('inner-text')[1].innerHTML = countJadwal(data.jadwal,0);
                //box atas 3
                document.getElementsByClassName('mini-stat-icon')[2].innerHTML = '<i class="mdi mdi-calendar-remove float-end" id="icon"></i>';
                document.getElementsByClassName('text-uppercase')[2].innerHTML = 'Kegiatan Ditolak';
                document.getElementsByClassName('inner-text')[2].innerHTML = countJadwal(data.jadwal,2);

                document.getElementById('inbox-title').innerHTML = 'Kegiatan Terbaru';
                document.getElementsByClassName('inbox-wid')[0].innerHTML = ``;
                console.log()
                for (var i = 0; i < data.jadwal.length; i++) {
                    if (data.jadwal[i].is_active == 0) {
                        var message = 'Menunggu verifikasi laboran.';
                    } else if (data.jadwal[i].is_active == 1) {
                        var message = 'Kegiatan kamu sudah aktif!';
                    } else {
                        var message = 'Kegiatan kamu ditolak. Silahkan menginputkan kembali.';
                    }
                    document.getElementsByClassName('inbox-wid')[0].innerHTML += `
                    <div class="text-dark">
                    <div class="inbox-item">
                    <h6 class="inbox-item-author mb-1 font-size-16">`+data.jadwal[i].title+`</h6>
                    <p class="inbox-item-text text-muted mb-0">`+message+`</p>
                    </div>
                    </div>`;
                }
            }
        });
    } else if(user_role == 3){
        $.ajax({
            url:"dashboard/ajaxLoadDashAsprak",
            dataType:"JSON",
            success: function(data){
                console.log(data.ba_asprak.is_valid)

                //box atas 1
                document.getElementsByClassName('mini-stat-icon')[0].innerHTML = '<i class="mdi mdi-file-check-outline float-end" id="icon"></i>';
                document.getElementsByClassName('text-uppercase')[0].innerHTML = 'BAP Diterima';
                document.getElementsByClassName('inner-text')[0].innerHTML = countBap(data.ba_asprak,1);
                //box atas 2
                document.getElementsByClassName('mini-stat-icon')[1].innerHTML = '<i class="mdi mdi-file-clock-outline float-end" id="icon"></i>';
                document.getElementsByClassName('text-uppercase')[1].innerHTML = 'BAP Diajukan';
                document.getElementsByClassName('inner-text')[1].innerHTML = countBap(data.ba_asprak,0);
                //box atas 3
                document.getElementsByClassName('mini-stat-icon')[2].innerHTML = '<i class="mdi mdi-file-cancel-outline float-end" id="icon"></i>';
                document.getElementsByClassName('text-uppercase')[2].innerHTML = 'BAP Ditolak';
                document.getElementsByClassName('inner-text')[2].innerHTML = countBap(data.ba_asprak,2);

                document.getElementById('inbox-title').innerHTML = 'Kegiatan Terbaru';
                document.getElementsByClassName('inbox-wid')[0].innerHTML = ``;
                console.log()
                for (var i = 0; i < data.ba_asprak.length; i++) {
                    if (data.ba_asprak[i].is_valid == 0) {
                        var message = 'Menunggu verifikasi laboran.';
                    } else if (data.ba_asprak[i].is_valid == 1) {
                        var message = 'BAP kamu sudah diterima!';
                    } else {
                        var message = 'BAP kamu ditolak. Silahkan menginputkan kembali.';
                    }
                    document.getElementsByClassName('inbox-wid')[0].innerHTML += `
                    <div class="text-dark">
                    <div class="inbox-item">
                    <h6 class="inbox-item-author mb-1 font-size-16">`+data.ba_asprak[i].modul+`</h6>
                    <p class="inbox-item-text text-muted mb-0">`+message+`</p>
                    </div>
                    </div>`;
                }
            }
        });
    }

    function convertDate(a){
        const input = a;
        const splitInput = a.split(' ');
        const inputDate = new Date(input);
        const time = splitInput[1].split(':')

        const year = inputDate.getFullYear();
        const month = (inputDate.getMonth() + 1).toString().padStart(2, "0");
        const day = inputDate.getDate().toString().padStart(2, "0");

        const formattedDate = `${day}-${month}-${year}` + ' ' + time[0]+':'+time[1];
        console.log(formattedDate)
        return formattedDate;
    }

    function getUserName(id){
        let result = null;
        $.ajax({
            url: 'dashboard/ajaxGetUserName/'+id,
            dataType: 'JSON',
            async : false,
        }).done(function(response){
            result = response
        }).fail(function(error){
            console.log(error)
        })
        return result;
    }

    function countJadwal(data,kondisi){
        const arr = [];
        for (var i = 0; i < data.length; i++) {
            arr[i] = data[i].is_active
        }
        const count = arr.filter(element => {
            if (element == kondisi) {
                return true;
            }
                return false;
        }).length;

        return count;
    }

    function countBap(data,kondisi){
        const arr = [];
        for (var i = 0; i < data.length; i++) {
            arr[i] = data[i].is_valid
        }
        const count = arr.filter(element => {
            if (element == kondisi) {
                return true;
            }
                return false;
        }).length;

        return count;
    }
});