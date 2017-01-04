<?php
namespace frontend\controllers;

use Yii;
use frontend\controllers\base\BaseController;
use frontend\models\PostForm;
use common\models\CatsModel;
/**
* 文章控制器
*/
class PostController extends BaseController
{

    public function actions()
    {
        return [
            'upload' => [
                'class' => 'common\widgets\file_upload\UploadAction',
                'config' => [
                    'imagePathFormat' => '/image/{yyyy}{mm}{dd}/{time}{rand:6}',

                ],
            ],
            'ueditor' => [
                'class' => 'common\widgets\ueditor\UeditorAction',
                'config' => [
                    'imageUrlPrefix' => "",
                    'imagePathFormat' => '/image/{yyyy}{mm}/{time}{rand:6}',
                ],
            ],

        ];
    }

    /**
     * 文章列表
     * @return [type] [description]
     */
    public function actionIndex()
    {
        return $this->render('index');
    }


    /**
     * 文章创建
     * @return [type] [description]
     */
    public function actionCreate()
    {
        $model = new PostForm();
        $cats  = CatsModel::getAllCats();
        return $this->render('create', ['model' => $model, 'cats' => $cats]);
    }
}

?>