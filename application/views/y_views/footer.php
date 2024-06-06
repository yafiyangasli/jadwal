<footer style="border-top: solid 2px #5f606a; ">
	<p class="text-center mt-1 mb-0" style="font-weight: 700;"><label class="text-secondary"><i class="far fa-fw fa-copyright"></i>2024 </label> Sistem Informasi Laboratorium Program Studi Teknik Informatika ITERA Tim</p>
</footer>
<script type="text/javascript">
	function tabTentang(a){
		var page = `<?=$page?>`;
		var tab = a.getAttribute('data-lab');

		if (page == 'home') {
			document.getElementsByClassName('tentang')[tab].setAttribute("class","tentang nav-link active");
			document.getElementsByClassName('tentangTab')[tab].setAttribute("class","tentangTab active tab-pane p-3");
		}
	}
</script>
<script src="<?=base_url('assets/libs/jquery/jquery.min.js');?>"></script>
<script src="<?=base_url('assets/libs/bootstrap/js/bootstrap.bundle.min.js');?>"></script>
<script src="<?=base_url('assets/libs/jquery-sparkline/jquery.sparkline.min.js');?>"></script>
<?php if($page == 'home'):?>
<script src="<?=base_url('assets/libs/moment/min/moment.min.js');?>"></script>
<script src="<?=base_url('assets/libs/jquery-ui-dist/jquery-ui.min.js');?>"></script>
<script src="<?=base_url('assets/libs/@fullcalendar/core/main.min.js');?>"></script>
<script src="<?=base_url('assets/libs/@fullcalendar/core/locales/id.js');?>"></script>
<script src="<?=base_url('assets/libs/@fullcalendar/bootstrap/main.min.js');?>"></script>
<script src="<?=base_url('assets/libs/@fullcalendar/daygrid/main.min.js');?>"></script>
<script src="<?=base_url('assets/libs/@fullcalendar/timegrid/main.min.js');?>"></script>
<script src="<?=base_url('assets/libs/@fullcalendar/interaction/main.min.js');?>"></script>
<script src="<?=base_url('assets/js/home.js');?>"></script>
<?php endif;?>
</body>
</html>