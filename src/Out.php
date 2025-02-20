<?php

namespace Kavlar\TestItSolutions;

use JetBrains\PhpStorm\NoReturn;

class Out
{
    private string $content;

    /**
     * @param string $viewFile
     * @param array $data
     * @return string
     */
    public function fetch(string $viewFile, array $data = []): string
    {
        $this->createContent($viewFile, $data);

        return $this->content;
    }

    /**
     * @param string $viewFile
     * @param array $data
     * @return void
     */
    public function render(string $viewFile, array $data = []): void
    {
        $this->createContent($viewFile, $data);

        echo $this->content;
    }

    /**
     * @param array $data
     * @return void
     */
    #[NoReturn] public function renderApi(array $data): void
    {
        header("Content-Type: application/json");
        echo json_encode($data);
        exit();
    }

    /**
     * @param string $viewFile
     * @param array $data
     * @return void
     */
    private function createContent(string $viewFile, array $data = []): void
    {
        ob_start();

        foreach ($data as $key => $datum) {
            ${"$key"} = $datum;
        }

        include($viewFile);

        $this->content = ob_get_contents();
        ob_end_clean();
    }

    /**
     * @return Out
     */
    public static function start(): Out
    {
        return new self();
    }

}