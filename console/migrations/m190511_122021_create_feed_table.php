<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%feed}}`.
 */
class m190511_122021_create_feed_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function Up()
    {
        $this->createTable('{{%feed}}', [
            'id' => $this->primaryKey(),
            'author_id' => $this->integer(),
            'author_name' => $this->string(),
            'author_nickname' => $this->integer(70),
            'author_picture' => $this->string(),
            'recipe_id' => $this->integer(),
            'recipe_filename' => $this->string()->notNull(),
            'recipe_description' => $this->text(),
            'post_created_at' => $this->integer()->notNull(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function Down()
    {
        $this->dropTable('{{%feed}}');
    }
}
