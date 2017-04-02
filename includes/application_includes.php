<?php
// Include the basic configuration elements
require_once('config.php');

// Include the database connection and query class
require_once('Database.php');

$requestType = $_SERVER[ 'REQUEST_METHOD' ];

//session start
session_start();