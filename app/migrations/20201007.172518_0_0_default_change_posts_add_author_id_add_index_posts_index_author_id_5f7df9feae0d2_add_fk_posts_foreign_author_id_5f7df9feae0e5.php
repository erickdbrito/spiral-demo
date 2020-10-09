<?php

namespace Migration;

use Spiral\Migrations\Migration;

class OrmDefault6ed5245c851ae87b527b06ccbdcf20da extends Migration
{
    protected const DATABASE = 'default';

    public function up()
    {
        $this->table('posts')
            ->addColumn('author_id', 'integer', [
                'nullable' => false,
                'default'  => null
            ])
            ->addIndex(["author_id"], [
                'name'   => 'posts_index_author_id_5f7df9feae0d2',
                'unique' => false
            ])
            ->addForeignKey(["author_id"], 'users', ["id"], [
                'name'   => 'posts_foreign_author_id_5f7df9feae0e5',
                'delete' => 'CASCADE',
                'update' => 'CASCADE'
            ])
            ->update();
    }

    public function down()
    {
        $this->table('posts')
            ->dropForeignKey(["author_id"])
            ->dropIndex(["author_id"])
            ->dropColumn('author_id')
            ->update();
    }
}
