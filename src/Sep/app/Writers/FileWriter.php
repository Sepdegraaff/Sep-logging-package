<?php

declare(strict_types=1);

namespace Sep\LoggingPackage\Writers;

use Sep\LoggingPackage\Interfaces\WriterInterface;

class FileWriter implements WriterInterface
{
    /**
     *
     * Standard file-writer to write logs to files
     *
     */

    protected string $loggerFilePath;
    protected string $fileName;
    public function __construct(string $loggerFilePath, string $fileName)
    {
        $this->loggerFilePath = $loggerFilePath;
        $this->fileName = $fileName;
    }

    /**
     * @param string $content
     * @return void
     */
    public function write(string $content): void
    {
        if (!$this->loggerFilePath) {
            throw new \RuntimeException("No filepath given");
        }

        try {
            $logFile = $this->loggerFilePath . strtolower($this->fileName) . '.log';
            file_put_contents($logFile, $content, FILE_APPEND);
        } catch (\RuntimeException $exception) {
            echo "Error:", $exception->getMessage();
        }
    }
}