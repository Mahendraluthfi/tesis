<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mkejadian extends CI_Model {

	public function get()
		{
			$this->db->from('kejadian');
			$this->db->join('jenis_kejahatan', 'jenis_kejahatan.id_jenis = kejadian.id_jenis');
			$this->db->join('wilayah', 'wilayah.id_wilayah = kejadian.id_wilayah');
			$db = $this->db->get();
			return $db;
		}	

}

/* End of file Mkejadian.php */
/* Location: ./application/models/Mkejadian.php */