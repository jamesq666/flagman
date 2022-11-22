<?php

namespace app\common\tables;

use yii\db\ActiveRecord;

/**
 * This is the model class for table "tbl_restpoints_main_services".
 *
 * @property integer $restpoint
 * @property integer $main_services
 */

class TblRestpointsMainServices extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_restpoints_main_services';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['restpoint', 'main_services'], 'integer'],
            [['restpoint', 'main_services'], 'required'],
            [['restpoint'], 'exist', 'skipOnError' => true, 'targetClass' => TblRestpoints::className(), 'targetAttribute' => ['restpoint' => 'id']],
            [['main_services'], 'exist', 'skipOnError' => true, 'targetClass' => TblMainServices::className(), 'targetAttribute' => ['main_services' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'restpoint' => 'Restpoint',
            'main_services' => 'Main services',
        ];
    }
}
