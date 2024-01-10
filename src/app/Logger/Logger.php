<?php

declare(strict_types=1);

namespace Sep\LoggingPackage\Logger;

use Sep\LoggingPackage\Formatter\StandardFormat;
use Sep\LoggingPackage\Interfaces\FormatInterface;
use Sep\LoggingPackage\Interfaces\InterpolatorInterface;
use Sep\LoggingPackage\Interfaces\LoggerInterface;
use Sep\LoggingPackage\Interfaces\WriterInterface;
use Sep\LoggingPackage\Interpolator\ArrayInterpolator;

class Logger implements LoggerInterface
{
    /**
     * Default logger class
     *
     * Basic usage logger class
     * Includes standard file-writer & interpolator
     *
     */
    private WriterInterface $writer;
    private InterpolatorInterface $interpolator;

    private FormatInterface $formatter;

    /**
     * @param WriterInterface $writer
     * @param InterpolatorInterface $interpolator
     * @param FormatInterface $formatter
     */
    public function __construct(WriterInterface $writer, InterpolatorInterface $interpolator = new ArrayInterpolator(), FormatInterface $formatter = new StandardFormat())
    {
        $this->writer = $writer;
        $this->interpolator = $interpolator;
        $this->formatter = $formatter;
    }

    /**
     * @param string $severity
     * @param string $message
     * @param array $context
     * @return void
     */
    public function log(string $severity, string $message, array $context = []): void
    {
        $severity = strtoupper($severity);

        if (!$context) {
            $entry = $this->formatter->format($message, $severity);
        }
        else {
            $entry = $this->formatter->format($this->interpolator->interpolate($message, $context), $severity);
        }

        $this->writer->write($entry . PHP_EOL);
    }

    /**
     * @param string $message
     * @param array $context
     * @return void
     */
    public function critical(string $message, array $context = []): void
    {
        $this->log(LogLevels::CRITICAL, $message, $context);
    }

    /**
     * @param string $message
     * @param array $context
     * @return void
     */
    public function error(string $message, array $context = []): void
    {
        $this->log(LogLevels::ERROR, $message, $context);
    }

    /**
     * @param string $message
     * @param array $context
     * @return void
     */
    public function warning(string $message, array $context = []): void
    {
        $this->log(LogLevels::WARNING, $message, $context);
    }

    /**
     * @param string $message
     * @param array $context
     * @return void
     */
    public function info(string $message, array $context = []): void
    {
        $this->log(LogLevels::INFO, $message, $context);
    }

    /**
     * @param string $message
     * @param array $context
     * @return void
     */
    public function debug(string $message, array $context = []): void
    {
        $this->log(LogLevels::DEBUG, $message, $context);
    }

    /**
     * @param string $message
     * @param array $context
     * @return void
     */
    public function notice(string $message, array $context = []): void
    {
        $this->log(LogLevels::NOTICE, $message, $context);
    }

    /**
     * @param string $message
     * @param array $context
     * @return void
     */
    public function alert(string $message, array $context = []): void
    {
        $this->log(LogLevels::ALERT, $message, $context);
    }

    /**
     * @param string $message
     * @param array $context
     * @return void
     */
    public function emergency(string $message, array $context = []): void
    {
        $this->log(LogLevels::EMERGENCY, $message, $context);
    }
}
