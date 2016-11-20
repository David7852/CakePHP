<?php
$baseDir = dirname(dirname(__FILE__));
return [
    'plugins' => [
        'Cake/Localized' => $baseDir . '/vendor/cakephp/localized//',
        'DebugKit' => $baseDir . '/vendor/cakephp/debug_kit/'
    ]
];