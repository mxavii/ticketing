<?php

use Phinx\Migration\AbstractMigration;

class AuthTable extends AbstractMigration
{
    /**
     * Change Method.
     *
     * Write your reversible migrations using this method.
     *
     * More information on writing migrations is available here:
     * http://docs.phinx.org/en/latest/migrations.html#the-abstractmigration-class
     *
     * The following commands can be used in this method and Phinx will
     * automatically reverse them when rolling back:
     *
     *    createTable
     *    renameTable
     *    addColumn
     *    renameColumn
     *    addIndex
     *    addForeignKey
     *
     * Remember to call "create()" or "update()" and NOT "save()" when working
     * with the Table class.
     */
    public function change()
    {
        $auth = $this->table('auth');
        $auth->addColumn('agent_id', 'integer')
            ->addColumn('key', 'string')
            ->addColumn('expired', 'datetime')
            ->addColumn('login', 'integer', ['limit' => 1, 'default' => 0])
            ->addForeignKey('agent_id', 'agents', 'id', ['delete' => 'CASCADE', 'update' => 'NO_ACTION'])
            ->create();
    }
}
