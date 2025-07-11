/**
 * Header functionality for Artemis Theme
 */
document.addEventListener('DOMContentLoaded', function() {
    // Mobile menu toggle
    const mobileMenuToggle = document.getElementById('mobile-menu-toggle');
    const mobileMenu = document.getElementById('mobile-menu');
    
    if (mobileMenuToggle && mobileMenu) {
        mobileMenuToggle.addEventListener('click', function() {
            mobileMenuToggle.classList.toggle('active');
            mobileMenu.classList.toggle('show');
        });
    }
    
    // User dropdown menu
    const userMenuToggle = document.getElementById('user-menu-toggle');
    const userDropdownMenu = document.getElementById('user-dropdown-menu');
    
    if (userMenuToggle && userDropdownMenu) {
        userMenuToggle.addEventListener('click', function(e) {
            e.preventDefault();
            userMenuToggle.classList.toggle('active');
            userDropdownMenu.classList.toggle('show');
        });
        
        // Close dropdown when clicking outside
        document.addEventListener('click', function(e) {
            if (!userMenuToggle.contains(e.target) && !userDropdownMenu.contains(e.target)) {
                userMenuToggle.classList.remove('active');
                userDropdownMenu.classList.remove('show');
            }
        });
    }
    
    // Location selector functionality
    const locationSelector = document.getElementById('location-selector');
    const mobileLocationSelector = document.querySelector('.mobile-location-selector');
    
    function handleLocationChange(selector) {
        if (selector) {
            selector.addEventListener('change', function() {
                const selectedLocation = this.value;
                if (selectedLocation) {
                    // Store selected location in localStorage
                    localStorage.setItem('selectedLocation', selectedLocation);
                    
                    // You can add custom functionality here, such as:
                    // - Updating page content based on location
                    // - Filtering search results
                    // - Showing location-specific information
                    
                    console.log('Location changed to:', selectedLocation);
                }
            });
        }
    }
    
    handleLocationChange(locationSelector);
    handleLocationChange(mobileLocationSelector);
    
    // Load saved location on page load
    const savedLocation = localStorage.getItem('selectedLocation');
    if (savedLocation) {
        if (locationSelector) locationSelector.value = savedLocation;
        if (mobileLocationSelector) mobileLocationSelector.value = savedLocation;
    }
    
    // Enhanced search functionality
    const searchFields = document.querySelectorAll('.search-field, .mobile-search-field');
    
    searchFields.forEach(function(field) {
        // Add search suggestions (you can customize this)
        field.addEventListener('input', function() {
            const query = this.value.trim();
            if (query.length > 2) {
                // Here you can add search suggestions functionality
                // For example, show dropdown with suggestions
                console.log('Search query:', query);
            }
        });
        
        // Submit on Enter key
        field.addEventListener('keypress', function(e) {
            if (e.key === 'Enter') {
                e.preventDefault();
                this.closest('form').submit();
            }
        });
    });
    
    // Sync mobile and desktop location selectors
    function syncLocationSelectors() {
        if (locationSelector && mobileLocationSelector) {
            locationSelector.addEventListener('change', function() {
                mobileLocationSelector.value = this.value;
            });
            
            mobileLocationSelector.addEventListener('change', function() {
                locationSelector.value = this.value;
            });
        }
    }
    
    syncLocationSelectors();
    
    // Close mobile menu when window is resized to desktop
    window.addEventListener('resize', function() {
        if (window.innerWidth > 768) {
            if (mobileMenu) mobileMenu.classList.remove('show');
            if (mobileMenuToggle) mobileMenuToggle.classList.remove('active');
        }
    });
    
    // Smooth scroll for anchor links
    document.querySelectorAll('a[href^="#"]').forEach(function(link) {
        link.addEventListener('click', function(e) {
            const href = this.getAttribute('href');
            if (href === '#') return;
            
            const target = document.querySelector(href);
            if (target) {
                e.preventDefault();
                target.scrollIntoView({
                    behavior: 'smooth',
                    block: 'start'
                });
            }
        });
    });
});
