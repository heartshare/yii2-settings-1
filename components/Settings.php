<?php


namespace dizews\settings\components;

use yii\base\Component;
use yii\caching\Cache;
use Yii;


class Settings extends Component
{

    public $modelClass = 'dizews\settings\models\Setting';

    protected $model;

    private $_settings = null;

    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();
        $this->model = new $this->modelClass;
    }


    public function get($key, $category = '')
    {

    }


    public function set($key, $value, $category= '', $type = null)
    {

    }

    public function enable($key, $category = '')
    {

    }

    public function disable($key, $category = '')
    {

    }

    public function delete($key, $category = '')
    {

    }

    public function deleteAll($category)
    {
        if ($category === null) {
            //delete all settings
        } else {
            //delete all category settings
        }
    }

}
