<?php

namespace AiHeadlines\Utils;

class HeadlinePlaceHolder
{
    // Generuje placeholder topic a titles
    public static function generate(): array
    {
        return [
            'topic' => 'Sample Topic',
            'titles' => [
                'Demo Title ' . rand(10, 100),
                'Demo Title ' . rand(10, 100),
                'Demo Title ' . rand(10, 100),
            ],
        ];
    }
}
