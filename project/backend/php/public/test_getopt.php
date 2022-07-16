#!/usr/bin/php -q
<?php
require_once 'Console/Getopt.php';
$obj = new Console_Getopt();
$args = $obj->readPHPArgv();
$short = null;
$long = array('aaaa=', 'bbbb=');
$res = $obj->getopt($args, $short, $long);

if (PEAR::isError($res)) {
    die($res->getMessage() . "\n");
}

list($options, $others) = $res;
print_r($options);
print_r($others);
