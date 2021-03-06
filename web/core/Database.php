<?php

namespace core;

use PDO;

class Database
{
  public $pdo;

  public function __construct($config)
  {
    $dsn = $config["dsn"] ?? "";
    $user = $config["user"] ?? "";
    $password = $config["password"] ?? "";

    $this->pdo = new \PDO($dsn, $user, $password);

    $this->pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
    $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  }
}
