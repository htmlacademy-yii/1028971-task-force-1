<?php


namespace src\import;


class ConverterCsv
{

    const DIRECTORY_PATH = 'data';

    /**
     * @param string $file_name
     * @param string $table_name
     * @return string
     */
    public static function getInsertQuery(string $file_name, string $table_name): string
    {
        $sql = '';
        $file = new \SplFileObject($file_name);
        $file->setFlags(\SplFileObject::READ_CSV);
        $headers = $file->current();
        $columns = implode(',', $headers);

        foreach ($file as $row) {
            if (!in_array(null, $row) && $row != $headers) {
                $values = "'" . implode("','", $row) . "'";
                $sql .= "INSERT INTO $table_name ($columns) VALUE($values)" . "\n";

            }

        }
        return $sql;
    }


    /**
     * @param string $path
     * @return array
     */
    public static function getFilesNameArr(string $path = self::DIRECTORY_PATH): array
    {
        $it = new \FilesystemIterator($path);
        $arr = [];
        foreach ($it as $item) {
            $arr[] .= $file_names = $it->getFilename();
        }
        return $arr;
    }


}
