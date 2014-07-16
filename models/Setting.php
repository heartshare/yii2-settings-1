<?php

namespace dizews\settings\models;

use Yii;
use yii\behaviors\AttributeBehavior;
use yii\behaviors\TimestampBehavior;
use yii\helpers\Json;

/**
 * This is the model class for table "settings".
 *
 * @property integer $id
 * @property string $created_at
 * @property string $updated_at
 * @property integer $is_active
 * @property string $type
 * @property string $category
 * @property string $key
 * @property string $value
 */
class Setting extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'settings';
    }

    public function behaviors()
    {
        return [
            'timestamp' => [
                'class' => TimestampBehavior::className(),
                'value' => new Expression('NOW()')
            ],
            'valueString' => [
                'class' => AttributeBehavior::className(),
                'attributes' => [
                    self::EVENT_AFTER_FIND => 'value',
                    self::EVENT_BEFORE_INSERT => 'value',
                    self::EVENT_BEFORE_UPDATE => 'value',
                ],
                'value' => function ($event) {
                        if ($event->name == self::EVENT_AFTER_FIND) {
                            return Json::encode($this->value);
                        } else {
                            return Json::decode($this->value);
                        }
                    }
            ]
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['category', 'key'], 'required'],
            [['type', 'category', 'key'], 'string', 'max' => 255],
            [['created_at', 'updated_at'], 'safe'],
            [['is_active'], 'integer'],
            [['value'], 'string']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        //make translation
        return [
            'id' => Yii::t('app', 'id'),
            'created_at' => Yii::t('app', 'created_at'),
            'updated_at' => Yii::t('app', 'updated_at'),
            'is_active' => Yii::t('app', 'is_active'),
            'type' => Yii::t('app', 'type'),
            'category' => Yii::t('app', 'category'),
            'key' => Yii::t('app', 'key'),
            'value' => Yii::t('app', 'value'),
        ];
    }
}
