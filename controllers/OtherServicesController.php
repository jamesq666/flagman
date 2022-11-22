<?php

namespace app\admin\controllers;

use Yii;
use app\admin\models\AdmOtherServices;
use app\common\tables\TblOtherServices;
use app\admin\models\AdmOtherServicesSearch;
use yii\base\BaseObject;
use yii\web\NotFoundHttpException;
use yii\web\ServerErrorHttpException;

use yii\web\Response;

class OtherServicesController extends MainController
{

    protected $attributeList = [
        'id',
        'title',
        'is_active',
    ];

    public function behaviors()
    {
        $behaviors = parent::behaviors();

        $behaviors['access']['rules'] = [
            [
                'allow' => true,
                'actions' => ['list', 'index', 'columns', 'filters', 'get-obj'],
                'roles' => ['viewOtherServices'],
            ],
            [
                'allow' => true,
                'actions' => ['create-obj', 'update-obj', 'delete-obj'],
                'roles' => ['crudOtherServices'],
            ]
        ];

        return $behaviors;
    }

    /**
     * @return mixed
     */
    public function actionIndex()
    {
        return $this->render('//site/index');
    }

    /**
     * Creates a new AdmOtherServices model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @throws ServerErrorHttpException
     * @return mixed
     */
    public function actionCreateObj()
    {
        $model = new AdmOtherServices();

        $model->setAttributes($this->getAttributesValue());

        if (!$model->validate()) {
            return [
                'ok' => false,
                'statusText' => $model->getErrors(),
            ];
        }

        if (!$model->save()) {
            throw new ServerErrorHttpException('Ошибка сохранения');
        }

        $model->refresh();

        return [
            'ok' => true,
            'model' => $model->id,
            ];
    }

    /**
     * Updates an existing AdmOtherServices model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throw ServerErrorHttpException
     */
    public function actionUpdateObj($id)
    {
        $model = AdmOtherServices::find()->where(['id' => $id])->one();

        $model->setAttributes($this -> getAttributesValue());

        if (!$model->validate()) {
            return [
                'ok' => false,
                'statusText' => $model->getErrors(),
            ];
        }

        if (!$model->update()) {
            throw new ServerErrorHttpException('Ошибка изменения');
        }

        return ['ok' => true];
    }

    /**
     * Lists all AdmOtherServices models.
     * @return mixed
     */
    public function actionList()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;

        $result = (new AdmOtherServicesSearch())->search(Yii::$app->request->bodyParams);

        return $result;
    }

    /**
     * @return mixed
     */
    public function actionFilters()
    {
        \Yii::$app->response->format = Response::FORMAT_JSON;
        $rules = (new AdmOtherServicesSearch())->attributeFilter;

        return $rules;
    }

    /**
     * Deletes an existing AdmOtherServices model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return array
     */
    public function actionDeleteObj($id)
    {
        Yii::$app->response->format = Response::FORMAT_JSON;

        if ($this->findModel($id)->delete() > 0) {
            return ['ok' => true];
        } else {
            return ['ok' => false];
        }
    }

    /**
     * Lists all AdmOtherServices models.
     * @return mixed
     */
    public function actionColumns()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;

        $rules = (new AdmOtherServices())->rules();

        return $rules;
    }

    /**
     * Displays a single AdmOtherServices model.
     * @param integer $id
     * @return mixed
     */
    public function actionGetObj($id)
    {
        Yii::$app->response->format = Response::FORMAT_JSON;

        $model = $this->findModel($id)->toArray();

        return [
            'model' => $model,
        ];
    }

    /**
     * Finds the TblOtherServices model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return TblOtherServices the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = TblOtherServices::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException(Yii::t('app', '[The requested page does not exist.]'));
        }
    }

    protected function getAttributesValue()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;

        $data = Yii::$app->request->bodyParams;

        $attributeList = $this -> attributeList;

        $attributesValue = [];

        foreach ($attributeList as $attribute) {
            if (array_key_exists($attribute, $data)) {
                $attributesValue[$attribute] = $data[$attribute];
            }
        }

        return $attributesValue;
    }

}