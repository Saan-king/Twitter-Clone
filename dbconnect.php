<?php
require 'vendor/autoload.php';
$client=new MongoDb\Client('mongodb://localhost:27017');
$db=$client->twitterdb;
?>