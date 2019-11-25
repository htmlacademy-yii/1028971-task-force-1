<?php
require_once __DIR__ . '\vendor\autoload.php';

use src\import\Converter2;

echo "<pre>";
$file_map = [];
print_r(Converter2::getSqlFromCsv('data\users.csv', $file_map, 'user'));






