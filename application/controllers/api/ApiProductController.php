<?php
defined('BASEPATH') or exit('No direct script access allowed');


class ApiProductController extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->database();
		$this->load->model('ProdukModel', 'produkM');
		$this->load->model('KategoriModel', 'kategoriM');
		$this->load->model('StatusModel', 'statusM');
		$this->load->helper('api');
		$this->load->helper('user');
	}

	public function store()
	{
		set_time_limit(0);

		ignore_user_abort(true);
		$url = 'https://recruitment.fastprint.co.id/tes/api_tes_programmer';
		$username = 'tesprogrammer150125C00';
		$password = 'bisacoding-15-01-25';

		$data_api = get_api_data($url, $username, $password);
		if ($data_api['error']) {
			$tanggal = date('d-m-y');
			$api_user = "https://recruitment.fastprint.co.id/tes/programmer";
			$userNew = extract_user_api($api_user);
			$passwordNew = "bisacoding-{$tanggal}";
			$data_api = get_api_data($url, $userNew, $passwordNew);
		}

		$new_data_added = false;

		if (!empty($data_api)) {
			foreach ($data_api['data'] as $item) {
				$kategori_id = $this->kategoriM->get_kategori_id($item['kategori']);
				$status_id = $this->statusM->get_status_id($item['status']);

				if ($kategori_id && $status_id) {
					$this->db->where('id_produk', $item['id_produk']);
					$existing_product = $this->db->get('produk')->row();

					if ($existing_product) {
						log_message('info', 'Produk sudah ada: ' . $item['nama_produk']);
					} else {
						$produk_data = [
							'id_produk'   => $item['id_produk'],
							'nama_produk' => $item['nama_produk'],
							'harga'       => $item['harga'],
							'kategori_id' => $kategori_id,
							'status_id'   => $status_id
						];

						$this->produkM->insert_produk($produk_data);
						$new_data_added = true;
						$this->session->set_flashdata('success', 'Data successfully inserted!');
					}
				} else {
					log_message('error', 'Kategori atau Status tidak ditemukan untuk produk: ' . $item['nama_produk']);
				}
			}

			if ($new_data_added) {
				$this->session->set_flashdata('success', 'Data successfully inserted!');
			} else {
				if ($data_api['error']) {
					$this->session->set_flashdata('warning', $data_api['ket']);
				}
			}
		} else {
			$this->session->set_flashdata('warning', 'No data received from API.');
		}
		redirect('product');
	}
}
