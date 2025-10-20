<?php
/**
 * Plugin Name: AI Headlines
 * Description: AI generovanie SEO nadpisov cez OpenAI pre Classic Editor.
 * Version: 1.0.0
 * Author: Tomas Doubek
 */
if (!defined('ABSPATH'))
    exit;


require_once __DIR__ . '/src/Admin/AdminUI.php';
require_once __DIR__ . '/src/Admin/ACFIntegration.php';
require_once __DIR__ . '/src/Api/OpenAIClient.php';
require_once __DIR__ . '/src/Api/Routes.php';
require_once __DIR__ . '/src/Storage/TitlesRepository.php';
require_once __DIR__ . '/src/Utils/PromptBuilder.php';
require_once __DIR__ . '/src/Plugin.php';

use AiHeadlines\Plugin;
use AiHeadlines\Storage\TitlesRepository;

register_activation_hook(__FILE__, [TitlesRepository::class, 'create_table']);

function ai_headlines_bootstrap()
{
    (new Plugin())->init();
}

add_action('plugins_loaded', 'ai_headlines_bootstrap');
