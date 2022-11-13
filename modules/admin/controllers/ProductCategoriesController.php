<?php

namespace app\modules\admin\controllers;

use Yii;
use app\modules\admin\models\ProductsCategories;
use app\modules\admin\models\ProductsCategoriesSearch;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * ProductCategoriesController implements the CRUD actions for ProductsCategories model.
 */
class ProductCategoriesController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all ProductsCategories models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ProductsCategoriesSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        // $dataProvider = new ActiveDataProvider([
        //     'query' => ProductsCategories::find(),
        // ]);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single ProductsCategories model.
     * @param integer $id_categories
     * @param integer $id_products
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id_categories, $id_products)
    {
        return $this->render('view', [
            'model' => $this->findModel($id_categories, $id_products),
        ]);
    }

    /**
     * Creates a new ProductsCategories model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {

        $model = new ProductsCategories();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index']);
            return $this->redirect(['view', 'id_categories' => $model->id_categories, 'id_products' => $model->id_products]);
        }

        return $this->renderAjax('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing ProductsCategories model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id_categories
     * @param integer $id_products
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id_categories, $id_products)
    {
        $model = $this->findModel($id_categories, $id_products);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id_categories' => $model->id_categories, 'id_products' => $model->id_products]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing ProductsCategories model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id_categories
     * @param integer $id_products
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id_categories, $id_products)
    {
        $this->findModel($id_categories, $id_products)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the ProductsCategories model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id_categories
     * @param integer $id_products
     * @return ProductsCategories the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id_categories, $id_products)
    {
        if (($model = ProductsCategories::findOne(['id_categories' => $id_categories, 'id_products' => $id_products])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
