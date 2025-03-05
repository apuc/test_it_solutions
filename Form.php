<?php

class Form
{
    protected array $data = [];
    protected array $formParams = [];
    protected string $formParamsStr = '';

    protected string $html = '';

    public function __construct(array $formParams = [])
    {
        $this->formParams = $formParams;
        $this->createParams();
    }

    public function start(): void
    {
        echo "<form $this->formParamsStr>";
    }

    public function end(): void
    {
        echo "</form>";
    }

    public function field(string $type, string $name, array $params = []): void
    {
        $fieldArr = [];
        $fieldArr['type'] = $type;
        $fieldArr = array_merge($fieldArr, $params);
        $this->data[$name] = $fieldArr;
    }

    /**
     * @param array $arr
     * @return void
     */
    public function load(array $arr): void
    {
        $this->data = $arr;
    }

    public function renderFields(): void
    {
        foreach ($this->data as $key => $input) {
            echo "</br><label for='$key'>" . $input['label'] . "</label>";
            echo "<input type='" . $input['type'] . "' name='$key' id='" . $input['id'] . "' class='" . $input['class'] . "' >";
        }
    }

    protected function createParams(): void
    {
        foreach ($this->formParams as $key => $param){
            $this->formParamsStr .= " $key='$param'";
        }
    }

    private function setSome()
    {

    }

}