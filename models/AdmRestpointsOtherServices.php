<?php

namespace app\admin\models;

use Yii;
use app\common\tables\TblRestpointsOtherServices;
use yii\helpers\ArrayHelper;

class AdmRestpointsOtherServices extends TblRestpointsOtherServices
{
    public function rules()
    {
        return ArrayHelper::merge(
            [
            ],
            parent::rules()
        );
    }

    public function afterSave($insert, $changedAttributes)
    {
        if ($insert) {
            $message = Yii::t('app', '[RestpointsOtherServices {id} created by user {user_id}]', ['id' => $this->restpoint . $this->other_services, 'user_id' => Yii::$app->user->id]);
            Yii::info($message, 'restpoints-other-services');
        } else {
            foreach ($changedAttributes as $attribute => $value) {
                if ($this->$attribute != $value) {
                    $message = Yii::t('app', '[RestpointsOtherServices {id} updated by user {user_id}: {attribute} from {old_val} to {new_val}]', [
                        'id' => $this->restpoint . $this->other_services,
                        'user_id' => Yii::$app->user->id,
                        'attribute' => $attribute,
                        'old_val' => $value ?: Yii::t('app', '[not set]'),
                        'new_val' => $this->$attribute ?: Yii::t('app', '[not set]')
                    ]);
                    Yii::info($message, 'restpoints-other-services');
                }
            }
        }
        parent::afterSave($insert, $changedAttributes);
    }

    public function afterDelete()
    {
        $message = Yii::t('app', '[RestpointsOtherServices {id} deleted by user {user_id}]', [
            'id' => $this->restpoint . $this->other_services,
            'user_id' => Yii::$app->user->id
        ]);
        Yii::info($message, 'restpoints-other-services');
        parent::afterDelete();
    }

    /**
     * @return array
     * label translation
     */
    public function attributeLabels()
    {
        $labels = [];
        foreach (parent::attributeLabels() as $attribute => $label)
        {
            $labels[$attribute] = Yii::t('app', '['.$label.']');
        }
        return $labels;
    }
}

