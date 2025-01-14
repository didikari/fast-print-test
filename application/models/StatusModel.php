<?php 

class StatusModel extends CI_Model {
    protected $table = 'status';
	public function get_status_id($status_name) {
		$query = $this->db->get_where($this->table, ['nama_status' => $status_name]);

        if ($query->num_rows() > 0) {
            return $query->row()->id_status; 
        }
        
        $data = [
            'nama_status' => $status_name
        ];

        $this->db->insert($this->table, $data);

        return $this->db->insert_id();
    }

	public function get_all_statuses(){
		return $this->db->get($this->table)->result_array();
	}

	public function getById($id)
	{
		return $this->db->where('id_status',$id)->get($this->table)->row_array();
	}


	public function insert_status($data){
		return $this->db->insert($this->table, $data);
	}

	public function update($data, $id)
	{
		$this->db->set($data);
		$this->db->where('id_status', $id);
		$this->db->update($this->table);

		if ($this->db->affected_rows() > 0) {
			return true;
		}
		return false;
	}

	public function delete($id){
	
		$this->db->where('id_status',$id);
		return $this->db->delete($this->table);
	}

	public function getId($id){
		return $this->db->get_where($this->table, ['id_status' => $id])->row();
	}

}
