<?php


namespace src\import;


class Converter2
{

    public static function getSqlFromCsv(string $file_name, array $value_map, string $table_name)
    {
        $file = new \SplFileObject($file_name);
        $file->setFlags(8);
        $headers = $file->current();
        $sql = '';
        foreach ($file as $row) {
            if ($row != $headers && !in_array(null, $row)) {
                $value_map['email'] = $row[0];
                $value_map['name'] = $row[1];
                $value_map['password'] = $row[2];
                $value_map['reg_date'] = $row[3];
                $value_map['city_id'] = rand(1, 1008);
                $value_map['is_executor'] = rand(0, 1);

                $values = "'" . implode("','", array_values($value_map)) . "'";
                $columns = implode(',', array_keys($value_map));

                $sql .= "INSERT INTO $table_name ($columns) VALUE($values)" . "\n";
            }
        }

        return $sql;
    }


}
