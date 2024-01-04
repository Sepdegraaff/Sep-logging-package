<?php

namespace Sep\LoggingPackage;

class Logger
{
    private string $loggerFilePath;

    public function __construct(string $loggerFilePath)
    {
        $this->loggerFilePath = $loggerFilePath;
    }

    public function log($message, $type, $severity = 'INFO'): void
    {
        $timestamp = date('Y-m-d H:i:s');
        $entry = "[$timestamp][$type][$severity]: $message". PHP_EOL;

        file_put_contents($this->loggerFilePath, $entry, FILE_APPEND);
    }
}