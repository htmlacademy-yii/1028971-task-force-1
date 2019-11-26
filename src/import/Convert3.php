<?php


namespace src\import;


class Convert3
{
    private $tableName;
    private $csvFile;
    private $headers;
    private $newFields;

    public function __construct(string $path, string $newFields)
    {
        $this->csvFile = new \SplFileObject($path);
        $this->newFields = $newFields;
    }

    public function getHeadersFromCsv()
    {
        $this->csvFile->seek(0);
        $this->headers = $this->csvFile->current();
        $headers = explode(',', $this->headers);
        return array_push($headers, $this->newFields);
    }


}
