<?php

namespace Kavlar\TestItSolutions\app\controllers;

use Kavlar\TestItSolutions\Controller;

class MainController extends Controller
{

    public function actionIndex(): void
    {
        $this->out->render($this->viewPath . "/main.php", ['title' => 'Main Page',]);
    }

}