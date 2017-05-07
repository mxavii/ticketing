<?php

use Phinx\Migration\AbstractMigration;

class TicketsTable extends AbstractMigration
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
        $tickets = $this->table('tickets');
        $tickets->addColumn('passenger_id', 'integer')
                ->addColumn('fare_id', 'integer')
                ->addColumn('issued', 'timestamp')
                ->addForeignKey('passenger_id', 'passengers', 'id', ['delete' => 'CASCADE', 'update' => 'NO_ACTION'])
                ->addForeignKey('fare_id', 'fares', 'id', ['delete' => 'CASCADE', 'update' => 'NO_ACTION'])
                ->create();
    }
}
