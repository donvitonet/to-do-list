<?php

class DatabaseConnection
{
  private $con;

  private $server;
  private $user;
  private $pass;
  private $options = [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
  ];

  public function __construct()
  {
    $path = realpath('./.env');
    if (!$path) {
      throw new Exception('.env file not found');
    }

    $env = parse_ini_file($path);

    $dbhost = $env['DB_HOST'];
    $dbname = $env['DB_DATABASE'];
    $this->server = "mysql:host=$dbhost;dbname=$dbname;charset=utf8";
    $this->user = $env['DB_USERNAME'];
    $this->pass = $env['DB_PASSWORD'];
  }

  public function openConnection()
  {
    try {
        $this->con = new PDO($this->server, $this->user, $this->pass, $this->options);
        return $this->con;
    } catch (PDOException $e) {
        echo 'There is some problem in connection: ' . $e->getMessage();
    }
  }

  public function closeConnection()
  {
      $this->con = null;
  }
}