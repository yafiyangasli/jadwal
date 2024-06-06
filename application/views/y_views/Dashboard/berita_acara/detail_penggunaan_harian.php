<div class="main-content">

    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-sm-6">
                    <div class="page-title-box">
                        <h4>Detail Penggunaan Harian</h4>
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item">Penggunaan Harian</li>
                            <li class="breadcrumb-item active">Detail</li>
                        </ol>
                    </div>
                </div>
            </div>

            <div class="col-lg">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title"><?=$ba_harian['kegiatan'];?></h4>
                        <p class="card-title-desc"><?=$ba_harian['laboratorium'];?></p>
                        <p class="card-title-desc"><strong class="text-strong">Waktu</strong><br><?=$ba_harian['waktu'];?></p>
                        <p class="card-title-desc"><strong class="text-strong">Deskripsi</strong><br><?=$ba_harian['deskripsi'];?></p>
                        <p class="card-title-desc">
                            <strong class="text-strong">Lampiran</strong><br>
                            <?php for($i = 0; $i < count($lampiran_bah) - 1; $i++):?>
                            <a href="#" onclick="modalLampiran(this)" data-lampiran="<?=$lampiran_bah[$i];?>"><?=$lampiran_bah[$i];?></a><br>
                            <?php endfor?>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>

<div id="myModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title mt-0" id="myModalLabel">Lampiran</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"aria-label="Close"></button>
            </div>
            <div class="modal-body" id="modal-body">    
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<script type="text/javascript">
    function modalLampiran(a){
        var lampiran = a.getAttribute('data-lampiran');
        $("#myModal").modal("show");
        if (lampiran.split(".")[1] === 'pdf') {
            document.getElementById('modal-body').innerHTML = `
                <iframe class="col-10 offset-1" src="<?=base_url('assets/images/input/lampiran_harian/');?>`+lampiran+`" style="min-height: 480px;"></iframe>
            `;
        }else{
            document.getElementById('modal-body').innerHTML = `
                <img src="<?=base_url('assets/images/input/lampiran_harian/');?>`+lampiran+`" class="img-fluid" alt="`+lampiran+`"/>
            `;
        }
    }
</script>