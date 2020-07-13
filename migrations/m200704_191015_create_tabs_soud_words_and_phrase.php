<?php

use yii\db\Migration;

/**
 * Class m200704_191015_create_tabs_soud_words_and_phrase
 */
class m200704_191015_create_tabs_soud_words_and_phrase extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('sounds_words', [
 
            'id' => $this->primaryKey(),
         
            'ru' => $this->string(100),

            'en' => $this->string(100),
         
            'status' => $this->smallInteger(2)->defaultValue(1),
        ]);

         $this->createTable('sounds_phrases', [
 
            'id' => $this->primaryKey(),
         
            'ru' => $this->string(100)->notNull()->unique(),

            'en' => $this->string(100)->notNull()->unique(),
         
            'status' => $this->smallInteger(2)->defaultValue(1),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('sounds_words');
        $this->dropTable('sounds_phrases');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m200704_191015_create_tabs_soud_words_and_phrase cannot be reverted.\n";

        return false;
    }
    */
}
