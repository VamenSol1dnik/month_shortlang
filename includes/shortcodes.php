<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

// Шорткод для поточного року.
function month_shortlang_current_year_shortcode() {
    return date('Y');
}
add_shortcode('current_year', 'month_shortlang_current_year_shortcode');

// Функція для отримання налаштованого місяця.
function month_shortlang_get_custom_month() {
    $months = get_option('dynamic_dates_months', []);
    $current_month_number = date('n'); // Отримати номер поточного місяця (1-12)
    return $months[$current_month_number] ?? date('F');
}

// Шорткод для поточного місяця.
function month_shortlang_current_month_shortcode() {
    return month_shortlang_get_custom_month();
}
add_shortcode('current_month', 'month_shortlang_current_month_shortcode');

// Додати кастомні дані до Yoast SEO Title та Meta Description.
function month_shortlang_customize_yoast_seo($title) {
    $custom_month = month_shortlang_get_custom_month();
    $current_year = date('Y');

    // Заміна спеціальних маркерів у SEO Title та Meta Description
    $title = str_replace('[current_month]', $custom_month, $title);
    $title = str_replace('[current_year]', $current_year, $title);

    return $title;
}
add_filter('wpseo_title', 'month_shortlang_customize_yoast_seo');
add_filter('wpseo_metadesc', 'month_shortlang_customize_yoast_seo');