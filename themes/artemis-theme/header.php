<?php
/**
 * Header template for Artemis Theme
 */
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php wp_title('|', true, 'right'); ?><?php bloginfo('name'); ?></title>
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
    <header class="site-header">
        <div class="header-container">
            <!-- Logo Section -->
            <div class="header-logo">
                <a href="<?php echo home_url(); ?>" class="logo-link">
                    <?php 
                    $logo = artemis_get_logo();
                    if ($logo && $logo !== get_template_directory_uri() . '/assets/images/logo.png' || file_exists(get_template_directory() . '/assets/images/logo.png')) : ?>
                        <img src="<?php echo esc_url($logo); ?>" alt="<?php bloginfo('name'); ?>" class="logo-image">
                    <?php endif; ?>
                    <span class="logo-text"><?php bloginfo('name'); ?></span>
                </a>
            </div>

            <!-- Location Section -->
            <div class="header-location">
                <select class="location-selector" id="location-selector">
                    <option value="">Select Location</option>
                    <option value="elmsford">Elmsford, NY</option>
                    <option value="orange">Orange, CT</option>
                </select>
            </div>

            <!-- Search Bar Section -->
            <div class="header-search">
                <form role="search" method="get" class="search-form" action="<?php echo home_url('/'); ?>">
                    <div class="search-container">
                        <input type="search" 
                               class="search-field" 
                               placeholder="Search..." 
                               value="<?php echo get_search_query(); ?>" 
                               name="s" 
                               autocomplete="off">
                        <button type="submit" class="search-submit">
                            <svg class="search-icon" viewBox="0 0 24 24" width="20" height="20">
                                <path fill="currentColor" d="M15.5 14h-.79l-.28-.27C15.41 12.59 16 11.11 16 9.5 16 5.91 13.09 3 9.5 3S3 5.91 3 9.5 5.91 16 9.5 16c1.61 0 3.09-.59 4.23-1.57l.27.28v.79l5 4.99L20.49 19l-4.99-5zm-6 0C7.01 14 5 11.99 5 9.5S7.01 5 9.5 5 14 7.01 14 9.5 11.99 14 9.5 14z"/>
                            </svg>
                        </button>
                    </div>
                </form>
            </div>

            <!-- Navigation Section -->
            <nav class="header-navigation">
                <ul class="nav-menu">
                    <li class="nav-item">
                        <a href="<?php echo home_url('/about'); ?>" class="nav-link">About Us</a>
                    </li>
                    <li class="nav-item">
                        <a href="<?php echo home_url('/blog'); ?>" class="nav-link">Blog</a>
                    </li>
                    <li class="nav-item user-menu">
                        <?php if (is_user_logged_in()) : ?>
                            <div class="user-dropdown">
                                <button class="user-toggle" id="user-menu-toggle">
                                    <span class="user-name"><?php echo wp_get_current_user()->display_name; ?></span>
                                    <svg class="dropdown-arrow" viewBox="0 0 24 24" width="16" height="16">
                                        <path fill="currentColor" d="M7 10l5 5 5-5z"/>
                                    </svg>
                                </button>
                                <div class="user-dropdown-menu" id="user-dropdown-menu">
                                    <a href="<?php echo admin_url(); ?>" class="dropdown-link">Dashboard</a>
                                    <a href="<?php echo wp_logout_url(); ?>" class="dropdown-link">Logout</a>
                                </div>
                            </div>
                        <?php else : ?>
                            <div class="auth-links">
                                <a href="<?php echo wp_login_url(); ?>" class="auth-link login-link">Login</a>
                                <a href="<?php echo wp_registration_url(); ?>" class="auth-link register-link">Register</a>
                            </div>
                        <?php endif; ?>
                    </li>
                </ul>
            </nav>

            <!-- Mobile Menu Toggle -->
            <button class="mobile-menu-toggle" id="mobile-menu-toggle">
                <span class="hamburger-line"></span>
                <span class="hamburger-line"></span>
                <span class="hamburger-line"></span>
            </button>
        </div>

        <!-- Mobile Menu -->
        <div class="mobile-menu" id="mobile-menu">
            <div class="mobile-search">
                <form role="search" method="get" class="mobile-search-form" action="<?php echo home_url('/'); ?>">
                    <input type="search" 
                           class="mobile-search-field" 
                           placeholder="Search..." 
                           value="<?php echo get_search_query(); ?>" 
                           name="s">
                    <button type="submit" class="mobile-search-submit">Search</button>
                </form>
            </div>
            <div class="mobile-location">
                <select class="mobile-location-selector">
                    <option value="">Select Location</option>
                    <option value="elmsford">Elmsford, NY</option>
                    <option value="orange">Orange, CT</option>
                </select>
            </div>
            <nav class="mobile-navigation">
                <ul class="mobile-nav-menu">
                    <li><a href="<?php echo home_url('/about'); ?>">About Us</a></li>
                    <li><a href="<?php echo home_url('/blog'); ?>">Blog</a></li>
                    <?php if (is_user_logged_in()) : ?>
                        <li><a href="<?php echo admin_url(); ?>">Dashboard</a></li>
                        <li><a href="<?php echo wp_logout_url(); ?>">Logout</a></li>
                    <?php else : ?>
                        <li><a href="<?php echo wp_login_url(); ?>">Login</a></li>
                        <li><a href="<?php echo wp_registration_url(); ?>">Register</a></li>
                    <?php endif; ?>
                </ul>
            </nav>
        </div>
    </header>
