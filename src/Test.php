<?php

namespace Sep\LoggingPackage;

class Test
{
    public function index(): void
    {
        $logger = new Logger("src/logfiles");
    }
}