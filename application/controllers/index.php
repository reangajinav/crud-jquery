<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

class Index extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		// if(!$this->session->userdata('admin'))
		// {
		// 	redirect('login/index','refresh');
		// }
		$this->load->model('Mprovinsi');
		
	}


	public function index()
	{
		
		$this->load->view('header');
		$this->load->view('index');
		$this->load->view('footer');

	}

	public function ambil()
	{
		$data['provinsi'] =$this->Mprovinsi->tampil_provinsi();
		echo json_encode($data['provinsi']);
	}

	public function tambah()
	{
		$input['nama_provinsi'] = $this->input->post('nama_provinsi');
		if($input['nama_provinsi'] == null)
		{
			$result['pesan'] = 'nama provinsi harus di isi';
		}
		else
		{	
			$result['pesan']='';
			$this->Mprovinsi->simpan_provinsi($input);
		}		

		echo json_encode($result);
		
	}

	public function ambilId()
	{
		$id = $this->input->post('id_provinsi');
		$dataprovinsi = $this->Mprovinsi->detail_provinsi($id)->result();

		echo json_encode($dataprovinsi);
	}

	public function ubah()
	{

		$id = $this->input->post('id_provinsi');
		$input = $this->input->post('nama_provinsi');

		if($input == null)
		{
			$result['pesan'] = 'nama provinsi harus di isi';
		}
		else
		{	
			
			if($this->Mprovinsi->update_provinsi($input,$id) > 0)
			{
				$result['pesan']='';
			}
			else
			{
				$result['pesan']='gagal update';
			}

			
		}		

		echo json_encode($result);
	}

	public function hapus()
	{
		$id = $this->input->post('id_provinsi');
		$this->Mprovinsi->hapus_provinsi($id);
		
	}

}

/* End of file index.php */
/* Location: ./application/controllers/index.php */

?>