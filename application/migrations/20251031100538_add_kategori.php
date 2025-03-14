<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Add_kategori extends CI_Migration {

        public function up()
        {
                $this->dbforge->add_field(array(
                        'id_kategori' => array(
                                'type' => 'INT',
                                'constraint' => 5,
                                'unsigned' => TRUE,
                                'auto_increment' => TRUE
                        ),
                        'nama_kategori' => array(
                                'type' => 'VARCHAR',
                                'constraint' => '100',
                        ),
                ));
                $this->dbforge->add_key('id_kategori', TRUE);
                $this->dbforge->create_table('kategori');
        }

        public function down()
        {
                $this->dbforge->drop_table('kategori');
        }
}
