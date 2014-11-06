<?php
session_start();

error_reporting(E_ALL ^ E_NOTICE);
ini_set("display_errors", 1);

header('Content-type: text/html; charset=utf-8');

//Veritabanı bağlantısı
$db	= new PDO("mysql:host=localhost;dbname=[dbname];charset=utf8", "[dbusername]", "[dbpass]");

//Easy DB
require('class/easydb.php');
$easydb	= new easyDB($db);

//Select
$userdetails	= $easydb->query("SELECT * FROM users WHERE userid = :userid", array('userid', 12));

echo $userdetails["name"];
echo $userdetails["lastname"];
echo $userdetails["location"];

//Select All
$userlist		= $easydb->query("SELECT * FROM users ORDER BY name ASC, lastname ASC", array(), "all");
//OR
$userlist		= $easydb->query("SELECT * FROM users WHERE location = :location ORDER BY name ASC, lastname ASC", array('location' => 'turkey'), "all");

foreach($userlist as $user)
{
	echo $user["name"];
	echo $user["lastname"];
	echo $user["location"];
}

//Insert
if($easydb->insert('users', array('name' => 'Dogan', 'lastname' => 'isikdemir', 'location' => 'turkey')))
{
	echo 'Success';
	echo 'LastInsertId: '.$easydb->lastInsertId();
}
else
{
	echo 'failed';
}

//Update
$update	= $easydb->query("UPDATE users SET location='istanbul' WHERE userid = :userid", array('userid' => 1), "update");
echo $update;

//Delete
$delete	= $easydb->query("DELETE FROM users WHERE userid = :userid", array('userid' => 1), "delete");
echo $delete;
?>