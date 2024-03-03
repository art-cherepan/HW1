<?php

namespace App\service;

use RecursiveDirectoryIterator;
use RecursiveIteratorIterator;

class FinderDirectoryRecursiveService implements FinderServiceInterface
{
    private const string START_DIRECTORY = __DIR__ . '/../resources';
    private const string FILE_NAME = 'count';

    public function find(): int
    {
        $recursiveDirIterator = new RecursiveDirectoryIterator(self::START_DIRECTORY);
        $recursiveIterator = new RecursiveIteratorIterator($recursiveDirIterator);

        $count = 0;
        foreach ($recursiveIterator as $item) {
            if ($item->isFile()
                && $item->isReadable()
                && $item->getFilename() === self::FILE_NAME
            ) {
                $count += $this->parseContent(file_get_contents($item));
            }
        }

        return $count;
    }

    private function parseContent(string $content): int
    {
        $sum = 0;
        $contentExplode = explode(PHP_EOL, $content);

        foreach ($contentExplode as $item) {
            $sum += (int)$item;
        }

        return $sum;
    }
}
