#!/usr/bin/env node
/**
 * Static Site Builder for Artemis Theme
 * Converts WordPress PHP templates to static HTML
 */

const fs = require('fs-extra');
const path = require('path');

class ArtemisStaticBuilder {
    constructor() {
        this.themeDir = path.join(__dirname, '../themes/artemis-theme');
        this.outputDir = path.join(__dirname, '../dist');
        this.staticDir = path.join(__dirname, '../static-site');
        this.baseUrl = process.env.NODE_ENV === 'development' ? '' : '/public-artemis-example';
    }

    async init() {
        console.log('🚀 Building Artemis static site...');
        await fs.ensureDir(this.outputDir);
        await fs.emptyDir(this.outputDir);
    }

    // Convert PHP template variables to static values
    processTemplate(content, data = {}) {
        const defaults = {
            siteName: 'Artemis',
            siteDescription: 'A modern WordPress-powered static site',
            currentYear: new Date().getFullYear(),
            homeUrl: this.baseUrl,
            themeUrl: this.baseUrl + '/assets',
            email: 'info@example.com',
            phone: '(914) 555-0123',
            ...data
        };

        // Replace PHP functions with static values
        content = content.replace(/<?php\s+get_header\(\);\s+\?>/g, '<!-- HEADER_PLACEHOLDER -->');
        content = content.replace(/<?php\s+get_footer\(\);\s+\?>/g, '<!-- FOOTER_PLACEHOLDER -->');
        content = content.replace(/<?php\s+wp_head\(\);\s+\?>/g, this.generateHead(defaults));
        content = content.replace(/<?php\s+wp_footer\(\);\s+\?>/g, this.generateFooterScripts());
        content = content.replace(/<?php\s+body_class\(\);\s+\?>/g, 'class=""');
        content = content.replace(/<?php\s+language_attributes\(\);\s+\?>/g, 'lang="en"');
        
        // Replace bloginfo calls
        content = content.replace(/<?php\s+bloginfo\(['"](.*?)['"]\);\s+\?>/g, (match, param) => {
            switch(param) {
                case 'name': return defaults.siteName;
                case 'charset': return 'UTF-8';
                case 'description': return defaults.siteDescription;
                default: return '';
            }
        });

        // Replace home_url calls
        content = content.replace(/<?php\s+echo\s+home_url\(['"](.*?)['"]\);\s+\?>/g, 
            (match, path) => defaults.homeUrl + path);
        content = content.replace(/<?php\s+echo\s+home_url\(\);\s+\?>/g, defaults.homeUrl);
        
        // Replace template directory calls
        content = content.replace(/<?php\s+echo\s+get_template_directory_uri\(\);\s+\?>/g, defaults.themeUrl);
        
        // Replace theme mod calls
        content = content.replace(/<?php\s+echo\s+esc_html\(get_theme_mod\(['"](.*?)['"]\s*,\s*['"](.*?)['"]\)\);\s+\?>/g, 
            (match, key, defaultValue) => {
                switch(key) {
                    case 'artemis_email': return defaults.email;
                    case 'artemis_phone': return defaults.phone;
                    default: return defaultValue;
                }
            });

        // Replace other common functions
        content = content.replace(/<?php\s+echo\s+date\(['"](Y|y)['"]\);\s+\?>/g, defaults.currentYear.toString());
        content = content.replace(/<?php\s+echo\s+esc_attr\([^)]+\);\s+\?>/g, (match) => {
            if (match.includes('artemis_email')) return defaults.email;
            if (match.includes('artemis_phone')) return defaults.phone.replace(/[()\s-]/g, '');
            return '';
        });

        // Remove remaining PHP tags and WordPress functions
        content = content.replace(/<?php[^?]*\?>/g, '');
        content = content.replace(/\s+class="[^"]*php[^"]*"/g, ' class=""');

        return content;
    }

    generateHead(data) {
        return `    <meta charset="${data.charset || 'UTF-8'}">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>${data.pageTitle || data.siteName}</title>
    <meta name="description" content="${data.siteDescription}">
    <link rel="stylesheet" href="${data.themeUrl}/css/style.css">`;
    }

    generateFooterScripts() {
        return `    <script src="${this.baseUrl}/assets/js/header.js"></script>`;
    }

    async copyAssets() {
        console.log('📦 Copying theme assets...');
        
        // Copy CSS
        await fs.ensureDir(path.join(this.outputDir, 'assets/css'));
        await fs.copy(
            path.join(this.themeDir, 'style.css'),
            path.join(this.outputDir, 'assets/css/style.css')
        );

        // Copy JS
        if (await fs.pathExists(path.join(this.themeDir, 'assets/js'))) {
            await fs.copy(
                path.join(this.themeDir, 'assets/js'),
                path.join(this.outputDir, 'assets/js')
            );
        }

        // Copy images if they exist
        if (await fs.pathExists(path.join(this.themeDir, 'assets/images'))) {
            await fs.copy(
                path.join(this.themeDir, 'assets/images'),
                path.join(this.outputDir, 'assets/images')
            );
        }
    }

    async buildTemplate(templateName, outputName, data = {}) {
        console.log(`📝 Building ${outputName}...`);
        
        try {
            // Read the static HTML template first
            const staticTemplate = await fs.readFile(
                path.join(this.staticDir, templateName),
                'utf8'
            );

            // Read header and footer from PHP templates
            const headerContent = await fs.readFile(
                path.join(this.themeDir, 'header.php'),
                'utf8'
            );
            
            const footerContent = await fs.readFile(
                path.join(this.themeDir, 'footer.php'),
                'utf8'
            );

            // Process templates
            const processedHeader = this.processTemplate(headerContent, data);
            const processedFooter = this.processTemplate(footerContent, data);
            let processedContent = this.processTemplate(staticTemplate, data);

            // Replace placeholders
            processedContent = processedContent.replace('<!-- HEADER_PLACEHOLDER -->', processedHeader);
            processedContent = processedContent.replace('<!-- FOOTER_PLACEHOLDER -->', processedFooter);

            // Clean up any remaining PHP artifacts
            processedContent = processedContent.replace(/\s*<?php[^?]*\?>\s*/g, '');
            processedContent = processedContent.replace(/\s+>/g, '>');

            // Write the final HTML
            await fs.writeFile(
                path.join(this.outputDir, outputName),
                processedContent
            );
            
            console.log(`✅ Generated ${outputName}`);
        } catch (error) {
            console.error(`❌ Error building ${outputName}:`, error.message);
        }
    }

    async build() {
        try {
            await this.init();
            await this.copyAssets();
            
            // Build pages
            await this.buildTemplate('index.html', 'index.html', {
                pageTitle: 'Home | Artemis',
                bodyClass: 'home'
            });
            
            await this.buildTemplate('about.html', 'about.html', {
                pageTitle: 'About Us | Artemis',
                bodyClass: 'page-about'
            });
            
            await this.buildTemplate('blog.html', 'blog.html', {
                pageTitle: 'Blog | Artemis',
                bodyClass: 'page-blog'
            });

            console.log('🎉 Static site build completed!');
            console.log(`📁 Output directory: ${this.outputDir}`);
        } catch (error) {
            console.error('💥 Build failed:', error);
            process.exit(1);
        }
    }
}

// Run the builder
if (require.main === module) {
    const builder = new ArtemisStaticBuilder();
    builder.build();
}

module.exports = ArtemisStaticBuilder;
