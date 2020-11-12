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
          'username' => $this->string()->notNull()->unique(),
          'name' => $this->string()->notNull(),
          'nip' => $this->string()->notNull()->unique(),
          'password_hash' => $this->string()->notNull(),
          'role' => $this->smallInteger()->notNull(),
          'images_id' => $this->smallInteger()->notNull(),
          'tgl_lahir' => $this->date()->notNull(),
          'status' => $this->smallInteger()->notNull()->defaultValue(10),
          'is_online' => $this->boolean()->notNull(),
          'auth_key' => $this->string()->notNull(),
          'verification_token' => $this->string()->notNull(),
          'created_at' => $this->integer()->notNull(),
          'updated_at' => $this->integer()->notNull(),
      ], $tableOptions);


      $this->createTable('{{%role}}', [
          'id' => $this->primaryKey(),
          'name' => $this->string()->notNull(),
      ], $tableOptions);

      $this->insert('{{%role}}', [
          'name' => 'Set Up Man',
      ]);
      $this->insert('{{%role}}', [
          'name' => 'Maintenance',
      ]);
      $this->insert('{{%role}}', [
          'name' => 'Quality Control',
      ]);
      $this->insert('{{%role}}', [
          'name' => 'Superior QC',
      ]);
      $this->insert('{{%role}}', [
          'name' => 'Superior MT',
      ]);

      $this->addForeignKey(
          'fk-role-role_id',
          '{{%user}}',
          'role',
          '{{%role}}',
          'id',
          'CASCADE'
      );

      $this->createTable('{{%task}}', [
          'id' => $this->primaryKey(),
          'from_id' => $this->smallInteger()->notNull(),
          'to_id' => $this->smallInteger(),
          'jenis_task' => $this->string()->notNull(),
          'line_id' => $this->smallInteger()->notNull(),
          'deskripsi' => $this->string()->notNull(),
          'status_id' => $this->smallInteger()->notNull(),
          'created_at' => $this->integer()->notNull(),
          'updated_at' => $this->integer()->notNull(),
      ], $tableOptions);

      $this->createTable('{{%notifikasi}}', [
          'id' => $this->primaryKey(),
          'for_id' => $this->smallInteger()->notNull(),
          'task_id' => $this->smallInteger()->notNull(),
          'is_read' => $this->boolean()->notNull(),
          'created_at' => $this->integer()->notNull(),
          'updated_at' => $this->integer()->notNull(),
      ], $tableOptions);

      $this->createTable('{{%images}}', [
          'id' => $this->primaryKey(),
          'filename' => $this->string()->notNull(),
          'path' => $this->string()->notNull(),
          'created_at' => $this->integer()->notNull(),
          'updated_at' => $this->integer()->notNull(),
      ], $tableOptions);

      $this->addForeignKey(
          'fk-user-from_id',
          '{{%task}}',
          'from_id',
          '{{%user}}',
          'id',
          'CASCADE'
      );

      $this->addForeignKey(
          'fk-user-to_id',
          '{{%task}}',
          'to_id',
          '{{%user}}',
          'id',
          'CASCADE'
      );

      $this->addForeignKey(
          'fk-images-images_id',
          '{{%user}}',
          'images_id',
          '{{%images}}',
          'id',
          'CASCADE'
      );

      $this->addForeignKey(
          'fk-task-id',
          '{{%notifikasi}}',
          'task_id',
          '{{%task}}',
          'id',
          'CASCADE'
      );

      $this->addForeignKey(
          'fk-user-id',
          '{{%notifikasi}}',
          'for_id',
          '{{%user}}',
          'id',
          'CASCADE'
      );

      $this->insert('{{%images}}', [
          'filename' => 'avatar.png',
          'path' => '/storage/avatar/default/avatar.svg',
          'created_at' => strtotime(date("Y-m-d H:i:s")),
          'updated_at' => strtotime(date("Y-m-d H:i:s")),
      ]);

      $this->createTable('{{%status}}', [
          'id' => $this->primaryKey(),
          'name' => $this->string()->notNull(),
      ], $tableOptions);

      $this->createTable('{{%line}}', [
          'id' => $this->primaryKey(),
          'name' => $this->string()->notNull(),
      ], $tableOptions);

      $this->addForeignKey(
          'fk-status-status_id',
          '{{%task}}',
          'status_id',
          '{{%status}}',
          'id',
          'CASCADE'
      );

      $this->addForeignKey(
          'fk-line-line_id',
          '{{%task}}',
          'line_id',
          '{{%line}}',
          'id',
          'CASCADE'
      );

      $this->insert('{{%status}}', [
          'name' => 'Diajukan',
      ]);
      $this->insert('{{%status}}', [
          'name' => 'Diterima',
      ]);
      $this->insert('{{%status}}', [
          'name' => 'Dikerjakan',
      ]);
      $this->insert('{{%status}}', [
          'name' => 'Selesai',
      ]);
      $this->insert('{{%status}}', [
          'name' => 'Tidak Selesai',
      ]);

      $this->insert('{{%user}}', [
        'id' => 1,
        'username' => 'superior.mt',
        'name' => 'Superior MT',
        'nip' => '0000000001',
        'password_hash' => '$2y$13$OQZTBWrWj60vaNYJmTqt9eDS7rA7EmGV5YkVkGl29qEWjLo2yrtki',
        'role' => 5,
        'images_id' => 1,
        'tgl_lahir' => '2020-11-09',
        'status' =>10,
        'is_online' => False,
        'auth_key' => 'M4kServhSo_f64HQB4m4l6kDEXjdRel_',
        'verification_token' => 'htov_h7GRcvBZ-1pBhFszIoErDdezmmZ_1604923983',
        'created_at' => 1604923983,
        'updated_at' => 1604923983,
      ]);

      $this->insert('{{%user}}', [
        'id' => 2,
        'username' => 'superior.qc',
        'name' => 'Superior QC',
        'nip' => '0000000002',
        'password_hash' => '$2y$13$OQZTBWrWj60vaNYJmTqt9eDS7rA7EmGV5YkVkGl29qEWjLo2yrtki',
        'role' => 4,
        'images_id' => 1,
        'tgl_lahir' => '2020-11-09',
        'status' =>10,
        'is_online' => False,
        'auth_key' => 'GTl-D2d5g56-uqD3VinAsj424-juooG6',
        'verification_token' => 'ayxFqXIqVq1ErbVEA6lB6Av0UyKcKqIG_1604924011',
        'created_at' => 1604923983,
        'updated_at' => 1604923983,
      ]);

      $this->insert('{{%user}}', [
        'id' => 3,
        'username' => 'haryandra.fatwa',
        'name' => 'Haryandra Fatwa',
        'nip' => '1301174007',
        'password_hash' => '$2y$13$nbYUFajx0eE3r5dS/IZvn.tqXKe4zsUaVJLPOBsbEcxTkRNwuDtjK',
        'role' => 2,
        'images_id' => 1,
        'tgl_lahir' => '1999-05-28',
        'status' =>10,
        'is_online' => False,
        'auth_key' => '11c4MbJA0vzybc8g1WGkE37BzT515iQ0',
        'verification_token' => '9noSY3fpro7vYJQIY_Ss5ckUPUf4OcUq_1604992727',
        'created_at' => 1604923983,
        'updated_at' => 1604923983,
      ]);

      $this->insert('{{%user}}', [
        'id' => 4,
        'username' => 'aditya.maulana',
        'name' => 'Aditya Maulana',
        'nip' => '1301174309',
        'password_hash' => '$2y$13$SvV8m3iZ.40RR9jztw5soeq.e7LLl7Q1UznDrJFcqwnTSHdEiPhCu',
        'role' => 1,
        'images_id' => 1,
        'tgl_lahir' => '1998-08-09',
        'status' =>10,
        'is_online' => False,
        'auth_key' => 'T8fWy66vSgqW3iYV2By9BpvUH99B8zLT',
        'verification_token' => 'PkTOvgTFPAZnD1mjyWz3rYOvAzddq8H1_1604992760',
        'created_at' => 1604923983,
        'updated_at' => 1604923983,
      ]);

      $this->insert('{{%user}}', [
        'id' => 5,
        'username' => 'lazuardi.azhar',
        'name' => 'Lazuardi Azhar',
        'nip' => '1301174368',
        'password_hash' => '$2y$13$SvV8m3iZ.40RR9jztw5soeq.e7LLl7Q1UznDrJFcqwnTSHdEiPhCu',
        'role' => 2,
        'images_id' => 1,
        'tgl_lahir' => '1998-08-09',
        'status' =>10,
        'is_online' => False,
        'auth_key' => 'T8fWy66vSgqW3iYV2By9BpvUH99B8zLT',
        'verification_token' => 'PkTOvgTFPAZnD1mjyWz3rYOvAzddq8H1_1604992760',
        'created_at' => 1604923983,
        'updated_at' => 1604923983,
      ]);

      $this->insert('{{%line}}', [
          'name' => 'TUP 01',
      ]);
      $this->insert('{{%line}}', [
          'name' => 'TUP 02',
      ]);
      $this->insert('{{%line}}', [
          'name' => 'TUP 03',
      ]);
      $this->insert('{{%line}}', [
          'name' => 'TUP 04',
      ]);
      $this->insert('{{%line}}', [
          'name' => 'TUP 05',
      ]);
      $this->insert('{{%line}}', [
          'name' => 'TUP 06',
      ]);
      $this->insert('{{%line}}', [
          'name' => 'TUP 07',
      ]);
      $this->insert('{{%line}}', [
          'name' => 'TUP 08',
      ]);
      $this->insert('{{%line}}', [
          'name' => 'TUP 09',
      ]);
      $this->insert('{{%line}}', [
          'name' => 'BOP 01',
      ]);
      $this->insert('{{%line}}', [
          'name' => 'BOP 02',
      ]);
      $this->insert('{{%line}}', [
          'name' => 'BOP 03',
      ]);
      $this->insert('{{%line}}', [
          'name' => 'BOP 04',
      ]);
      $this->insert('{{%line}}', [
          'name' => 'BOP 05',
      ]);
      $this->insert('{{%line}}', [
          'name' => 'BOP 06',
      ]);
      $this->insert('{{%line}}', [
          'name' => 'BOP 07',
      ]);
      $this->insert('{{%line}}', [
          'name' => 'BOP 08',
      ]);
      $this->insert('{{%line}}', [
          'name' => 'BOP 09',
      ]);
      $this->insert('{{%line}}', [
          'name' => 'BOP 10',
      ]);
      $this->insert('{{%line}}', [
          'name' => 'JAP 01',
      ]);
      $this->insert('{{%line}}', [
          'name' => 'JAP 02',
      ]);
      $this->insert('{{%line}}', [
          'name' => 'JAP 03',
      ]);
      $this->insert('{{%line}}', [
          'name' => 'EMP 01',
      ]);
      $this->insert('{{%line}}', [
          'name' => 'EMP 03',
      ]);
      $this->insert('{{%line}}', [
          'name' => 'EMP 05',
      ]);
      $this->insert('{{%line}}', [
          'name' => 'EMP 06',
      ]);
      $this->insert('{{%line}}', [
          'name' => 'EMP 07',
      ]);
      $this->insert('{{%line}}', [
          'name' => 'EMP 15',
      ]);
      $this->insert('{{%line}}', [
          'name' => 'LQP 04',
      ]);
      $this->insert('{{%line}}', [
          'name' => 'EMP 01',
      ]);
      $this->insert('{{%line}}', [
          'name' => 'OSP 01',
      ]);
      $this->insert('{{%line}}', [
          'name' => 'BLP 01',
      ]);
      $this->insert('{{%line}}', [
          'name' => 'BLP 02',
      ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%notifikasi}}');
        $this->dropTable('{{%task}}');
        $this->dropTable('{{%user}}');
        $this->dropTable('{{%role}}');
        $this->dropTable('{{%images}}');
        $this->dropTable('{{%line}}');
        $this->dropTable('{{%status}}');
    }
}
