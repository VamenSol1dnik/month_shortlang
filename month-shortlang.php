<?php
/**
 * Plugin Name: Month Shortlang
 * Description: Provides dynamic date shortcodes with customizable translations for months and years.
 * Version: 1.2.0
 * Author: Solidny Ua
 * Text Domain: month-shortlang
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Запобігаємо прямому доступу.
}

// Підключення необхідних файлів.
require_once plugin_dir_path( __FILE__ ) . 'includes/admin-menu.php';
require_once plugin_dir_path( __FILE__ ) . 'includes/shortcodes.php';

// Активація плагіна.
function month_shortlang_activate() {
    add_option( 'month_shortlang_months', [] ); // Збереження кастомних назв місяців.
}
register_activation_hook( __FILE__, 'month_shortlang_activate' );

// Деактивація плагіна.
function month_shortlang_deactivate() {
    delete_option( 'month_shortlang_months' ); // Видалення налаштувань.
}
register_deactivation_hook( __FILE__, 'dynamic_dates_deactivate' );