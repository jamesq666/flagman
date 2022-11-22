<?php

namespace app\common\tables;

use yii\db\ActiveRecord;

/**
 * This is the model class for table "tbl_restpoints_other_services".
 *
 * @property integer $restpoint
 * @property integer $other_services
 */

class TblRestpointsOtherServices extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_restpoints_other_services';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['restpoint', 'other_services'], 'integer'],
            [['restpoint', 'other_services'], 'required'],
            [['restpoint'], 'exist', 'skipOnError' => true, 'targetClass' => TblRestpoints::className(), 'targetAttribute' => ['restpoint' => 'id']],
            [['other_services'], 'exist', 'skipOnError' => true, 'targetClass' => TblOtherServices::className(), 'targetAttribute' => ['other_services' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'restpoint' => 'Restpoint',
            'other_services' => 'Other services',
        ];
    }
}
