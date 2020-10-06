<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%user}}`.
 */
class m201002_024633_create_user_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
      $tableOptions = null;
      if ($this->db->driverName === 'psql') {
          // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
          $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
      }

      $this->createTable('{{%user}}', [
          'id' => $this->primaryKey(),
          'name' => $this->string()->notNull()->unique(),
          'auth_key' => $this->string(32)->notNull(),
          'password_hash' => $this->string()->notNull(),
          'password_reset_token' => $this->string()->unique(),
          'email' => $this->string()->notNull()->unique(),
          'isVerify' => $this->boolean()->notNull(),
          'status' => $this->smallInteger()->notNull()->defaultValue(10),
          'verification_token' => $this->string()->notNull(),
          'created_at' => $this->integer()->notNull(),
          'updated_at' => $this->integer()->notNull(),
      ], $tableOptions);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%user}}');
    }
}
