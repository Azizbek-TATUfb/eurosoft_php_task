<?php

namespace shop\forms\manage\Shop\Product;

use shop\forms\manage\MetaForm;
use shop\entities\Shop\Product\Product;
use yii\base\Model;

/**
 * @property MetaForm $meta
 * @property CategoriesForm $categories
 * @property TagsForm $tags
 * @property ValueForm[] $values
 */
class PriceForm extends Model
{
    public $old;
    public $new;

    public function __construct(Product $product, $config = [])
    {
        if ($product) {
            $this->new = $product->price_new;
            $this->old = $product->price_old;
        }
        parent::__construct($config);
    }
    public function rules()
    {
        return [
          [['new'], 'required'],
          [['old', 'new'], 'integer', 'min' => 0],
        ];
    }
}