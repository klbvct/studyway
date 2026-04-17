<?php
function bobcat_create_consent_log_table() {
    global $wpdb;
 
    $table_name = $wpdb->prefix . 'consent_log'; 
    $charset_collate = $wpdb->get_charset_collate();

    $sql = "CREATE TABLE $table_name (
        id bigint(20) NOT NULL AUTO_INCREMENT,
        user_id bigint(20) NOT NULL DEFAULT 0,
        anon_id varchar(50) NOT NULL,
        consent_timestamp datetime NOT NULL,
        consent_options longtext NOT NULL,
        consent_lang varchar(10) NOT NULL,
        ip_address varchar(45) NOT NULL,
        user_agent text NOT NULL,
        PRIMARY KEY (id),
        KEY anon_id (anon_id),
        KEY user_id (user_id)
    ) $charset_collate;";

    require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
    dbDelta($sql);
}
add_action('after_setup_theme', 'bobcat_create_consent_log_table');

function bobcat_save_user_consent() {
global $wpdb;
    $table_name = $wpdb->prefix . 'consent_log';
    
    if (empty($_POST['consent_data'])) {
        wp_send_json_error(['message' => 'Нет данных согласия.']);
        wp_die();
    }

    $consent_data = json_decode(stripslashes($_POST['consent_data']), true);
    
    $user_id = get_current_user_id(); // 0, если пользователь не авторизован
    $anon_id = sanitize_text_field($consent_data['anon_id'] ?? uniqid('anon_')); 

    if ($user_id === 0) {
        setcookie('bobcat_anon_id', $anon_id, time() + (86400 * 365), "/"); // Устанавливаем куку на 1 год
    }
    
    $record = [
        'user_id'           => $user_id,
        'anon_id'           => $anon_id,

        'consent_timestamp' => date('Y-m-d H:i:s', strtotime($consent_data['timestamp'])), 
        'consent_options'   => json_encode([ // Сохраняем только ключевые настройки
            'analytics_storage' => $consent_data['analytics_storage'] ?? 'denied',
            'ad_storage'        => $consent_data['ad_storage'] ?? 'denied',
            'personalization_storage' => $consent_data['personalization_storage'] ?? 'denied',
        ]),
        'consent_lang'      => sanitize_text_field($consent_data['lang'] ?? 'ru'),
        'ip_address'        => $_SERVER['REMOTE_ADDR'] ?? '0.0.0.0', 
        'user_agent'        => $_SERVER['HTTP_USER_AGENT'] ?? 'Unknown',
    ];

    $data_formats = array('%d', '%s', '%s', '%s', '%s', '%s', '%s');
    $log_id = 0;

    if ($user_id > 0) {
        $existing_record_id = $wpdb->get_var( $wpdb->prepare(
            "SELECT id FROM {$table_name} WHERE user_id = %d",
            $user_id
        ) );
    } else {
        $existing_record_id = $wpdb->get_var( $wpdb->prepare(
            "SELECT id FROM {$table_name} WHERE anon_id = %s",
            $anon_id
        ) );
    }

    if ($existing_record_id) {
        $result = $wpdb->update(
            $table_name,
            $record, // Данные для обновления
            ['id' => $existing_record_id], // Условие WHERE
            $data_formats, // Форматы данных
            ['%d'] // Формат WHERE-условия (id)
        );
        $log_id = $existing_record_id;
    } else {
        $result = $wpdb->insert(
            $table_name,
            $record,
            $data_formats // Форматы данных
        );
        $log_id = $wpdb->insert_id;
    }

    if ($result === false) {
        wp_send_json_error(['message' => 'Ошибка записи в БД.', 'db_error' => $wpdb->last_error]);
    } else {
        wp_send_json_success(['message' => 'Согласие сохранено.', 'log_id' => $wpdb->insert_id]);
    }

    wp_die();
}

add_action('wp_ajax_consent_save_action', 'bobcat_save_user_consent');
add_action('wp_ajax_nopriv_consent_save_action', 'bobcat_save_user_consent');