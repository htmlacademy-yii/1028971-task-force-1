<?php


namespace src\import;

use SplFileObject;


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
                    }, $lineMap)) . ")" . ";";
            }
        }

        return $sql;
    }


    /**
     * @param string $fileName
     * @param array $sql
     */
    public static function writeInSqlFile(string $fileName, array $sql)
    {
        $filePath = getcwd() . '/' . $fileName;
        if (!is_file($filePath)) {
            touch($filePath);
        }
        if (trim(file_get_contents(getcwd() . '/' . $fileName)) == false) {
            $file = new SplFileObject($fileName, 'a');

            foreach ($sql as $value) {
                $file->fwrite($value . PHP_EOL);

            }
        } else {
            echo 'Данные уже записаны в файл<br>';
        }
    }


}
