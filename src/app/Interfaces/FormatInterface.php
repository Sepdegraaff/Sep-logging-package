<?php

declare(strict_types=1);

namespace Sep\LoggingPackage\Interfaces;

interface FormatInterface
{
    public function format(string $message, string $severity);
}