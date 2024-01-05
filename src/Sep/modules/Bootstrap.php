<?php

namespace Sep\Testing;

use Sep\LoggingPackage\Logger;

class Bootstrap
{
    public function index(): void
    {
        $logger = new Logger(__DIR__ . '/../logger/Log-files/');

        try {
            $result = 10 / 0;
        } catch (\Throwable $exception) {
            $logger->logError($exception, "An error occurred: " . $exception->getMessage(), 'Division');
        }

        $additionalData = [
            'user_id' => 123,
            'action' => 'login_attempt',
            'device' => 'mobile',
        ];
        $logger->logMetaData("Login attempt failed.", $additionalData);
    }
}