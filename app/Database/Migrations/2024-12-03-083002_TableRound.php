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
            'id_user' => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true,
                'null'       => false,
            ],
            'id_gagnant' => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true,
                'null'       => false,
            ],
            'id_tournament' => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true,
                'null'       => true,
            ],
            'created_at' => [
                'type'       => 'DATETIME',
                'null'       => true,
            ],
        ]);

        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('id_user', 'users', 'id', 'CASCADE', 'CASCADE'); // Exemple de clé étrangère vers `users`
        $this->forge->addForeignKey('id_tournament', 'tournaments', 'id', 'CASCADE', 'CASCADE'); // Exemple de clé étrangère vers `tournaments`
        $this->forge->createTable('round');

    }

    public function down()
    {
        $this->forge->dropTable('round');
    }
}
