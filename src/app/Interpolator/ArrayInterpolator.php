<?php

declare(strict_types=1);

namespace Sep\LoggingPackage\Interpolator;

use Sep\LoggingPackage\Interfaces\InterpolatorInterface;

class ArrayInterpolator implements InterpolatorInterface
{
    /**
     *
     * Standard interpolator for array to string conversion
     *
     * @param string $message
     * @param array $context
     * @return string
     */
    public function interpolate(string $message, array $context = []): string
    {
        $replacement = [];

        foreach ($context as $key => $value) {
            if ($value instanceof \Exception) {
                $replacement['{' . $key . '}'] = $value->getMessage() . "\n" . $value->getTraceAsString();
            }
            elseif ((!is_array($value) && !is_object($value)) || method_exists($value, '__toString')) {
                $replacement['{' . $key . '}'] = $value;
            }
        }

        return strtr($message, $replacement);
    }
}
