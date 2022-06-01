<?php

namespace app\views\auth\assets;

use app\assets\AppAsset;
use yii\web\AssetBundle;

class AuthAsset extends AssetBundle
{
    public $sourcePath = '@app/views/auth/assets/';

    public $css = [
        'css/auth.css'
    ];

    public $depends = [
        AppAsset::class
    ];

}