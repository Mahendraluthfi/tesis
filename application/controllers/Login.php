<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

	public function index()
	{
		if($this->auth->is_logged_in() == false){ 			       
        	$this->load->view('login');
        }else{
        	redirect('dashboard','refresh');
        }
	}

	public function submit()
	{
		$username = $this->input->post('username');
		$password = md5($this->input->post('password'));

		$cek = $this->db->get_where('user', array('username' => $username, 'password' => $password))->num_rows();
		if ($cek > 0) {
			$array = array(
					'username' => $username,
					'password' => $password
				);				
				$this->session->set_userdata( $array );	
				redirect('dashboard','refresh');
		}else{
			$this->session->set_flashdata('msg', '
				<div class="alert alert-danger">					
					<strong>Username atau Password salah !</strong>
				</div>
				');
			redirect('login','refresh');
		}
	}

	public function logout()
	{
		session_destroy();
		redirect('login','refresh');
	}

}

/* End of file Login.php */
/* Location: ./application/controllers/Login.php */