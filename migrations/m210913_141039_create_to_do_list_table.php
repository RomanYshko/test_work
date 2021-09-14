<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%to_do_list}}`.
 */
class m210913_141039_create_to_do_list_table extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%to_do_list}}', [
            'id' => $this->primaryKey(),
            'task' => $this->string()->notNull(),
            'responsible' => $this->string(60)->notNull(),
            'term' => $this->date(),
            'status' => $this->string()->notNull(),
        ], $tableOptions);
    }

    public function down()
    {
        $this->dropTable('{{%to_do_list}}');
    }
}
