<?php

require_once 'autoloader.php';

$configArr = require_once 'config.php';

if(count($argv)<3) {
    echo new \Exceptions\InvalidParametersNumberException("Invalid number of parameters");
    exit;
}
$service = $configArr['default_service'];

$gitIndex = 1;
$serviceArr = getopt(null, ["service:"]);

if(!empty($serviceArr)){
	$service = $serviceArr['service'];
	$gitIndex++;
}

$repo = $argv[$gitIndex];
$branch = $argv[$gitIndex + 1];

if(empty($configArr['services'][$service])) {
    echo new \Exceptions\NotFoundServiceException("Unknown service {$service}");
    exit;
}

$serviceClass = $configArr['services'][$service];

$repoService = new $serviceClass();

$repoService->setConfig(['repo'=>$repo,'branch'=>$branch]);

echo $repoService->getLastCommit();