<?php

namespace app\controllers;

use yii\web\Controller;

class TeacherController extends Controller
{
    public function actionStudents()
    {
        $name_student = 'Timofey';
        return $this->render('student',['name' => $name_student]);
    }
}