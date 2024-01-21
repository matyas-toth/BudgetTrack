<?php

include_once("BudgetManagerAPI.php");

$api = new BudgetManagerAPI("budget");

$api->addEntry($_GET["period"], $_GET["name"], $_GET["amount"]);

header('Location: index.php?period='.strtolower($_GET["period"]).'');
