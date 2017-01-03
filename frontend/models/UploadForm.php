<?php 
namespace frontend\models;

use yii\base\Model;
use yii\web\UploadedFile;

/**
 * 上传文件表单
 */
class UploadForm extends Model
{
    public $imageFile;

    public function rules()
    {
        return [
            [['label_img'], 'file', 'skipOnEmpty' => false, 'extensions' => 'png, jpg'],
        ];
    }

    /**
     * 上传主要方法: 验证文件并保存到服务器
     * @return [type] [description]
     */
    public function upload()
    {
        if ($this->validate()) {
            $this->imageFile->save(
                'uploads/' 
                . $this->imageFile->baseName
                . '.' . $this->imageFile->extension
            );
            return true;
        } else {
            return false;
        }
    }
}