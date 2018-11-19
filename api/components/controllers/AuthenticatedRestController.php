<?php

namespace app\components\controllers;

use app\components\helpers\Log;
use app\components\SystemCode;
use yii\filters\auth\HttpBearerAuth;

class AuthenticatedRestController extends MainRestController {


    public function behaviors() {
        $behaviors = parent::behaviors();
        // Set authenticator
        $behaviors['authenticator'] = [
            'class' => HttpBearerAuth::className(),
        ];
        return $behaviors;
    }

    /**
     * @param $action
     * @return bool
     * @throws \app\components\exceptions\ServerErrorHttpException
     * @throws \yii\web\BadRequestHttpException
     * @throws \app\components\exceptions\ForbiddenHttpException
     */
    public function beforeAction($action) {
        // parent before action
        if (!parent::beforeAction($action)) { // must be executed first in order for behaviours and especially authenticator to run first
            return FALSE;
        }

        // get controller/action info for current request
        $currentCalledActionId = $this->action->id;
        $currentCalledControllerClassName = \Yii::$app->controller->className();

        // If permissions table is missing don't continue
        if (!defined($currentCalledControllerClassName . '::GIVE_ACCESS_TO_ROLE_PER_ACTION')) {
            // Log the situation
            $logCode = SystemCode::SYSTEM['PERMISSIONS_ARRAY_MISSING'];
            $referenceString = Log::error($logCode, __METHOD__, ['controller' => $currentCalledControllerClassName]);

            // Inform user
            $userResponseCode = SystemCode::SYSTEM['GENERAL_ERROR'];
            throw new \app\components\exceptions\ServerErrorHttpException(
                $referenceString,
                $userResponseCode,
                $logCode
            );
        }

        // Check that in permissions array, current called action id exists
        if (!array_key_exists($currentCalledActionId, \Yii::$app->controller::GIVE_ACCESS_TO_ROLE_PER_ACTION)) {
            // Log the situation
            $logCode = SystemCode::SYSTEM['ACTION_ID_MISSING_FROM_PERMISSIONS_ARRAY'];
            $referenceString = Log::error(
                $logCode,
                __METHOD__,
                [
                    'action' => $currentCalledControllerClassName . '::' . $currentCalledActionId,
                ]
            );

            // Inform user
            $userResponseCode = SystemCode::SYSTEM['GENERAL_ERROR'];
            throw new \app\components\exceptions\ServerErrorHttpException(
                $referenceString,
                $userResponseCode,
                $logCode
            );
        }

        // Check user has sufficient permissions to access this recourse
        $userRole = \Yii::$app->user->identity->role;
        if (!in_array($userRole, \Yii::$app->controller::GIVE_ACCESS_TO_ROLE_PER_ACTION[$currentCalledActionId])) {
            // Log the situation
            $logCode = SystemCode::USER['TRY_ACCESS_RESTRICTED_RECOURSE'];
            $referenceString = Log::error(
                $logCode,
                __METHOD__,
                [
                    'action' => $currentCalledControllerClassName . '::' . $currentCalledActionId,
                ]
            );

            // Inform user
            $userResponseCode = SystemCode::USER['TRY_ACCESS_RESTRICTED_RECOURSE'];
            throw new \app\components\exceptions\ForbiddenHttpException(
                $referenceString,
                $userResponseCode,
                $logCode
            );
        }

        return TRUE;
    }

}