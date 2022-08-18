<?php

namespace shop\repositories\Shop;

use shop\entities\Shop\Brand;
use shop\repositories\NotFoundException;

class BrandRepository
{
    /**
     * @param $id
     * @return Brand
     */
    public function get($id): Brand
    {
        if (!$category = Brand::findOne($id)) {
            throw new NotFoundException('Brand is not found.');
        }
        return $category;
    }
    public function save(Brand $brand)
    {
        if (!$brand->save()){
            throw new \RuntimeException('Saving error');
        }
    }

    /**
     * @param Brand $brand
     * @return void
     * @throws \yii\db\StaleObjectException
     */
    public function remove(Brand $brand){
        if (!$brand->delete()){
            throw new \RuntimeException('Removing error');
        }
    }
}