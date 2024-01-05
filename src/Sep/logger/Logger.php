<?php

namespace Sep\LoggingPackage;

class Logger
{
    protected string $loggerFilePath;

    public function __construct(string $loggerFilePath)
    {
        $this->loggerFilePath = $loggerFilePath;
    }

    private function writeToFile(string $fileName, string $content): void
    {
        if (!$this->loggerFilePath) {
            throw new \RuntimeException("No filepath given");
        }

        try {
            $logFile = $this->loggerFilePath . strtolower($fileName) . '.log';
            file_put_contents($logFile, $content, FILE_APPEND);
        } catch (\RuntimeException $exception) {
            echo "Error:", $exception->getMessage();
        }
    }

    public function log(string $message, string $type = 'None given', string $severity = 'None given'): void
    {
        $timestamp = date('Y-m-d H:i:s');
        $entry = "[$timestamp][$type][$severity]: $message" . PHP_EOL;
        $this->writeToFile($type, $entry);
    }

    public function logError(\Throwable $exception, string $message = "An error occurred: ", string $errorType = "None"): void
    {
        $timestamp = date('Y-m-d H:i:s');
        $entry = "[$timestamp][Error]:" . $exception->getMessage() . " in " . $exception->getFile() . " line " . $exception->getLine() . PHP_EOL;
        $this->writeToFile($errorType . '_error', $entry);
        echo $message . '<br>';
    }

    public function logWarning(string $warningMessage, string $warningType = "None"): void
    {
        $timestamp = date('Y-m-d H:i:s');
        $warningEntry = "[$timestamp][Warning]: $warningMessage" . PHP_EOL;
        $this->writeToFile($warningType . '_warnings', $warningEntry);
        echo $warningMessage . '<br>';
    }

    public function logMetaData(string $message, array $metadata, string $metadataType = "None"): void
    {
        $timestamp = date('Y-m-d H:i:s');
        try {
            $warningEntry = "[$timestamp][Metadata]: $message- Metadata: " . json_encode($metadata, JSON_THROW_ON_ERROR) . PHP_EOL;
        } catch (\JsonException $e) {
            echo "Error:", $exception->getMessage();
        }
        $this->writeToFile($metadataType . '_metadata', $warningEntry);
        echo $message . '<br>';
    }
}
