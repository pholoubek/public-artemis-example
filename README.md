# Public Artemis Example - WordPress Static Site

A WordPress-powered static site that combines the ease of WordPress content management with the performance and security of static site deployment via GitHub Pages.

## 🚀 Quick Start

1. **View Live Site**
   - Visit: https://pholoubek.github.io/public-artemis-example/
   - Currently shows a "Hello World" page

2. **Local Development Setup**
   ```bash
   git clone https://github.com/pholoubek/public-artemis-example.git
   cd public-artemis-example
   docker-compose -f docker/docker-compose.yml up -d
   ```

3. **Access WordPress Admin**
   - URL: http://localhost:8080/wp-admin
   - Username: admin
   - Password: admin123

4. **Deploy to GitHub Pages**
   - Push changes to main branch
   - GitHub Actions will automatically build and deploy

## 📖 Documentation

- [Setup Guide](docs/setup.md) - Complete setup instructions
- [Workflow Guide](docs/workflow.md) - Content management workflow

## 🏗️ Architecture

- **Content Management**: WordPress (local or hosted)
- **Static Generation**: Custom Node.js scripts
- **Deployment**: GitHub Actions → GitHub Pages
- **Domain**: https://pholoubek.github.io/public-artemis-example/

## 📁 Project Structure

```
├── .github/workflows/    # GitHub Actions
├── docker/              # Local WordPress setup
├── scripts/             # Static generation scripts
├── themes/              # Custom WordPress theme
├── config/              # WordPress configuration
└── docs/               # Documentation
```

## 🔧 Features

- ✅ WordPress admin for content management
- ✅ Automatic static site generation
- ✅ GitHub Pages deployment
- ✅ Responsive design
- ✅ SEO optimized
- ✅ Fast loading static files
- ✅ SSL/HTTPS support

## 🤝 Contributing

1. Create content in WordPress admin
2. Commit changes to repository
3. GitHub Actions handles the rest!

---

Built with ❤️ using WordPress + GitHub Pages
