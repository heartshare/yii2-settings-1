<?php


namespace dizews\settings;

use Yii;

/**
 * Class Module
 */
class Module extends \yii\base\Module
{
    /**
     * @inheritdoc
     */
    public $controllerNamespace = 'dizews\settings\controllers';

    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();
        //init translation!!
    }

}
