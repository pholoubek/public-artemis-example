<?php
// Theme setup
function artemis_setup() {
    // Add theme support
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    add_theme_support('html5', array('search-form', 'comment-form', 'comment-list', 'gallery', 'caption'));
    
    // Register navigation menu
    register_nav_menus(array(
        'primary' => 'Primary Menu',
    ));
}
add_action('after_setup_theme', 'artemis_setup');

// Enqueue styles and scripts
function artemis_scripts() {
    wp_enqueue_style('artemis-style', get_stylesheet_uri(), array(), '1.0');
}
add_action('wp_enqueue_scripts', 'artemis_scripts');

// Optimize for static generation
function artemis_static_optimizations() {
    // Remove unnecessary WordPress features for static sites
    remove_action('wp_head', 'wp_generator');
    remove_action('wp_head', 'wlwmanifest_link');
    remove_action('wp_head', 'rsd_link');
    remove_action('wp_head', 'wp_shortlink_wp_head');
    
    // Disable embeds
    remove_action('wp_head', 'wp_oembed_add_discovery_links');
    remove_action('wp_head', 'wp_oembed_add_host_js');
}
add_action('init', 'artemis_static_optimizations');

// Add static-friendly meta tags
function artemis_static_meta() {
    echo '<meta name="generator" content="WordPress + Artemis Static">' . "\n";
}
add_action('wp_head', 'artemis_static_meta');
?>