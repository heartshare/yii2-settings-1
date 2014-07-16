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


    public function get($category, $key)
    {

    }


    public function set($category, $key, $value, $type = null)
    {

    }

    public function enable($category, $key)
    {

    }

    public function disable($category, $key)
    {

    }

    public function delete($category, $key)
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
