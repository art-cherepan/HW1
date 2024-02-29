<?php

use App\service\FinderDirectoryRecursiveService;

require_once  __DIR__ . '/../vendor/autoload.php';

$finderService = new FinderDirectoryRecursiveService();

echo $finderService->find();
