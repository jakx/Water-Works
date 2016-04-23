<?php
class MyDB extends SQLite3
{
    function __construct()
    {
            $dbFile = $_SERVER['DOCUMENT_ROOT'] . '/db/example.sqlite';
            $this->open($dbFile);
    }
}
$db = new MyDB();

