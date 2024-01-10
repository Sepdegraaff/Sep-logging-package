<?php

namespace Sep\LoggingPackage\Formatter;

use Sep\LoggingPackage\Interfaces\FormatInterface;
use Sep\LoggingPackage\Logger\LogLevels;

class SlackFormat implements FormatInterface
{
    protected string $channelId;

    public function __construct(string $channelId)
    {
        $this->channelId = $channelId;
    }

    public function format(string $message, string $severity): string
    {
        $timestamp = date('Y-m-d H:i:s');

        $severityIconAndColor = match (strtolower($severity)) {
            LogLevels::EMERGENCY => [":radioactive_sign:", "#FF0000"],
            LogLevels::ALERT => [":exclamation:", "#FFFF00"],
            LogLevels::NOTICE => [":grey_exclamation:", "#36a64f"],
            LogLevels::WARNING => [":warning:", "#ffa500"],
            LogLevels::CRITICAL => [":bangbang:", "#FF0000"],
            LogLevels::ERROR => [":no_entry:", "#FFFF00"],
            LogLevels::INFO => [":information_source:", "#36a64f"],
            LogLevels::DEBUG => [":ladybug:", "#36a64f"],
            default => ["", "#36a64f"],
        };

        $severityIcon = $severityIconAndColor[0];
        $barColor = $severityIconAndColor[1];

        return '{
              "channel": "' . $this->channelId . '",
              "attachments": [
                {
                  "color": "' . $barColor . '",
                  "text": "*Message:* ' . addcslashes($message, '\\') . '\n*Severity Level:* ' . $severityIcon . ' ' . $severity . ' ' . $severityIcon . '\n*Timestamp:* :clock1: ' . $timestamp . '"
                }
              ]
        }';
    }
}
