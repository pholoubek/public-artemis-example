const axios = require('axios');
const cheerio = require('cheerio');
const fs = require('fs-extra');
const path = require('path');
const { execSync } = require('child_process');
const yargs = require('yargs');

const argv = yargs(process.argv.slice(2))
  .option('dev', {
    alias: 'd',
    type: 'boolean',
    description: 'Run in development mode'
  })
  .help()
  .argv;

class WordPressStaticGenerator {
  constructor() {
    this.wpUrl = process.env.WORDPRESS_URL || 'http://localhost:8080';
    this.outputDir = path.join(__dirname, '../dist');
    this.baseUrl = argv.dev ? '' : '/public-artemis-example';
    this.pages = new Set();
    this.assets = new Set();
  }

  async init() {
    console.log('🚀 Starting WordPress static site generation...');
    await fs.ensureDir(this.outputDir);
    await fs.emptyDir(this.outputDir);
  }

  async fetchPage(url) {
    try {
      console.log(`📄 Fetching: ${url}`);
      const response = await axios.get(url);
      return response.data;
    } catch (error) {
      console.error(`❌ Error fetching ${url}:`, error.message);
      return null;
    }
  }

  async discoverPages() {
    console.log('🔍 Discovering pages and posts...');
    
    // Get sitemap or REST API endpoints
    const endpoints = [
      `${this.wpUrl}/wp-json/wp/v2/pages`,
      `${this.wpUrl}/wp-json/wp/v2/posts`
    ];

    for (const endpoint of endpoints) {
      try {
        const response = await axios.get(endpoint);
        response.data.forEach(item => {
          this.pages.add(item.link);
        });
      } catch (error) {
        console.warn(`⚠️ Could not fetch from ${endpoint}`);
      }
    }

    // Add homepage
    this.pages.add(this.wpUrl);
    
    console.log(`📋 Found ${this.pages.size} pages to process`);
  }

  processHtml(html, originalUrl) {
    const $ = cheerio.load(html);
    
    // Update base URLs for assets
    $('link[href], script[src], img[src]').each((i, el) => {
      const $el = $(el);
      const attr = $el.attr('href') || $el.attr('src');
      
      if (attr && attr.startsWith(this.wpUrl)) {
        const relativePath = attr.replace(this.wpUrl, '');
        $el.attr($el.attr('href') ? 'href' : 'src', this.baseUrl + relativePath);
        this.assets.add(attr);
      }
    });

    // Update internal links
    $('a[href]').each((i, el) => {
      const $el = $(el);
      const href = $el.attr('href');
      
      if (href && href.startsWith(this.wpUrl)) {
        const relativePath = href.replace(this.wpUrl, '');
        $el.attr('href', this.baseUrl + relativePath);
      }
    });

    // Add meta tags for static site
    $('head').prepend(`
      <meta name="generator" content="WordPress Static Generator">
      <meta name="robots" content="index, follow">
    `);

    return $.html();
  }

  async downloadAssets() {
    console.log('📦 Downloading assets...');
    
    for (const assetUrl of this.assets) {
      try {
        const response = await axios.get(assetUrl, { responseType: 'stream' });
        const relativePath = assetUrl.replace(this.wpUrl, '');
        const outputPath = path.join(this.outputDir, relativePath);
        
        await fs.ensureDir(path.dirname(outputPath));
        response.data.pipe(fs.createWriteStream(outputPath));
        
        console.log(`✅ Downloaded: ${relativePath}`);
      } catch (error) {
        console.error(`❌ Failed to download ${assetUrl}:`, error.message);
      }
    }
  }

  async generatePages() {
    console.log('📝 Generating static pages...');
    
    for (const pageUrl of this.pages) {
      const html = await this.fetchPage(pageUrl);
      if (!html) continue;

      const processedHtml = this.processHtml(html, pageUrl);
      const relativePath = pageUrl.replace(this.wpUrl, '') || '/index.html';
      
      let outputPath = path.join(this.outputDir, relativePath);
      
      // Ensure .html extension
      if (!path.extname(outputPath)) {
        outputPath = path.join(outputPath, 'index.html');
      }

      await fs.ensureDir(path.dirname(outputPath));
      await fs.writeFile(outputPath, processedHtml);
      
      console.log(`✅ Generated: ${relativePath}`);
    }
  }

  async generateSitemap() {
    console.log('🗺️ Generating sitemap...');
    
    const sitemap = `<?xml version="1.0" encoding="UTF-8"?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
${Array.from(this.pages).map(url => {
  const relativePath = url.replace(this.wpUrl, '');
  return `  <url>
    <loc>https://pholoubek.github.io${this.baseUrl}${relativePath}</loc>
    <lastmod>${new Date().toISOString().split('T')[0]}</lastmod>
    <changefreq>weekly</changefreq>
    <priority>0.8</priority>
  </url>`;
}).join('\n')}
</urlset>`;

    await fs.writeFile(path.join(this.outputDir, 'sitemap.xml'), sitemap);
    console.log('✅ Sitemap generated');
  }

  async build() {
    try {
      await this.init();
      await this.discoverPages();
      await this.generatePages();
      await this.downloadAssets();
      await this.generateSitemap();
      
      console.log('🎉 Static site generation completed!');
      console.log(`📁 Output directory: ${this.outputDir}`);
    } catch (error) {
      console.error('💥 Build failed:', error);
      process.exit(1);
    }
  }
}

// Run the generator
const generator = new WordPressStaticGenerator();
generator.build();