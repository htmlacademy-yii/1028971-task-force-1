<?php

$file = new SplFileObject("data/tasks.csv");
$file->setFlags(SplFileObject::READ_CSV);
$headers = $file->current();
$columns = implode(',', $headers);


foreach ($file as $row) {
    if (!in_array(null, $row) && $row != $headers) {
        $values = "'" . implode("','", $row) . "'";
        $sql = "INSERT INTO users ({$columns}) VALUE({$values})";
        var_dump($sql);
        echo '<pre>';
    }
}


$it = new FilesystemIterator((__DIR__) . '\data');
$arr = [];
foreach ($it as $item) {
    $arr[] .= $file_names = $it->getFilename();

}

foreach ($arr as $file) {

}

