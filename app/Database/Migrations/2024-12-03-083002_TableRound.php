<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class TableRound extends Migration
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
            'tournament_id' => [ // Foreign key
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true,
                'null'       => false,
            ],
            'name' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
                'null'       => false,
            ],
            'created_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'updated_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
        ]);

        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('tournament_id', 'tournament', 'id', 'CASCADE', 'CASCADE'); // Vérifiez que `tournament` existe
        $this->forge->createTable('round');

    }

    public function down()
    {
        $this->forge->dropTable('round');
    }
}
