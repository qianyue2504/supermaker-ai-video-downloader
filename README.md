# SuperMaker AI Video Downloader (PHP)

构建指向 https://supermaker.ai/video/ 的外链及 HTML 片段。

## 安装

```bash
composer require supermaker/ai-video-downloader
```

## 用法

```php
<?php
require 'vendor/autoload.php';

use SuperMaker\AiVideoDownloader\Backlinks;

$url = Backlinks::buildLink([
    'utm_source' => 'blog',
    'utm_medium' => 'banner',
    'utm_campaign' => 'video',
    // 默认 path 是 /video/，如需可覆盖:
    // 'path' => Backlinks::defaultPath(),
]);

$html = Backlinks::generateAnchor([
    'text' => 'SuperMaker AI Video Downloader',
    'rel' => 'sponsored noopener',
    'utm' => ['utm_source' => 'blog'],
]);
```

## API
- `Backlinks::buildLink(array $options = [])` 返回 URL，支持 `utm_source`, `utm_medium`, `utm_campaign`, `path`（默认 `/video/`）。
- `Backlinks::generateAnchor(array $options = [])` 返回 HTML `<a>`，支持 `text`, `rel`, `target`, `class`, `utm`, `path`。
- `Backlinks::defaultPath()` => `/video/`.

## 开发/测试

```bash
composer install
composer test
```
