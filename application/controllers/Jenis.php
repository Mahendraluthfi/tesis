<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Jenis extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		if($this->auth->is_logged_in() == false){ 			       
        	redirect('login','refresh');
        }
	}

	public function index()
	{
		$data['get'] = $this->db->get('jenis_kejahatan')->result();
		$data['content'] = 'jenis_kejahatan';
		$this->load->view('index', $data);	
	}

	public function save()
	{
		$this->db->insert('jenis_kejahatan', array(
			'jenis_kejahatan' => $this->input->post('jenis_kejahatan')
		));
		echo json_encode(array('status' => TRUE));
	}

	public function get($id)
	{
		$data = $this->db->get_where('jenis_kejahatan', array('id_jenis' => $id))->row();
		echo json_encode($data);
	}

	public function edit($id)
	{
		$this->db->where('id_jenis', $id);
		$this->db->update('jenis_kejahatan', array(
			'jenis_kejahatan' => $this->input->post('jenis_kejahatan')
		));

		echo json_encode(array('status' => TRUE));
	}

	public function delete($id)
	{
		# code...
		$this->db->where('id_jenis', $id);
		$this->db->delete('jenis_kejahatan');
		redirect('jenis','refresh');
	}

}

/* End of file Jenis.php */
/* Location: ./application/controllers/Jenis.php */