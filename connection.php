<?php

$conn= new mysqli('localhost', 'root', '');

if($conn->connect_error){
	die("connection failed: ".$conn->connect_error);
}

$sql="CREATE DATABASE IF NOT EXISTS users";

if($conn->query($sql)===true){
	echo "database created successfully";
}else{
	echo "error creating database:".$conn->error;

}

$newConn= new mysqli('localhost', 'root', '', 'users');

$sqlOne="CREATE TABLE IF NOT EXISTS accounts(name VARCHAR(255) PRIMARY KEY)";

if($newConn->query($sqlOne)===true){
	echo "table created successfully";
}else{
	echo "error creating table :".$conn->error;

}

$anotherSQL='ALTER TABLE accounts 
ADD COLUMN password VARCHAR(255), ALTER TABLE accounts 
ADD COLUMN image VARCHAR(255)
';


if($newConn->query($anotherSQL)===true){
	echo " successfully";
}else{
	echo "error  :".$conn->error;

}


$conn->close();

?>