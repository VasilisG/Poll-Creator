<?php

require_once __DIR__ . '\..\..\vendor\autoload.php';

$voteController = new \Poll\Controller\Vote();
$result = $voteController->execute();
return $result;