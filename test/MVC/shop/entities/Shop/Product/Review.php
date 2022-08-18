<?php

namespace shop\entities\Shop\Product;

use yii\db\ActiveRecord;

/**
 * @property int $id
 * @property int $created_at
 * @property int $user_id
 * @property int $vote
 * @property string $text
 * @property boolean $active
 */
class Review extends ActiveRecord
{
    public static function create($userId, int $vote, string $text): self
    {
        $review = new static();
        $review->user_id = $userId;
        $review->vote = $vote;
        $review->text = $text;
        $review->created_at = time();
        $review->active = false;
        return  $review;
    }
    public function edit($vote, $text)
    {
        $this->vote = $vote;
        $this->text = $text;
    }

    public function activate()
    {
        $this->active = true;
    }
    public function draft()
    {
        $this->active = true;
    }
    public function isActive(): bool
    {
        return $this->active === true;
    }
    public function getRating(): bool
    {
        return $this->vote;
    }
    public function isIdEqualTo($id): bool
    {
        return $this->id === $id;
    }
    public static function tableName(): string
    {
        return '{{%shop_reviews}}';
    }
}