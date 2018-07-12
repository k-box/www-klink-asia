<?php

use TightenCo\Jigsaw\Parsers\ParsedownExtraParser;

return [
    'baseUrl' => env('APP_URL'),
    'production' => true,
    'collections' => [],
    'klink_token' => env('KLINK_TOKEN'),
    'markdownRender' => function ($page, $text) {
        $parser = new ParsedownExtraParser();
        return $parser->parse($text);
    },
];
