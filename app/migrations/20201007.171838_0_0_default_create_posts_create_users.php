<?php

namespace Migration;

use Spiral\Migrations\Migration;

class OrmDefault476e6227c66c5f6ba3063c5cf458e1a6 extends Migration
{
    protected const DATABASE = 'default';

    public function up()
    {
        $this->table('posts')
            ->addColumn('id', 'primary', [
                'nullable' => false,
                'default'  => null
            ])
            ->addColumn('title', 'string', [
                'nullable' => false,
                'default'  => null,
                'size'     => 255
            ])
            ->addColumn('content', 'text', [
                'nullable' => false,
                'default'  => null
            ])
            ->setPrimaryKeys(["id"])
            ->create();
        
        $this->table('users')
            ->addColumn('id', 'primary', [
                'nullable' => false,
                'default'  => null
            ])
            ->addColumn('name', 'string', [
                'nullable' => false,
                'default'  => null,
                'size'     => 255
            ])
            ->setPrimaryKeys(["id"])
            ->create();
    }

    public function down()
    {
        $this->table('users')->drop();
        
        $this->table('posts')->drop();
    }
}
