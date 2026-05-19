<?php

namespace App\Support;

use Illuminate\Support\Facades\Storage;

final class PublicMedia
{
    public static function normalize(?string $path): ?string
    {
        if (!$path) {
            return null;
        }

        if (filter_var($path, FILTER_VALIDATE_URL)) {
            return $path;
        }

        $normalized = trim(str_replace('\\', '/', $path), '/');

        if ($normalized === '') {
            return null;
        }

        do {
            $original = $normalized;

            foreach (['storage/', 'public/'] as $prefix) {
                if (str_starts_with($normalized, $prefix)) {
                    $normalized = substr($normalized, strlen($prefix));
                }
            }
        } while ($normalized !== $original);

        return $normalized === '' ? null : $normalized;
    }

    public static function url(?string $path, ?string $fallback = null): string
    {
        if (!$path) {
            return $fallback ?? '';
        }

        if (filter_var($path, FILTER_VALIDATE_URL)) {
            return $path;
        }

        $normalized = self::normalize($path);

        if (!$normalized) {
            return $fallback ?? '';
        }

        if (!Storage::disk('public')->exists($normalized)) {
            return $fallback ?? '';
        }

        return route('media.show', ['path' => $normalized]);
    }
}
