<?php
// Yii2 basic proyektda commands papkasiga yaratiladi
namespace app\commands;
//Yii2 fremaworkda
use yii\console\Controller;
use yii\console\ExitCode;

class MycommandController extends Controller
{
    public function actionWelcome($message = 'Hello world!')
    {
        echo $message . "\n";

        return ExitCode::OK;
    }
}