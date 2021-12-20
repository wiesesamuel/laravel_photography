<?php

namespace App\Helper;

class LanguageManager
{
    protected $fileManager;

    public function __construct()
    {
        $this->fileManager = new FileManager();
    }

    public function simplifyLocationJsons()
    {
        $sourceDir = resource_path('lang/raw/');
        $destinationDir = resource_path('lang/');

        $files = $this->fileManager->getFilesFromDirectory($sourceDir, ['json']);
        foreach ($files as $lang => $sourceDir) {
            $content = json_decode($this->fileManager->readFile($sourceDir), true);
            $simplified = $this->simplify($content);
            asort($simplified);
            $this->fileManager->writeFile($destinationDir . $lang, json_encode($simplified, JSON_PRETTY_PRINT));
        }
    }

    private function simplify($array)
    {
        $filtered = array();

        array_walk_recursive($array, function ($val, $key) use (&$filtered) {
            if (is_string($key) && is_string($val)) {
                $filtered[$key] = $val;
            }
        });

        return array_unique($filtered);
    }

}
