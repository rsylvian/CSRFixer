<?php

require_once "CSRFixer/CSRFixer.php";

// This is an example that show how to use CSRFixer
// Imagine we are in a bank application :

if (!isset($_GET["token"]))
	echo "Error : illegitimate request !";

if (isset($_GET) && 
	isset($_GET["user"]) && 
	isset($_GET["receiver"]) && 
	isset($_GET["amount"]) &&
	isset($_GET["token"]))
{
	$user = $_GET["user"];
	$receiver = $_GET["receiver"];
	$amount = $_GET["amount"];
	$token = $_GET["token"];

	if (CSRFixer::isValid($token))
	{
		echo "User " . $user . " gives " . $amount . "$ to " . $receiver;
		// Here we are in a secure context !
		// You can perform database queries to save the money transfer :)
	}
	else
		echo "Error : illegitimate request !";
}

?>