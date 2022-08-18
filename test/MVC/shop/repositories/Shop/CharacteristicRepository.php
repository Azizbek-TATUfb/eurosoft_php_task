<?php

namespace shop\repositories\Shop;

use shop\entities\Shop\Characteristic;
use shop\repositories\NotFoundException;

class CharacteristicRepository
{
    /**
     * @param $id
     * @return Characteristic
     */
    public function get($id): Characteristic
    {
        if (!$characteristic = Characteristic::findOne($id)) {
            throw new NotFoundException('Characteristic is not found.');
        }
        return $characteristic;
    }

    /**
     * @param Characteristic $characteristic
     * @return void
     */
    public function save(Characteristic $characteristic)
    {
        if (!$characteristic->save()) {
            throw new \RuntimeException('Saving error.');
        }
    }

    /**
     * @param Characteristic $characteristic
     * @return void
     * @throws \yii\db\StaleObjectException
     */
    public function remove(Characteristic $characteristic)
    {
        if (!$characteristic->delete()) {
            throw new \RuntimeException('Removing error.');
        }
    }
}