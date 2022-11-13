<?php

namespace app\modules\admin\controllers;

use Yii;
use app\modules\admin\models\ProductAndAttributes;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * ProductAndAttributesController implements the CRUD actions for ProductAndAttributes model.
 */
class ProductAndAttributesController extends Controller
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
     * Lists all ProductAndAttributes models.
     * @return mixed
     */
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => ProductAndAttributes::find(),
        ]);



        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single ProductAndAttributes model.
     * @param integer $id_product
     * @param string $attribut_value
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id_product, $attribut_value)
    {
        return $this->render('view', [
            'model' => $this->findModel($id_product, $attribut_value),
        ]);
    }

    /**
     * Creates a new ProductAndAttributes model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new ProductAndAttributes();




        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id_product' => $model->id_product, 'attribut_value' => $model->attribut_value]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing ProductAndAttributes model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id_product
     * @param string $attribut_value
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id_product, $attribut_value)
    {
        $model = $this->findModel($id_product, $attribut_value);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id_product' => $model->id_product, 'attribut_value' => $model->attribut_value]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing ProductAndAttributes model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id_product
     * @param string $attribut_value
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id_product, $attribut_value)
    {
        $this->findModel($id_product, $attribut_value)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the ProductAndAttributes model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id_product
     * @param string $attribut_value
     * @return ProductAndAttributes the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id_product, $attribut_value)
    {
        if (($model = ProductAndAttributes::findOne(['id_product' => $id_product, 'attribut_value' => $attribut_value])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
