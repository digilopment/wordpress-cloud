<?php
namespace AiHeadlines\Utils;

class PromptBuilder {
    public static function build($content): string {
        return "Analyze the following article and respond in JSON. 
        Identify the main topic and propose 3–5 SEO-friendly titles.
        Content:\n\n" . strip_tags($content);
    }
}
