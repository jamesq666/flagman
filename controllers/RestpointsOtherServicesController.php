<?php

namespace app\admin\controllers;

use Yii;
use app\admin\models\AdmRestpointsOtherServices;
use app\common\tables\TblRestpointsOtherServices;
use app\admin\models\AdmRestpointsOtherServicesSearch;
use yii\web\NotFoundHttpException;
use yii\web\ServerErrorHttpException;
use yii\web\Response;

class RestpointsOtherServicesController extends MainController
{

    protected $attributeList = [
        'restpoint',
        'other_services',
    ];

    public function behaviors()
    {
        $behaviors = parent::behaviors();

        $behaviors['access']['rules'] = [
            [
                'allow' => true,
                'actions' => ['list', 'index'],
                'roles' => ['viewRestpointsOtherServices'],
            ],
            [
                'allow' => true,
                'actions' => ['create-obj', 'delete-obj'],
                'roles' => ['crudRestpointsOtherServices'],
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
     * Creates a new AdmRestpointsOtherServices model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @throws ServerErrorHttpException
     * @return mixed
     */
    public function actionCreateObj()
    {
        $model = new AdmRestpointsOtherServices();

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
            'restpoint' => $model->restpoint,
            'other_services' => $model->other_services,
            ];
    }

    /**
     * Lists all AdmRestpointsOtherServices models.
     * @return mixed
     */
    public function actionList()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;

        $result = (new AdmRestpointsOtherServicesSearch())->search(Yii::$app->request->bodyParams);

        return $result;
    }

    /**
     * Deletes an existing AdmRestpointsMainServices model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $restpoint
     * @param integer $other_services
     * @return array
     */
    public function actionDeleteObj($restpoint, $other_services)
    {
        Yii::$app->response->format = Response::FORMAT_JSON;

        if ($this->findModel($restpoint, $other_services)->delete() > 0) {
            return ['ok' => true];
        } else {
            return ['ok' => false];
        }
    }

    /**
     * Lists all AdmRestpointsOtherServices models.
     * @return mixed
     */
    public function actionColumns()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;

        $rules = (new AdmRestpointsOtherServices())->rules();

        return $rules;
    }

    /**
     * Displays a single AdmRestpointsOtherServices model.
     * @param integer $restpoint
     * @param integer $other_services
     * @return mixed
     */
    public function actionGetObj($restpoint, $other_services)
    {
        Yii::$app->response->format = Response::FORMAT_JSON;

        $model = $this->findModel($restpoint, $other_services)->toArray();

        return [
            'model' => $model,
        ];
    }

    /**
     * Finds the TblRestpointsOtherServices model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $restpoint
     * @param integer $other_services
     * @return TblRestpointsOtherServices the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($restpoint, $other_services)
    {
        if (($model = TblRestpointsOtherServices::findOne(['restpoint' => $restpoint, 'other_services' => $other_services])) !== null) {
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