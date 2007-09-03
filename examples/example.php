<?php
set_include_path('../src/Validator/' . PATH_SEPARATOR . get_include_path());

require_once 'Validator.php';

// either filled like this or automatically from GET and POST
$request = new Request_Raw(array('username' => 'testervih.dk'));

$validator = new Validator;
$validator->add(new Validator_Basic(new Rule_Email('username'), 'email is not valid'));

if (!$validator->validate($request)) {
    print_r($validator->getErrors());
} else {
    print_r($validator->getCleanRequest());
}
