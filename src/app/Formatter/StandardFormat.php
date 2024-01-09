<?php

declare(strict_types=1);

namespace Sep\LoggingPackage\Formatter;

use Sep\LoggingPackage\Interfaces\FormatInterface;

class StandardFormat implements FormatInterface
{
    public function format(string $message, string $severity): string
    {
        $timestamp = date('Y-m-d H:i:s');

        return "[$timestamp][$severity]: $message ";
    }
}