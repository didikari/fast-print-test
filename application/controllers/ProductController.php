<?php
defined('BASEPATH') or exit('No direct script access allowed');

class ProductController extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->load->model('ProdukModel', 'produkM');
        $this->load->model('KategoriModel', 'kategoriM');
        $this->load->model('StatusModel', 'statusM');
    }

    public function index()
    {
        $data = [
            'title' => 'Product',
            'products' => $this->produkM->getAll(),
            'content' => 'product/index',
            'menu_active' => 'product'
        ];
        $this->load->view('_layouts/main', $data);
    }

    public function add()
    {
        $data = array_merge(
            [
                'title' => 'Add Product',
                'content' => 'product/add',
                'menu_active' => 'product'
            ],
            $this->load_category_and_status_data()
        );
        $this->load->view('_layouts/main', $data);
    }

    public function store()
    {
        if ($this->validate_product()) {
            $data = $this->get_product_data_from_post();

            $insert = $this->produkM->insert_produk($data);

            if ($insert) {
                $this->session->set_flashdata('success', 'Produk berhasil ditambahkan!');
                redirect('product');
            } else {
                $this->session->set_flashdata('error', 'Gagal menyimpan produk. Silakan coba lagi.');
                redirect('product/add');
            }
        } else {
            $this->add();
        }
    }

    public function edit($id)
    {
        $product = $this->produkM->getById($id);
        if (!$product) {
            show_404(); 
        }

        $data = array_merge(
            [
                'title' => 'Edit Product',
                'product' => $product,
                'content' => 'product/edit',
                'menu_active' => 'product'
            ],
            $this->load_category_and_status_data()
        );

        if ($this->input->post()) {
            if ($this->update_product($id)) {
                $this->session->set_flashdata('success', 'Produk berhasil diperbarui!');
                redirect('product');
            } else {
                $this->session->set_flashdata('error', 'Gagal memperbarui produk. Silakan coba lagi.');
            }
        }

        $this->load->view('_layouts/main', $data);
    }

    private function update_product($id)
    {
        if ($this->validate_product()) {
            $data = $this->get_product_data_from_post();

            if ($this->produkM->update($data, $id)) {
                return true;
            } else {
                $this->session->set_flashdata('error', 'Gagal memperbarui produk.');
                return false;
            }
        }

        return false;
    }

    private function validate_product()
    {
        $this->form_validation->set_rules('nama_produk', 'Nama Produk', 'required');
        $this->form_validation->set_rules('kategori_id', 'Kategori', 'required');
        $this->form_validation->set_rules('harga', 'Harga', 'required|numeric');
        $this->form_validation->set_rules('status_id', 'Status', 'required');

        return $this->form_validation->run();
    }

    private function get_product_data_from_post()
    {
        return [
            'nama_produk' => $this->input->post('nama_produk'),
            'kategori_id' => $this->input->post('kategori_id'),
            'harga' => $this->input->post('harga'),
            'status_id' => $this->input->post('status_id'),
        ];
    }

	 private function load_category_and_status_data()
	 {
		 return [
			 'categories' => $this->kategoriM->get_all_categories(),
			 'statuses' => $this->statusM->get_all_statuses()
		 ];
	 }

	 public function destroy($id){
		$product = $this->db->get_where('produk', ['id_produk' => $id])->row_array();
    
		if ($product) {
			$this->db->where('id_produk', $id);
			$delete = $this->db->delete('produk');
			
			if ($delete) {
				$this->session->set_flashdata('success', 'Produk berhasil dihapus.');
			} else {
				$this->session->set_flashdata('error', 'Gagal menghapus produk.');
			}
		} else {
			$this->session->set_flashdata('error', 'Produk tidak ditemukan.');
		}
		
		redirect('product');
	 }
}
