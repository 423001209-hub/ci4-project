<?php
// Provides a minimal fallback for the PHP intl `Locale` class when the
// `intl` extension is not available in the environment (common in CI/dev).
if (! class_exists('Locale')) {
    class Locale
    {
        protected static $default = 'en';

        public static function setDefault(string $locale): void
        {
            self::$default = $locale;
        }

        public static function getDefault(): string
        {
            return self::$default;
        }

        public static function getPrimaryLanguage(string $locale): ?string
        {
            if (empty($locale)) {
                return null;
            }
            $parts = preg_split('/[-_]/', $locale);
            return $parts[0] ?? null;
        }

        public static function acceptFromHttp(string $header): ?string
        {
            if (empty($header)) {
                return null;
            }
            $parts = explode(',', $header);
            $best = trim($parts[0]);
            return $best ?: null;
        }
    }
}
