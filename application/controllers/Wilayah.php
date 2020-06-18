<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Wilayah extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		if($this->auth->is_logged_in() == false){ 			       
        	redirect('login','refresh');
        }
	}

	public function index()
	{
		$data['get'] = $this->db->get('wilayah')->result();
		$data['content'] = 'wilayah';
		$this->load->view('index', $data);	
	}

	public function save()
	{
		$this->db->insert('wilayah', array(
			'kecamatan' => $this->input->post('kecamatan'),
			'latitude' => $this->input->post('latitude'),
			'longitude' => $this->input->post('longitude')
		));
		echo json_encode(array('status' => TRUE));
	}

	public function get($id)
	{
		$data = $this->db->get_where('wilayah', array('id_wilayah' => $id))->row();
		echo json_encode($data);
	}

	public function edit($id)
	{
		$this->db->where('id_wilayah', $id);
		$this->db->update('wilayah', array(
			'kecamatan' => $this->input->post('kecamatan'),
			'latitude' => $this->input->post('latitude'),
			'longitude' => $this->input->post('longitude')
		));

		echo json_encode(array('status' => TRUE));
	}

	public function delete($id)
	{
		# code...
		$this->db->where('id_wilayah', $id);
		$this->db->delete('wilayah');
		redirect('wilayah','refresh');
	}

	public function vmap($id)
	{
		$data['get'] = $this->db->get_where('wilayah', array('id_wilayah' => $id))->row();
		$data['content'] = 'wilayah_map';
		$this->load->view('index', $data);	
	}
}

/* End of file Wilayah.php */
/* Location: ./application/controllers/Wilayah.php */