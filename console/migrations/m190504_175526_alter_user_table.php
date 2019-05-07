<?php

use yii\db\Migration;

/**
 * Class m190504_175526_alter_user_table
 */
class m190504_175526_alter_user_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function  Up()
    {
        $this->addColumn('{{%user}}','about',$this->text());
        $this->addColumn('{{%user}}','rating',$this->integer(6));
        $this->addColumn('{{%user}}','nickname',$this->string(30));
        $this->addColumn('{{%user}}','picture',$this->string());
    }

    /**
     * {@inheritdoc}
     */
    public function Down()
    {
        $this->dropColumn('{{%user}}','about');
        $this->dropColumn('{{%user}}','rating');
        $this->dropColumn('{{%user}}','nickname');
        $this->dropColumn('{{%user}}','picture');
    }


}
