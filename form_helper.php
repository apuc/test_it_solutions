<?php

function printForm(array $inputsArr): void
{
    if ($_GET['show_form']) {
        foreach ($inputsArr as $key => $input) {
            echo "</br><label for='$key'>" . $input['label'] . "</label>";
            echo "<input type='" . $input['type'] . "' name='$key' id='" . $input['id'] . "' class='" . $input['class'] . "' >";
        }
    }
}