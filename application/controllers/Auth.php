<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {
	public function index(){
		
		$this->load->view('y_views/auth/index');
	}

	public function login(){
		$id=$this->input->post('email');
		$password=$this->input->post('password');

		$email=$this->db->get_where('user',['email'=>$id])->row_array();
		if($email){
				if(password_verify($password, $email['password'])){
					$data=[
						'id_user' =>$email['id_user'],
						'email'=>$email['email'],
						'nama'=>$email['nama'],
						'role_id'=>$email['role_id']
					];
					
					$this->session->set_userdata($data);
					redirect('dashboard');
			}else{
				redirect('auth');
		
			}
		}else{
			redirect('auth');
		}
	}

	public function logout(){
		$this->session->unset_userdata('id_user');
		$this->session->unset_userdata('email');
		$this->session->unset_userdata('nama');
		$this->session->unset_userdata('role_id');

		redirect('home');
	}
}
