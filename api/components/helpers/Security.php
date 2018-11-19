<?php

namespace app\components\helpers;

use app\models\UserJwt;
use app\models\User;
use \Yii;
use yii\web\User;

class Security {

    const PASSWORD_HASH = [
        'OK' => 0,
        'INVALID' => 1,
        'INTERNAL_ERROR' => 2,
        'HAS_NOT_BEEN_SET' => 3,
    ];

    const RANDOM_STRING_LENGTH = 128;

    public static function generatePasswordHash($passwordInPlaintext) {
        try {
            return Yii::$app->getSecurity()->generatePasswordHash($passwordInPlaintext, Yii::$app->params['passwordHashCost']);
        } catch (\yii\base\Exception $exception) {
            // @@TODO: Consider logging this
            return NULL;
        }
    }

    public static function validatePasswordHash($passwordInPlaintext, $passwordInHash) {
        if (!$passwordInHash) {
            return self::PASSWORD_HASH['HAS_NOT_BEEN_SET'];
        }
        try {
            $passwordHashValidation = Yii::$app->getSecurity()->validatePassword($passwordInPlaintext, $passwordInHash);
        } catch (\yii\base\InvalidArgumentException $exception) {
            // @@TODO: Consider logging this
            return self::PASSWORD_HASH['INTERNAL_ERROR'];
        }
        if ($passwordHashValidation) {
            return self::PASSWORD_HASH['OK'];
        } else {
            return self::PASSWORD_HASH['INVALID'];
        }
    }

    public static function generateRandomString($length = NULL) {
        try {
            if (!$length) {
                $length = self::RANDOM_STRING_LENGTH;
            }
            return Yii::$app->getSecurity()->generateRandomString($length);
        } catch (\yii\base\Exception $exception) {
            // @@TODO: Consider logging this
            return NULL;
        }
    }

    public static function generateJwtToken(\app\models\User $userIdentity) {
        // Init authzManager variable
        $authzManager = \Yii::$app->getAuthManager();
//        $userRoles = $authzManager->getRolesByUser($userIdentity->getId());
//        $userRoleNames = [];
//        foreach ($userRoles as $userRole) {
//            $userRoleNames[] = $userRole->name;
//        }

        // Current datetime object
        $now = new \DateTime();

        // Token builder object
        $tokenBuilder = new \Lcobucci\JWT\Builder();

        // set app claims
        $tokenBuilder->setIssuer(\Yii::$app->id); // Configures the issuer (iss claim)
        $tokenBuilder->setIssuedAt($now->getTimestamp()); // Configures the time that the token was issue (iat claim)
        $tokenBuilder->setAudience('http://routeme.app'); // Configures the audience (aud claim)
//        $tokenBuilder->setId(self::generateRandomString()); // Configures the id (jti claim), replicating as a header item
//        $tokenBuilder->setNotBefore(time() + 60); // Configures the time that the token can be used (nbf claim)
//        $tokenBuilder->setExpiration(time() + 3600); // Configures the expiration time of the token (exp claim)
        // Set claims for user
        $tokenBuilder->set('uid', $userIdentity->getId()); // Configures a new claim, called "uid"
        $tokenBuilder->set('http://routme.app/jwt/claims/user/role', $userIdentity->role);

        // Sign
        $jwtPrivateRsaKey = new \Lcobucci\JWT\Signer\Key('file:///run/jwt/jwt-sign-rsa-key-private.pem');
        $jwtSigner = new \Lcobucci\JWT\Signer\Rsa\Sha256();
        $tokenBuilder->sign($jwtSigner, $jwtPrivateRsaKey);

        $jsonWebToken = $tokenBuilder->getToken();

        return $jsonWebToken;

    }

    public static function validateJwtToken($jsonWebTokenStr) {
        $jsonWebToken = (new \Lcobucci\JWT\Parser())->parse($jsonWebTokenStr);
        $data = new \Lcobucci\JWT\ValidationData(); // It will use the current time to validate (iat, nbf and exp)
        $data->setIssuer(\Yii::$app->id);

        // @@TODO: how expiration will work???

        // Check if JWT is valid
        if (!$jsonWebToken->validate($data)) {
            // @@TODO: log situation
            return FALSE;
        }

        // Now check, that we have this valid token in our db, in order to ensure that the JWT had issued from us
        $userJwt = UserJwt::find()->where(['value' => $jsonWebTokenStr])->one();
        if (!$userJwt) {
            // @@TODO: log situation
            return FALSE;
        }

        // Retrieve related user profile
        $userProfile = UserProfile::find()->andWhere(['id' => $userJwt->userId])->one();

        return $userProfile;

    }

}