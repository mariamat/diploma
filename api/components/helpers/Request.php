<?php

namespace app\components\helpers;


use app\components\SystemCode;

class Request {

    /**
     * @return bool
     * @throws \yii\web\BadRequestHttpException
     */
    public static function isContentTypeJson() {
        if (\Yii::$app->request->contentType != 'application/json') {
            // Log
            $logCode = SystemCode::REQUEST['WRONG_CONTENT_TYPE'];

            // Inform user
            $userResponseCode = SystemCode::REQUEST['WRONG_CONTENT_TYPE'];
            throw new \app\components\exceptions\BadRequestHttpException(
                $userResponseCode,
                $logCode
            );
        }
        return TRUE;
    }

}