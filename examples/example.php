<?php
set_include_path('../src/Validator/' . PATH_SEPARATOR . get_include_path());

require_once 'Validator.php';
require_once 'Validator/Coordinator.php';
require_once 'Validator/Basic.php';
require_once 'Request/Raw.php';
require_once 'Request/Clean.php';
require_once 'Rule/Base.php';
require_once 'Rule/Email.php';
require_once 'Rule/Equal.php';

// either filled like this or automatically from GET and POST
$request = new Request_Raw(array('username' => 'tester@vih.dk', 'password' => 'txester', 'retype' => 'tester'));

$validator = new Validator;
$validator->addBasicValidator(new Rule_Email('username'), 'email is not valid');
$validator->addBasicValidator(new Rule_Equal('password', 'retype'), 'passwords does not match');

if (!$validator->validate($request)) {
    print_r($validator->getErrors());
} else {
    echo $validator->getCleanRequest()->get('username');
}
