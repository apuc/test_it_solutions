<?php

namespace Kavlar\TestItSolutions;

use JetBrains\PhpStorm\NoReturn;

class ApiController
{

    #[NoReturn] protected function renderApi(array $data): void
    {
        header("Content-Type: application/json");
        echo json_encode($data);
        exit();
    }

}