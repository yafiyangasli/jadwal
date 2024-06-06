<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {
  function __construct(){
    parent::__construct();

    $this->load->model('y_models','model');
    require FCPATH.'vendor/autoload.php';
  }

	public function index(){
    $data['page'] = 'home';
		$data['lab'] = $this->db->get('laboratorium')->result_array();
    //$lab1 = $this->model->arrDataLabProdi2();
    //$lab2 = $this->model->arrDataLabProdi3();
    //$lab3 = $this->model->arrDataLabIOT();
    $lab1 = $this->model->arrDataLabProdi2DB();
    $lab2 = $this->model->arrDataLabProdi3DB();
    $lab3 = $this->model->arrDataLabIOTDB();

    $data['gambar_lab'] = [];
    $data['barang_lab'] = array_merge(array_merge($lab1,$lab2),$lab3);

    for ($i=0; $i < count($data['lab']); $i++) { 
      $temp = $data['lab'][$i]['nama_lab'];
      $temp2 = explode(',',$data['lab'][$i]['foto_lab']);
      for ($j=0; $j < count($temp2) - 1; $j++) { 
        $data['gambar_lab'][$temp][$j] = $temp2[$j];
      }
    }

		$this->load->view('y_views/header', $data);
		$this->load->view('y_views/home/index', $data);
		$this->load->view('y_views/footer');
	}

  public function ajaxLoadLab(){
    $data = $this->db->get('laboratorium')->result_array();

    echo json_encode($data);
  }

  public function ajaxLoadJadwalHome($lab){
    $lab2 = str_replace("%20", " ", $lab);
    $data = $this->model->M_get_jadwal($lab2,'home');

    echo json_encode($data);
  }

	public function passGen($pass){
		var_dump(password_hash($pass, PASSWORD_DEFAULT));
		die;
	}

	public function cekDatetime(){
		$tanggal = '2024-04-24';
		$start = '10:00';
		$end = '11:00';
		$rentang = 2;
		$nama_lab = 'Lab Prodi 2';

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

  		var_dump($jadwalInput);

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
  		echo $j;
	}

  public function printBAP(){
    $mpdf = new mPDF();
    $mpdf->WriteHTML('<h1>Hello world!</h1>');
    $mpdf->Output();
  }

  public function cek(){
    $data = $this->model->arrDataLabProdi3();
    
     for ($i=0; $i < count($data); $i++) { 
       var_dump($data[$i]);
       echo "<br><br>";
     }
    die;
  }

  private function get_token_from_api() {

    $curl = curl_init();

    curl_setopt_array($curl, array(
      CURLOPT_URL => "https://silabor.itera.ac.id/data/barangif",
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_ENCODING => "",
      CURLOPT_MAXREDIRS => 10,
      CURLOPT_TIMEOUT => 30,
      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
      CURLOPT_CUSTOMREQUEST => "POST",
      CURLOPT_POSTFIELDS => "{\n\"api_token\": \"[ADD YOUR TOKEN]\"\n}",
      CURLOPT_HTTPHEADER => array(
        "Accept: */*",
        "Cache-Control: no-cache",
        "Connection: keep-alive",
        "Content-Type: application/json",
      ),
    ));

    $response = curl_exec($curl);
    $err = curl_error($curl);

    curl_close($curl);

// Decode the response from the API

    $decoded_response_object = json_decode($response);

    curl_close($curl);

// Return the decoded response so you can use it to make another request
    return $decoded_response_object;

  }

  public function get_data_from_api() {

// Run the function that will make a POST request and return the token

    $exoclick_token = $this->get_token_from_api();

    var_dump($exoclick_token->token);
    die;

    $new_token = $exoclick_token->token;

    $auth_array = array(
      "Authorization:",
      "Bearer",
      $new_token
    );

    $new_token = implode(" ", $auth_array);

    $curl = curl_init();

    curl_setopt_array($curl, array(
      CURLOPT_URL => "https://silabor.itera.ac.id/data/barangif",
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_ENCODING => "",
      CURLOPT_MAXREDIRS => 10,
      CURLOPT_TIMEOUT => 30,
      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
      CURLOPT_CUSTOMREQUEST => "GET",
      CURLOPT_POSTFIELDS => "",
      CURLOPT_HTTPHEADER => array(
       $new_token,
       "Content-Type: application/json",
       "cache-control: no-cache"
     ),
    ));

    $response = curl_exec($curl);
    $err = curl_error($curl);

    $data = json_decode($response, true);

// do something with the data

    var_dump($data);
    die;
  }

  
}
