<?php

namespace app\components\controllers;

use app\components\helpers\Log;
use app\components\helpers\Request;
use app\components\helpers\Security;
use app\components\helpers\Time;
use app\components\SystemCode;

class MainRestController extends \yii\rest\Controller {

    public $guestUuid = null;
    public $isGuestUuidCookieExistsOnClient = FALSE;
    public $postRequestBodyDecodedData = NULL;
    public $currentPageIndex = NULL;

    public function init() {
        parent::init();

        // Attach api version to responses
        \Yii::$app->response->on(\yii\web\Response::EVENT_BEFORE_SEND, ['\app\components\helpers\Execution', 'appendApiVersion']);

        // Attach meta data to output if yii is in debug mode
        if (YII_DEBUG) {
            \Yii::$app->response->on(\yii\web\Response::EVENT_BEFORE_SEND, ['\app\components\helpers\Execution', 'appendMetaInfo']);
        }

        // Give each client a cookie to distinguish them
        if (!\Yii::$app->request->cookies->has('guestUuid')) {
            $this->guestUuid = Security::generateRandomString();
            \Yii::$app->response->cookies->add(new \yii\web\Cookie([
                'name' => 'guestUuid',
                'value' => $this->guestUuid,
                'expire' => time() + Time::ONE_DAY_INTERVAL_SEC * 365,
                'httpOnly' => TRUE,
//                'secure' => TRUE, // @@TODO: fix this on production https environments
            ]));
        } else {
            $this->guestUuid = \Yii::$app->request->cookies->getValue('guestUuid');
            $this->isGuestUuidCookieExistsOnClient = TRUE;
        }
    }

    /**
     * @param $action
     * @return bool
     * @throws \yii\web\BadRequestHttpException
     */
    public function beforeAction($action) {
        \Yii::$app->controller->detachBehavior('contentNegotiator'); // because this change the format of response

        if (!parent::beforeAction($action)) {
            return FALSE;
        }

        // @@TODO: Consider making checks for the other HTTP methods (verbs)
        if (\Yii::$app->request->method === 'POST') {
            // Check request content type
            Request::isContentTypeJson();

            // Retrieve data from the POST request body
            $this->postRequestBodyDecodedData = \Yii::$app->request->post();

            if (!$this->postRequestBodyDecodedData) {
                // Log
                $logCode = SystemCode::REQUEST['EMPTY_REQUEST_BODY'];
                // Inform user
                $userResponseCode = $logCode;
                throw new \app\components\exceptions\BadRequestHttpException(
                    $userResponseCode,
                    $logCode
                );
            }
        }

//        // Retrieve current page param if exists
//        $this->currentPageIndex = \Yii::$app->request->get('currentPage', NULL);

        return TRUE;

    }

}
