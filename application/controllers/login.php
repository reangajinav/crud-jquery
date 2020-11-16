<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('MAdmin');
	}

	public function index()
	{
		$log = $this->input->post();
		if($log)
		{
			$hasil=$this->MAdmin->login_admin($log);
			if ($hasil) 
			{
				$this->session->set_flashdata("pesan","<script>
            swal({
            text: 'Login Berhasil',
            icon: 'success'
            });
        </script>");
				redirect('index','refresh');
			}
			else
			{
				$this->session->set_flashdata("pesan", "<script>
            swal({
            text: 'Login Gagal',
            icon: 'error'
            });
        </script>");
				redirect('login/index','refresh');
			}
			
		}

		$this->load->view('login.php');
	}

	public function logout()
	{
		$this->session->unset_userdata("admin");
		redirect('login/index','refresh');
	}

}

/* End of file login.php */
/* Location: ./application/controllers/login.php */ ?>