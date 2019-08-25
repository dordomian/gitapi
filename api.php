<?php

if(count($argv)<3) {
	throw new \Exception('błąd');
}
$gitIndex = 1;

$serviceArr = getopt(null, ["service:"]);
$service = 'github';

if(!empty($serviceArr)){
	$service = $serviceArr['service'];
	$gitIndex++;
}

$git = $argv[$gitIndex];
$branch = $argv[$gitIndex + 1];


//echo "Git: {$git}, branch: {$branch}, service: {$service}";

spl_autoload_register(function ($class) {
            $file = str_replace('\\', DIRECTORY_SEPARATOR, $class).'.php';
            if (file_exists($file)) {
                require $file;
                return true;
            }
            return false;
        });

$git = new RepoServices\GitHubService\GitHubService();

$git->setConfig([]);
