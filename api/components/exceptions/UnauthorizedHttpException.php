<?php

namespace app\components\exceptions;


use app\components\SystemCode;

class UnauthorizedHttpException extends \yii\web\UnauthorizedHttpException {

    /**
     * UnauthorizedHttpException constructor.
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