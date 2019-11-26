<?php


namespace src\import;


class Converter2
{

    public static function getSqlFromCsv(string $file_name, array $value_map, string $table_name)
    {
        $file = new \SplFileObject($file_name);
        $file->setFlags(8);
        $headers = $file->current();
        $sql = [];
        foreach ($file as $row) {
            $lineMap = [];
            if ($row != $headers && !in_array(null, $row)) {
                foreach ($value_map as $fieldName => $fieldValue) {
                    $lineMap[$fieldName] = is_int($fieldValue) ? $row[$fieldValue] : $fieldValue();
                }
                $sql[] = "INSERT INTO $table_name (" . implode(', ', array_keys($lineMap)) . ")
                 VALUES (" . implode(', ', array_map(function (&$value) {
                        return "'" . $value . "'";
                    }, $lineMap)) . ")";
            }
        }

        return $sql;
    }


}
