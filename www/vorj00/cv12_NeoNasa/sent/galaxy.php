<?php
$mysql = array(
    "host" => "localhost",
    "user" => "",
    "password" => "",
    "database" => "",
    "charset" => "utf8",
);

$mysqli = @new mysqli($mysql['host'], $mysql['user'], $mysql['password'], $mysql['database']);

@$mysqli->query("SET NAMES " . $mysql['charset']);

if (mysqli_connect_errno()) {die("MySQLi connect error: " . mysqli_connect_error());
}

class NeoNasa
{

    public function fetchAllGalaxy()
    {

        return $fetchAllGalaxy = $mysqli->query('SELECT * FROM galaxy');

    }

    public function fetchAllSpaceStation()
    {

        return $fetchAllSpaceStation = $mysqli->query('SELECT * FROM spaceStation');

    }

    public function fetchSpaceStation($id)
    {

        return $fetchSpaceStation = $mysqli->query('SELECT * FROM spaceStation WHERE galaxy ="' . $id . '" ');

    }

}
