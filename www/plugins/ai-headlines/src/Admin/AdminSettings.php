<?php

namespace AiHeadlines\Admin;

class AdminSettings
{

    const OPTION_NAME = 'ai_openai_api_key';

    public function register()
    {
        add_action('admin_init', [$this, 'register_setting']);
    }

    public function register_setting()
    {
        // Registrácia option
        register_setting('general', self::OPTION_NAME, [
            'type' => 'string',
            'sanitize_callback' => 'sanitize_text_field',
            'default' => '',
        ]);

        // Pridanie field do General settings
        add_settings_field(
            self::OPTION_NAME,
            'OpenAI API Key',
            [$this, 'render_field'],
            'general',
            'default'
        );
    }

    public function render_field()
    {
        $value = get_option(self::OPTION_NAME, '');
        echo '<input type="text" id="' . self::OPTION_NAME . '" name="' . self::OPTION_NAME . '" value="' . esc_attr($value) . '" class="regular-text">';
    }
}
