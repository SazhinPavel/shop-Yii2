<?php

namespace app\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\db\Expression;

/**
 * This is the model class for table "order_table".
 *
 * @property int $id
 * @property string $created_att
 * @property string $updated_at
 * @property int $qty
 * @property int $sum
 * @property int $status
 * @property string $name
 * @property string $email
 * @property string $phone
 * @property string $address
 */
class OrderTable extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'order_table';
    }

    public function behaviors()
    {
        return [
            [
                'class' => TimestampBehavior::class,
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => ['created_at', 'updated_at'],
                    ActiveRecord::EVENT_BEFORE_UPDATE => ['updated_at'],
                ],
                // если вместо метки времени UNIX используется datetime:
                'value' => new Expression('NOW()'),
            ],
        ];
    }

    public function getOrderItem()
    {
        return $this->hasMany(OrderItem::class, ['order_id' => 'id']);
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            // правила для валидации
            [['name', 'phone',], 'required'],
            [['created_att', 'updated_at'], 'safe'],
            ['email', 'email'],
            [['qty', 'sum', 'status'], 'integer'],
            [['name', 'email', 'phone'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            // поля название формы
            'name' => 'Ваше имя',
            'email' => 'Email адрес (не обязательно, для получения заказа на email)',
            'phone' => 'Ваш телефон',
            //'address' => 'Адрес доставки',
        ];
    }
}
