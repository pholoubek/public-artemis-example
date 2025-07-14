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
    // Enqueue global design system variables first
    wp_enqueue_style('artemis-global-variables', get_template_directory_uri() . '/assets/css/global-variables.css', array(), '1.0');
    
    // Enqueue base styles that use the design tokens
    wp_enqueue_style('artemis-base-styles', get_template_directory_uri() . '/assets/css/base-styles.css', array('artemis-global-variables'), '1.0');
    
    // Enqueue main theme stylesheet
    wp_enqueue_style('artemis-style', get_stylesheet_uri(), array('artemis-global-variables', 'artemis-base-styles'), '1.0');
    
    wp_enqueue_script('artemis-header', get_template_directory_uri() . '/assets/js/header.js', array(), '1.0', true);
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

// Theme customizer options
function artemis_customize_register($wp_customize) {
    // Header section
    $wp_customize->add_section('artemis_header', array(
        'title' => 'Header Settings',
        'priority' => 30,
    ));
    
    // Logo setting
    $wp_customize->add_setting('artemis_logo', array(
        'default' => '',
        'sanitize_callback' => 'esc_url_raw',
    ));
    
    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'artemis_logo', array(
        'label' => 'Logo',
        'section' => 'artemis_header',
        'settings' => 'artemis_logo',
    )));
    
    // Contact information
    $wp_customize->add_section('artemis_contact', array(
        'title' => 'Contact Information',
        'priority' => 35,
    ));
    
    $wp_customize->add_setting('artemis_phone', array(
        'default' => '(914) 555-0123',
        'sanitize_callback' => 'sanitize_text_field',
    ));
    
    $wp_customize->add_control('artemis_phone', array(
        'label' => 'Phone Number',
        'section' => 'artemis_contact',
        'type' => 'text',
    ));
    
    $wp_customize->add_setting('artemis_email', array(
        'default' => 'info@example.com',
        'sanitize_callback' => 'sanitize_email',
    ));
    
    $wp_customize->add_control('artemis_email', array(
        'label' => 'Email Address',
        'section' => 'artemis_contact',
        'type' => 'email',
    ));
}
add_action('customize_register', 'artemis_customize_register');

// Get custom logo
function artemis_get_logo() {
    $logo = get_theme_mod('artemis_logo');
    if ($logo) {
        return $logo;
    }
    return get_template_directory_uri() . '/assets/images/logo.png';
}

// Enable user registration
function artemis_enable_registration() {
    if (!get_option('users_can_register')) {
        update_option('users_can_register', 1);
    }
}
add_action('init', 'artemis_enable_registration');

// Custom search form
function artemis_search_form($form) {
    $form = '<form role="search" method="get" class="search-form" action="' . home_url('/') . '">
        <div class="search-container">
            <input type="search" class="search-field" placeholder="Search..." value="' . get_search_query() . '" name="s" autocomplete="off">
            <button type="submit" class="search-submit">
                <svg class="search-icon" viewBox="0 0 24 24" width="20" height="20">
                    <path fill="currentColor" d="M15.5 14h-.79l-.28-.27C15.41 12.59 16 11.11 16 9.5 16 5.91 13.09 3 9.5 3S3 5.91 3 9.5 5.91 16 9.5 16c1.61 0 3.09-.59 4.23-1.57l.27.28v.79l5 4.99L20.49 19l-4.99-5zm-6 0C7.01 14 5 11.99 5 9.5S7.01 5 9.5 5 14 7.01 14 9.5 11.99 14 9.5 14z"/>
                </svg>
            </button>
        </div>
    </form>';
    return $form;
}
add_filter('get_search_form', 'artemis_search_form');

// Add body classes for better styling
function artemis_body_classes($classes) {
    if (is_user_logged_in()) {
        $classes[] = 'logged-in-user';
    } else {
        $classes[] = 'logged-out-user';
    }
    return $classes;
}
add_filter('body_class', 'artemis_body_classes');