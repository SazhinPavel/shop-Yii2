<?php

namespace app\modules\admin\models;

use Yii;

/**
 * This is the model class for table "product_and_attributes".
 *
 * @property int $id_product
 * @property string $attribut_value
 *
 * @property Products $product
 * @property AttributesProduct $attributValue
 */
class ProductAndAttributes extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'product_and_attributes';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_product', 'attribut_value'], 'required'],
            [['id_product'], 'integer'],
            [['attribut_value'], 'string', 'max' => 255],
            [['id_product', 'attribut_value'], 'unique', 'targetAttribute' => ['id_product', 'attribut_value']],
            // [['id_product'], 'exist', 'skipOnError' => true, 'targetClass' => Products::className(), 'targetAttribute' => ['id_product' => 'id']],
            // [['attribut_value'], 'exist', 'skipOnError' => true, 'targetClass' => AttributesProduct::className(), 'targetAttribute' => ['attribut_value' => 'attr_value']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_product' => 'Название продукта',
            'attribut_value' => 'Свойста продукта',
        ];
    }

    /**
     * Gets query for [[Product]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getProduct()
    {
        return $this->hasOne(Products::className(), ['id' => 'id_product']);
    }

    /**
     * Gets query for [[AttributValue]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAttributValue()
    {
        return $this->hasOne(AttributesProduct::className(), ['attr_value' => 'attribut_value']);
    }
}
