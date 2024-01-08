<?php

namespace Sep\LoggingPackage\Logger;

use Sep\LoggingPackage\Interfaces\WriterInterface;

class Logger
{
    private WriterInterface $writer;

    public string $fileName;

    public function __construct(WriterInterface $writer, $fileName)
    {
        $this->writer = $writer;
        $this->fileName = $fileName;
    }

    public function log(string $message, string $severity): void
    {
        $timestamp = date('Y-m-d H:i:s');
        $entry = "[$timestamp][$severity]: $message" . PHP_EOL;
        $this->writer->write($this->fileName, $entry);
    }

    public function fatal(string $message): void
    {
        $this->log($message, 'fatal');
    }

    public function error(string $message): void
    {
        $this->log($message, 'error');
    }

    public function warning(string $message): void
    {
        $this->log($message, 'warning');
    }
}
