<?php
class y_models extends CI_Model{

	function M_get_jadwal($lab,$page){
		//$data = $this->db->get('jadwal')->result_array();
		$labo = $this->db->get_where('laboratorium',['nama_lab' => $lab])->row_array();
		if ($page == 'penjadwalan') {
			$data = $this->db->get_where('jadwal',['id_lab' => $labo['id_lab']])->result_array();
		} else if ($page == 'home') {
			$data = $this->db->get_where('jadwal',['id_lab' => $labo['id_lab'], 'is_active' => 1])->result_array();
		}
  		$jadwal = [];
  		$totalJadwal = 0;
  		$rentang = 0;
  		$kategori = '';
  		foreach ($data as $dt) {
  			if (($dt['is_active'] == 0) || ($dt['is_active'] == 2)) {
  				$rentang = 1;
  			} else {
  				$rentang = $dt['rentang_waktu'];
  			}

  			for($i = 0; $i < $rentang; $i++){
  				$timesRentang = $i*7;
  				$time1 = explode(' ', $dt['start']);
  				$time2 = explode(' ', $dt['end']);
  				$firstDate = strtotime($dt['start']);
  				$contDate = strtotime("+".$timesRentang." day", $firstDate);
  				$dateNow = date('Y-m-d ', $contDate);
  				if ($dt['kategori'] == 1) {
  					$kategori = 'bg-success';
  				}else if ($dt['kategori'] == 2) {
  					$kategori = 'bg-info';
  				} else{
  					$kategori = 'bg-warning';
  				}
  		
  				$jadwal[$totalJadwal] = [
  					'id_jadwal' => $dt['id_jadwal'],
  					'id_kp' => $dt['id_kp'],
  					'id_user' => $dt['id_user'],
  					'title' => $dt['title'],
  					'start' => $dateNow.$time1[1],
  					'end' => $dateNow.$time2[1],
  					'className' => $kategori,
  					'rentang' => $dt['rentang_waktu'],
  					'kebutuhan' => $dt['kebutuhan'],
  					'jumlah_mhs' => $dt['jumlah_mhs'],
  					'is_active' => $dt['is_active']
  				];
  				$totalJadwal++;
  			}
  		}
  		return $jadwal;
	}

	function getLabIDNameforSide(){
		$this->db->select('id_lab');
		$this->db->select('nama_lab');
		return $data = $this->db->get('laboratorium')->result_array();
	}

	function getUserNameByID($id){
		$data = $this->db->get_where('user',['id_user' => $id])->row_array();

		return $data['nama'];
	}

	function getKPNameByID($id){
		$data = $this->db->get_where('kelas_praktikum',['id_kp' => $id])->row_array();

		return $data['nama_mk'];
	}

	function arrDataLabProdi2(){
		$json = "https://silabor.itera.ac.id/data/barangif";
    	$data = file_get_contents($json);
    	$decode = json_decode($data,'false');
    	//array(8) { ["id_barang_bmn"]=> string(19) "2015110010010.00042" ["id_ruang"]=> string(6) "KR1211" ["namaruangan"]=> string(7) "Lab IOT" ["nama_barang"]=> string(32) "Meja Komputer ORBITREND OSC-1091" ["kondisi_barang"]=> string(4) "Baik" ["status"]=> string(19) "Tidak Bisa Dipinjam" ["deskripsi"]=> string(32) "Meja Komputer ORBITREND OSC-1091" ["keterangan_barang"]=> string(10) "Meja Dosen" }

    	$temp = '';
	    $arrData = [];
	    $j = 0;
	    for ($i=0; $i < count($decode['data']); $i++) {
	    	if ($decode['data'][$i]['id_ruang'] == 'KR1212') {
	      		$arrData[$j] = $decode['data'][$i];
	      		$j++;
	       	} 
	    }
	    $arrBarang = [];
	    $temp = '';
	    $j=0;
	    $l=0;
	    $m=0;

	    for ($i=0; $i < count($arrData); $i++) {
	      if ($arrData[$i]['nama_barang'] != $temp) {
	        $arrBarang[$j]['id_barang'] = $arrData[$i]['id_barang_bmn'];
	        $arrBarang[$j]['id_ruang'] = $arrData[$i]['id_ruang'];
	        $arrBarang[$j]['nama_barang'] = $arrData[$i]['nama_barang'];
	        $arrBarang[$j]['keterangan_barang'] = $arrData[$i]['keterangan_barang'];
	        $arrBarang[$j]['deskripsi'] = $arrData[$i]['deskripsi'];
	        $temp = $arrData[$i]['nama_barang'];
	        $j++;
	      }
	    }

	    foreach ($arrBarang as $an) {
	      for($i=0; $i < count($arrData); $i++){
	        if ($an['nama_barang'] == $arrData[$i]['nama_barang']) {
	          $l++;
	        }
	      }
	      $arrBarang[$m]['total_barang'] = $l;
	      $m++;
	      $l=0;
	    }
	    return $arrBarang;
	}

	function arrDataLabProdi3(){
		$json = "https://silabor.itera.ac.id/data/barangif";
    	$data = file_get_contents($json);
    	$decode = json_decode($data,'false');

    	$temp = '';
	    $arrData = [];
	    $j = 0;
	    for ($i=0; $i < count($decode['data']); $i++) {
	    	if ($decode['data'][$i]['id_ruang'] == 'KR1213') {
	      		$arrData[$j] = $decode['data'][$i];
	      		$j++;
	       	} 
	    }
	    $arrBarang = [];
	    $temp = '';
	    $j=0;
	    $l=0;
	    $m=0;

	    for ($i=0; $i < count($arrData); $i++) {
	      if ($arrData[$i]['nama_barang'] != $temp) {
	        $arrBarang[$j]['id_barang'] = $arrData[$i]['id_barang_bmn'];
	        $arrBarang[$j]['id_ruang'] = $arrData[$i]['id_ruang'];
	        $arrBarang[$j]['nama_barang'] = $arrData[$i]['nama_barang'];
	        $arrBarang[$j]['keterangan_barang'] = $arrData[$i]['keterangan_barang'];
	        $arrBarang[$j]['deskripsi'] = $arrData[$i]['deskripsi'];
	        $temp = $arrData[$i]['nama_barang'];
	        $j++;
	      }
	    }

	    foreach ($arrBarang as $an) {
	      for($i=0; $i < count($arrData); $i++){
	        if ($an['nama_barang'] == $arrData[$i]['nama_barang']) {
	          $l++;
	        }
	      }
	      $arrBarang[$m]['total_barang'] = $l;
	      $m++;
	      $l=0;
	    }
	    
	    return $arrBarang;
	}

	function arrDataLabIOT(){
		$json = "https://silabor.itera.ac.id/data/barangif";
    	$data = file_get_contents($json);
    	$decode = json_decode($data,'false');

    	$temp = '';
	    $arrData = [];
	    $j = 0;
	    for ($i=0; $i < count($decode['data']); $i++) {
	    	if ($decode['data'][$i]['id_ruang'] == 'KR1211') {
	      		$arrData[$j] = $decode['data'][$i];
	      		$j++;
	       	} 
	    }
	    $arrBarang = [];
	    $temp = '';
	    $j=0;
	    $l=0;
	    $m=0;

	    for ($i=0; $i < count($arrData); $i++) {
	      if ($arrData[$i]['nama_barang'] != $temp) {
	        $arrBarang[$j]['id_barang'] = $arrData[$i]['id_barang_bmn'];
	        $arrBarang[$j]['id_ruang'] = $arrData[$i]['id_ruang'];
	        $arrBarang[$j]['nama_barang'] = $arrData[$i]['nama_barang'];
	        $arrBarang[$j]['keterangan_barang'] = $arrData[$i]['keterangan_barang'];
	        $arrBarang[$j]['deskripsi'] = $arrData[$i]['deskripsi'];
	        $temp = $arrData[$i]['nama_barang'];
	        $j++;
	      }
	    }

	    foreach ($arrBarang as $an) {
	      for($i=0; $i < count($arrData); $i++){
	        if ($an['nama_barang'] == $arrData[$i]['nama_barang']) {
	          $l++;
	        }
	      }
	      $arrBarang[$m]['total_barang'] = $l;
	      $m++;
	      $l=0;
	    }

	    return $arrBarang;
	}
	function arrDataLabProdi2DB(){
    	$decode = $this->db->get_where('barang_lab',['id_ruang' => 'KR1212'])->result_array();
    	
	    return $decode;
	}

	function arrDataLabProdi3DB(){
    	$decode = $this->db->get_where('barang_lab',['id_ruang' => 'KR1213'])->result_array();
    	
	    return $decode;
	}

	function arrDataLabIOTDB(){
    	$decode = $this->db->get_where('barang_lab',['id_ruang' => 'KR1211'])->result_array();

	    return $decode;
	}

	function convert_hari($index){
		$hariFull = ['Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', "Jum'at", 'Sabtu'];

		return $hariFull[$index];
	}

	function convert_tanggal($data){
		return date('d-m-Y', strtotime($data));
	}

	function convert_jam($data){
		return date('H:i',strtotime($data));
	}

	function cekBetweenDatetime($tanggal,$start,$end,$rentang,$nama_lab){
		$lab = $this->db->get_where('laboratorium',['nama_lab' => $nama_lab])->row_array();
		$data = $this->db->get_where('jadwal',['id_lab' => $lab['id_lab'], 'is_active' => 1])->result_array();

		$inputStart=date('Y-m-d H:i', strtotime($tanggal." ".$start));
		$inputEnd=date('Y-m-d H:i', strtotime($tanggal." ".$end));

		$jadwal = [];
  		$totalJadwal = 0;
  		$jadwalInput = [];
  		$totalJadwalInput = 0;


		foreach ($data as $dt) {
  			for($i = 0; $i < $dt['rentang_waktu']; $i++){
  				$timesRentang = $i*7;
  				$time1 = explode(' ', $dt['start']);
  				$time2 = explode(' ', $dt['end']);
  				$firstDate = strtotime($dt['start']);
  				$contDate = strtotime("+".$timesRentang." day", $firstDate);
  				$dateNow = date('Y-m-d ', $contDate);
  		
  				$jadwal[$totalJadwal] = [
  					'start' => $dateNow.$time1[1],
  					'end' => $dateNow.$time2[1]
  				];
  				$totalJadwal++;
  			}
  		}

  		for($i = 0; $i < $rentang; $i++){
  			$timesRentang = $i*7;
  			$firstDate = strtotime($tanggal);
  			$contDate = strtotime("+".$timesRentang." day", $firstDate);
  			$dateNow = date('Y-m-d ', $contDate);

  			$jadwalInput[$totalJadwalInput] = [
  				'start' => $dateNow.$start,
  				'end' => $dateNow.$end
  			];
  			$totalJadwalInput++;
  		}

  		$j = 0;
  		foreach ($jadwal as $jd) {
  			$dbStart = date('Y-m-d H:i', strtotime($jd['start']));
			$dbEnd = date('Y-m-d H:i', strtotime($jd['end']));
			foreach ($jadwalInput as $ji) {
				if (($ji['start'] >= $dbStart) && ($ji['start'] <= $dbEnd)){
				    $j++;
				}
				if (($ji['end'] >= $dbStart) && ($ji['end'] <= $dbEnd)){
				    $j++;
				}
			}
  		}

  		return $j;
	}

	function input_file($file,$path,$nama,$jenis){
		$db_file = '';

		for ($i=0; $i < count($file['name']); $i++) { 
			$tmp = $file['tmp_name'][$i];
			$explode_name_file = explode(".", $file['name'][$i]);
			$upload_file = round(microtime(true)) . $jenis. $nama. '_'. ($i+1) .'.'. end($explode_name_file);
			$db_file .= $upload_file.",";
			if(move_uploaded_file($tmp, $path.$upload_file)){
				$movefile = $path.$upload_file;
			}
		}
		return $db_file;
	}

	function ubah_file($file,$filelama,$path){
		$db_file = '';
 
		$tmp = $file['tmp_name'];
		$upload_file = $filelama;

		unlink($path.$filelama);
		if(move_uploaded_file($tmp, $path.$upload_file)){
			$movefile = $path.$upload_file;
		}

		return $upload_file;
	}

	function hapus_file($file,$path){
		unlink($path.$file);
	}

	function get_tables($tables,$cari,$iswhere){
            // Ambil data yang di ketik user pada textbox pencarian
		$search = htmlspecialchars($_POST['search']['value']);
            // Ambil data limit per page
		$limit = preg_replace("/[^a-zA-Z0-9.]/", '', "{$_POST['length']}");
            // Ambil data start
		$start =preg_replace("/[^a-zA-Z0-9.]/", '', "{$_POST['start']}"); 

		$query = $tables;

		if(!empty($iswhere)){
			$sql = $this->db->query("SELECT * FROM ".$query." WHERE ".$iswhere);
		}else{
			$sql = $this->db->query("SELECT * FROM ".$query);
		}

		$sql_count = $sql->num_rows();

		$cari = implode(" LIKE '%".$search."%' OR ", $cari)." LIKE '%".$search."%'";


            // Untuk mengambil nama field yg menjadi acuan untuk sorting
		$order_field = $_POST['order'][0]['column']; 

            // Untuk menentukan order by "ASC" atau "DESC"
		$order_ascdesc = $_POST['order'][0]['dir']; 
		$order = " ORDER BY ".$_POST['columns'][$order_field]['data']." ".$order_ascdesc;

		if(!empty($iswhere)){
			$sql_data = $this->db->query("SELECT * FROM ".$query." WHERE $iswhere AND (".$cari.")".$order." LIMIT ".$limit." OFFSET ".$start);
		}else{
			$sql_data = $this->db->query("SELECT * FROM ".$query." WHERE (".$cari.")".$order." LIMIT ".$limit." OFFSET ".$start);
		}

		if(isset($search))
		{
			if(!empty($iswhere)){
				$sql_cari =  $this->db->query("SELECT * FROM ".$query." WHERE $iswhere (".$cari.")");
			}else{
				$sql_cari =  $this->db->query("SELECT * FROM ".$query." WHERE (".$cari.")");
			}
			$sql_filter_count = $sql_cari->num_rows();
		}else{
			if(!empty($iswhere)){
				$sql_filter = $this->db->query("SELECT * FROM ".$query."WHERE ".$iswhere);
			}else{
				$sql_filter = $this->db->query("SELECT * FROM ".$query);
			}
			$sql_filter_count = $sql_filter->num_rows();
		}
		$data = $sql_data->result_array();

		$callback = array(    
                'draw' => $_POST['draw'], // Ini dari datatablenya    
                'recordsTotal' => $sql_count,    
                'recordsFiltered'=>$sql_filter_count,    
                'data'=>$data
            );
        return json_encode($callback); // Convert array $callback ke json
        }
    }
?>