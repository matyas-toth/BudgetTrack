<?php

include_once("BudgetManagerAPI.php");

$api = new BudgetManagerAPI("budget");

$api->removeEntry($_GET["period"], $_GET["id"]);

header('Location: index.php?period='.strtolower($_GET["period"]).'');

?>