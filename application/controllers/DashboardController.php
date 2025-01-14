<?php
defined('BASEPATH') or exit('No direct script access allowed');

class DashboardController extends CI_Controller{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('ProdukModel', 'productM');
	}
	public function index(){
		$data = [
			'title'=>'Dashboard',
			'content'=>'dashboard',
			'count'=> $this->productM->count_products_by_status(),
			'menu_active'=>'dashboard',
		];

		$this->load->view('_layouts/main',$data);
	}
}
