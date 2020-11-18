<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use GuzzleHttp\Client;

class Mprovinsi extends CI_Model 
{
	private $client;
	public $apikey = 'testapikey';

	public function __construct()
	{
		$this->client = new Client([
			'base_uri' => 'http://localhost/restfull-api/api/'
		]);
	}

	public function tampil_provinsi()
	{	
			// return $this->db->select('provinsi.id_provinsi,provinsi.nama_provinsi as nama_provinsi, SUM(kabupaten.jumlah_penduduk) as jumlah_penduduk')
			// ->join('kabupaten', 'kabupaten.id_provinsi = provinsi.id_provinsi', 'left')
			// ->group_by('provinsi.id_provinsi')
			// ->get('provinsi')->result_array();
		$response = $this->client->request('GET', 'provinsi', [
			'query' => [
				'X-API-KEY' => $this->apikey
			]
		]);

		$result = json_decode($response->getBody()->getContents(), true);
		return $result['data'];
	}

	public function detail_provinsi($id)
	{	
		$response = $this->client->request('GET', 'provinsi',
			['query' => [
				'X-API-KEY'=> $this->apikey,
				'id_provinsi' => $id
			]
		]);
		$result = json_decode($response->getBody()->getContents(), true);
		return $result['data'][0];
	}

	public function simpan_provinsi($input)
	{
		$nama=$input['nama_provinsi'];
		$data = [
			"nama_provinsi" => $nama,
			"X-API-KEY" => $this->apikey
		];
		$response = $this->client->request('POST', 'provinsi', [
			'form_params' => $data
		]);
		$result = json_decode($response->getBody()->getContents(), true);
		return $result;
		// $this->db->insert("provinsi",$data);
	}

	public function update_provinsi($input,$id)
	{

		
		$data = [
			"nama_provinsi" => $input,
			"id_provinsi" => $id,
			"X-API-KEY" => $this->apikey
		];

		$response = $this->client->request('PUT', 'provinsi', [
			'form_params' => $data
		]);

		$result = json_decode($response->getBody()->getContents(), true);

		return $result;


	}

	public function hapus_provinsi($id)
	{
		$result = $this->client->request('DELETE', 'provinsi', [
			'form_params'=>[
				'X-API-KEY' => $this->apikey,
				'id_provinsi' => $id
			]
		]);

		return $result;
	}

}	

/* End of file Mprovinsi.php */
/* Location: ./application/models/Mprovinsi.php */
?>