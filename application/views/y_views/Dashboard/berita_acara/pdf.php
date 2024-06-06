<!doctype html>
<html lang="en">
  <head>
  </head>
  <body>
  	<style type="text/css">
  		body{
  			font-family: sans-serif;
  			font-weight: bold;
  		}
  		.p1{
  			border: 1px solid black;
  			width: 100%;
  			height: 30px;
  			background-color: yellow;
  			display: block;
  			text-align: center;
  			padding-top: 5px;
  			padding-bottom: 10px;
  			font-size: 12px;
  			box-sizing: border-box;
  		}

  		.p2{
  			border: 1px solid black;
  			border-top: 0;
  			width: 100%;
  			height: 25px;
  			display: block;
  			font-size: 15px;
  			margin-bottom: -10px;
  			box-sizing: border-box;
  		}

  		table, td, th {
		  border: 1px solid;
		  font-size: 12px;
		  height: 20px;
		}

		table {
		  width: 100%;
		  border-collapse: collapse;
		  margin-top: 20px;
		}
  		
  		.row-2{
  			padding: 5px;
  		}

  	</style>
  	<div class="wrapper">
  		<table class="tabel-1">
		  <tr style="background-color: yellow;">
		    <th class="row-1" colspan="3" style="padding-bottom: 10px;">BERITA ACARA PRAKTIKUM</th>
		  </tr>
		  <tr>
		    <td class="row-2" style="width: 25%">Nama Assisten | NIM</td>
		    <td style="width: 50%"><?=$nama;?></td>
		    <td style="width: 25%"><?=$nim;?></td>
		  </tr>
		  <tr>
		    <td class="row-2" style="width: 25%">Modul/Pertemuan ke-, Judul Modul</td>
		    <td colspan="2"><?=$pertemuan;?> - <?=$modul;?></td>
		  </tr>
		  <tr>
		    <td class="row-2" style="width: 25%">Mata Kuliah | Kode MK</td>
		    <td style="width: 50%"><?=$mk;?></td>
		    <td style="width: 25%"><?=$kode;?></td>
		  </tr>
		  <tr class="row-5">
		    <td class="row-2" style="width: 25%">Hari/Tanggal | Jam</td>
		    <td style="width: 50%"><?=$hari;?> / <?=$tanggal;?></td>
		    <td style="width: 25%"><?=$jam;?></td>
		  </tr>
		  <tr class="row-6">
		    <td class="row-2" style="width: 25%">Kelas</td>
		    <td colspan="2"><?=$kelas;?></td>
		  </tr>
		  <tr class="row-7">
		    <td class="row-2" style="width: 25%">Dosen PJ Praktikum</td>
		    <td colspan="2"><?=$dosen;?></td>
		  </tr>
		  <tr class="row-8">
		    <td class="row-2" style="width: 25%">Jenis Praktikum | Link</td>
		    <td style="width: 50%">Offline</td>
		    <td style="width: 25%"> - </td>
		  </tr>
		  <tr class="row-9">
		    <td class="row-2" style="width: 25%">Lokasi Praktikum</td>
		    <td colspan="2"><?=$lokasi;?></td>
		  </tr>
		  <tr class="row-20">
		    <td class="row-2" style="width: 25%">Deskripsi & Materi Praktikum</td>
		    <td colspan="2"><?=$deskripsi;?></td>
		  </tr>
		</table>

		<table class="tabel-2">
		  <tr style="background-color: yellow;">
		    <th class="row-1" colspan="3" style="padding-bottom: 10px;">Informasi Peserta Praktikum</th>
		  </tr>
		  <tr style="text-align: center;">
		    <td class="row-2">Praktikan Hadir</td>
		    <td>Praktikan Tidak Hadir</td>
		    <td>Total Praktikan</td>
		  </tr>
		  <tr style="text-align: center;">
		    <td class="row-2"><?=$hadir;?></td>
		    <td><?=$tidak_hadir;?></td>
		    <td><?=$total_hadir;?></td>
		  </tr>
		</table>

		<table class="tabel-3">
		  <tr style="background-color: yellow;">
		    <th class="row-1" style="padding-bottom: 10px;">Dokumentasi Praktikum</th>
		  </tr>
		  <?php for($i = 0; $i < count($dokumentasi); $i++):?>
		  <tr style="text-align: center;">
		    <td class="row-2" style="max-height: 100px;"><img src="<?=base_url().'assets/images/input/dokumentasi_asprak/'.$dokumentasi[$i];?>" style="max-height: 250px;"></td>
		  </tr>
		<?php endfor;?>
		</table>
    	
  	</div>
    
  </body>
</html>