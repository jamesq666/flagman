<?php

namespace app\admin\controllers;

use Yii;
use app\admin\models\AdmRestpointsMainServices;
use app\common\tables\TblRestpointsMainServices;
use app\admin\models\AdmRestpointsMainServicesSearch;
use yii\web\NotFoundHttpException;
use yii\web\ServerErrorHttpException;

use yii\web\Response;

class RestpointsMainServicesController extends MainController
{

    protected $attributeList = [
        'restpoint',
        'main_services',
    ];

    public function behaviors()
    {
        $behaviors = parent::behaviors();

        $behaviors['access']['rules'] = [
            [
                'allow' => true,
                'actions' => ['list', 'index'],
                'roles' => ['viewRestpointsMainServices'],
            ],
            [
                'allow' => true,
                'actions' => ['create-obj', 'delete-obj'],
                'roles' => ['crudRestpointsMainServices'],
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
     * Creates a new AdmRestpointsMainServices model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @throws ServerErrorHttpException
     * @return mixed
     */
    public function actionCreateObj()
    {
        $model = new AdmRestpointsMainServices();

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
            'main_services' => $model->main_services,
            ];
    }

    /**
     * Deletes an existing AdmRestpointsMainServices model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $restpoint
     * @param integer $main_services
     * @return array
     */
    public function actionDeleteObj($restpoint, $main_services)
    {
        Yii::$app->response->format = Response::FORMAT_JSON;

        if ($this->findModel($restpoint, $main_services)->delete() > 0) {
            return ['ok' => true];
        } else {
            return ['ok' => false];
        }
    }

    /**
     * Lists all AdmRestpointsMainServices models.
     * @return mixed
     */
    public function actionList()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;

        $result = (new AdmRestpointsMainServicesSearch())->search(Yii::$app->request->bodyParams);

        return $result;
    }

    /**
     * Lists all AdmRestpointsMainServices models.
     * @return mixed
     */
    public function actionColumns()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;

        $rules = (new AdmRestpointsMainServices())->rules();

        return $rules;
    }

    /**
     * Displays a single AdmRestpointsMainServices model.
     * @param integer $restpoint
     * @param integer $main_services
     * @return mixed
     */
    public function actionGetObj($restpoint, $main_services)
    {
        Yii::$app->response->format = Response::FORMAT_JSON;

        $model = $this->findModel($restpoint, $main_services)->toArray();

        return [
            'model' => $model,
        ];
    }

    /**
     * Finds the TblRestpointsMainServices model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $restpoint
     * @param integer $main_services
     * @return TblRestpointsMainServices the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($restpoint, $main_services)
    {
        if (($model = TblRestpointsMainServices::findOne(['restpoint' => $restpoint, 'main_services' => $main_services])) !== null) {
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