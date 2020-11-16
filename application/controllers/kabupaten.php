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
			$data['provinsi']=$this->Mkabupaten->tampil_provinsi();
			
			$data['kabupaten']=$this->Mkabupaten->tampil_kabupaten();

			$input= $this->input->post();
				
			
			if($input)
			{
				$inputan=$input['selectProvinsi'];
				$inputan2=$input['selectKabupaten'];
				$data['kabupaten']=$this->Mkabupaten->search_kabupaten($inputan,$inputan2);
			}

			$this->load->view('header');
			$this->load->view('tampilkabupaten', $data);
			$this->load->view('footer');


		}

		public function tambah()
		{

			$input=$this->input->post();
			
			if($input)
			{
				$this->Mkabupaten->tambah_kabupaten($input);
				redirect('kabupaten/index','refresh');
			}

			$prov['provinsi']=$this->Mkabupaten->tampil_provinsi();

			$this->load->view('header');
			$this->load->view('tambahkabupaten', $prov);
			$this->load->view('footer');
		}

		public function ubah($id)
		{
			$data["provinsi"]=$this->Mkabupaten->tampil_provinsi();
			$data["kabupaten"]=$this->Mkabupaten->detail_kabupaten($id);

			$input=$this->input->post();
			if($input)
			{
				$this->Mkabupaten->update_kabupaten($input, $id);
				redirect('kabupaten/index','refresh');
			}

			$this->load->view('header');
			$this->load->view('editkabupaten', $data);
			$this->load->view('footer');
		}

		public function hapus($id)
		{
			$this->Mkabupaten->hapus_kabupaten($id);
			redirect('kabupaten/index','refresh');
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
