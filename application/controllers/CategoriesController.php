<?php
defined('BASEPATH') or exit('No direct script access allowed');

class CategoriesController extends CI_Controller{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('KategoriModel','categoriesM');
	}
	public function index()
    {
        $data = [
            'title' => 'Categories',
            'categories' => $this->categoriesM->get_all_categories(),
            'content' => 'category/index',
            'menu_active' => 'categories'
        ];
        $this->load->view('_layouts/main', $data);
    }

	public function add()
    {
        $data = array_merge(
            [
                'title' => 'Add Categories',
                'content' => 'category/add',
                'menu_active' => 'categories'
            ],
        );
        $this->load->view('_layouts/main', $data);
    }

	public function store()
    {
        if ($this->validate_categories()) {
            $data = $this->get_categories_data_from_post();

            $insert = $this->categoriesM->insert_kategori($data);

            if ($insert) {
                $this->session->set_flashdata('success', 'Kategori berhasil ditambahkan!');
                redirect('categories');
            } else {
                $this->session->set_flashdata('error', 'Gagal menyimpan Kategori. Silakan coba lagi.');
                redirect('categories/add');
            }
        } else {
            $this->add();
        }
		
    }

	public function edit($id)
    {
        $categories = $this->categoriesM->getById($id);
        if (!$categories) {
            show_404(); 
        }

        $data = array_merge(
            [
                'title' => 'Edit Category',
                'categories' => $categories,
                'content' => 'category/edit',
                'menu_active' => 'categories'
            ],
        );

        if ($this->input->post()) {
            if ($this->update_categories($id)) {
                $this->session->set_flashdata('success', 'Kategori berhasil diperbarui!');
                redirect('categories');
            } else {
                $this->session->set_flashdata('error', 'Gagal memperbarui kategori. Silakan coba lagi.');
            }
        }

        $this->load->view('_layouts/main', $data);
    }

	private function get_categories_data_from_post()
    {
        return [
            'nama_kategori' => $this->input->post('nama_kategori'),
        ];
    }

	private function validate_categories()
    {
        $this->form_validation->set_rules('nama_kategori', 'Nama Kategori', 'required');

        return $this->form_validation->run();
    }

	private function update_categories($id)
    {
        if ($this->validate_categories()) {
            $data = $this->get_categories_data_from_post();

            if ($this->categoriesM->update($data, $id)) {
                return true;
            } else {
                $this->session->set_flashdata('error', 'Gagal memperbarui kategori.');
                return false;
            }
        }

        return false;
    }

	public function destroy($id){
		$categoriesId =$this->categoriesM->getId($id)->id_kategori;
		if ($categoriesId) {
			$delete = $this->categoriesM->delete($categoriesId);
			if ($delete) {
				$this->session->set_flashdata('success', 'Kategori berhasil dihapus.');
			} else {
				$this->session->set_flashdata('error', 'Gagal menghapus kategori.');
			}
		} else {
			$this->session->set_flashdata('error', 'Kategori tidak ditemukan.');
		}
		
		redirect('categories');
	 }
}
