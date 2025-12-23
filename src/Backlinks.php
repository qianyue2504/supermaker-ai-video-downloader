<?php

namespace SuperMaker\AiVideoDownloader;

class Backlinks
{
    private const BASE_URL = 'https://supermaker.ai/';
    private const DEFAULT_PATH = '/video/';

    public static function defaultPath(): string
    {
        return self::DEFAULT_PATH;
    }

    public static function buildLink(array $options = []): string
    {
        $path = $options['path'] ?? self::DEFAULT_PATH;
        $targetPath = ltrim($path, '/');
        $url = rtrim(self::BASE_URL, '/') . '/' . $targetPath;

        $query = array_filter([
            'utm_source' => $options['utm_source'] ?? null,
            'utm_medium' => $options['utm_medium'] ?? null,
            'utm_campaign' => $options['utm_campaign'] ?? null,
        ]);

        if (!empty($query)) {
            $url .= '?' . http_build_query($query);
        }

        return $url;
    }

    public static function generateAnchor(array $options = []): string
    {
        $text = $options['text'] ?? 'SuperMaker AI Video Downloader';
        $rel = $options['rel'] ?? 'noopener';
        $target = $options['target'] ?? '_blank';
        $class = $options['class'] ?? '';
        $path = $options['path'] ?? null;

        $utm = $options['utm'] ?? [];
        $href = self::buildLink([
            'utm_source' => $utm['utm_source'] ?? null,
            'utm_medium' => $utm['utm_medium'] ?? null,
            'utm_campaign' => $utm['utm_campaign'] ?? null,
            'path' => $path,
        ]);

        $attrs = [
            'href' => $href,
            'target' => $target,
        ];
        if (!empty($rel)) {
            $attrs['rel'] = $rel;
        }
        if (!empty($class)) {
            $attrs['class'] = $class;
        }

        $attrStr = '';
        foreach ($attrs as $key => $value) {
            $attrStr .= sprintf(' %s="%s"', htmlspecialchars($key, ENT_QUOTES), htmlspecialchars($value, ENT_QUOTES));
        }

        return sprintf('<a%s>%s</a>', $attrStr, htmlspecialchars($text, ENT_QUOTES));
    }
}
