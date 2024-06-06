<footer class="footer">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">

            </div>
        </div>
    </div>
</footer>
</div>            
<!-- end main content-->

</div>
<!-- END layout-wrapper -->
<!-- JAVASCRIPT -->
<script type="text/javascript">
	var user_id = `<?=$this->session->userdata('id_user');?>`;
	var user_name = `<?=$this->session->userdata('nama');?>`;
	var user_role = `<?=$this->session->userdata('role_id');?>`;
</script>

<script src="<?=base_url('assets/libs/metismenu/metisMenu.min.js');?>"></script>
<script src="<?=base_url('assets/libs/simplebar/simplebar.min.js');?>"></script>
<script src="<?=base_url('assets/libs/node-waves/waves.min.js');?>"></script>
<script src="<?=base_url('assets/libs/jquery-sparkline/jquery.sparkline.min.js');?>"></script>
<?php if($page == 'dashboard-home'):?>
<script src="<?=base_url('assets/js/script-dash/indexDash.js');?>"></script>

<?php elseif($page == 'penjadwalan'):?>
<script src="<?=base_url('assets/libs/moment/min/moment.min.js');?>"></script>
<script src="<?=base_url('assets/libs/jquery-ui-dist/jquery-ui.min.js');?>"></script>
<script src="<?=base_url('assets/libs/@fullcalendar/core/main.min.js');?>"></script>
<script src="<?=base_url('assets/libs/@fullcalendar/core/locales/id.js');?>"></script>
<script src="<?=base_url('assets/libs/@fullcalendar/bootstrap/main.min.js');?>"></script>
<script src="<?=base_url('assets/libs/@fullcalendar/daygrid/main.min.js');?>"></script>
<script src="<?=base_url('assets/libs/@fullcalendar/timegrid/main.min.js');?>"></script>
<script src="<?=base_url('assets/libs/@fullcalendar/interaction/main.min.js');?>"></script>
<!-- Calendar init -->
<script src="<?=base_url('assets/js/script-dash/penjadwalan.js');?>"></script>

<?php elseif($page == 'penjadwalan2'):?>
<script src="<?=base_url('assets/libs/moment/min/moment.min.js');?>"></script>
<script src="<?=base_url('assets/libs/jquery-ui-dist/jquery-ui.min.js');?>"></script>
<script src="<?=base_url('assets/libs/@fullcalendar/core/main.min.js');?>"></script>
<script src="<?=base_url('assets/libs/@fullcalendar/core/locales/id.js');?>"></script>
<script src="<?=base_url('assets/libs/@fullcalendar/bootstrap/main.min.js');?>"></script>
<script src="<?=base_url('assets/libs/@fullcalendar/daygrid/main.min.js');?>"></script>
<script src="<?=base_url('assets/libs/@fullcalendar/timegrid/main.min.js');?>"></script>
<script src="<?=base_url('assets/libs/@fullcalendar/interaction/main.min.js');?>"></script>
<script src="<?=base_url('assets/js/script-dash/penjadwalan.js');?>"></script>
<?php elseif($page == 'penggunaan_harian'):?>
<script src="<?=base_url('assets/js/script-dash/harianBA.js');?>"></script>
<?php elseif($page == 'assisten_praktikum'):?>
<script src="<?=base_url('assets/js/script-dash/asprakBA.js');?>"></script>
<?php elseif($page == 'laboratorium'):?>
<script src="<?=base_url('assets/js/script-dash/indexLab.js');?>"></script>
<?php elseif($page == 'detail_laboratorium'):?>
<script src="<?=base_url('assets/libs/magnific-popup/jquery.magnific-popup.min.js');?>"></script>
<script src="<?=base_url('assets/js/script-dash/detailLab.js');?>"></script>
<?php elseif($page == 'kelas'):?>
<script src="<?=base_url('assets/js/script-dash/kelas.js');?>"></script>
<?php elseif($page == 'manage-kegiatan'):?>
<script src="<?=base_url('assets/js/script-dash/manageKegiatan.js');?>"></script>
<?php endif;?>
<script src="<?=base_url('assets/js/app.js');?>"></script>

</body>

</html>