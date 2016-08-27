<?php

class BaseModel {
	private $config = [];
	
	public function __construct()
	{
		$this->config = require 'config.php';
	}
	
	public function connection()
	{
		$config = $this->config;
		static $connection;
		if (empty($connection)) {
			// $dsn потому что эта строка - имя источника данных (Data Source Name)
			// смотри доки: http://php.net/manual/ru/pdo.construct.php
			$dsn = 'mysql:host=' . $config['host'] . ';dbname=' . $config['dbname'];
			$connection = new PDO ($dsn, $config['user'], $config['password'], [
				PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
				PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
				PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES ' . $config['encoding']
			]);
		}
		return $connection;
	}
}
