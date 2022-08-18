<?php
namespace shop\entities\behaviors;

use shop\entities\Shop\Brand;
use yii\db\BaseActiveRecord;
use shop\entities\Meta;
use yii\base\Behavior;
use yii\helpers\ArrayHelper;
use yii\helpers\Json;
use yii\base\Event;

class MetaBehavior extends Behavior
{
    public $attribute = 'meta';
    public $jsonAttribute = 'meta_json';
    public function events()
    {
        return [
            BaseActiveRecord::EVENT_AFTER_FIND =>  'onAfterFind',
            BaseActiveRecord::EVENT_BEFORE_INSERT =>  'onBeforeSave',
            BaseActiveRecord::EVENT_BEFORE_UPDATE =>  'onBeforeSave',
        ];
    }

    /**
     * @throws \Exception
     */
    public function onAfterFind(Event $event)
    {
        /** @var Brand $brand*/
        $brand = $event->sender;
        $meta = Json::decode($brand->getAttribute($this->jsonAttribute));
        $brand->{$this->attribute} = new Meta(
            ArrayHelper::getValue($meta, 'title'),
            ArrayHelper::getValue($meta, 'description'),
            ArrayHelper::getValue($meta, 'keywords')
        );
    }
    public function onBeforeSave(Event $event)
    {
        /** @var Brand $brand*/
        $brand = $event->sender;
        $brand->setAttribute($this->jsonAttribute, Json::encode([
            'title' => $brand->{$this->attribute}->title,
            'description' => $brand->{$this->attribute}->description,
            'keywords' => $brand->{$this->attribute}->keywords,
        ]));
    }
}