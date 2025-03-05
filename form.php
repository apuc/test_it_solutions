<?php

require_once "form_helper.php";
require_once "Form.php";
require_once "UserForm.php";

include "header.php";

require_once "vendor/autoload.php";



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

$form = new UserForm([
    'action' => 'save_user.php',
    'method' => 'POST'
]);
$form->load($inputs);

$form->start();
$form->field(type: "text", name: "additional_email", params: [
    'class' => 'additional_email inputForm',
    'label' => 'Дполнительный email',
    'id' => 'additional_email',
]);
$form->renderFields();
$form->end();

$form2 = new UserForm([
    'action' => "save_client.php",
    'method' => 'POST'
]);

$form2->start();
$form2->field(type: "text", name: "user_id", params: [
    'class' => 'inputForm',
    'label' => 'Пользователь',
    'id' => 'user_id',
]);
$form2->renderFields();
$form2->end();

