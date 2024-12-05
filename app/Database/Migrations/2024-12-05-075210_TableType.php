<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class TableType extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'type_name' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
                'null'       => false,
            ],
        ]);

        $this->forge->addKey('id', true);
        $this->forge->createTable('types');
    }

    public function down()
    {
        $this->forge->dropTable('types');
    }
}
