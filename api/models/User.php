<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "user".
 *
 * @property int $id
 * @property string $username
 * @property string $password
 * @property int $aem
 * @property int $activated
 * @property int $type
 * @property string $last_name
 * @property string $first_name
 * @property int $act_code
 * @property string $email
 * @property int $telephone
 * @property int $academicid
 * @property string $public_comment
 * @property string $private_comment
 * @property int $departmentid
 * @property string $last_login_datetime
 */
class User extends \yii\db\ActiveRecord implements \yii\web\IdentityInterface {

    /**
     * {@inheritdoc}
     */
    public static function tableName() {
        return 'user';
    }

    /**
     * {@inheritdoc}
     */
    public function rules() {
        return [
            [['username', 'password', 'departmentid'], 'required'],
            [['aem', 'activated', 'type', 'act_code', 'telephone', 'academicid', 'departmentid'], 'integer'],
            [['username', 'last_name', 'first_name'], 'string', 'max' => 25],
            [['password'], 'string', 'max' => 250],
            [['email'], 'string', 'max' => 30],
            [['public_comment', 'private_comment'], 'string', 'max' => 256],
            [['username'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels() {
        return [
            'id' => 'ID',
            'username' => 'Username',
            'password' => 'Password',
            'aem' => 'Aem',
            'activated' => 'Activated',
            'type' => 'Type',
            'last_name' => 'Last Name',
            'first_name' => 'First Name',
            'act_code' => 'Act Code',
            'email' => 'Email',
            'telephone' => 'Telephone',
            'academicid' => 'Academicid',
            'public_comment' => 'Public Comment',
            'private_comment' => 'Private Comment',
            'departmentid' => 'Departmentid',
            'last_login_datetime' => Yii::t('app', 'Last Login Datetime'),
        ];
    }
    
    public static function findIdentity($id) {
        return static::findOne($id);
    }

    public static function findIdentityByAccessToken($jsonWebTokenStr, $type = NULL) {
        $jwtVerificationResult = Security::validateJwtToken($jsonWebTokenStr);
        if (!$jwtVerificationResult) {
            return NULL;
        }
        return $jwtVerificationResult;
    }

    public function getId() {
        return $this->id;
    }

    public function getAuthKey() {
        return NULL;
    }

    public function validateAuthKey($authKey) {
        return NULL;
    }

}
