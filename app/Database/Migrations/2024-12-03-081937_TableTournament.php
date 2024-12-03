<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class TableTournament extends Migration
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
            'id_game' => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true,
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
        $this->forge->addForeignKey('id_game', 'game', 'id', 'CASCADE', 'CASCADE'); // Clé étrangère vers `game`
        $this->forge->addForeignKey('type', 'types', 'id', 'CASCADE', 'CASCADE'); // Clé étrangère vers `types`
        $this->forge->createTable('tournament');

    }

    public function down()
    {
        $this->forge->dropTable('tournament');
    }
}
