<?php
namespace shop\forms\manage\Shop\Product;

use yii\web\UploadedFile;

class PhotosForm extends \yii\base\Model
{
    /**
     * @var UploadedFile[]
     */
    public $files;
    public function rules(): array
    {
        return [
            ['files', 'each', 'rule' => ['image']],
        ];
    }
    public function beforeValidate(): bool
    {
        if (parent::beforeValidate()) {
            $this->files = UploadedFile::getInstances($this, 'files');
            return true;
        }
        return false;
    }
}