<?php

namespace app\components\exceptions;


use app\components\SystemCode;

class BadRequestHttpException extends \yii\web\BadRequestHttpException {

    /**
     * BadRequestHttpException constructor.
     * @param $userResponseCode
     * @param $logCode
     */
    public function __construct($userResponseCode, $logCode) {
        // Code
        $finalUserResponseCode = (YII_DEBUG) ? $logCode : $userResponseCode;
        // Msg
        $finalUserMsg = SystemCode::retrieveMessage($finalUserResponseCode);
        parent::__construct($finalUserMsg, $finalUserResponseCode);
    }

}