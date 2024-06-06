<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require FCPATH.'vendor/autoload.php';
class Dashboard extends CI_Controller {

	function __construct(){
		parent::__construct();
		if ($this->session->userdata('email')==NULL) {
			redirect('auth');
		}
		$this->load->model('y_models','model');
	}

	public function index(){
		//page digunakan untuk exceptional per page (untuk script js dan assets kebanyakan)
		$data['page'] = 'dashboard-home';

		$this->load->view('y_views/dashboard/head', $data);
		$this->load->view('y_views/dashboard/side', $data);
		$this->load->view('y_views/dashboard/index', $data);
		$this->load->view('y_views/dashboard/foot', $data);
	}

	public function ajaxGetUserName($id){
		$data = $this->db->get_where('user',['id_user'=>$id])->row_array();

		echo json_encode($data['nama']);
	}

	public function ajaxLoadDashAdmin(){
		$data['jadwal'] = $this->db->get_where('jadwal',['is_active' => 0])->result_array();
		$data['ba_asprak'] = $this->db->get_where('ba_asprak',['is_valid' =>0])->result_array();
		$query = "SELECT * FROM `ba_harian` ORDER BY `id_bah` DESC LIMIT 5";
		$data['ba_harian'] = $this->db->query($query)->result_array();

		echo json_encode($data);
	}

	public function ajaxLoadDashDosen(){
		$this->db->order_by('is_active','DESC');
		$data['jadwal'] = $this->db->get_where('jadwal',['id_user' => $this->session->userdata('id_user')])->result_array();

		echo json_encode($data);
	}

	public function ajaxLoadDashAsprak(){
		$this->db->order_by('is_valid','DESC');
		$data['ba_asprak'] = $this->db->get_where('ba_asprak',['id_user' => $this->session->userdata('id_user')])->result_array();

		echo json_encode($data);
	}

	public function ajaxLoadLab(){
		$data = $this->db->get('laboratorium')->result_array();

		echo json_encode($data);
	}

	public function ajaxLoadPertemuan($id_mk){
		$jadwal = $this->db->get_where('jadwal',['id_kp' => $id_mk])->row_array();
		$bap = $this->db->get_where('ba_asprak',['id_user' => $this->session->userdata('id_user'), 'id_kp' => $id_mk])->result_array();
		$data['pertemuan1'] = [];
		$data['pertemuan2'] = [];
		$j = 0;
		foreach ($bap as $ba) {
			$data['pertemuan1'][$j] = intval($ba['pertemuan']);
			$j++;
		}
		for ($i=0; $i < $jadwal['rentang_waktu']; $i++) { 
			$data['pertemuan2'][$i] = $i+1;
		}

		//array(5) { [1]=> int(2) [3]=> int(4) [4]=> int(5) [5]=> int(6) [6]=> int(7) } {"1":2,"3":4,"4":5,"5":6,"6":7}
		//array(7) { [0]=> int(1) [1]=> int(2) [2]=> int(3) [3]=> int(4) [4]=> int(5) [5]=> int(6) [6]=> int(7) } [1,2,3,4,5,6,7]

		echo json_encode($data);
	}

	public function ajaxLoadDosen(){
		$this->db->select('id_user');
		$this->db->select('nama');
		$data = $this->db->get_where('user',['role_id' => 2])->result_array();

		echo json_encode($data);
	}

	public function ajaxLoadJadwal($lab){
		$lab2 = str_replace("%20", " ", $lab);
		$data = $this->model->M_get_jadwal($lab2,'penjadwalan');

		echo json_encode($data);
	}

	public function ajaxCekInputDatetimeBetween(){
		$tanggal = $this->input->post('tanggal');
		$start = $this->input->post('start');
		$end = $this->input->post('end');
		$rentang = $this->input->post('rentang');
		$nama_lab = $this->input->post('lab');

		$data = $this->model->cekBetweenDatetime($tanggal,$start,$end,$rentang,$nama_lab);

		echo json_encode($data);
	}

	public function ajaxInputJadwal(){
		$lab = $this->db->get_where('laboratorium',['nama_lab' => $this->input->post('lab')])->row_array();
		$kategori = $this->input->post('kategori');
		if ($kategori == 1) {
			$kp = $this->input->post('id_kp');
		}else if ($kategori == 2){
			$dataKP = [
				'id_dosen' => $this->session->userdata('id_user'),
				'nama_mk' => $this->input->post('nama_mk'),
				'kode_mk' => $this->input->post('kode_mk'),
				'kelas' => $this->input->post('kelas'),
				'sks' => $this->input->post('sks'),
				'is_active' => 0
			];
			$this->db->insert('kelas_praktikum',$dataKP);

			$query1 = "SELECT * FROM `kelas_praktikum` ORDER BY `id_kp` DESC LIMIT 1";
			$getKP = $this->db->query($query1)->row_array();
			$kp = $getKP['id_kp'];
		}else{
			$kp = 0;
		}

		$dataJadwal = [
			'id_lab' => $lab['id_lab'],
			'id_kp' => $kp,
			'id_user' => $this->session->userdata('id_user'),
			'title' => $this->input->post('title'),
			'start' => $this->input->post('start'),
			'end' => $this->input->post('end'),
			'rentang_waktu' => $this->input->post('rentang_waktu'),
			'jumlah_mhs' => $this->input->post('jumlah_mhs'),
			'kategori' => $this->input->post('kategori'),
			'kebutuhan' => $this->input->post('kebutuhan'),
			'is_active' => 0
		];
		$this->db->insert('jadwal',$dataJadwal);

		$query2 = "SELECT * FROM `jadwal` ORDER BY `id_jadwal` DESC LIMIT 1";
		$jadwal = $this->db->query($query2)->row_array();

		$data['id_kp'] = $kp;
		$data['id_jadwal'] = $jadwal['id_jadwal'];

		echo json_encode($data);
	}

	public function ajaxUbahJadwal(){
		$kategori = $this->input->post('kategori');
		$kp = $this->input->post('id_kp');
		if ($kategori == 2){
			$dataKP = [
				'nama_mk' => $this->input->post('nama_mk'),
	            'kode_mk' => $this->input->post('kode_mk'),
	            'kelas' => $this->input->post('kelas'),
	            'sks' => $this->input->post('sks')
			];

			$this->db->where('id_kp', $kp);
			$this->db->set($dataKP);
			$this->db->update('kelas_praktikum');
		}

		$dataJadwal = [
			'id_kp' => $kp,
            'title' => $this->input->post('title'),
            'start' => $this->input->post('start'),
            'end' => $this->input->post('end'),
            'rentang_waktu' => $this->input->post('rentang_waktu'),
            'jumlah_mhs' => $this->input->post('jumlah_mhs'),
            'kategori' => $this->input->post('kategori'),
            'kebutuhan' => $this->input->post('kebutuhan'),
            'is_active' => 0
		];
		$this->db->where('id_jadwal', $this->input->post('id_jadwal'));
		$this->db->set($dataJadwal);
		$this->db->update('jadwal');
	}

	public function ajaxHapusJadwal(){
		$dataKP = $this->db->get_where('kelas_praktikum',['id_kp' => $this->input->post('id_kp')])->row_array();
		$kodeMK = explode('IF',$dataKP['kode_mk']);
		if (count($kodeMK) < 2) {
			$this->db->where('id_kp', $this->input->post('id_kp'));
			$this->db->delete('kelas_praktikum');
		}

		$this->db->where('id_jadwal', $this->input->post('id_jadwal'));
		$this->db->delete('jadwal');
	}

	public function ajaxLoadJadwalByID($id){
		$query = "SELECT a.id_jadwal,a.id_lab,a.id_kp,a.id_user,a.title,a.start,a.end,a.rentang_waktu,a.jumlah_mhs,a.kategori,a.kebutuhan,a.catatan,a.is_active,b.id_dosen,b.nama_mk,b.kode_mk,b.kelas,b.sks,b.is_active AS kp_is_active FROM jadwal AS a LEFT JOIN kelas_praktikum AS b ON a.id_kp = b.id_kp WHERE a.id_jadwal = $id";
		$data = $this->db->query($query)->row_array();
		$temp = explode(' ',$data['start']);
		$temp2 = explode(' ',$data['end']);

		$data['tanggal'] = $this->model->convert_tanggal($temp[0]);
		$data['start'] = $this->model->convert_jam($temp[1]);
		$data['end'] = $this->model->convert_jam($temp2[1]);

		echo json_encode($data);
	}

	public function ajaxLoadLabByID($id){
		$data = $this->db->get_where('laboratorium',['id_lab' => $id])->row_array();

		echo json_encode($data);
	}

	public function ajaxLoadKP(){
		$query = "SELECT * FROM kelas_praktikum WHERE kode_mk LIKE '%IF%' AND is_active = 1";
		$data = $this->db->query($query)->result_array();

		echo json_encode($data);
	}

	public function ajaxLoadKPByID($id){
		$data = $this->db->get_where('kelas_praktikum',['id_kp' => $id])->row_array();

		echo json_encode($data);
	}

	public function ajaxLoadDosenByID($id){
		$data = $this->db->get_where('user',['id_user' => $id])->row_array();

		echo json_encode($data);
	}

	public function ajaxLoadBAPByID($id){
		$data = $this->db->get_where('ba_asprak',['id_bap' => $id])->row_array();
		$data['nama_dosen'] = $this->model->getUserNameByID($data['id_user']);
		$temp = explode(" ", $data['waktu']);
		$data['tanggal'] = $this->model->convert_tanggal($temp[0]);
		$data['jam'] = $this->model->convert_jam($temp[1]);

		echo json_encode($data);
	}

	public function penjadwalan(){
		$data['page'] = 'penjadwalan';
		$lab = str_replace("%20", " ", $_GET['lab']);
		$data['lab'] = $this->db->get_where('laboratorium',['nama_lab' => $lab])->row_array();
		$data['kelas'] = $this->db->get_where('kelas_praktikum',['is_active' => 1])->result_array();
		
		$this->load->view('y_views/dashboard/head', $data);
		$this->load->view('y_views/dashboard/side', $data);
		$this->load->view('y_views/dashboard/penjadwalan/index', $data);
		$this->load->view('y_views/dashboard/foot', $data);
	}

	public function penjadwalan2(){
		$data['page'] = 'penjadwalan2';
		$lab = str_replace("%20", " ", $_GET['lab']);

		$this->load->view('y_views/dashboard/head', $data);
		$this->load->view('y_views/dashboard/side', $data);
		$this->load->view('y_views/dashboard/penjadwalan/index', $data);
		$this->load->view('y_views/dashboard/foot', $data);
	}

	public function penggunaan_harian(){
		$data['page'] = 'penggunaan_harian';
		if ($this->session->userdata('role_id') == 1) {
			$data['ba_harian'] = $this->db->get('ba_harian')->result_array();
		} else{
			$data['ba_harian'] = $this->db->get_where('ba_harian',['id_user' => $this->session->userdata('id_user')])->result_array();
		}

		$this->load->view('y_views/dashboard/head', $data);
		$this->load->view('y_views/dashboard/side', $data);
		$this->load->view('y_views/dashboard/berita_acara/penggunaan_harian', $data);
		$this->load->view('y_views/dashboard/foot', $data);
	}

	public function input_harianBA(){
		$input_lampiran = $_FILES['file'];

		if(strlen($input_lampiran['name'][0]) > 0){
			$lampiran = $_FILES['file'];
			$db_lampiran = '';
			$nama_lampiran = $this->input->post('namakegiatan');
			$jenis_lampiran = '_Lampiran_BA_Harian_';
			$path = './assets/images/input/lampiran_harian/';
			$db_lampiran = $this->model->input_file($lampiran,$path,$nama_lampiran,$jenis_lampiran);
		} else{
			$db_lampiran = '';
		}

		$waktu = $this->input->post('tanggal') .' '. $this->input->post('jam');

		$data = [
			'id_user' => $this->session->userdata('id_user'),
			'kegiatan' => $this->input->post('namakegiatan'),
			'laboratorium' => $this->input->post('lab'),
			'waktu' => $waktu,
			'deskripsi' => $this->input->post('deskripsi'),
			'lampiran' => $db_lampiran
		];

		$this->db->insert('ba_harian',$data);

		redirect('dashboard/penggunaan_harian');
	}

	public function hapus_harianBA($id){
		$data_bah = $this->db->get_where('ba_harian',['id_bah'=> $id])->row_array();
		$path = './assets/images/input/lampiran_harian/';

		if ($data_bah['lampiran'] != '') {

			$temp = explode(',', $data_bah['lampiran']);

			for($i = 0; $i < count($temp) - 1; $i++){
				$this->model->hapus_file($temp[$i],$path);
			}
		}

		$this->db->where('id_bah', $id);
		$this->db->delete('ba_harian');
		redirect('dashboard/penggunaan_harian');
	}

	public function detail_penggunaan_harian($id){
		$data['page'] = 'detail_penggunaan_harian';
		$data['ba_harian'] = $this->db->get_where('ba_harian', ['id_bah' => $id])->row_array();
		$data['lampiran_bah'] = explode(',', $data['ba_harian']['lampiran']);

		$this->load->view('y_views/dashboard/head', $data);
		$this->load->view('y_views/dashboard/side', $data);
		$this->load->view('y_views/dashboard/berita_acara/detail_penggunaan_harian', $data);
		$this->load->view('y_views/dashboard/foot', $data);
	}

	public function assisten_praktikum(){
		$data['page'] = 'assisten_praktikum';
		if ($this->session->userdata('role_id') == 1) {
			$this->db->order_by('id_bap','DESC');
			$data['ba_asprak'] = $this->db->get('ba_asprak')->result_array();
			$i=0;
			foreach ($data['ba_asprak'] as $dba) {
				$temp = $this->model->getUserNameByID($dba['id_user']);
				$temp2 = $this->model->getKPNameByID($dba['id_kp']);
				$data['ba_asprak'][$i]['nama'] = $temp;
				$data['ba_asprak'][$i]['nama_mk'] = $temp2;
				if ($dba['is_valid'] == 0) {
					$data['ba_asprak'][$i]['is_valid'] = 'Diajukan';
				} else if ($dba['is_valid'] == 1) {
					$data['ba_asprak'][$i]['is_valid'] = 'Diterima';
				} else {
					$data['ba_asprak'][$i]['is_valid'] = 'Ditolak';
				}
				$i++;
			}
		} else if ($this->session->userdata('role_id') == 2){
			$kp = $this->db->get_where('kelas_praktikum',['id_dosen' => $this->session->userdata('id_user')])->result_array();
			$id_dosen = $this->session->userdata('id_user');
			$query = "SELECT * FROM ba_asprak LEFT JOIN kelas_praktikum ON ba_asprak.id_kp = kelas_praktikum.id_kp WHERE kelas_praktikum.id_dosen = $id_dosen ORDER BY id_bap DESC";
			$data['ba_asprak'] = $this->db->query($query)->result_array();
			$i=0;
			foreach ($data['ba_asprak'] as $dba) {
				$temp = $this->model->getUserNameByID($dba['id_user']);
				$data['ba_asprak'][$i]['nama'] = $temp;
				if ($dba['is_valid'] == 0) {
					$data['ba_asprak'][$i]['is_valid'] = 'Diajukan';
				} else if ($dba['is_valid'] == 1) {
					$data['ba_asprak'][$i]['is_valid'] = 'Diterima';
				} else {
					$data['ba_asprak'][$i]['is_valid'] = 'Ditolak';
				}
				$i++;
			}
		} else {
			$this->db->order_by('id_bap','DESC');
			$data['ba_asprak'] = $this->db->get_where('ba_asprak',['id_user' => $this->session->userdata('id_user')])->result_array();
			$i=0;
			foreach ($data['ba_asprak'] as $dba) {
				$temp = $this->model->getUserNameByID($dba['id_user']);
				$temp2 = $this->model->getKPNameByID($dba['id_kp']);
				$data['ba_asprak'][$i]['nama'] = $temp;
				$data['ba_asprak'][$i]['nama_mk'] = $temp2;
				if ($dba['is_valid'] == 0) {
					$data['ba_asprak'][$i]['is_valid'] = 'Diajukan';
				} else if ($dba['is_valid'] == 1) {
					$data['ba_asprak'][$i]['is_valid'] = 'Diterima';
				} else {
					$data['ba_asprak'][$i]['is_valid'] = 'Ditolak';
				}
				$i++;
			}
		}

		$this->load->view('y_views/dashboard/head', $data);
		$this->load->view('y_views/dashboard/side', $data);
		$this->load->view('y_views/dashboard/berita_acara/assisten_praktikum', $data);
		$this->load->view('y_views/dashboard/foot', $data);
	}

	public function input_asprakBA(){
		$input_dokumentasi = $_FILES['file'];
		$db_dokumentasi = '';
		
		$nama_dokumentasi = $this->session->userdata('id_user');
		$jenis_dokumentasi = '_Dokumentasi_BA_Asprak_';
		$path = './assets/images/input/dokumentasi_asprak/';
		$db_dokumentasi = $this->model->input_file($input_dokumentasi,$path,$nama_dokumentasi,$jenis_dokumentasi);

		$waktu = $this->input->post('tanggal') .' '. $this->input->post('jam');

		$data = [
			'id_user' => $this->session->userdata('id_user'),
			'id_kp' => $this->input->post('mk'),
			'hari' => $this->model->convert_hari(date('w', strtotime($this->input->post('tanggal')))),
			'waktu' => $waktu,
			'pertemuan' => $this->input->post('pertemuan'),
			'modul' => $this->input->post('modul'),
			'jenis_prak' => 'Offline',
			'link' => '',
			'lokasi_prak' => $this->input->post('lab'),
			'hadir' => $this->input->post('hadir'),
			'tidak_hadir' => $this->input->post('thadir'),
			'deskripsi' => $this->input->post('deskripsi'),
			'dokumentasi' => $db_dokumentasi
		];

		$this->db->insert('ba_asprak',$data);
		redirect('dashboard/assisten_praktikum');
	}

	public function printBAP($id){
		$data['bap'] = $this->db->get_where('ba_asprak',['id_bap' => $id])->row_array();
		$data['user'] = $this->db->get_where('user',['id_user' => $data['bap']['id_user']])->row_array();
		$data['kp'] = $this->db->get_where('kelas_praktikum',['id_kp' => $data['bap']['id_kp']])->row_array();
		$data['dosen'] = $this->db->get_where('user',['id_user' => $data['kp']['id_dosen']])->row_array();
        
		$this->load->library('pdf');
        // title dari pdf
        $this->data['nama'] = $data['user']['nama'];
        $this->data['nim'] = $data['bap']['id_user'];
        $this->data['modul'] = $data['bap']['modul'];
        $this->data['pertemuan'] = $data['bap']['pertemuan'];
        $this->data['mk'] = $data['kp']['nama_mk'];
        $this->data['kode'] = $data['kp']['kode_mk'];
        $this->data['hari'] = $data['bap']['hari'];
        $waktu = explode(" ",$data['bap']['waktu']);
        $this->data['tanggal'] = $this->model->convert_tanggal($waktu[0]);
        $this->data['jam'] = $this->model->convert_jam($waktu[1]);
        $this->data['kelas'] = $data['kp']['kelas'];
        $this->data['dosen'] = $data['dosen']['nama'];
        $this->data['lokasi'] = $data['bap']['lokasi_prak'];
        $this->data['deskripsi'] = $data['bap']['deskripsi'];
        $this->data['hadir'] = $data['bap']['hadir'];
        $this->data['tidak_hadir'] = $data['bap']['tidak_hadir'];
        $this->data['total_hadir'] = $data['bap']['hadir'] + $data['bap']['tidak_hadir'];
        $gambar = explode(',',$data['bap']['dokumentasi']);
        for ($i=0; $i < count($gambar) - 1; $i++) { 
        	$this->data['dokumentasi'][$i] = $gambar[$i];
        }
        
		$html = $this->load->view('y_views/dashboard/berita_acara/pdf',$this->data, true);	    
        
        // run dompdf
        $this->pdf->createPDF($html, 'BAP_Praktikum_'.$data['bap']['id_user'], false, 'A4', 'potrait');
	}

	public function verif_bap(){
		$id = $this->input->post('id_bap');
		$status = $this->input->post('status');
		$this->db->set('is_valid', $status);
		$this->db->set('catatan', $this->input->post('catatan'));
		$this->db->where('id_bap', $id);
		$this->db->update('ba_asprak');
	}

	public function hapus_asprakBA($id){
		$data_bap = $this->db->get_where('ba_asprak',['id_bap'=> $id])->row_array();
		$path = './assets/images/input/dokumentasi_asprak/';

		$temp = explode(',', $data_bap['dokumentasi']);

		for($i = 0; $i < count($temp) - 1; $i++){
			$this->model->hapus_file($temp[$i],$path);
		}

		$this->db->where('id_bap', $id);
		$this->db->delete('ba_asprak');
		redirect('dashboard/assisten_praktikum');
	}

	public function laboratorium(){
		$data['page'] = 'laboratorium';

		$data['lab'] = $this->db->get('laboratorium')->result_array();

		$this->load->view('y_views/dashboard/head', $data);
		$this->load->view('y_views/dashboard/side', $data);
		$this->load->view('y_views/dashboard/laboratorium/index', $data);
		$this->load->view('y_views/dashboard/foot', $data);
	}

	public function input_lab(){
		$input_gambar = $_FILES['file'];

		if(strlen($input_gambar['name'][0]) > 0){
			$gambar_lab = $_FILES['file'];
			$db_gambar_lab = '';
			$nama_gambar = $this->input->post('lab');
			$jenis_gambar = '_Foto_LAB_';
			$path = './assets/images/input/foto_lab/';
			$db_gambar_lab = $this->model->input_file($gambar_lab,$path,$nama_gambar,$jenis_gambar);
		} else{
			$db_gambar_lab = '';
		}

		$data = [
			'id_lab' => $this->input->post('id_lab'),
			'nama_lab' => $this->input->post('lab'),
			'gedung' => $this->input->post('gedung'),
			'jenis' => $this->input->post('jenis'),
			'jam_awal' => $this->input->post('jam1'),
			'jam_akhir' => $this->input->post('jam2'),
			'ukuran' => $this->input->post('ukuran'),
			'peserta' => $this->input->post('peserta'),
			'pc' => $this->input->post('pc'),
			'software' => $this->input->post('software'),
			'spek_pc' => $this->input->post('hardware'),
			'foto_lab' => $db_gambar_lab
		];

		$this->db->insert('laboratorium',$data);
		redirect('dashboard/laboratorium');
	}

	public function edit_lab($id){
		var_dump($this->input->post());

		$data = [
			'id_lab' => $this->input->post('id_lab'),
			'nama_lab' => $this->input->post('lab'),
			'gedung' => $this->input->post('gedung'),
			'jenis' => $this->input->post('jenis'),
			'jam_awal' => $this->input->post('jam1'),
			'jam_akhir' => $this->input->post('jam2'),
			'ukuran' => $this->input->post('ukuran'),
			'peserta' => $this->input->post('peserta'),
			'pc' => $this->input->post('pc'),
			'software' => $this->input->post('software'),
			'spek_pc' => $this->input->post('hardware')
		];

		$this->db->where('id_lab', $id);
		$this->db->set($data);
		$this->db->update('laboratorium');
		redirect('dashboard/laboratorium/detail_laboratorium/'.$id);
	}

	public function detail_laboratorium($id){
		$data['page'] = 'detail_laboratorium';
		$data['lab'] = $this->db->get_where('laboratorium', ['id_lab' => $id])->row_array();
		$data['gambar_lab'] = [];
		// $lab1 = $this->model->arrDataLabProdi2();
	 	// $lab2 = $this->model->arrDataLabProdi3();
	 	// $lab3 = $this->model->arrDataLabIOT();

		$lab1 = $this->model->arrDataLabProdi2DB();
	    $lab2 = $this->model->arrDataLabProdi3DB();
	    $lab3 = $this->model->arrDataLabIOTDB();

	    $data['barang_lab'] = array_merge(array_merge($lab1,$lab2),$lab3);

		$data['gambar_lab'] = explode(',', $data['lab']['foto_lab']);

		$this->load->view('y_views/dashboard/head', $data);
		$this->load->view('y_views/dashboard/side', $data);
		$this->load->view('y_views/dashboard/laboratorium/detail', $data);
		$this->load->view('y_views/dashboard/foot', $data);
	}

	public function ubah_foto_laboratorium($id,$jenis){
		$data_lab = $this->db->get_where('laboratorium', ['id_lab' => $id])->row_array();
		$gambar = explode(',',$data_lab['foto_lab']);
		$path = './assets/images/input/foto_lab/';
		
		if ($jenis == 'tambah') {
			$gambar_lab = $_FILES['file'];
			$db_gambar_lab = $data_lab['foto_lab'];
			$jenis_gambar = '_Foto_LAB_';
			
			$db_gambar_lab .= $this->model->input_file($gambar_lab,$path,$data_lab['nama_lab'],$jenis_gambar);

			$data = [
				'foto_lab' => $db_gambar_lab,
			];

			$this->db->where('id_lab', $id);
			$this->db->set($data);
			$this->db->update('laboratorium');
		}else if ($jenis == 'ubah') {
			$gambar_lab = $_FILES['file'];
			$db_gambar_lab = $data_lab['foto_lab'];

			$this->model->ubah_file($gambar_lab,$this->input->post('gambar'),$path);
		}else{
			$db_gambar_lab = '';
			for ($i=0; $i < count($gambar) - 1; $i++) {
				if ($gambar[$i] == $this->input->post('gambar')) {
					$this->model->hapus_file($this->input->post('gambar'),$path);
				}else{
					$db_gambar_lab .= $gambar[$i].',';
				}
			}
			$this->db->where('id_lab', $id);
			$this->db->set('foto_lab', $db_gambar_lab);
			$this->db->update('laboratorium');
		}
		redirect('dashboard/laboratorium/detail_laboratorium/'.$id);

	}

	public function hapus_laboratorium($id){
		$data_lab = $this->db->get_where('laboratorium',['id_lab'=> $id])->row_array();
		$path = './assets/images/input/foto_lab/';

		if ($data_lab['foto_lab'] != '') {

			$temp = explode(',', $data_lab['foto_lab']);

			for($i = 0; $i < count($temp) - 1; $i++){
				$this->model->hapus_file($temp[$i],$path);
			}
		}

		$this->db->where('id_lab', $id);
		$this->db->delete('laboratorium');
		redirect('dashboard/laboratorium');
	}

	public function kelas(){
		$data['page'] = 'kelas';

		$this->db->order_by('is_active','DESC');
		$data['kelas'] = $this->db->get('kelas_praktikum')->result_array();
		$i = 0;

		foreach ($data['kelas'] as $dk) {
			$this->db->select('nama');
			$temp = $this->db->get_where('user',['id_user' => $dk['id_dosen']])->row_array();
			$data['kelas'][$i]['nama_dosen'] = $temp['nama'];
			if ($dk['is_active'] == 1) {
				$data['kelas'][$i]['is_active'] = 'Aktif';
			} else {
				$data['kelas'][$i]['is_active'] = 'Tidak Aktif';
			}
			$i++;
		}

		$this->load->view('y_views/dashboard/head', $data);
		$this->load->view('y_views/dashboard/side', $data);
		$this->load->view('y_views/dashboard/laboratorium/kelas', $data);
		$this->load->view('y_views/dashboard/foot', $data);
	}

	public function input_kelas(){
		$data = [
			'id_dosen' => $this->input->post('dosen'),
			'nama_mk' => $this->input->post('mk'),
			'kode_mk' => $this->input->post('kodemk'),
			'kelas' => $this->input->post('kelas'),
			'sks' => $this->input->post('sks'),
			'is_active' => 0
		];

		$this->db->insert('kelas_praktikum',$data);
		redirect('dashboard/kelas');
	}

	public function ubah_kelas($id){
		$data = [
			'id_dosen' => $this->input->post('dosen'),
			'nama_mk' => $this->input->post('mk'),
			'kode_mk' => $this->input->post('kodemk'),
			'kelas' => $this->input->post('kelas'),
			'sks' => $this->input->post('sks')
		];

		$this->db->where('id_kp',$id);
		$this->db->set($data);
		$this->db->update('kelas_praktikum');
		redirect('dashboard/kelas');
	}

	public function hapus_kelas($id){
		$this->db->where('id_kp', $id);
		$this->db->delete('kelas_praktikum');

		redirect('dashboard/kelas');
	}

	public function ubahStatusKelas($id){
		$kelas = $this->db->get_where('kelas_praktikum',['id_kp' => $id])->row_array();

		if ($kelas['is_active'] == 0) {
			$result = 1;
		} else{
			$result = 0;
		}
		$this->db->where('id_kp',$id);
		$this->db->set('is_active', $result);
		$this->db->update('kelas_praktikum');
		redirect('dashboard/kelas');
	}

	public function manage_kegiatan(){
		$data['page'] = 'manage-kegiatan';
		$this->db->order_by('is_active','ASC');
		$data['kegiatan'] = $this->db->get('jadwal')->result_array();
		$i = 0;
		
		foreach ($data['kegiatan'] as $dk) {
			$temp = explode(' ',$dk['start']);
			$temp2 = explode(' ',$dk['end']);

			$data['kegiatan'][$i]['tanggal'] = $this->model->convert_tanggal($temp[0]);
			$data['kegiatan'][$i]['start'] = $this->model->convert_jam($temp[1]);
			$data['kegiatan'][$i]['end'] = $this->model->convert_jam($temp2[1]);
			if ($dk['is_active'] == 0) {
				$data['kegiatan'][$i]['is_active'] = 'Diajukan';
			}else if($dk['is_active'] == 1){
				$data['kegiatan'][$i]['is_active'] = 'Aktif';
			}else{
				$data['kegiatan'][$i]['is_active'] = 'Ditolak';
			}
			$i++;
		}

		$this->load->view('y_views/dashboard/head', $data);
		$this->load->view('y_views/dashboard/side', $data);
		$this->load->view('y_views/dashboard/laboratorium/manage_kegiatan', $data);
		$this->load->view('y_views/dashboard/foot', $data);
	}

	public function verif_jadwal(){
		$id = $this->input->post('id_jadwal');
		$status = $this->input->post('status');
		$this->db->set('is_active', $status);
		$this->db->where('id_jadwal', $id);
		$this->db->update('jadwal');
	}
}
