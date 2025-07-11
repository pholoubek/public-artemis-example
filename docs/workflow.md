# Content Management Workflow

## Content Creation Process

### 1. Create Content in WordPress
1. **Access WordPress Admin**: http://localhost:8080/wp-admin
2. **Create Pages/Posts**: Use WordPress editor to create content
3. **Add Media**: Upload images and files through Media Library
4. **Configure SEO**: Set meta descriptions and titles
5. **Preview**: Use WordPress preview to check content

### 2. Deploy to Production
1. **Commit Changes**: Any theme/config changes to git
2. **Push to GitHub**: `git push origin main`
3. **Automatic Build**: GitHub Actions fetches WordPress content
4. **Deploy**: Static site deploys to GitHub Pages
5. **Live Site**: Available at https://pholoubek.github.io/public-artemis-example/

## Content Types

### Pages
- Static content (About, Contact, etc.)
- Automatically included in navigation
- SEO optimized URLs

### Posts
- Blog posts and news
- Chronological listing
- Category and tag support

### Media
- Images automatically optimized
- Files accessible via static URLs
- CDN-like performance

## Best Practices

### Content Structure
- Use clear, descriptive titles
- Organize content with categories/tags
- Optimize images before upload
- Write SEO-friendly meta descriptions

### Performance
- Keep images under 1MB
- Use descriptive file names
- Minimize external embeds
- Test mobile responsiveness

### SEO
- Use proper heading hierarchy (H1, H2, H3)
- Add alt text to images
- Include internal links
- Write meta descriptions

## Advanced Features

### Custom Fields
Add custom fields for structured content:
```php
// In functions.php
function artemis_custom_fields() {
    add_meta_box('custom_fields', 'Custom Fields', 'custom_fields_callback', 'post');
}
```

### Shortcodes
Create reusable content blocks:
```php
// Example shortcode
function artemis_button_shortcode($atts) {
    $atts = shortcode_atts(array(
        'text' => 'Click Here',
        'url' => '#'
    ), $atts);
    return '<a href="' . $atts['url'] . '" class="btn">' . $atts['text'] . '</a>';
}
add_shortcode('button', 'artemis_button_shortcode');
```

### Menu Management
1. Go to Appearance → Menus
2. Create menu items
3. Assign to "Primary Menu" location
4. Menu automatically appears in static site

## Deployment Schedule

### Automatic Deployment
- Triggers on every push to main branch
- Usually completes in 2-3 minutes
- No manual intervention required

### Manual Deployment
```bash
# Trigger via GitHub CLI
gh workflow run deploy.yml

# Or push empty commit
git commit --allow-empty -m "Trigger deployment"
git push
```

## Monitoring

### Check Deployment Status
1. Go to Actions tab in GitHub
2. View latest workflow run
3. Check logs for any errors

### Site Health
- Monitor site performance
- Check broken links regularly
- Validate HTML/CSS
- Test mobile responsiveness