<?php

class KategoriModel extends CI_Model {
    
	protected $table = 'kategori';
    public function get_kategori_id($kategori_name) {
		$query = $this->db->get_where($this->table, ['nama_kategori' => $kategori_name]);

        if ($query->num_rows() > 0) {
            return $query->row()->id_kategori;
        }
        
        $data = [
            'nama_kategori' => $kategori_name
        ];

        $this->db->insert($this->table, $data);

        return $this->db->insert_id();
    }

	public function get_all_categories(){
		return $this->db->get($this->table)->result_array();
	}

	public function getById($id)
	{
		return $this->db->where('id_kategori',$id)->get($this->table)->row_array();
	}


	public function insert_kategori($data){
		return $this->db->insert($this->table, $data);
	}

	public function update($data, $id)
	{
		$this->db->set($data);
		$this->db->where('id_kategori', $id);
		$this->db->update($this->table);

		if ($this->db->affected_rows() > 0) {
			return true;
		}
		return false;
	}

	public function delete($id){
	
		$this->db->where('id_kategori',$id);
		return $this->db->delete($this->table);
	}

	public function getId($id){
		return $this->db->get_where($this->table, ['id_kategori' => $id])->row();
	}

}
