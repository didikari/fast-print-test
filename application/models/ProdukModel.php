<?php

class ProdukModel extends CI_Model
{

	protected $table = 'produk';

	public function insert_produk($data)
	{
		$this->db->insert($this->table, $data);
		return $this->db->insert_id();
	}

	public function getAll()
	{
		$this->db->select('produk.*, kategori.nama_kategori');
		$this->db->from('produk');
		$this->db->join('kategori', 'kategori.id_kategori = produk.kategori_id');
		$this->db->where('produk.status_id', 1);
		return $this->db->get()->result_array();
	}

	public function getById($id)
	{
		$this->db->select('produk.*, kategori.nama_kategori, status.nama_status');
		$this->db->from('produk');
		$this->db->join('kategori', 'kategori.id_kategori = produk.kategori_id', 'left');
		$this->db->join('status', 'status.id_status = produk.status_id', 'left');
		$this->db->where('produk.id_produk', $id);
		return $this->db->get()->row_array();
	}

	public function update($data, $id)
	{
		$this->db->set($data);
		$this->db->where('id_produk', $id);
		$this->db->update($this->table);

		if ($this->db->affected_rows() > 0) {
			return true;
		}
		return false;
	}

	public function delete($id)
	{
		$this->db->where('id_produk', $id);
		return $this->db->delete($this->table);
	}

	public function count_products_by_status()
	{
		$this->db->where('status_id', 1);
		$count_status_1 = $this->db->count_all_results('produk');

		$this->db->where('status_id', 2);
		$count_status_2 = $this->db->count_all_results('produk');

		return [
			'status_1' => $count_status_1,
			'status_2' => $count_status_2,
		];
	}
}
