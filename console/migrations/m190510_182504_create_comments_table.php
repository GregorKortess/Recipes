<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%comments}}`.
 */
class m190510_182504_create_comments_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function Up()
    {
        $this->createTable('{{%comments}}', [
            'id' => $this->primaryKey(),
            'recipe_id' => $this->integer()->notNull(),
            'comment_text' => $this->text()->notNull(),
            'comment_author' => $this->string()->notNull(),
            'created_at' => $this->integer()->notNull(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function Down()
    {
        $this->dropTable('{{%comments}}');
    }
}
