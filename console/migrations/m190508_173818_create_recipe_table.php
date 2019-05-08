<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%recipe}}`.
 */
class m190508_173818_create_recipe_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function Up()
    {
        $this->createTable('{{%recipe}}', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer()->notNull(),
            'name' => $this->string()->notNull(),
            'filename' => $this->string()->notNull(),
            'description' => $this->text()->notNull(),
            'created_at' => $this->integer()->notNull(),
            'recipe' => $this->text()->notNull(),
            'ingredients'  => $this->text()->notNull(),
            'type' => $this->string(),
            'kitchen' => $this->string(),
            'calorie' => $this->integer(4),
            'difficulty' => $this->string(),
            'cooking_time' => $this->integer(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function Down()
    {
        $this->dropTable('{{%recipe}}');
    }
}
