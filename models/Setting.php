<?php

namespace dizews\settings\models;

use Yii;
use yii\behaviors\AttributeBehavior;
use yii\behaviors\TimestampBehavior;
use yii\db\Expression;
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
    private $_value;

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
            ]
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['category', 'key', 'is_active'], 'required'],
            [['type', 'category', 'key'], 'string', 'max' => 255],
            [['created_at', 'updated_at', 'value'], 'safe'],
            [['is_active'], 'integer'],
            ['value_string', 'string']
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
            'value_string' => Yii::t('app', 'value'),
        ];
    }

    public function setValue($value)
    {
        if ($this->type === null) {
            $type = is_object($value) ? get_class($value) : gettype($value);
        }
        $this->_value = $value;
        $this->value_string = Json::encode($this->_value);
    }

    public function getValue()
    {
        if ($this->_value === null) {
            $this->_value = Json::decode($this->value_string);
        }

        return $this->_value;
    }
}
