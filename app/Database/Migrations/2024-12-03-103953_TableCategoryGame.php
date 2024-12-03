<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class TableCategoryGame extends Migration
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
            'libelle' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
                'null'       => false,
            ],
        ]);

        $this->forge->addKey('id', true);
        $this->forge->createTable('categorygame');
    }

    public function down()
    {
        $this->forge->dropTable('categorygame');

    }
}
