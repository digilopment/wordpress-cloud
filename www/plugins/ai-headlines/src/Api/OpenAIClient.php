<?php

namespace AiHeadlines\API;

use AiHeadlines\Utils\HeadlinePlaceHolder;
use AiHeadlines\Utils\PromptBuilder;

class OpenAIClient
{
    private string $api_key;

    private string $endpoint = 'https://api.openai.com/v1/chat/completions';

    private HeadlinePlaceHolder $placeholder;

    public function __construct(string $api_key)
    {
        $this->api_key = $api_key;
        $this->placeholder = new HeadlinePlaceHolder();
    }

    public function generateTitles(string $content)
    {
        if (empty($this->api_key)) {
            return $this->placeholder->generate();
        }

        $prompt = PromptBuilder::build($content);

        $response = wp_remote_post($this->endpoint, [
            'headers' => [
                'Authorization' => 'Bearer ' . $this->api_key,
                'Content-Type' => 'application/json',
            ],
            'body' => json_encode([
                'model' => 'gpt-4o-mini',
                'messages' => [['role' => 'user', 'content' => $prompt]],
            ]),
        ]);

        if (is_wp_error($response)) {
            return $this->placeholder->generate();
        }

        $body = json_decode(wp_remote_retrieve_body($response), true);

        if (isset($body['error']['code']) && $body['error']['code'] === 'insufficient_quota') {
            return [
                'topic' => '',
                'titles' => [],
            ];
        }

        return $body;
    }
}
