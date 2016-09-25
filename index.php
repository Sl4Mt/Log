<?php
    
require 'vendor/autoload.php';
    
use LOG\Factory\LoggerFactory;

$w = "Alert!";
    
$file = LoggerFactory::createFileLogger("log", "C:\Users\SlUH\Desktop\qwer.txt");
$file->log("ALERT", $w);

$dbase = LoggerFactory::createDataBaseLogger("localhost", "root", "", "logg");
$dbase->log("ALERT", $w);

$std = LoggerFactory::createStdOutLogger("log");
$std->log("ALERT", $w);
