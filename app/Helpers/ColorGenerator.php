<?php

namespace App\Helpers;

final class ColorGenerator
{
    /**
     * Generates a deterministic color (hex) from a string.
     *
     * @param string $string Input string (e.g., username, category name)
     * @param float $saturation Saturation (0.0 to 1.0)
     * @param float $lightness Lightness (0.0 to 1.0)
     * @return string Hex color code (e.g., "#3a7bd5")
     */
    public function fromString(string $string, float $saturation = 0.7, float $lightness = 0.6): string
    {
        // Hash the string to an integer
        $hash = crc32($string);

        // Convert hash to HSL's hue (0-360)
        $hue = $hash % 360;

        // Convert HSL to RGB
        $rgb = $this->hslToRgb($hue / 360, $saturation, $lightness);

        // Format RGB as hex
        return sprintf('#%02x%02x%02x', $rgb[0], $rgb[1], $rgb[2]);
    }

    /**
     * Helper: Convert HSL to RGB.
     *
     * @param float $h Hue (0.0 to 1.0)
     * @param float $s Saturation (0.0 to 1.0)
     * @param float $l Lightness (0.0 to 1.0)
     * @return array [R, G, B] (0-255 each)
     */
    private function hslToRgb(float $h, float $s, float $l): array
    {
        $r = $g = $b = 0.0;

        if (0 === $s) {
            $r = $g = $b = round($l * 255);
        } else {
            $q = $l < 0.5 ? $l * (1 + $s) : $l + $s - $l * $s;
            $p = 2 * $l - $q;

            $hk = $h + 1 / 3;
            $r = $this->hueToRgb($hk, $p, $q);
            $hk -= 1 / 3;
            $g = $this->hueToRgb($hk, $p, $q);
            $hk -= 1 / 3;
            $b = $this->hueToRgb($hk, $p, $q);
        }

        return [
            round($r * 255),
            round($g * 255),
            round($b * 255),
        ];
    }

    /**
     * Helper: Convert hue to RGB component.
     */
    private function hueToRgb(float $hk, float $p, float $q): float
    {
        $hk = $hk < 0 ? $hk + 1 : ($hk > 1 ? $hk - 1 : $hk);

        if ($hk < 1 / 6) {
            return $p + ($q - $p) * 6 * $hk;
        }
        if ($hk < 1 / 2) {
            return $q;
        }
        if ($hk < 2 / 3) {
            return $p + ($q - $p) * (2 / 3 - $hk) * 6;
        }

        return $p;
    }

}
