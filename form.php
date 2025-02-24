<?php

require_once "form_helper.php";
require_once "Form.php";
require_once "UserForm.php";

include "header.php";



$inputs = [
    'name' => [
        'label' => 'Имя',
        'type' => 'text',
        'id' => 'user_name',
        'class' => 'inputForm',
    ],
    'email' => [
        'label' => 'Email',
        'type' => 'email',
        'id' => 'user_email',
        'class' => 'inputForm',
    ],
    'tg' => [
        'label' => 'Telegram',
        'type' => 'text',
        'id' => 'user_tg',
        'class' => 'inputForm',
    ],
    'phone' => [
        'label' => 'Телефон',
        'type' => 'number',
        'id' => 'user_phone',
        'class' => 'inputForm',
    ],
];

$form = new UserForm();
$form->load($inputs);

printForm($inputs);



