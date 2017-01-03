<?php
namespace frontend\controllers;

use Yii;
use frontend\controllers\base\BaseController;
use frontend\models\PostForm;
use frontend\models\UploadForm;

use common\models\CatsModel;
/**
* 文章控制器
*/
class PostController extends BaseController
{

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

        if (Yii::$app->request->isPost) {
            $UpForm = new UploadForm;
            $UpForm->imageFile = UploadedFile::getInstance($UpForm, 'label_img');

            // 文件上传成功？ 
            if ($UpForm->upload()) {
            
            }
        }
        return $this->render('create', ['model' => $model, 'cats' => $cats]);
    }

}

?>