<?php
namespace frontend\controllers\base;

use Yii;
use yii\web\Controller;

/**
* 基础控制器 
*/
class BaseController extends Controller
{

    public function beforeAction($action)
    {
        if (!parent::beforeAction($action)) {
            return false;
        }
        return true;
    }
}


?>