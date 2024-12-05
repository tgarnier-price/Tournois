<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class TableSchool extends Migration
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
            'id_category' => [
                'type'       => 'INT',
                'unsigned'   => true,
            ],
            'name' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
            ],
            'city' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
            ],
            'score' => [
                'type'       => 'INT',
                'unsigned'   => true,
                'default'    => 0
            ],
            'actif' => [
                'type'       => 'TINYINT',
                'constraint' => 1,
                'default'    => 0,
                'null'       => false
            ],
            'created_at' => [
                'type'       => 'DATETIME',
                'null'       => true,
            ],
            'updated_at' => [
                'type'       => 'DATETIME',
                'null'       => true,
            ],
            'deleted_at' => [
                'type'       => 'DATETIME',
                'null'       => true,
            ],
        ]);

        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('id_category', 'school_category', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('school');
    }

    public function down()
    {
        $this->forge->dropTable('school');
    }
}
