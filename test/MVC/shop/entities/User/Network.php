<?php

namespace shop\entities;
use Webmozart\Assert\Assert;

/**
 * @property integer $user_id
 * @property string $identity
 * @property string $network
 */
class Network extends \yii\db\ActiveRecord
{
    public static function create($network, $identity): self
    {
        Assert::notEmpty($network);
        Assert::notEmpty($identity);
        $item = new static();
        $item->network = $network;
        $item->identity = $identity;
        return $item;
    }

    public function isFor($network, $identity)
    {
        return $this->network === $network && $this->identity === $identity;
    }
    public static function tableName()
    {
        return '{{%user_networks}}';
    }

//    /**
//     * {@inheritdoc}
//     */
//    public function rules()
//    {
//        return [
//            [['user_id'], 'integer'],
//            [['identity', 'network', 'name'], 'required'],
//            [['identity', 'network', 'name'], 'string', 'max' => 255],
//            [['identity', 'name', 'network'], 'unique', 'targetAttribute' => ['identity', 'name', 'network']],
//            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => Users::className(), 'targetAttribute' => ['user_id' => 'id']],
//        ];
//    }
//
//    /**
//     * {@inheritdoc}
//     */
//    public function attributeLabels()
//    {
//        return [
//            'id' => 'ID',
//            'user_id' => 'User ID',
//            'identity' => 'Identity',
//            'network' => 'Network',
//            'name' => 'Name',
//        ];
//    }
//
//    /**
//     * Gets query for [[User]].
//     *
//     * @return \yii\db\ActiveQuery
//     */
//    public function getUser()
//    {
//        return $this->hasOne(Users::className(), ['id' => 'user_id']);
//    }
}