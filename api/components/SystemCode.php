<?php

namespace app\components;


class SystemCode {

    const SYSTEM = [
        'GENERAL_ERROR' => 500,
        'PASSWORD_HASH_FUNCTION_ERROR' => 501,
        'YII_LOGIN_FAIL' => 502,
        'YII_LOGIN_SUCCESS' => 5021,
        'YII_LOGOUT_FAIL' => 503,
        'YII_LOGOUT_SUCCESS' => 5031,
        'PERMISSIONS_ARRAY_MISSING' => 504,
        'ACTION_ID_MISSING_FROM_PERMISSIONS_ARRAY' => 505,
    ];

    const REQUEST = [
        'WRONG_CONTENT_TYPE' => 100,
        'EMPTY_REQUEST_BODY' => 101,
        'MISSING_ARGUMENTS' => 102,
    ];

    const UNAUTHORIZED = [
        'GENERAL_ERROR' => 200,
        'USERNAME_NOT_FOUND' => 201,
        'WRONG_PASSWORD' => 202,
    ];

    const USER = [
        'GENERAL_ERROR' => 300,
        'PASSWORD_HAS_NOT_BEEN_SET' => 301,
        'TRY_ACCESS_RESTRICTED_RECOURSE' => 302,
    ];

    const MESSAGE = [
        // System
        self::SYSTEM['GENERAL_ERROR'] => 'Something went wrong with our system. Please try again later',
        self::SYSTEM['PASSWORD_HASH_FUNCTION_ERROR'] => 'Password hash function error',
        self::SYSTEM['YII_LOGIN_FAIL'] => 'User login failed',
        self::SYSTEM['YII_LOGOUT_FAIL'] => 'User logout failed',
        self::SYSTEM['YII_LOGIN_SUCCESS'] => 'User success login',
        self::SYSTEM['YII_LOGOUT_SUCCESS'] => 'User success logout',
        self::SYSTEM['PERMISSIONS_ARRAY_MISSING'] => 'Permissions array is missing from class',
        self::SYSTEM['ACTION_ID_MISSING_FROM_PERMISSIONS_ARRAY'] => 'Current called action id is missing form permissions array',
        // Request
        self::REQUEST['WRONG_CONTENT_TYPE'] => 'Request content type is not the expected',
        self::REQUEST['EMPTY_REQUEST_BODY'] => 'Empty request body',
        self::REQUEST['MISSING_ARGUMENTS'] => 'Some required arguments are missing',
        // Unauthorized
        self::UNAUTHORIZED['GENERAL_ERROR'] => 'Invalid username or password',
        self::UNAUTHORIZED['USERNAME_NOT_FOUND'] => 'This username does not exist',
        self::UNAUTHORIZED['WRONG_PASSWORD'] => 'User gave wrong password',
        //User
        self::USER['GENERAL_ERROR'] => 'User error',
        self::USER['PASSWORD_HAS_NOT_BEEN_SET'] => 'User password is not set',
        self::USER['TRY_ACCESS_RESTRICTED_RECOURSE'] => 'Try to access restricted recourse',
    ];

    public static function retrieveMessage($systemCode) {
        return self::MESSAGE[$systemCode];
    }

}