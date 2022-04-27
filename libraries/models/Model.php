<?php

require_once('libraries/database.php');

class Model
{
    protected $pdo;

    function __construct()
    {
        $this->pdo = getPdo();
    }
}
