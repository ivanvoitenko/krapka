<?php

namespace Roots\Sage\Setup;

use Roots\Sage\Assets;

/**
 * Theme setup
 */
function setup()
{
    // Enable features from Soil when plugin is activated
    // https://roots.io/plugins/soil/
    add_theme_support('soil-clean-up');
    add_theme_support('soil-nav-walker');
    add_theme_support('soil-nice-search');
    add_theme_support('soil-disable-trackbacks');
    add_theme_support('soil-js-to-footer');
    add_theme_support('soil-jquery-cdn');
    add_theme_support('soil-relative-urls');

    // Make theme available for translation
    // Community translations can be found at https://github.com/roots/sage-translations
    load_theme_textdomain('sage', get_template_directory() . '/lang');

    // Enable plugins to manage the document title
    // http://codex.wordpress.org/Function_Reference/add_theme_support#Title_Tag
    add_theme_support('title-tag');

    // Register wp_nav_menu() menus
    // http://codex.wordpress.org/Function_Reference/register_nav_menus
    register_nav_menus([
        'primary_navigation' => __('Primary Navigation', 'sage'),
        'mobile_navigation'  => __('Mobile Navigation', 'sage'),
        'footer_mobile_navigation'  => __('Footer Mobile Navigation', 'sage'),
    ]);

    // Enable post thumbnails
    // http://codex.wordpress.org/Post_Thumbnails
    // http://codex.wordpress.org/Function_Reference/set_post_thumbnail_size
    // http://codex.wordpress.org/Function_Reference/add_image_size
    add_theme_support('post-thumbnails');


    add_image_size('author-big', 400, 200, true);
    add_image_size('post', 590, 350, true);
    add_image_size('post@2', 1180, 700, true);

    remove_image_size('alm-thumbnail');

    // Enable HTML5 markup support
    // http://codex.wordpress.org/Function_Reference/add_theme_support#HTML5
    add_theme_support('html5', ['caption', 'comment-form', 'comment-list', 'gallery', 'search-form']);

    // Use main stylesheet for visual editor
    // To add custom styles edit /assets/styles/layouts/_tinymce.scss
    add_editor_style(Assets\asset_path('styles/main.css'));
}

add_action('after_setup_theme', __NAMESPACE__ . '\\setup');

/**
 * Register sidebars
 */
function widgets_init()
{
    register_sidebar([
        'name' => __('Footer 1', 'sage'),
        'id' => 'sidebar-footer-1',
        'before_title' => '<div class="footer-title">',
        'after_title' => '</div>',
        'before_widget' => '<div class="widget-content">',
		'after_widget' => "</div>"
    ]);

    register_sidebar([
        'name' => __('Footer 2', 'sage'),
        'id' => 'sidebar-footer-2',
        'before_title' => '<div class="footer-title">',
        'after_title' => '</div>',
        'before_widget' => '<div class="widget-content">',
		'after_widget' => "</div>"
    ]);

    register_sidebar([
        'name' => __('Footer 3', 'sage'),
        'id' => 'sidebar-footer-3',
        'before_title' => '<div class="footer-title">',
        'after_title' => '</div>',
        'before_widget' => '<div class="widget-content">',
		'after_widget' => "</div>"
    ]);

    register_sidebar([
        'name' => __('Footer 4', 'sage'),
        'id' => 'sidebar-footer-4',
        'before_title' => '<div class="footer-title">',
        'after_title' => '</div>',
        'before_widget' => '<div class="widget-content">',
		'after_widget' => "</div>"
    ]);

}

add_action('widgets_init', __NAMESPACE__ . '\\widgets_init');

/**
 * Determine which pages should NOT display the sidebar
 */
function display_sidebar()
{
    static $display;

    isset($display) || $display = !in_array(true, [
        // The sidebar will NOT be displayed if ANY of the following return true.
        // @link https://codex.wordpress.org/Conditional_Tags
        is_404(),
        is_front_page(),
        is_page_template('template-custom.php'),
    ]);

    return apply_filters('sage/display_sidebar', $display);
}

/**
 * Theme assets
 */
function assets()
{
    wp_enqueue_style('open-sans-font', 'https://fonts.googleapis.com/css?family=Open+Sans:400,700,800|Ubuntu:400,700');

    if (is_author()) {
        wp_enqueue_style('noto-font', 'https://fonts.googleapis.com/css?family=Noto+Serif&subset=cyrillic');
    }

    //wp_enqueue_style('sage/vendor', Assets\asset_path('styles/vendor.css'));
    wp_enqueue_style('sage/vendor', get_template_directory_uri() . '/static/dist/css/libs.min.css');
    wp_enqueue_style('sage/vendor-main', get_template_directory_uri() . '/static/dist/css/style.css');
    wp_enqueue_style('sage/css', Assets\asset_path('styles/main.css'), false, null);

    if (is_single() && comments_open() && get_option('thread_comments')) {
        wp_enqueue_script('comment-reply');
    }

    wp_enqueue_script('sage/vendor', get_template_directory_uri() . '/static/dist/js/libs.min.js', ['jquery'], null, true);
    wp_enqueue_script('sage/core', Assets\asset_path('scripts/main.js'), ['jquery'], null, true);
    wp_localize_script( 'sage/core', 'settings', [
        'homeurl' => home_url(),
        'ajax_url' => admin_url('admin-ajax.php')
    ]);
}

add_action('wp_enqueue_scripts', __NAMESPACE__ . '\\assets', 100);
