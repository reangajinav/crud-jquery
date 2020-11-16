<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mkabupaten extends CI_Model {

	public function tampil_provinsi()
	{
		return $this->db->get('provinsi')->result_array();
	}

	public function tampil_kabupaten()
	{
		return $this->db
		->join('provinsi p','p.id_provinsi=k.id_provinsi','left')
		->get('kabupaten k')
		->result_array();
	}

	public function search_kabupaten($inputan,$inputan2)
	{
		if ($inputan=="semua") {
			$inputan='';
			$inputan2='';
		}
		return $this->db
		->join('provinsi p','p.id_provinsi=k.id_provinsi','left')
		->where('k.id_provinsi', $inputan)
		->where('k.id_kabupaten', $inputan2)
		->get('kabupaten k')
		->result_array();
	}

	
	public function tambah_kabupaten($input)
	{
		$prov=$this->input->post('id_provinsi');
		$kab=$this->input->post('nama_kabupaten');
		$jml=$this->input->post('jumlah_penduduk');

		$data = [
					"id_provinsi" => $prov,
					"nama_kabupaten" =>$kab,
					"jumlah_penduduk" =>$jml
				];

		$this->db->insert('kabupaten', $data);
	}

	public function detail_kabupaten($id)
	{
		return $this->db
		->join('provinsi p','p.id_provinsi=k.id_provinsi','left')
		->where('k.id_kabupaten',$id)
		->get('kabupaten k')
		->row_array();
	}

	public function get_kabupaten($id)
	{
		return $this->db
		->join('provinsi p','p.id_provinsi=k.id_provinsi','left')
		->where('k.id_provinsi',$id)
		->get('kabupaten k')
		->result_array();
	}

	public function update_kabupaten($input,$id)
	{
		$prov=$this->input->post('id_provinsi');
		$kab=$this->input->post('nama_kabupaten');
		$jml=$this->input->post('jumlah_penduduk');

		$data = [
					"id_provinsi" => $prov,
					"nama_kabupaten" =>$kab,
					"jumlah_penduduk" =>$jml
				];
		$this->db->where('id_kabupaten', $id);
		$this->db->update('kabupaten', $data);
	}

	public function hapus_kabupaten($id)
	{
		$this->db->where('id_kabupaten', $id);
		$this->db->delete('kabupaten');
	}

}

/* End of file Mkabupaten.php */
/* Location: ./application/models/Mkabupaten.php */
 ?>