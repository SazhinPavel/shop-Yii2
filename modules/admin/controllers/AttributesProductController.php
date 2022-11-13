<?php

namespace app\modules\admin\controllers;

use Yii;
use app\modules\admin\models\AttributesProduct;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * AttributesProductController implements the CRUD actions for AttributesProduct model.
 */
class AttributesProductController extends Controller
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
     * Lists all AttributesProduct models.
     * @return mixed
     */
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => AttributesProduct::find(),
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single AttributesProduct model.
     * @param string $attr_name
     * @param string $attr_value
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($attr_name, $attr_value)
    {
        return $this->render('view', [
            'model' => $this->findModel($attr_name, $attr_value),
        ]);
    }

    /**
     * Creates a new AttributesProduct model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new AttributesProduct();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'attr_name' => $model->attr_name, 'attr_value' => $model->attr_value]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing AttributesProduct model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $attr_name
     * @param string $attr_value
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($attr_name, $attr_value)
    {
        $model = $this->findModel($attr_name, $attr_value);


        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            // $model->attr_value поменял местами
            return $this->redirect(['view', 'attr_name' => $model->attr_name, 'attr_value' => $model->attr_value]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing AttributesProduct model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $attr_name
     * @param string $attr_value
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($attr_name, $attr_value)
    {
        $this->findModel($attr_name, $attr_value)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the AttributesProduct model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $attr_name
     * @param string $attr_value
     * @return AttributesProduct the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($attr_name, $attr_value)
    {
        if (($model = AttributesProduct::findOne(['attr_name' => $attr_name, 'attr_value' => $attr_value])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
