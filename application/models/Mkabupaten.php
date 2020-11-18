<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use GuzzleHttp\Client;

class Mkabupaten extends CI_Model {

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
		$response = $this->client->request('GET', 'provinsi', [
			'query'=>[
				'X-API-KEY' => $this->apikey
			]
		]);

		$result = json_decode($response->getBody()->getContents(), true);
		return $result['data'];
	}

	public function tampil_kabupaten()
	{
		$response = $this->client->request('GET', 'kabupaten', [
			'query' =>[
				'X-API-KEY'=> $this->apikey
			]
		]);

		$result = json_decode($response->getBody()->getContents(), true);
		return $result['data'];
	}

	public function search_kabupaten($input)
	{
		if ($input['selectProvinsi']=="semua") {
			
			$response = $this->client->request('GET', 'kabupaten', [
				'query' => [
					'X-API-KEY' => $this->apikey
				]
			]);
			
			$result = json_decode($response->getBody()->getContents(), true);
			return $result['data'];

		}
		else
		{
			$response = $this->client->request('GET', 'kabupaten', [
				'query' => [
					'X-API-KEY' => $this->apikey,
					'id_provinsi' => $input['selectProvinsi'],
					'id_kabupaten' => $input['selectKabupaten']
				]
			]);

			$result = json_decode($response->getBody()->getContents(), true);

			return $result['data'];
			
		}

	}

	
	public function tambah_kabupaten($input)
	{
		$prov=$this->input->post('id_provinsi');
		$kab=$this->input->post('nama_kabupaten');
		$jml=$this->input->post('jumlah_penduduk');

		$data = [
			"id_provinsi" => $prov,
			"nama_kabupaten" =>$kab,
			"jumlah_penduduk" =>$jml,
			"X-API-KEY" => $this->apikey
		];

		$response = $this->client->request('POST', 'kabupaten', [
			'form_params' => $data
		]);

		$result = json_decode($response->getBody()->getContents(), true);
		return $result;
	}

	public function detail_kabupaten($id)
	{
		$response = $this->client->request('GET', 'kabupaten', [
			'query' => [
				'X-API-KEY' => $this->apikey,
				'id_kabupaten' => $id
			]
		]);

		$result = json_decode($response->getBody()->getContents(), true);
		return $result['data'][0];
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
			"id_kabupaten" => $id,
			"id_provinsi" => $prov,
			"nama_kabupaten" =>$kab,
			"jumlah_penduduk" =>$jml,
			"X-API-KEY" => $this->apikey
		];
		$response = $this->client->request('PUT', 'kabupaten', [
			'form_params'=>$data
		]);

		$result = json_decode($response->getBody()->getContents(), true);
		return $result;
	}

	public function hapus_kabupaten($id)
	{
		$response = $this->client->request('DELETE', 'kabupaten', [
			'form_params' => [
				'X-API-KEY' => $this->apikey,
				'id_kabupaten' => $id
			]
		]);

		$result = json_decode($response->getBody()->getContents(), true);
		return $result;
	}

}

/* End of file Mkabupaten.php */
/* Location: ./application/models/Mkabupaten.php */
?>