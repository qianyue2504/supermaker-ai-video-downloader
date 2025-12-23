<?php

require __DIR__ . '/../vendor/autoload.php';

use SuperMaker\AiVideoDownloader\Backlinks;

$errors = 0;

function assertContains($needle, $haystack, $msg) {
    global $errors;
    if (strpos($haystack, $needle) === false) {
        $errors++;
        fwrite(STDERR, "FAIL: $msg\n");
    }
}

$url = Backlinks::buildLink([
    'utm_source' => 'blog',
    'utm_medium' => 'banner',
    'utm_campaign' => 'video',
    'path' => Backlinks::defaultPath(),
]);
assertContains('utm_source=blog', $url, 'utm_source missing');
assertContains('utm_medium=banner', $url, 'utm_medium missing');
assertContains('utm_campaign=video', $url, 'utm_campaign missing');
assertContains(Backlinks::defaultPath(), $url, 'path missing');

$anchor = Backlinks::generateAnchor([
    'text' => 'Try SuperMaker Video',
    'rel' => 'sponsored noopener',
    'class' => 'supermaker-video-link',
    'utm' => ['utm_source' => 'docs'],
    'path' => Backlinks::defaultPath(),
]);
assertContains('<a ', $anchor, 'anchor not starting');
assertContains('class="supermaker-video-link"', $anchor, 'class missing');
assertContains('>Try SuperMaker Video</a>', $anchor, 'text missing');
assertContains('utm_source=docs', $anchor, 'utm missing');
assertContains(Backlinks::defaultPath(), $anchor, 'path missing');

if ($errors === 0) {
    fwrite(STDOUT, "All tests passed.\n");
    exit(0);
} else {
    exit(1);
}
