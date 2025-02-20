<?php

namespace Kavlar\TestItSolutions;

class Controller
{

    protected Out $out;
    protected string $viewPath;

    public function __construct()
    {
        $this->out = new Out();
        $this->viewPath = BASE_PATH . "/views";
    }

}