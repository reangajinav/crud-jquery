<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MAdmin extends CI_Model {

	function login_admin($input)
	{
		$username = $input['username'];
		$password = $input['password'];

		$this->db->where('username', $username);
		$this->db->where('password', $password);
		$cek=$this->db->get('admin');

		if($cek->num_rows() > 0)
		{
			$this->session->set_userdata('admin',$cek->row_array());
			return true;
		}
		else
		{
			return false;
		}
	}
	

}

/* End of file MAdmin.php */
/* Location: ./application/models/MAdmin.php */ ?>