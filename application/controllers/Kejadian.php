<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kejadian extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		if($this->auth->is_logged_in() == false){ 			       
        	redirect('login','refresh');
        }
        $this->load->model('Mkejadian');
	}

	public function index()
	{
		$data['wilayah'] = $this->db->get('wilayah')->result();
		$data['jenis'] = $this->db->get('jenis_kejahatan')->result();
		$data['get'] = $this->Mkejadian->get()->result();
		$data['content'] = 'kejadian';
		$this->load->view('index', $data);	
	}

	public function save()
	{
		$this->db->insert('kejadian', array(
			'id_wilayah' => $this->input->post('id_wilayah'),
			'id_jenis' => $this->input->post('id_jenis'),
			'date' => $this->input->post('date'),
			'uraian' => $this->input->post('uraian'),
			'tersangka' => $this->input->post('tersangka')
		));
		echo json_encode(array('status' => TRUE));
	}

	public function get($id)
	{
		$data = $this->db->get_where('kejadian', array('id' => $id))->row();
		echo json_encode($data);
	}

	public function edit($id)
	{
		$this->db->where('id', $id);
		$this->db->update('kejadian', array(
			'id_wilayah' => $this->input->post('id_wilayah'),
			'id_jenis' => $this->input->post('id_jenis'),
			'date' => $this->input->post('date'),
			'uraian' => $this->input->post('uraian'),
			'tersangka' => $this->input->post('tersangka')
		));

		echo json_encode(array('status' => TRUE));
	}

	public function delete($id)
	{
		# code...
		$this->db->where('id', $id);
		$this->db->delete('kejadian');
		redirect('kejadian','refresh');
	}

}

/* End of file Kejadian.php */
/* Location: ./application/controllers/Kejadian.php */