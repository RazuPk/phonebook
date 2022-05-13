<?php


$router->get('/', function () use ($router) {
    return $router->app->version();
});

$router->post('/registration','RegistrationController@onRegister');

$router->post('/login','LoginController@onLogin');

$router->post('/insert',['middleware'=>'auth','uses'=>'PhoneBookController@onInsert']);
$router->post('/view',['middleware'=>'auth','uses'=>'PhoneBookController@onSelect']);
$router->post('/update',['middleware'=>'auth','uses'=>'PhoneBookController@onUpdate']);
$router->post('/delete',['middleware'=>'auth','uses'=>'PhoneBookController@onDelete']);