<?php

namespace AiHeadlines\Storage;

class TitlesRepository
{

    private const TABLE_NAME = 'ai_title_suggestions';

    private function getTableName()
    {
        global $wpdb;
        return $wpdb->prefix . self::TABLE_NAME;
    }

    public static function create_table()
    {
        global $wpdb;
        $table = $wpdb->prefix . self::TABLE_NAME;
        $charset_collate = $wpdb->get_charset_collate();

        $sql = "CREATE TABLE IF NOT EXISTS $table (
            id BIGINT AUTO_INCREMENT PRIMARY KEY,
            post_id BIGINT NOT NULL,
            topic TEXT,
            titles LONGTEXT,
            created_at DATETIME DEFAULT CURRENT_TIMESTAMP
        ) $charset_collate;";

        require_once ABSPATH . 'wp-admin/includes/upgrade.php';
        dbDelta($sql);
    }

    public function getByPostId($postId)
    {
        global $wpdb;
        $table = $this->getTableName();

        $query = $wpdb->prepare("SELECT * FROM {$table} WHERE post_id = %d LIMIT 1", $postId);
        return $wpdb->get_row($query);
    }

    public function store($post_id, $data)
    {
        global $wpdb;
        $table = $this->getTableName();

        $wpdb->insert($table, [
            'post_id' => $post_id,
            'topic' => sanitize_text_field($data['topic'] ?? ''),
            'titles' => json_encode($data['titles'] ?? []),
        ]);
    }

    public function deleteByPostId($postId)
    {
        global $wpdb;
        $table = $this->getTableName();

        $wpdb->delete($table, ['post_id' => $postId], ['%d']);
    }

}
