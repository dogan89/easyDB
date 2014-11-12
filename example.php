<?php
/**
 * easyDB for PDO
 * NOTE: Requires PHP version 5 or later
 * @author		Dogan ISIKDEMIR
 * @email		dgn_isikdemir@hotmail.com
 * @website		http://www.dusyazilim.com/
 * @facebook	https://www.facebook.com/dogan89
 * @twitter		https://twitter.com/dogan89
 * @linkedin	https://tr.linkedin.com/in/dogan89
 * @github		https://github.com/dogan89
 */

session_start();

error_reporting(E_ALL ^ E_NOTICE);
ini_set("display_errors", 1);

header('Content-type: text/html; charset=utf-8');

//Database Connection
$db	= new PDO("mysql:host=localhost;dbname=[dbname];charset=utf8", "[dbusername]", "[dbpass]");

//Easy DB
require('class/easydb.php');
$easydb	= new easyDB($db);



#SELECT QUERY

//Select example 1
$userdetails	= $easydb->query("SELECT * FROM users WHERE userid = :userid", array('userid' => 12));
//Select example 2
$userdetails	= $easydb->selectSingle("SELECT * FROM users WHERE userid = :userid", array('userid' => 12));
//Select example 3
$userdetails	= $easydb->findSingle("users", "userid = :userid", array('userid' => 12));

echo $userdetails["name"];
echo $userdetails["lastname"];
echo $userdetails["location"];



#SELECT ALL QUERY

//Select All example 1
$userlist		= $easydb->query("SELECT * FROM users ORDER BY name ASC, lastname ASC", array(), "all");
//Select All example 2
$userlist		= $easydb->query("SELECT * FROM users WHERE location = :location ORDER BY name ASC, lastname ASC", array('location' => 'turkey'), "all");
//Select All example 3
$userlist		= $easydb->selectAll("SELECT * FROM users WHERE location = :location ORDER BY name ASC, lastname ASC", array('location' => 'turkey'));
//Select All example 4
$userlist		= $easydb->findAll("users", "location = :location" array('location' => 'turkey'));
//Select All example 5
$userlist		= $easydb->findAll("users");

foreach($userlist as $user)
{
	echo $user["name"];
	echo $user["lastname"];
	echo $user["location"];
}



#INSERT QUERY

if($easydb->insert('users', array('name' => 'Dogan', 'lastname' => 'isikdemir', 'location' => 'turkey')))
{
	echo 'Success';
	echo 'LastInsertId: '.$easydb->lastInsertId();
}
else
{
	echo 'failed';
}



#UPDATE QUERY

//Update example 1
$update	= $easydb->query("UPDATE users SET location='istanbul' WHERE userid = :userid", array('userid' => 1), "update");
//Update example 2
$update	= $easydb->update("UPDATE users SET location='istanbul' WHERE userid = :userid", array('userid' => 1));

echo $update;



#DELETE QUERY

//Delete example 1
$delete	= $easydb->query("DELETE FROM users WHERE userid = :userid", array('userid' => 1), "delete");
//Delete example 2
$delete	= $easydb->delete("DELETE FROM users WHERE userid = :userid", array('userid' => 1));
//Delete example 3
$delete	= $easydb->deleteAll("users", "userid = :userid", array('userid' => 1));
//Delete example 4
$delete	= $easydb->deleteAll("users");

echo $delete;
?>