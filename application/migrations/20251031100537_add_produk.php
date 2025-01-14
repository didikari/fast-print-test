<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Add_produk extends CI_Migration {

        public function up()
        {
                $this->dbforge->add_field(array(
                        'id_produk' => array(
                                'type' => 'INT',
                                'constraint' => 11,
                                'unsigned' => TRUE,
                                'auto_increment' => TRUE
                        ),
                        'nama_produk' => array(
                                'type' => 'VARCHAR',
                                'constraint' => '255',
                        ),
                        'harga' => array(
                                'type' => 'double',
                                'null' => TRUE,
                        ),
                        'kategori_id' => array(
                                'type' => 'int',
                                'null' => TRUE,
                        ),
                        'status_id' => array(
                                'type' => 'int',
                                'null' => TRUE,
                        ),
                ));
                $this->dbforge->add_key('id_produk', TRUE);
                $this->dbforge->create_table('produk');
        }

        public function down()
        {
                $this->dbforge->drop_table('produk');
        }
}
