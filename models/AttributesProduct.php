<?php

namespace app\models;

use app\modules\admin\models\Products;
use Yii;

/**
 * This is the model class for table "attributes_product".
 *
 * @property string $attr_name
 * @property string $attr_value
 *
 * @property ProductAndAttributes[] $productAndAttributes
 * @property Products[] $products
 */
class AttributesProduct extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'attributes_product';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['attr_name', 'attr_value'], 'required'],
            [['attr_name', 'attr_value'], 'string', 'max' => 255],
            [['attr_name', 'attr_value'], 'unique', 'targetAttribute' => ['attr_name', 'attr_value']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'attr_name' => 'Attr Name',
            'attr_value' => 'Attr Value',
        ];
    }

    /**
     * Gets query for [[ProductAndAttributes]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getProductAndAttributes()
    {
        return $this->hasMany(ProductAndAttributes::class, ['attribut_value' => 'attr_value']);
    }

    /**
     * Gets query for [[Products]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getProducts()
    {
        return $this->hasMany(Products::class, ['id' => 'id_product'])->viaTable('product_and_attributes', ['attribut_value' => 'attr_value']);
    }
}
