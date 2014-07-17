<?php


namespace dizews\settings;


use dizews\settings\models\Setting;
use yii\base\Component;
use Yii;
use yii\base\InvalidConfigException;


class Manager extends Component
{
    public $modelClass = 'dizews\settings\models\Setting';

    private $_settings;


    public function get($category, $key)
    {
        $setting = $this->findModel($category, $key);
        if ($setting->is_active) {
            return $setting->value;
        }

        return null;
    }


    public function set($category, $key, $value, $type = null)
    {
        $modelClass = $this->modelClass;
        $setting = $modelClass::findOne(['category' => $category, 'key' => $key]);
        /* @var Setting $setting */
        if (!$setting) {
            $setting = new $modelClass;
            $setting->category = $category;
            $setting->key = $key;
        }
        if ($type === null) {
            $type = is_object($value) ? get_class($value) : gettype($value);
        }

        $setting->is_active = 1;
        $setting->type = $type;
        $setting->value = $value;
        $setting->validate();
        if ($setting->save() !== false) {
            return true;
        }

        return false;
    }

    public function enable($category, $key)
    {
        $setting = $this->findModel($category, $key);
        $setting->is_active = 1;
        if ($setting->save() !== false) {
            return true;
        }

        return false;
    }

    public function disable($category, $key)
    {
        $setting = $this->findModel($category, $key);
        $setting->is_active = 0;
        if ($setting->save() !== false) {
            return true;
        }

        return false;
    }

    public function delete($category, $key)
    {
        $setting = $this->findModel($category, $key);

        if ($setting->delete() !== false) {
            return true;
        }

        return false;
    }

    public function deleteAll($category)
    {
        /* @var Setting $modelClass */
        $modelClass = $this->modelClass;
        if ($category === '') {
            $result = $modelClass::deleteAll('');
        } else {
            $result = $modelClass::deleteAll(['category' => $category]);
        }

        if ($result !== false) {
            return true;
        }

        return false;
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
        $model = $modelClass::findOne(['category' => $category, 'key' => $key]);
        if ($model) {
            return $model;
        }

        throw new InvalidConfigException("Unable to locate setting value for category '$category' and key '$key'.");
    }

}
