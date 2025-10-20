<?php

namespace AiHeadlines;

use AiHeadlines\Admin\AdminUI;
use AiHeadlines\Admin\ACFIntegration;
use AiHeadlines\API\Routes;
use AiHeadlines\CLI\GenerateTitlesCommand;

class Plugin
{

    public function init()
    {
        add_action('init', [$this, 'register_hooks']);
    }

    public function register_hooks()
    {
        (new AdminUI())->register();
        (new ACFIntegration())->register();
        (new Routes())->register();

        if (defined('WP_CLI') && WP_CLI) {
            require_once __DIR__ . '/Cli/GenerateTitlesCommand.php';
            \WP_CLI::add_command('ai-headlines', new GenerateTitlesCommand());
        }
    }

}
