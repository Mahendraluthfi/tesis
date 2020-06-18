<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth
{
	protected $ci;

	public function __construct()
	{
        $this->ci =& get_instance();
	}

	function is_logged_in(){
      if($this->ci->session->userdata('username') == '' && $this->ci->session->userdata('password') == ''){
         return false;
      }      
      return true;
   }	

}

/* End of file Auth.php */
/* Location: ./application/libraries/Auth.php */
