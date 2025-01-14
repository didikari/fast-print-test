<?php
defined('BASEPATH') or exit('No direct script access allowed');

class StatusController extends CI_Controller{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('StatusModel','statusM');
	}
	public function index()
    {
        $data = [
            'title' => 'Status',
            'status' => $this->statusM->get_all_statuses(),
            'content' => 'status/index',
            'menu_active' => 'status'
        ];
        $this->load->view('_layouts/main', $data);
    }

	public function add()
    {
        $data = array_merge(
            [
                'title' => 'Add Status',
                'content' => 'status/add',
                'menu_active' => 'status'
            ],
        );
        $this->load->view('_layouts/main', $data);
    }

	public function store()
    {
        if ($this->validate_status()) {
            $data = $this->get_status_data_from_post();

            $insert = $this->statusM->insert_status($data);

            if ($insert) {
                $this->session->set_flashdata('success', 'status berhasil ditambahkan!');
                redirect('status');
            } else {
                $this->session->set_flashdata('error', 'Gagal menyimpan status. Silakan coba lagi.');
                redirect('status/add');
            }
        } else {
            $this->add();
        }
		
    }

	public function edit($id)
    {
        $status = $this->statusM->getById($id);
        if (!$status) {
            show_404(); 
        }

        $data = array_merge(
            [
                'title' => 'Edit Status',
                'status' => $status,
                'content' => 'status/edit',
                'menu_active' => 'status'
            ],
        );

        if ($this->input->post()) {
            if ($this->update_status($id)) {
                $this->session->set_flashdata('success', 'status berhasil diperbarui!');
                redirect('status');
            } else {
                $this->session->set_flashdata('error', 'Gagal memperbarui status. Silakan coba lagi.');
            }
        }

        $this->load->view('_layouts/main', $data);
    }

	private function get_status_data_from_post()
    {
        return [
            'nama_status' => $this->input->post('nama_status'),
        ];
    }

	private function validate_status()
    {
        $this->form_validation->set_rules('nama_status', 'Nama status', 'required');

        return $this->form_validation->run();
    }

	private function update_status($id)
    {
        if ($this->validate_status()) {
            $data = $this->get_status_data_from_post();

            if ($this->statusM->update($data, $id)) {
                return true;
            } else {
                $this->session->set_flashdata('error', 'Gagal memperbarui status.');
                return false;
            }
        }

        return false;
    }

	public function destroy($id){
		$statusId = $this->statusM->getId($id)->id_status;
		if ($statusId) {
			$delete = $this->statusM->delete($statusId);
			if ($delete) {
				$this->session->set_flashdata('success', 'status berhasil dihapus.');
			} else {
				$this->session->set_flashdata('error', 'Gagal menghapus status.');
			}
		} else {
			$this->session->set_flashdata('error', 'status tidak ditemukan.');
		}
		
		redirect('status');
	 }
}
