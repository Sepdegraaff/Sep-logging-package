<?php

declare(strict_types=1);

namespace Sep\LoggingPackage\Interfaces;

interface LoggerInterface
{
    /**
     * System is unusable.
     *
     * @param string $message
     * @param array $context
     * @return void
     */
    public function critical(string $message, array $context = []);

    public function error(string $message, array $context = []);

    public function warning(string $message, array $context = []);

    public function info(string $message, array $context = []);

    public function debug(string $message, array $context = []);

    public function notice(string $message, array $context = []);

    public function alert(string $message, array $context = []);

    public function emergency(string $message, array $context = []);

    public function log(string $severity, string $message, array $context = []);
}