<?php
/**
 * Setting class file.
 * @copyright (c) 2014, Galament
 * @license http://www.opensource.org/licenses/bsd-license.php
 */

namespace dizews\settings\models;

use Yii;

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

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['created_at', 'updated_at'], 'safe'],
            [['is_active'], 'integer'],
            [['value'], 'string'],
            [['type', 'category', 'key'], 'string', 'max' => 255]
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
