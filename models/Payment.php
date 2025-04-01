<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "payment".
 *
 * @property int $id
 * @property int $order_id
 * @property float $amount
 * @property string $payment_date
 * @property string|null $created_at
 *
 * @property Order $order
 */
class Payment extends \yii\db\ActiveRecord
{


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'payment';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['order_id', 'amount', 'payment_date'], 'required'],
            [['order_id'], 'integer'],
            [['amount'], 'number'],
            [['payment_date', 'created_at'], 'safe'],
            [['order_id'], 'exist', 'skipOnError' => true, 'targetClass' => Order::class, 'targetAttribute' => ['order_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'order_id' => 'Номер заказа',
            'amount' => 'Сумма',
            'payment_date' => 'Дата оплаты',
            'created_at' => 'Created At',
        ];
    }

    /**
     * Gets query for [[Order]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getOrder()
    {
        return $this->hasOne(Order::class, ['id' => 'order_id']);
    }

}
