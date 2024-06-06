<!-- ========== Left Sidebar Start ========== -->
<div class="vertical-menu">

    <div data-simplebar class="h-100">

        <!--- Sidemenu -->
        <div id="sidebar-menu">
            <!-- Left Menu Start -->
            <ul class="metismenu list-unstyled" id="side-menu">
                <li class="menu-title">Main</li>

                <li>
                    <a href="<?=base_url('dashboard');?>" class="waves-effect">
                        <i class="mdi mdi-view-dashboard"></i>
                        <span>Dashboard</span>
                    </a>
                </li>

                <?php if(($this->session->userdata('role_id') == 1) || ($this->session->userdata('role_id') == 2)):?>
                <li id="sub-jadwal">
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="mdi mdi-calendar-check"></i>
                        <span>Penjadwalan</span>
                    </a>
                        <ul class="sub-menu" id="jadwal" aria-expanded="false">
                        </ul>
                </li>
                <?php endif;?>

                <li id="side-ba">
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="mdi mdi-file-document-edit-outline"></i>
                        <span>Berita Acara</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <?php if(($this->session->userdata('role_id') == 1) || ($this->session->userdata('role_id') == 3)):?>
                        <li><a href="<?=base_url('dashboard/penggunaan_harian');?>">Penggunaan Harian</a></li>
                        <?php endif;?>
                        <li><a href="<?=base_url('dashboard/assisten_praktikum');?>">Assisten Praktikum</a></li>
                    </ul>
                </li>

                <?php if($this->session->userdata('role_id') == 1):?>
                <li id="side-lab">
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="mdi mdi-atom"></i>
                        <span>Master Data</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="<?=base_url('dashboard/laboratorium');?>">Laboratorium</a></li>
                        <li><a href="<?=base_url('dashboard/kelas');?>">Kelas</a></li>
                        <li><a href="<?=base_url('dashboard/manage_kegiatan');?>">Manage Kegiatan</a></li>
                        <!-- <li><a href="#">Pusat Akun</a></li> -->
                    </ul>
                </li>
                <?php endif;?>
            </ul>
        </div>
        <!-- Sidebar -->
    </div>
</div>
            <!-- Left Sidebar End -->
<?php if(($this->session->userdata('role_id') == 1) || ($this->session->userdata('role_id') == 2)):?>
<script type="text/javascript">
    document.addEventListener('DOMContentLoaded', function(a) {
    var role_id = `<?= $this->session->userdata('role_id');?>`;
    var page = `<?=$page?>`;
    if (page === 'dashboard-home') {
        var link = 'dashboard/ajaxLoadLab'
    }else{
        var link = 'ajaxLoadLab'
    }
    $.ajax({
        url:link,
        dataType:"JSON",
        success: function(data){
            console.log(window.location.href);
            for (var i = 0; i < data.length; i++) {
                document.getElementById("jadwal").innerHTML += `<li><a href="`+`<?=base_url('dashboard/penjadwalan');?>`+`?lab=`+data[i].nama_lab+`">`+data[i].nama_lab+`</a></li>`;
            }
        }
    })
});
    
</script>
<?php endif;?>
