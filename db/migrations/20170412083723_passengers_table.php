<?php

use Phinx\Migration\AbstractMigration;

class PassengersTable extends AbstractMigration
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
        $passenger = $this->table('passengers');
        $passenger->addColumn('name', 'string')
                  ->addColumn('title', 'string')
                  ->addColumn('phone', 'integer')
                  ->addColumn('email', 'string')
                  ->addColumn('address', 'string')
                  ->create();
    }
}
