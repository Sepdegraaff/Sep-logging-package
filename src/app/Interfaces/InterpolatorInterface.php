<?php

declare(strict_types=1);

namespace Sep\LoggingPackage\Interfaces;

interface InterpolatorInterface
{
    public function interpolate(string $message, array $context = []): string;
}