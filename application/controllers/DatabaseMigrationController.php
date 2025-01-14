<?php
defined('BASEPATH') or exit('No direct script access allowed');

class DatabaseMigrationController extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function migrate()
    {
        $this->load->library('migration');

        if ($this->migration->latest()) {
            echo "Migrasi berhasil dijalankan.";
        } else {
            echo "Terjadi kesalahan saat menjalankan migrasi: " . $this->migration->error_string();
        }
    }
}
