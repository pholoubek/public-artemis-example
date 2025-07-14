<?php
/**
 * Debug file to check theme loading
 */
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Artemis Theme Debug</title>
    <style>
        :root {
            --color-primary: #2563eb;
            --color-on-primary: #ffffff;
            --spacing-4: 1rem;
            --spacing-6: 1.5rem;
            --shadow-md: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
            --z-index-sticky: 1020;
            --container-max-width: 1200px;
            --container-padding: 1rem;
            --header-height: 80px;
            --font-family-secondary: 'Poppins', sans-serif;
            --font-size-lg: 1.125rem;
            --font-weight-bold: 700;
            --transition-fast: 150ms ease-in-out;
            --radius-md: 0.375rem;
            --font-size-sm: 0.875rem;
            --font-family-primary: 'Inter', sans-serif;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: var(--font-family-primary);
            background: #f5f5f5;
        }

        .debug-banner {
            background: #ff6b6b;
            color: white;
            padding: 10px;
            text-align: center;
            font-weight: bold;
        }

        .site-header {
            background: var(--color-primary);
            color: var(--color-on-primary);
            box-shadow: var(--shadow-md);
            position: sticky;
            top: 0;
            z-index: var(--z-index-sticky);
        }

        .header-container {
            max-width: var(--container-max-width);
            margin: 0 auto;
            padding: var(--spacing-4) var(--container-padding);
            display: grid;
            grid-template-columns: 1fr 2fr 1fr;
            align-items: center;
            gap: var(--spacing-6);
            min-height: var(--header-height);
        }

        .header-left {
            display: flex;
            align-items: center;
            gap: var(--spacing-4);
            justify-self: start;
        }

        .header-center {
            justify-self: center;
            width: 100%;
            max-width: 500px;
        }

        .header-right {
            justify-self: end;
        }

        .logo-link {
            display: flex;
            align-items: center;
            text-decoration: none;
            color: var(--color-on-primary);
        }

        .logo-text {
            font-size: var(--font-size-lg);
            font-weight: var(--font-weight-bold);
            font-family: var(--font-family-secondary);
            color: var(--color-on-primary);
        }

        .location-selector {
            padding: 8px 12px;
            border: 1px solid rgba(255, 255, 255, 0.3);
            border-radius: var(--radius-md);
            background: rgba(255, 255, 255, 0.1);
            color: var(--color-on-primary);
            font-size: var(--font-size-sm);
            cursor: pointer;
        }

        .search-container {
            position: relative;
            display: flex;
            align-items: center;
        }

        .search-field {
            width: 100%;
            padding: 12px 50px 12px 16px;
            border: none;
            border-radius: 25px;
            font-size: 16px;
            background: rgba(255, 255, 255, 0.9);
        }

        .search-submit {
            position: absolute;
            right: 8px;
            background: none;
            border: none;
            padding: 8px;
            cursor: pointer;
            border-radius: 50%;
        }

        .nav-menu {
            display: flex;
            list-style: none;
            gap: var(--spacing-6);
            align-items: center;
        }

        .nav-link {
            color: var(--color-on-primary);
            text-decoration: none;
            font-weight: 500;
            transition: opacity var(--transition-fast);
        }

        .nav-link:hover {
            opacity: 0.8;
        }

        .main-content {
            padding: 40px 20px;
            text-align: center;
            max-width: 800px;
            margin: 0 auto;
        }

        @media (max-width: 768px) {
            .header-container {
                grid-template-columns: 1fr;
                gap: 1rem;
                text-align: center;
            }
            
            .header-left,
            .header-center,
            .header-right {
                justify-self: center;
            }
            
            .nav-menu {
                flex-direction: column;
                gap: 1rem;
            }
        }
    </style>
</head>
<body>
    <div class="debug-banner">
        🐛 DEBUG MODE: Artemis Theme Direct HTML Test
    </div>
    
    <header class="site-header">
        <div class="header-container">
            <!-- Left Side: Logo and Location -->
            <div class="header-left">
                <div class="header-logo">
                    <a href="#" class="logo-link">
                        <span class="logo-text">Artemis Store</span>
                    </a>
                </div>
                <div class="header-location">
                    <select class="location-selector">
                        <option value="">Select Location</option>
                        <option value="elmsford">Elmsford, NY</option>
                        <option value="orange">Orange, CT</option>
                    </select>
                </div>
            </div>

            <!-- Center: Search Bar -->
            <div class="header-center">
                <div class="header-search">
                    <form class="search-form">
                        <div class="search-container">
                            <input type="search" 
                                   class="search-field"
                                   placeholder="Search products..."
                                   autocomplete="off">
                            <button type="submit" class="search-submit">
                                <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor">
                                    <path d="M15.5 14h-.79l-.28-.27C15.41 12.59 16 11.11 16 9.5 16 5.91 13.09 3 9.5 3S3 5.91 3 9.5 5.91 16 9.5 16c1.61 0 3.09-.59 4.23-1.57l.27.28v.79l5 4.99L20.49 19l-4.99-5zm-6 0C7.01 14 5 11.99 5 9.5S7.01 5 9.5 5 14 7.01 14 9.5 11.99 14 9.5 14z"/>
                                </svg>
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Right Side: Navigation -->
            <div class="header-right">
                <nav class="header-navigation">
                    <ul class="nav-menu">
                        <li><a href="#" class="nav-link">About Us</a></li>
                        <li><a href="#" class="nav-link">Blog</a></li>
                        <li><a href="#" class="nav-link">Sign In</a></li>
                    </ul>
                </nav>
            </div>
        </div>
    </header>

    <div class="main-content">
        <h1>🎨 Header Design Test</h1>
        <p>This is how your header should look with the new design.</p>
        <p><strong>Background:</strong> Primary blue (#2563eb)</p>
        <p><strong>Text:</strong> White (on-primary)</p>
        <p><strong>Layout:</strong> Equal padding, centered search</p>
        
        <hr style="margin: 40px 0;">
        
        <h2>Next Steps:</h2>
        <ol style="text-align: left; max-width: 500px; margin: 0 auto;">
            <li>Visit <code>http://localhost:8080/wp-admin</code></li>
            <li>Go to <strong>Appearance → Themes</strong></li>
            <li>Activate <strong>"Artemis Theme"</strong></li>
            <li>Visit <code>http://localhost:8080</code> (front page)</li>
            <li>The header should look like this!</li>
        </ol>
    </div>
</body>
</html>
