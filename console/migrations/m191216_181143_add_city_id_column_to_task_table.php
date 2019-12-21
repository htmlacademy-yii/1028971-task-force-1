<?php

use yii\db\Migration;

/**
 * Handles adding columns to table `{{%task}}`.
 * Has foreign keys to the tables:
 *
 * - `{{%city}}`
 */
class m191216_181143_add_city_id_column_to_task_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%task}}', 'city_id', $this->integer());

        // creates index for column `city_id`
        $this->createIndex(
            '{{%idx-task-city_id}}',
            '{{%task}}',
            'city_id'
        );

        // add foreign key for table `{{%city}}`
        $this->addForeignKey(
            '{{%fk-task-city_id}}',
            '{{%task}}',
            'city_id',
            '{{%city}}',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        // drops foreign key for table `{{%city}}`
        $this->dropForeignKey(
            '{{%fk-task-city_id}}',
            '{{%task}}'
        );

        // drops index for column `city_id`
        $this->dropIndex(
            '{{%idx-task-city_id}}',
            '{{%task}}'
        );

        $this->dropColumn('{{%task}}', 'city_id');
    }
}
