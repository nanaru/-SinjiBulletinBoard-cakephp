<?php
declare(strict_types=1);

use Migrations\AbstractMigration;

class CreateUsers extends AbstractMigration
{
    /**
     * Change Method.
     *
     * More information on this method is available here:
     * https://book.cakephp.org/phinx/0/en/migrations.html#the-change-method
     * @return void
     */
    public function change(): void
    {
        $table = $this->table('users');
        $table->addColumn('cognito_sub', 'string', ['limit' => 255, 'null' => false])
            ->addColumn('name', 'string', ['limit' => 10, 'null' => false])
            ->addColumn('profile', 'string', ['limit' => 140, 'default' => '', 'null' => false])
            ->addColumn('icon', 'string', ['limit' => 255, 'default' => '', 'null' => false])
            ->addColumn('created', 'timestamp', ['default' => 'CURRENT_TIMESTAMP', 'limit' => null, 'null' => false])
            ->addColumn('modified', 'timestamp', ['default' => 'CURRENT_TIMESTAMP', 'update' => 'CURRENT_TIMESTAMP', 'limit' => null, 'null' => false])
            ->addIndex('cognito_sub', ['unique' => true])
            ->create();
    }
}
