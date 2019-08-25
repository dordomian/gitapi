<?php

require_once 'autoloader.php';

$configArr = require_once 'config.php';

if(count($argv)<3) {
    echo new \Exceptions\InvalidParametersNumberException("Invalid number of parameters");
    exit;
}
$repoIndex = 2;

$service = getopt(null, ["service:"])['service'] ?? NULL;

if(!$service){
    $repoIndex--;
    $service = $configArr['default_service'];
}

$repo = $argv[$repoIndex];
$branch = $argv[$repoIndex + 1];

if(empty($configArr['services'][$service])) {
    echo new \Exceptions\NotFoundServiceException("Unknown service '{$service}'");
    exit;
}

$serviceClass = $configArr['services'][$service];

$repoService = new $serviceClass();

$repoService->setConfig(['repo'=>$repo,'branch'=>$branch]);

echo $repoService->getLastCommit();