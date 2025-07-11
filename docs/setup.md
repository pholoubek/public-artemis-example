# Setup Guide

## Prerequisites

- Docker and Docker Compose
- Node.js 18+ (for local development)
- GitHub account with Actions enabled

## Local Development Setup

### 1. Clone Repository
```bash
git clone https://github.com/pholoubek/public-artemis-example.git
cd public-artemis-example
```

### 2. Start WordPress with Docker
```bash
cd docker
docker-compose up -d
```

### 3. Access WordPress Admin
- URL: http://localhost:8080/wp-admin
- Username: `admin`
- Password: `admin123`

### 4. Initial WordPress Configuration

1. **Install Required Plugins** (if needed):
   - Classic Editor (if you prefer classic editing)
   - Yoast SEO (for better SEO)

2. **Activate Artemis Theme**:
   - Go to Appearance → Themes
   - Activate "Artemis Theme"

3. **Create Sample Content**:
   - Create a few pages and posts
   - Set up navigation menu
   - Configure site settings

### 5. Test Static Generation Locally
```bash
cd scripts
npm install
npm run build
```

## GitHub Pages Setup

### 1. Enable GitHub Pages
1. Go to repository Settings
2. Navigate to Pages section
3. Set Source to "GitHub Actions"

### 2. Configure Secrets (Optional)
If using external WordPress:
- `WORDPRESS_URL`: Your WordPress site URL
- `WORDPRESS_USERNAME`: WordPress admin username  
- `WORDPRESS_PASSWORD`: WordPress admin password

### 3. Deploy
Push to main branch to trigger automatic deployment.

## Troubleshooting

### WordPress Connection Issues
- Ensure Docker containers are running: `docker ps`
- Check WordPress logs: `docker-compose logs wordpress`
- Verify database connection: `docker-compose logs db`

### Static Generation Issues
- Check WordPress REST API is accessible
- Verify all pages are publicly accessible
- Review GitHub Actions logs for errors

### Deployment Issues
- Ensure GitHub Pages is enabled
- Check Actions permissions in repository settings
- Verify workflow file syntax