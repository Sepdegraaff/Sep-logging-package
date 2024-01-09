<?php

declare(strict_types=1);

namespace Sep\LoggingPackage\Interfaces;

interface WriterInterface
{
    /**
     * Use to make writers
     */
    public function write(string $content);
}