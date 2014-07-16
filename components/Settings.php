<?php


namespace dizews\settings\components;


use dizews\settings\models\Setting;
use yii\base\Component;
use Yii;


class Settings extends Component
{
    public $modelClass = 'dizews\settings\models\Setting';

    private $_settings;


    public function get($category, $key)
    {
        $setting = $this->findModel($category, $key);

        return $setting->value;
    }


    public function set($category, $key, $value, $type = null)
    {
        $modelClass = $this->modelClass;
        $setting = $modelClass::findOne(['category' => $category, 'key' => $key]);
        if (!$setting) {
            $setting = new Setting();
            $setting->category = $category;
            $setting->key = $key;
        }
        $setting->value = $value;
        $setting->save();
    }

    public function enable($category, $key)
    {
        $setting = $this->findModel($category, $key);
        $setting->is_active = 1;
        $setting->save();
    }

    public function disable($category, $key)
    {
        $setting = $this->findModel($category, $key);
        $setting->is_active = 0;
        $setting->save();
    }

    public function delete($category, $key)
    {
        $setting = $this->findModel($category, $key);
        $setting->delete();
    }

    public function deleteAll($category)
    {
        /* @var Setting $modelClass */
        $modelClass = $this->modelClass;
        if ($category === '') {
            $modelClass::deleteAll('');
        } else {
            $modelClass::deleteAll(['category' => $category]);
        }
    }

    /**
     * @param $category
     * @param $key
     * @return Setting
     */
    protected function findModel($category, $key)
    {
        /* @var Setting $modelClass */
        $modelClass = $this->modelClass;
        return $modelClass::findOne(['category' => $category, 'key' => $key]);
    }

}
