<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mprovinsi extends CI_Model 
	{

		public function tampil_provinsi()
		{	
			return $this->db->select('provinsi.id_provinsi,provinsi.nama_provinsi as nama_provinsi, SUM(kabupaten.jumlah_penduduk) as jumlah_penduduk')
			->join('kabupaten', 'kabupaten.id_provinsi = provinsi.id_provinsi', 'left')
			->group_by('provinsi.id_provinsi')
			->get('provinsi')->result_array();
		}

		public function detail_provinsi($id)
		{	
			return $this->db->where('id_provinsi', $id)
			->get('provinsi');
		}

		public function simpan_provinsi($input)
		{
			$nama=$input['nama_provinsi'];
			$data = [
				"nama_provinsi" => $nama
					];
			$this->db->insert("provinsi",$data);
		}

		public function update_provinsi($input,$id)
		{
						
			$data = [
				"nama_provinsi" => $input
					];

			$this->db->where('id_provinsi', $id);
			$this->db->update('provinsi', $data);

			return $this->db->affected_rows();


		}

		public function hapus_provinsi($id)
		{
			$this->db->where('id_provinsi', $id);
			$this->db->delete('provinsi');
		}



	}	

/* End of file Mprovinsi.php */
/* Location: ./application/models/Mprovinsi.php */
?>