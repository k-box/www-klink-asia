<?php

use TightenCo\Jigsaw\Parsers\ParsedownExtraParser;

return [

    // Application variables
    'siteTitle' => 'K-Link Asia',
    'shortname' => 'klink.asia',
    'siteDescription' => 'K-Link Asia is a network of knowledge platforms in the fields of Natural Resource Management, Climate Change and Biodiversity in Central Asia.',
    
    // Application manifest

    'theme_color' => '#3490dc',
    'background_color' => '#ffffff',

    // Application URL
    'baseUrl' => '',
    
    // K-Link Integration
    'klink_url' => env('KLINK_URL'), // at this time it will be probably null, the beforeBuild event will load the environment from a file and populate this
    'klink_token' => env('KLINK_TOKEN'), // at this time it will be probably null, the beforeBuild event will load the environment from a file and populate this
    
    // Build customization
    'production' => false,
    'collections' => [],
    'markdownRender' => function ($page, $text) {
        $parser = new ParsedownExtraParser();
        return $parser->parse($text);
    },
    'selected' => function ($page, $url, $selectedClasses = 'selected', $defaultClasses = '') {
        return str_contains($page->getPath(), $url) ? $selectedClasses : $defaultClasses;
    },
    'hasTemplate' => function ($page, $template) {
        return $page->extends === $template;
    },
    'language' => function($page, $lang = null){

        $pageLang = str_contains($page->getPath(), 'ru') ? 'ru' : 'en';

        if(is_null($lang)){
            return $pageLang;
        }

        return $pageLang === $lang;
    },
    'urlForLanguage' => function($page, $lang){
        $normalizedPath = str_replace("\\", "/", $page->getPath());
        $pageLang = str_contains($normalizedPath, 'ru') ? 'ru' : 'en';
        $url = trimPath(str_replace("/$pageLang","/$lang",$normalizedPath));
        return rightTrimPath($page->getBaseUrl()) . '/' . $url . '/';
    }
];
