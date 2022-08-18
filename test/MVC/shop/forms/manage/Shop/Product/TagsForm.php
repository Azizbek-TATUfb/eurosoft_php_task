<?php

namespace shop\forms\manage\Shop\Product;

use yii\base\Model;
use yii\helpers\ArrayHelper;
use shop\entities\Shop\Product\Product;

/**
 * @property array $newNames
 */
class TagsForm extends Model
{
    public $existing = [];
    public $testNew;

    public function __construct(Product $product = null, $config = [])
    {
        if ($product) {
            $this->existing = ArrayHelper::getColumn($product->tagAssignments, 'tag_id');
        }
        parent::__construct($config);
    }
    public function rules()
    {
        return [
            ['existing', 'each', 'rule' => ['integer']],
            ['textNew', 'string']
        ];
    }

    public function getNewNames(): array
    {
        return preg_split('#\s*,\s*#i', $this->testNew);
//        return array_map('trim', preg_split('#\s*,\s*#i', $this->testNew));
    }
}