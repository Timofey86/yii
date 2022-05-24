<?php

namespace app\components;

use app\models\Users;
use yii\base\Component;
use yii\base\Exception;

class AuthComponent extends Component
{
    public $model_class;

    /*public function init()
    {
        parent::init();

        if (empty($this->model_class)){
            throw new Exception('Need model_class param');
        }
    }*/

    /**
     * @param null $params
     * @return Users
     * */
    public function getModel($data = [])
    {
        $model = new Users();
        if ($data) {
            $model->load($data);
        }
        return $model;
    }

    /**
     * @param $model Users
     * @return bool
     */
    public function authUser(&$model):bool
    {
        $model->setAuthScenario();

        if (!$model->validate(['email','password'])){
            return false;
        }
        $password = $model->password;

        $model = $model::findOne(['email' => $model->email]);
        $model->auth_key=$this->generateAuthKey();
        $model->save();

        if(!$this->checkPassword($password, $model->password_hash)){
            $model->addError('password','Неправильный пароль');
            return false;
        }

        if(!\Yii::$app->user->login($model,3600)){
            return false;
        }

        return true;

    }

    private function checkPassword($password, $password_hash):bool
    {
        return \Yii::$app->security->validatePassword($password,$password_hash);

    }

    /**
     * @param $model Users
     * @return bool
     */
    public function createUser(&$model): bool
    {
        $model->setRegisterScenario();
        if (!$model->validate(['password','email'])) {
            return false;
        }

        $model->password_hash=$this->generatePasswordHash($model->password);
        $model->auth_key=$this->generateAuthKey();

        if(!$model->save()){
            return false;
        }
        return true;
    }

    private function generateAuthKey(){
        return \Yii::$app->security->generateRandomString();
    }

    public function generatePasswordHash($password)
    {
        return \Yii::$app->security->generatePasswordHash($password);
    }

    public function createDemoUser($email, $password) {
        $model = $this->getModel()::findOne(['email' => $email]);
        if ($model) {
            if (!$this->checkPassword($password, $model->password_hash)) {
                $model->password = $password;
                $model->password_hash = $this->generatePasswordHash($password);
            }
        } else {
            $model = $this->getModel();
            $model->email = $email;
            $model->password = $password;
            $this->createUser($model);
        }
        return $model->id;
    }

}