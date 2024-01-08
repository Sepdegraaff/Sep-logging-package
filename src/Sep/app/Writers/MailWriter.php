<?php

declare(strict_types=1);

namespace Sep\LoggingPackage\Writers;

use Sep\LoggingPackage\Interfaces\WriterInterface;

class MailWriter implements WriterInterface
{
    protected string $loggerFilePath;

    public function __construct(string $loggerFilePath)
    {
        $this->loggerFilePath = $loggerFilePath;
    }
    public function write(string $name, string $content): void
    {
        if (!$this->loggerFilePath) {
            throw new \RuntimeException("No filepath given");
        }

        try {
            $logFile = $this->loggerFilePath . strtolower($name) . '.log';
            file_put_contents($logFile, $content, FILE_APPEND);
        } catch (\RuntimeException $exception) {
            echo "Error:", $exception->getMessage();
        }
    }
}