<?php

declare(strict_types=1);

namespace Sep\LoggingPackage\Interfaces;

interface WriterInterface
{
    public function write(string $name, string $content);
}