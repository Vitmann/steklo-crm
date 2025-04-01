<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "contacts".
 *
 * @property int $id
 * @property int $client_id
 * @property string $name
 * @property string|null $post
 * @property string|null $phone
 * @property string|null $comment
 *
 * @property Client $client
 */
class Contact extends \yii\db\ActiveRecord
{


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'contacts';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['post', 'phone', 'comment'], 'default', 'value' => null],
            [['client_id', 'name'], 'required'],
            [['client_id'], 'integer'],
            [['comment'], 'string'],
            [['name', 'post'], 'string', 'max' => 255],
            [['phone'], 'string', 'max' => 50],
            [['client_id'], 'exist', 'skipOnError' => true, 'targetClass' => Client::class, 'targetAttribute' => ['client_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'client_id' => 'Client ID',
            'name' => 'ФИО',
            'post' => 'Должность',
            'phone' => 'Телефон',
            'comment' => 'Комментарий',
        ];
    }

    /**
     * Gets query for [[Client]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getClient()
    {
        return $this->hasOne(Client::class, ['id' => 'client_id']);
    }

}
