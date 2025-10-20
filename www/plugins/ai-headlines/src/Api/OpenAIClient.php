<?php

namespace AiHeadlines\API;

use AiHeadlines\Utils\PromptBuilder;

class OpenAIClient
{

    private string $api_key;
    private string $endpoint = 'https://api.openai.com/v1/chat/completions';

    public function __construct(string $api_key)
    {
        $this->api_key = $api_key;
    }

    public function generateTitles(string $content)
    {
        if (empty($this->api_key)) {
            return [
                'topic' => 'Sample Topic',
                'titles' => [
                    'Návrh nadpisu 1',
                    'Návrh nadpisu 2',
                    'Návrh nadpisu 3'
                ]
            ];
        }

        $prompt = PromptBuilder::build($content);

        $response = wp_remote_post($this->endpoint, [
            'headers' => [
                'Authorization' => 'Bearer ' . $this->api_key,
                'Content-Type' => 'application/json'
            ],
            'body' => json_encode([
                'model' => 'gpt-4o-mini',
                'messages' => [['role' => 'user', 'content' => $prompt]],
            ]),
        ]);

        return json_decode(wp_remote_retrieve_body($response), true);
    }

}
