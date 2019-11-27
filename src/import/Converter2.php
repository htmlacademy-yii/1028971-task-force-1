<?php


namespace src\import;

use SplFileObject;
use src\exceptions\ConvertException;


class Converter2
{
    /**
     * get File Object use SplFileObject
     * @param string $fileName
     * @return SplFileObject
     */
    public static function getFile(string $fileName)
    {
        return $file = new SplFileObject($fileName);
    }

    /**
     * create SQL-query from CSV-file
     * @param string $fileName
     * @param array $value_map
     * @param string $table_name
     * @return array
     */
    public static function getSqlFromCsv(string $fileName, array $value_map, string $table_name)
    {
        $file = self::getFile($fileName);
        $file->setFlags(8);
        $headers = $file->current();
        $sql = [];
        foreach ($file as $row) {
            $lineMap = [];
            /** @var string $headers */
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

    /**
     * insert data into DB
     * @param array $sql
     * @return string
     * @throws ConvertException
     */
    public static function insertIntoDB(array $sql)
    {
        $mysql = new \PDO('mysql:host=localhost;dbname=task_force', 'root', '');
        $addedRows = '';

        if (!$mysql) {
            throw new ConvertException('Ошибка подключения к базе данных');
        }

        foreach ($sql as $value) {
            $addedRows = $mysql->exec($value);
        }
        return "Добавлено $addedRows строк";
    }




}
