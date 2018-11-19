<?php

namespace app\controllers;

use \Yii;
use app\components\SystemCode;
use app\components\helpers\Security;
use app\models\User;

class SessionController extends \app\components\controllers\MainRestController {

    public function actionCreate() {
         $loginFormData = $this->postRequestBodyDecodedData;

        // Extract username/password from login form
        $username = isset($loginFormData['email']) ? $loginFormData['email'] : NULL;
        $passwordInPlaintext = isset($loginFormData['password']) ? $loginFormData['password'] : NULL;
        if (!$username || !$passwordInPlaintext) {
            $logCode = SystemCode::REQUEST['MISSING_ARGUMENTS'];
            // Inform user
            $userResponseCode = SystemCode::REQUEST['MISSING_ARGUMENTS'];
            throw new \app\components\exceptions\BadRequestHttpException(
                $userResponseCode,
                $logCode
            );
        }

        // Find a user identity with the specified username.
        $user = User::findOne(['username' => $username]);
        if (!$user) {
            $logCode = SystemCode::UNAUTHORIZED['USERNAME_NOT_FOUND'];
            // Inform user
            $userResponseCode = SystemCode::UNAUTHORIZED['GENERAL_ERROR'];
            throw new \app\components\exceptions\UnauthorizedHttpException(
                $userResponseCode,
                $logCode
            );
        }

        // @@TODO: maybe check user status???

        // Password validation
        $passwordHashValidationResponse = Security::validatePasswordHash($passwordInPlaintext, $user->password);
        if ($passwordHashValidationResponse === Security::PASSWORD_HASH['INVALID']) {
            $logCode = SystemCode::UNAUTHORIZED['WRONG_PASSWORD'];
            // Inform user
            $userResponseCode = SystemCode::UNAUTHORIZED['GENERAL_ERROR'];
            throw new \app\components\exceptions\UnauthorizedHttpException(
                $userResponseCode,
                $logCode
            );
        } elseif ($passwordHashValidationResponse === Security::PASSWORD_HASH['INTERNAL_ERROR']) {
            $logCode = SystemCode::SYSTEM['PASSWORD_HASH_FUNCTION_ERROR'];
            // Inform user
            $userResponseCode = SystemCode::SYSTEM['GENERAL_ERROR'];
            throw new \app\components\exceptions\ServerErrorHttpException(
                $userResponseCode,
                $logCode
            );
//            Exception::throw(\yii\web\ServerErrorHttpException::class, $referenceString, $userMsg, $userResponseCode, $logMsg, $logCode);
        } elseif ($passwordHashValidationResponse === Security::PASSWORD_HASH['HAS_NOT_BEEN_SET']) {
            $logCode = SystemCode::USER['PASSWORD_HAS_NOT_BEEN_SET'];
            // @@TODO: when does this happen?
            // Inform user
            $userResponseCode = SystemCode::USER['GENERAL_ERROR'];
            throw new \app\components\exceptions\UnauthorizedHttpException(
                $userResponseCode,
                $logCode
            );
        }

        // login the user
        if (!Yii::$app->user->login($user)) {
            $logCode = SystemCode::SYSTEM['YII_LOGIN_FAIL'];
            // Inform user
            $userResponseCode = $logCode;
            throw new \app\components\exceptions\ServerErrorHttpException(
                $userResponseCode,
                $logCode
            );
        }

//        // Check if 'userJwt' entry exists for this user
//        $userJwt = UserJwt::find()->where(['userId' => $userProfile->id])->one();
//        if ((!$userJwt)) {
//            $userJwt = new UserJwt();
//            $userJwt->userId = $userProfile->id;
//            $userJwt->status = UserJwt::RECORD_STATUS['NORMAL'];
//            $userJwt->acquireCount = 0;
//        }

        // Get json web token
        $jwtToken = Security::generateJwtToken($user);

//        // Now save userJwt token to Database
//        $userJwt->value = $jwtToken->__toString();
//        $userJwt->acquireCount += 1;
//        $userJwt->save();

        // Update last login datetime
        $user->touch('last_login_datetime');

        // Success response
        return [
            'data' => [
                'userId' => $userProfile->id,
                'csrfToken' => Yii::$app->request->getCsrfToken(),
                'accessToken' => $jwtToken->__toString(),
            ],
        ];
    }

}
