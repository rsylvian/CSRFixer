<?php

require_once "CSRFixer.php";

if (!isset($_SESSION))
	session_start();

$tp = new TokenProvider();
$json = new stdClass();
$json->token = $tp->getToken();
echo json_encode($json);

?>