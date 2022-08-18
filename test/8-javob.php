<?php
/**
 * Yii2 basic frameworkda module yaratish
 *
 * 1) proyektimizni gii generatoriga kirib olamiz
 *  va undagi inputlarga shartli ma'lumotlarni kiritamiz
 *  1-input  Module Classga | app\modules\test\Module |
 *  2-input Module Id | test |
 *  qilib yurgiziladi
 *
 *  2) keyingi ishimiz config/web.php faylga kirib
 *   buni qo'shib qo'yamiz
 *   ......
 *   'modules' => [
 *        'test' => [
 *           'class' => 'app\modules\test\Module',
 *         ],
 *     ],
 *    ......
 */