<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kabupaten extends CI_Controller {

	public function __construct()
	{
		parent:: __construct();
		$this->load->model('Mkabupaten');
	}
	
	public function index()
	{


		$this->load->view('header');
		$this->load->view('tampilkabupaten');
		$this->load->view('footer');


	}

	public function ambil()
	{
		$data['provinsi']=$this->Mkabupaten->tampil_provinsi();

		$data['kabupaten']=$this->Mkabupaten->tampil_kabupaten();

		$input= $this->input->post();


		if($input)
		{
			$inputan=$input['selectProvinsi'];
			$inputan2=$input['selectKabupaten'];
			$data['kabupaten']=$this->Mkabupaten->search_kabupaten($inputan,$inputan2);
		}

		echo json_encode($data);
	}

	public function tambah()
	{

		$input=$this->input->post();

		if($input)
		{

			$hasil = $this->Mkabupaten->tambah_kabupaten($input);
			if ($hasil > 0) 
			{
				$result['pesan']='';
			}
			else
			{
				$result['pesan']='gagal';
			}
		}
		echo json_encode($result);
	}

	public function ambilById()
	{
		$id = $this->input->post('id_kabupaten');
		$data['provinsi']=$this->Mkabupaten->tampil_provinsi();
		$data['kabupaten'] = $this->Mkabupaten->detail_kabupaten($id)->result();

		echo json_encode($data);
	}

	public function ubah()
	{
		$id = $this->input->post('id_kabupaten');
		$input=$this->input->post();
		if($input)
		{
			$hasil = $this->Mkabupaten->update_kabupaten($input, $id);
			if($hasil > 0)
			{
				$result['pesan']='';
			}
			else
			{
				$result['pesan']='gagal';
			}
		}

		echo json_encode($result);

	}

	public function hapus()
	{
		$id= $this->input->post('id_kabupaten');
		$this->Mkabupaten->hapus_kabupaten($id);
		
	}

	public function getLocation()
	{
		$id = $this->input->post('id');
		$getLocation = $this->Mkabupaten->get_Kabupaten($id);
		$list = "<option></option>";
		foreach($getLocation as $d){
			$list .= "<option value='".$d['id_kabupaten']."'>".$d['nama_kabupaten']."";
		}
		echo json_encode($list);

	}


}

/* End of file kabupaten.php */
/* Location: ./application/controllers/kabupaten.php */
