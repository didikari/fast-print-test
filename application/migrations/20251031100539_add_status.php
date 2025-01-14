<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Add_status extends CI_Migration {

        public function up()
        {
                $this->dbforge->add_field(array(
                        'id_status' => array(
                                'type' => 'INT',
                                'constraint' => 5,
                                'unsigned' => TRUE,
                                'auto_increment' => TRUE
                        ),
                        'nama_status' => array(
                                'type' => 'VARCHAR',
                                'constraint' => '100',
                        ),
                ));
                $this->dbforge->add_key('id_status', TRUE);
                $this->dbforge->create_table('status');
        }

        public function down()
        {
                $this->dbforge->drop_table('status');
        }
}
