<?php

namespace AiHeadlines\Admin;

class AdminUI
{
    public function register()
    {
        add_action('admin_enqueue_scripts', [$this, 'enqueue']);
        add_action('edit_form_after_title', [$this, 'render_button']);
    }

    public function enqueue()
    {
        wp_enqueue_script('ai-admin', plugin_dir_url(__FILE__) . '../../assets/js/admin.js', ['jquery'], '1.0', true);
        wp_localize_script('ai-admin', 'AIConfig', [
            'ajax_url' => admin_url('admin-ajax.php'),
            'nonce' => wp_create_nonce('ai_generate_titles'),
        ]);
    }

    public function render_button($post)
    {
        if ($post->post_status === 'auto-draft') {
            return;
        }
        echo '<button type="button" class="button button-primary" id="ai-generate-titles">Navrhnúť AI nadpisy</button>';
    }
}
