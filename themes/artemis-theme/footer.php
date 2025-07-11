<?php
/**
 * Footer template for Artemis Theme
 */
?>
    <footer class="site-footer">
        <div class="footer-container">
            <div class="footer-content">
                <div class="footer-section footer-about">
                    <h3 class="footer-title">About <?php bloginfo('name'); ?></h3>
                    <p class="footer-description">
                        <?php echo get_bloginfo('description', 'display'); ?>
                    </p>
                    <div class="footer-locations">
                        <div class="location-item">
                            <h4>Elmsford, NY</h4>
                            <p>123 Main Street<br>Elmsford, NY 10523<br>(914) 555-0123</p>
                        </div>
                        <div class="location-item">
                            <h4>Orange, CT</h4>
                            <p>456 Oak Avenue<br>Orange, CT 06477<br>(203) 555-0456</p>
                        </div>
                    </div>
                </div>

                <div class="footer-section footer-links">
                    <h3 class="footer-title">Quick Links</h3>
                    <nav class="footer-navigation">
                        <ul class="footer-menu">
                            <li><a href="<?php echo home_url('/'); ?>">Home</a></li>
                            <li><a href="<?php echo home_url('/about'); ?>">About Us</a></li>
                            <li><a href="<?php echo home_url('/blog'); ?>">Blog</a></li>
                            <li><a href="<?php echo home_url('/contact'); ?>">Contact</a></li>
                            <li><a href="<?php echo home_url('/privacy'); ?>">Privacy Policy</a></li>
                            <li><a href="<?php echo home_url('/terms'); ?>">Terms of Service</a></li>
                        </ul>
                    </nav>
                </div>

                <div class="footer-section footer-contact">
                    <h3 class="footer-title">Connect With Us</h3>
                    <div class="contact-info">
                        <div class="contact-item">
                            <span class="contact-label">Email:</span>
                            <a href="mailto:<?php echo esc_attr(get_theme_mod('artemis_email', 'info@example.com')); ?>"><?php echo esc_html(get_theme_mod('artemis_email', 'info@example.com')); ?></a>
                        </div>
                        <div class="contact-item">
                            <span class="contact-label">Phone:</span>
                            <a href="tel:<?php echo esc_attr(str_replace(['(', ')', ' ', '-'], '', get_theme_mod('artemis_phone', '(914) 555-0123'))); ?>"><?php echo esc_html(get_theme_mod('artemis_phone', '(914) 555-0123')); ?></a>
                        </div>
                    </div>
                    <div class="social-links">
                        <a href="#" class="social-link facebook" aria-label="Facebook">
                            <svg viewBox="0 0 24 24" width="24" height="24">
                                <path fill="currentColor" d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/>
                            </svg>
                        </a>
                        <a href="#" class="social-link twitter" aria-label="Twitter">
                            <svg viewBox="0 0 24 24" width="24" height="24">
                                <path fill="currentColor" d="M23.953 4.57a10 10 0 01-2.825.775 4.958 4.958 0 002.163-2.723c-.951.555-2.005.959-3.127 1.184a4.92 4.92 0 00-8.384 4.482C7.69 8.095 4.067 6.13 1.64 3.162a4.822 4.822 0 00-.666 2.475c0 1.71.87 3.213 2.188 4.096a4.904 4.904 0 01-2.228-.616v.06a4.923 4.923 0 003.946 4.827 4.996 4.996 0 01-2.212.085 4.936 4.936 0 004.604 3.417 9.867 9.867 0 01-6.102 2.105c-.39 0-.779-.023-1.17-.067a13.995 13.995 0 007.557 2.209c9.053 0 13.998-7.496 13.998-13.985 0-.21 0-.42-.015-.63A9.935 9.935 0 0024 4.59z"/>
                            </svg>
                        </a>
                        <a href="#" class="social-link linkedin" aria-label="LinkedIn">
                            <svg viewBox="0 0 24 24" width="24" height="24">
                                <path fill="currentColor" d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433c-1.144 0-2.063-.926-2.063-2.065 0-1.138.92-2.063 2.063-2.063 1.14 0 2.064.925 2.064 2.063 0 1.139-.925 2.065-2.064 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z"/>
                            </svg>
                        </a>
                    </div>
                </div>
            </div>

            <div class="footer-bottom">
                <div class="footer-copyright">
                    <p>&copy; <?php echo date('Y'); ?> <?php bloginfo('name'); ?>. All rights reserved.</p>
                </div>
                <div class="footer-legal">
                    <a href="<?php echo home_url('/privacy'); ?>">Privacy Policy</a>
                    <a href="<?php echo home_url('/terms'); ?>">Terms of Service</a>
                </div>
            </div>
        </div>
    </footer>

    <?php wp_footer(); ?>
</body>
</html>
