<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class TableGame extends Migration
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
                'constraint' => 11,
                'unsigned'   => true,
                'null'       => false,
            ],
            'libelle' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
                'null'       => false,
            ],
            'category' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
                'null'       => true,
            ],
            'type' => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true,
                'null'       => false,
            ],
            'nb' => [
                'type'       => 'ENUM',
                'constraint' => ['user', 'admin'],
                'default'    => 'user',
            ],
        ]);

        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('id_category', 'categories', 'id', 'CASCADE', 'CASCADE'); // Clé étrangère vers `categories`
        $this->forge->addForeignKey('type', 'types', 'id', 'CASCADE', 'CASCADE'); // Clé étrangère vers `types`
        $this->forge->createTable('game');

    }

    public function down()
    {
        $this->forge->dropTable('game');
    }
}
