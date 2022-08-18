<?php

namespace shop\repositories\Shop;

use shop\entities\Shop\Category;
use shop\repositories\NotFoundException;
use yii\db\StaleObjectException;

class CategoryRepository
{
    public function get($id)
    {
        if (!$category = Category::findOne($id)) {
            throw new NotFoundException('Category is not found.');
        }
        return $category;
    }
    public function save(Category $category)
    {
        if (!$category->save()) {
            throw new \RuntimeException('Saving error.');
        }
    }

    /**
     * @param Category $category
     * @return void
     * @throws StaleObjectException
     */
    public function remove(Category $category)
    {
        if (!$category->delete()) {
            throw new \RuntimeException('Removing error.');
        }
    }
}