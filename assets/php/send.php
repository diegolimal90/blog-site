<?php
//www.resellscripts.info
error_reporting(E_ALL);
if(getenv('REQUEST_METHOD') != 'POST')
    exit('Opss! Aceitamos apenas o metodo POST');

include_once 'config.class.php';
include_once 'protector.class.php';
include_once 'email.class.php';

define('DS' , DIRECTORY_SEPARATOR);

    $email = new Email($_POST);
    $email->init();

?>