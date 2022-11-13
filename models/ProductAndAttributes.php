<?php

namespace app\models;

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
            [['id_product'], 'exist', 'skipOnError' => true, 'targetClass' => Product::class, 'targetAttribute' => ['id_product' => 'id']],
            [['attribut_value'], 'exist', 'skipOnError' => true, 'targetClass' => AttributesProduct::class, 'targetAttribute' => ['attribut_value' => 'attr_value']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_product' => 'Id Product',
            'attribut_value' => 'Attribut Value',
        ];
    }

    /**
     * Gets query for [[Product]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getProduct()
    {
        return $this->hasOne(Product::class, ['id' => 'id_product']);
    }

    /**
     * Gets query for [[AttributValue]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAttribut()
    {
        return $this->hasOne(AttributesProduct::class, ['attr_value' => 'attribut_value']);
    }
}
