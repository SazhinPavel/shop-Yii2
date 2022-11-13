<?php

namespace app\modules\admin\models;

use app\models\AttributesProduct;
use phpDocumentor\Reflection\Types\Array_;
use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "products".
 *
 * @property int $id
 * @property string $title
 * @property string $content
 * @property int $category_id
 * @property string $art
 * @property int $stock
 * @property int|null $price
 * @property int|null $old_price
 * @property string $alias
 * @property int $hit
 * @property int $new
 * @property int $sale
 *
 * @property ProductAndAttributes[] $productAndAttributes
 * @property AttributesProduct[] $attributValues
 * @property Categories $category
 * @property ProductsCategories[] $productsCategories
 * @property Categories[] $categories
 */
class Products extends \yii\db\ActiveRecord
{
  // для загрузки картинок
  public $image;
  public $gallery;
  public $categories_array;
  public function behaviors()
  {
    return [
      'image' => [
        'class' => 'rico\yii2images\behaviors\ImageBehave',
      ]
    ];
  }



  /**
   * {@inheritdoc}
   */
  public static function tableName()
  {
    return 'products';
  }

  /**
   * {@inheritdoc}
   */
  public function rules()
  {
    return [

      [['title', 'category_id',], 'required'],
      [['category_id', 'stock', 'price', 'old_price', 'hit', 'new', 'sale'], 'integer'],
      [['content'], 'string'],
      [['title', 'art', 'alias'], 'string', 'max' => 255],
      [['category_id'], 'exist', 'skipOnError' => true, 'targetClass' => Category::className(), 'targetAttribute' => ['category_id' => 'id']],
      [['image'], 'file',  'extensions' => 'png, jpg'],
      [['categories_array'], 'safe'],
      [['gallery'], 'file',  'extensions' => 'png, jpg', 'maxFiles' => 6]
    ];
  }

  /**
   * {@inheritdoc}
   */
  public function attributeLabels()
  {
    return [
      'id' => 'ID',
      'title' => 'Название товара',
      'category_id' => 'Главная категория',
      'content' => 'Описание',
      'art' => 'Art',
      'stock' => 'Наличие',
      'price' => 'Цена',
      'old_price' => 'Old Price',
      'alias' => 'Alias',
      'image' => 'Главное фото',
      'gallery' => 'Дополнительные фото - не больше 5 шт.',
      'hit' => 'Популярный товар',
      'new' => 'Новинка',
      'sale' => 'Распродажа',
      'categories_array' => 'Категории',
      'categories' => 'Находится в категориях',
      'categoriesasstring' => 'Находится в категориях'
    ];
  }

  public function upload()
  {
    if ($this->validate()) {
      $path = 'upload/store/' . $this->image->basename . '.' . $this->image->extension;

      $this->image->saveAs($path);
      $this->attachImage($path, true);
      //удаляем оригинальную сохраненую картинку
      @unlink($path);
      return true;
    } else {
      return false;
    }
  }


  public function uploadGallery()
  {
    if ($this->validate()) {
      foreach ($this->gallery as $file) {
        $path = 'upload/store/' . $file->basename . '.' . $file->extension;
        $file->saveAs($path);
        $this->attachImage($path);
        //удаляем оригинальную сохраненую картинку
        @unlink($path);
      }
      return true;
    } else {
      return false;
    }
  }

  /**
   * Gets query for [[ProductAndAttributes]].
   *
   * @return \yii\db\ActiveQuery
   */
  public function getProductAndAttributes()
  {
    return $this->hasMany(ProductAndAttributes::className(), ['id_product' => 'id']);
  }

  /**
   * Gets query for [[AttributValues]].
   *
   * @return \yii\db\ActiveQuery
   */
  public function getAttributValues()
  {
    return $this->hasMany(AttributesProduct::className(), ['attr_value' => 'attribut_value'])->viaTable('product_and_attributes', ['id_product' => 'id']);
  }

  /**
   * Gets query for [[Category]].
   *
   * @return \yii\db\ActiveQuery
   */
  public function getCategory()
  {
    return $this->hasOne(Category::className(), ['id' => 'category_id']);
  }

  public function getCategories()
  {
    return $this->hasMany(Category::className(), ['id' => 'id_categories'])->viaTable('products_categories', ['id_products' => 'id']);
  }


  /**
   * Gets query for [[ProductsCategories]].
   *
   * @return \yii\db\ActiveQuery
   */
  public function getProductsFromCategories()
  {
    return $this->hasMany(ProductsCategories::className(), ['id_products' => 'id']);
  }

  /**
   * Gets query for [[Categories]].
   *
   * @return \yii\db\ActiveQuery
   */
 

  private function createNewCategotry($new_category)
  {
    $products_categories = new ProductsCategories();
    $products_categories->id_products = $this->id;
    $products_categories->id_categories = $new_category;
    $products_categories->save();
  }



  public function afterFind()
  {
    //$this->categories_array = $this->categories;
    //Category::find()->select(['id', 'title'])->all(), 'id', 'title')
    $this->categories_array = ArrayHelper::map($this->categories, 'title', 'id');
  }

  public function getCategoriesAsString()
  {
    return implode(', ',  ArrayHelper::map($this->categories, 'id', 'title'));
  }

  public function afterSave($insert, $changedAttributes)
  {
    parent::afterSave($insert, $changedAttributes);
    if (is_array($this->categories_array)) {
      $old_category = ArrayHelper::map($this->categories, 'title', 'id');

      $categoryToInsert = array_diff($this->categories_array, $old_category);
      $categoryToDelete = array_diff($old_category, $this->categories_array);

      if (is_array($categoryToInsert)) {
        foreach ($categoryToInsert as $new_category)
          $this->createNewCategotry($new_category);
      }
      if (is_array($categoryToDelete)) {
        ProductsCategories::deleteAll(['and', ['id_products' => $this->id], ['id_categories' =>  $categoryToDelete]]);
      }
    } else {
      ProductsCategories::deleteAll(['id_products' => $this->id]);
    }
  }

  public function beforeDelete()
  {
    if (parent::beforeDelete()) {
      ProductsCategories::deleteAll(['id_products' => $this->id]);
      return true;
    } else {
      return false;
    }
  }
}
