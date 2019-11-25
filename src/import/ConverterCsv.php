<?php


namespace src\import;

class ConverterCsv
{

    const DIRECTORY_PATH = 'data';

    public static function countRowInFile(string $file_name): int
    {
        $file = file($file_name);
        return count($file) - 1;
    }

    /**
     *
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
        $file->seek(1);
        $next_line = $file->current();

        if (count($headers) != count($next_line)) {
            foreach ($file as $row) {
                $empty_fields = array_diff_key($headers, $row);
                foreach ($empty_fields as &$value) {
                    $value = rand(1, self::countRowInFile('data\cities.csv'));
                }
                if (!in_array(null, $row) && $row != $headers) {
                    $new_values = "'" . implode("','", array_merge($row, $empty_fields)) . "'";
                    $sql .= "INSERT INTO $table_name ($columns) VALUE($new_values)" . "\n";
                }
            }
        } else {
            foreach ($file as $row) {
                if (!in_array(null, $row) && $row != $headers) {
                    $values = "'" . implode("','", $row) . "'";
                    $sql .= "INSERT INTO $table_name ($columns) VALUE($values)" . "\n";
                }
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
