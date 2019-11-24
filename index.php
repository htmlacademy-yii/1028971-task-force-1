<?php
require_once __DIR__ . '\vendor\autoload.php';

use src\import\ConverterCsv;
echo "<pre>";
print_r(ConverterCsv::getInsertQuery('data\users.csv', 'users'));







