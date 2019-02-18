<?php

include_once '../model/database.php';
include_once '../model/currency_offerings_db.php';

echo "START OF TEST:";

$currencies = get_currency_offerings();

var_dump($currencies);



