<?php
if (!defined('ABSPATH')) {
    exit; // Заборона прямого доступу
}

// ✅ Додавання меню налаштувань
function month_shortlang_add_admin_menu() {
    add_menu_page(
        __('Month Shortlang Settings', 'month-shortlang'), // Заголовок сторінки
        __('Month Shortlang', 'month-shortlang'), // Назва меню
        'manage_options', // Рівень доступу
        'month_shortlang-settings', // Унікальний ідентифікатор сторінки
        'month_shortlang_settings_page', // Функція для відображення сторінки
        'dashicons-calendar-alt', // Іконка меню
        80 // Позиція в меню
    );
}
add_action('admin_menu', 'month_shortlang_add_admin_menu');

// ✅ Реєстрація налаштувань
function month_shortlang_register_settings() {
    register_setting('month_shortlang_settings_group', 'month_shortlang_months');

    add_settings_section(
        'month_shortlang_main_section',
        __('Month Settings', 'month-shortlang'),
        'month_shortlang_section_callback',
        'month_shortlang-settings'
    );

    // Додати поля для кожного місяця
    $default_months = [
        1 => 'January', 2 => 'February', 3 => 'March',
        4 => 'April', 5 => 'May', 6 => 'June',
        7 => 'July', 8 => 'August', 9 => 'September',
        10 => 'October', 11 => 'November', 12 => 'December'
    ];

    foreach ($default_months as $key => $default_month) {
        add_settings_field(
            "month_shortlang_month_{$key}",
            esc_html($default_month),
            'month_shortlang_month_field_callback',
            'month_shortlang-settings',
            'month_shortlang_main_section',
            ['month_key' => $key, 'default_value' => $default_month]
        );
    }
}
add_action('admin_init', 'month_shortlang_register_settings');

// ✅ Callback для секції
function month_shortlang_section_callback() {
    echo '<p>' . __('Customize month names for different languages.', 'month-shortlang') . '</p>';
}

// ✅ Callback для полів місяців
function month_shortlang_month_field_callback($args) {
    $months = get_option('month_shortlang_months', []);
    $month_key = $args['month_key'];
    $default_value = $args['default_value'];
    $value = $months[$month_key] ?? $default_value;

    echo '<input type="text" name="month_shortlang_months[' . esc_attr($month_key) . ']" value="' . esc_attr($value) . '" />';
}

// ✅ Сторінка налаштувань
function month_shortlang_settings_page() {
    ?>
    <div class="wrap">
        <h1><?php _e('Month Shortlang Settings', 'month-shortlang'); ?></h1>
        <form method="post" action="options.php">
            <?php
            settings_fields('month_shortlang_settings_group');
            do_settings_sections('month_shortlang-settings');
            submit_button(__('Save Changes', 'month-shortlang'));
            ?>
        </form>
    </div>
    <?php
}