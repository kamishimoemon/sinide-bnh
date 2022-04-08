<?php
namespace sinide\bnh\persistence\pg;

class IniDatabase
	extends PostgresDatabase
{
	public function __construct (array $config)
	{
		parent::__construct(
			$config["host"],
			intval($config["port"]),
			$config["name"],
			$config["username"],
			$config["password"]
		);
	}
}