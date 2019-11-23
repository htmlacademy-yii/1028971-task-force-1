<?php
require_once __DIR__ . '\vendor\autoload.php';

use src\import\ConverterCsv;

var_dump(ConverterCsv::getInsertQuery('data\profiles.csv', 'users'));







