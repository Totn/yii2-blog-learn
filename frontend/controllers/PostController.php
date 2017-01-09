<?php
namespace frontend\controllers;

use Yii;
use frontend\controllers\base\BaseController;
use frontend\models\PostForm;
use common\models\CatsModel;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
/**
* 文章控制器
*/
class PostController extends BaseController
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['index', 'view', 'create'],
                'rules' => [
                    // ? 表示任意身份
                    [
                        'actions' => ['view', 'index'],
                        'allow' => true,
                    ],
                    // @ 表示某一角色(除了游客)
                    [
                        'actions' => ['create'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    '*' => ['get'],
                    'upload' => ['post'],
                    'create' => ['get', 'post'],
                ],
            ],
        ];
    }


    public function actions()
    {
        return [
            'upload' => [
                'class' => 'common\widgets\file_upload\UploadAction',
                'config' => [
                    'imagePathFormat' => '/image/{yyyy}{mm}{dd}/{time}{rand:6}',

                ],
            ],

            // 百度编辑器的组件
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
        $model->setScenario(PostForm::SCENARIOS_CREATE);

        // 加载post数据，校验数据
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            // 数据入库
            if (!$model->create()) {
                // 失败则标记错误
                Yii::$app->session->setFlash('warning', $model->_lastError);
            } else {
                // 成功则跳转查看页
                return $this->redirect(['post/view', 'id' => $model->id]);

            }
        }
        
        $cats  = CatsModel::getAllCats();
        return $this->render('create', ['model' => $model, 'cats' => $cats]);
    }
}

?>