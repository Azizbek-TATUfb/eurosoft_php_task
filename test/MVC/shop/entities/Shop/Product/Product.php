<?php

namespace shop\entities\Shop\Product;

use lhs\Yii2SaveRelationsBehavior\SaveRelationsBehavior;
use shop\entities\behaviors\MetaBehavior;
use shop\entities\Shop\Category;
use shop\entities\Shop\Brand;
use shop\entities\Meta;
use yii\db\ActiveQuery;
use yii\db\ActiveRecord;
use yii\web\UploadedFile;

/**
 * @property integer $id
 * @property integer $created_at
 * @property string $code
 * @property string $name
 * @property integer $category_id
 * @property integer $brand_id
 * @property integer $price_old
 * @property integer $price_new
 * @property integer $rating
 *
 * @property Meta $meta
 * @property Brand $brand
 * @property Value[] $values
 * @property Photo[] $photos
 * @property Category $category
 * @property CategoryAssignment[] $categoryAssignments
 * @property TagAssignment[] $tagAssignments
 * @property Modification[] $modifications
 * @property RelatedAssignment[] $relatedAssignments
 * @property Review[] $reviews
 */
class Product extends ActiveRecord
{
    public $meta;
    private $values;
    private $tagAssignments;

    public static function create($brandId, $categoryId, $code, $name, Meta $meta): self
    {
        $product = new static();
        $product->brand_id = $brandId;
        $product->category_id = $categoryId;
        $product->code = $code;
        $product->name = $name;
        $product->meta = $meta;
        $product->created_at = time();
        return $product;
    }
    public function setPrice($new, $old)
    {
        $this->price_new = $new;
        $this->price_old = $old;
    }
    public function edit($brandId, $code, $name, Meta $meta)
    {
        $this->brand_id = $brandId;
        $this->code = $code;
        $this->name = $name;
        $this->meta = $meta;
    }
    public function changeMainCategory($categoryId)
    {
        $this->category_id = $categoryId;
    }

    public function setValue($id, $value)
    {
        $values = $this->values;
        foreach ($values as $val) {
            if ($val->isForCharacteristic($id)) {
                return;
            }
        }
        $values[] = Value::create($id,$value);
        $this->values = $values;
    }

    public function getValue($id): Value
    {
        $values = $this->values;
        foreach ($values as $val) {
            if ($val->isForCharacteristic($id)) {
                return $val;
            }
        }
        return Value::blank($id);
    }
    //Modification

    public function getModification($id): Modification
    {
        foreach ($this->modifications as $modification) {
            if ($modification->isIdEqualTo($id)) {
                return $modification;
            }
        }
        throw new \DomainException('Modification is not found.');
    }

    public function addModification($code, $name, $price)
    {
        $modifications = $this->modifications;
        foreach ($modifications as $modification) {
            if ($modification->isCodeEqualTo($code)) {
                throw new \DomainException('Modification already exists.');
            }
        }
        $modifications[] = Modification::create($code, $name, $price);
        $this->modifications = $modifications;
    }

    public function editModification($id, $code, $name, $price)
    {
        $modifications = $this->modifications;
        foreach ($modifications as $i => $modification) {
            if ($modification->isIdEqualTo($id)) {
                $modification->edit($code, $name, $price);
                $this->modifications = $modifications;
                return;
            }
        }
        throw new \DomainException('Modification is not found.');
    }

    //Categories
    public function assignCategory($id)
    {
        $assignments = $this->categoryAssignments;
        foreach ($assignments as $assignment) {
            if ($assignment->isForCategory($id)){
                return;
            }
        }
        $assignments[] = CategoryAssignment::create($id);
        $this->categoryAssignments = $assignments;
    }
    public function revokeCategory($id)
    {
        $assignments = $this->categoryAssignments;
        foreach ($assignments as $i => $assignment) {
            unset($assignments[$i]);
            $this->categoryAssignments = $assignments;
            return;
        }
        throw new \DomainException('Assignment is not found.');
    }
    public function revokeCategories()
    {
        $this->categoryAssignments = [];
    }
    //Tags
    public function assignTag($id)
    {
        $assignments = $this->tagAssignments;
        foreach ($assignments as $assignment) {
            if ($assignment->isForTag($id)) {
                return;
            }
        }
        $assignments[] = CategoryAssignment::create($id);
        $this->tagAssignments = $assignments;
    }

    public function revokeTag($id)
    {
        $assignments = $this->tagAssignments;
        foreach ($assignments as $i => $assignment) {
            if ($assignment->isForTag($id)) {
                unset($assignments[$i]);
                $this->tagAssignments = $assignments;
                return;
            }
        }
        throw new \DomainException('Assignment is not found.');
    }

    public function revokeTags()
    {
        $this->tagAssignments = [];
    }

    //Photos

    public function addPhoto(UploadedFile $file)
    {
        $photos = $this->photos;
        $photos[] = Photo::create($file);
        $this->setPhotos($photos);
    }
    public function removePhoto($id)
    {
        $photos = $this->photos;
        foreach ($photos as $i => $photo) {
            if ($photo->isIdEqualTo($id)) {
                unset($photos[$i]);
                $this->setPhotos($photos);
                return;
            }
        }
        throw new \DomainException('Photo is not found.');
    }
    public function removePhotos()
    {
        $this->setPhotos([]);
    }
    public function movePhotoUp($id)
    {
        $photos = $this->photos;
        foreach ($photos as $i => $photo) {
            if ($photo->isIdEqualTo($id) && $next = $photos[$i-1] ?? null) {
                $photos[$i] = $next;
                $photos[$i-1] = $photo;
                $this->setPhotos($photos);
                return ;
            }
        }
        throw new \DomainException('Photo is not found.');
    }
    public function movePhotoDown($id)
    {
        $photos = $this->photos;
        foreach ($photos as $i => $photo) {
            if ($photo->isIdEqualTo($id) && $prev = $photos[$i+1] ?? null) {
                $photos[$i] = $prev;
                $photos[$i+1] = $photo;
                $this->setPhotos($photos);
                return ;
            }
        }
        throw new \DomainException('Photo is not found.');
    }
    private function setPhotos(array $photos)
    {
        foreach ($photos as $i => $photo) {
            $photo->setSort($i);
        }
        $this->photos = $photos;
    }

    //Related Product

    public function assignRelatedProduct($id)
    {
        $assignments = $this->relatedAssignments;
        foreach ($assignments as $assignment) {
            if ($assignment->isForProduct($id)){
                return;
            }
        }
        $assignments[] = CategoryAssignment::create($id);
        $this->relatedAssignments = $assignments;
    }

    public function revokeRelatedProduct($id)
    {
        $assignments = $this->relatedAssignments;
        foreach ($assignments as $i => $assignment) {
            if ($assignment->isForProduct($id)) {
                unset($assignments[$i]);
                $this->relatedAssignments = $assignments;
                return;
            }
        }
        throw new \DomainException('Assignment is not found');
    }

    // Reviews

    public function addReview($userId, $vote, $text)
    {
        $reviews = $this->reviews;
        $reviews[] = Review::create($userId, $vote, $text);
        $this->setReviews($reviews);
    }
    public function editReview($id, $vote, $text)
    {
        $this->doWithReview($id, function (Review $review) use ($vote, $text){
            $review->edit($vote, $text);
        });
    }
    public function activateReview($id)
    {
        $this->doWithReview($id, function (Review $review){
            $review->activate();
        });
    }
    public function draftReview($id)
    {
        $this->doWithReview($id, function (Review $review){
            $review->draft();
        });
    }

    public function doWithReview($id,callable $callback)
    {
        $reviews = $this->reviews;
        foreach ($reviews as $i => $review) {
            if ($review->isIdEqualTo($id)) {
                $callback($review);
                $this->setReviews($reviews);
                return;
            }
        }
        throw new \DomainException('Review is not found');
    }

    public function removeReview($id)
    {
        $reviews = $this->reviews;
        foreach ($reviews as $i => $review) {
            if ($review->isIdEqualTo($id)) {
                unset($reviews[$i]);
                $this->setReviews($reviews);
                return;
            }
        }
        throw new \DomainException('Review is not found');
    }

    public function setReviews(array $reviews)
    {
        $amount = 0;
        $total = 0;
        foreach ($reviews as $review) {
            if ($review->isActive()) {
                $amount++;
                $total += $review->getRating();
            }
        }
        $this->reviews = $reviews;
        $this->rating = $amount? $total/$amount: null;
    }

    public function getBrand(): ActiveQuery
    {
        return $this->hasOne(Brand::class, ['id' => 'brand_id']);
    }
    public function getCategory(): ActiveQuery
    {
        return $this->hasOne(Category::class, ['id' => 'category_id']);
    }
    public function getCategoryAssignments(): ActiveQuery
    {
        return $this->hasOne(CategoryAssignment::class, ['product_id' => 'id']);
    }
    public function getValues(): ActiveQuery
    {
        return $this->hasOne(Value::class, ['product_id' => 'id']);
    }
    public function getPhotos(): ActiveQuery
    {
        return $this->hasOne(Photo::class, ['product_id' => 'id']);
    }
    public function getTagAssignments(): ActiveQuery
    {
        return $this->hasOne(TagAssignment::class, ['product_id' => 'id']);
    }
    public function getRelatedAssignments(): ActiveQuery
    {
        return $this->hasOne(RelatedAssignment::class, ['product_id' => 'id']);
    }
    public function getModifications(): ActiveQuery
    {
        return $this->hasOne(Modification::class, ['product_id' => 'id']);
    }
    public function getReviews(): ActiveQuery
    {
        return $this->hasOne(Review::class, ['product_id' => 'id']);
    }
    ################################

    public static function tableName(): string
    {
        return '{{%shop_products}}';
    }

    public function behaviors(): array
    {
        return [
            MetaBehavior::className(),
            [
                'class' => SaveRelationsBehavior::className(),
                'relations' => ['categoryAssignments', 'tagAssignments', 'relatedAssignments', 'values', 'photos','reviews'],
            ]
        ];
    }
    public function transactions(): array
    {
        return [
          self::SCENARIO_DEFAULT => self::OP_ALL,
        ];
    }



}