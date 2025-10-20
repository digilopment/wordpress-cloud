<?php

namespace AiHeadlines;

use AiHeadlines\Admin\ACFIntegration;
use AiHeadlines\Admin\AdminSettings;
use AiHeadlines\Admin\AdminUI;
use AiHeadlines\Api\Routes;
use AiHeadlines\Cli\GenerateTitlesCommand;
use WP_CLI;

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
        (new AdminSettings())->register();

        if (defined('WP_CLI') && WP_CLI) {
            WP_CLI::add_command('ai-gen', new GenerateTitlesCommand());
        }
    }
}
