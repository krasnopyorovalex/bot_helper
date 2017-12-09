<?php

namespace Bisaga\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20151117184031 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {

        $usersTable = $schema->createTable('users');

        $usersTable->addColumn('id', 'integer', ['unsigned' => true, 'autoincrement' => true]);

        $usersTable->addColumn('name', 'string', ['length' => 512]);
        $usersTable->addColumn('image', 'string', ['length' => 64]);
        $usersTable->addColumn('is_favorite', 'smallint', ['length' => 1, 'default' => 1]);

        $usersTable->setPrimaryKey(['id']);


        /////////////////////////////
        $messagesTable = $schema->createTable('messages');

        $messagesTable->addColumn('id', 'integer', ['unsigned' => true, 'autoincrement' => true]);
        $messagesTable->addColumn('user_id', 'integer', ['unsigned' => true]);
        $messagesTable->addColumn('message', 'string');
        $messagesTable->addColumn('status', 'smallint', ['length' => 1, 'default' => 1]);
        $messagesTable->addColumn('is_answer', 'smallint', ['length' => 1, 'default' => 0]);
        $messagesTable->addColumn('time', 'integer');

        $messagesTable->setPrimaryKey(['id']);

        $messagesTable->addForeignKeyConstraint($usersTable, array('user_id'),
            array('id'), array('onUpdate'=>'CASCADE', 'onDelete'=>'CASCADE'));

    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $schema->dropTable('users');
        $schema->dropTable('messages');
    }
}