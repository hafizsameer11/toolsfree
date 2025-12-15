# Quick Dokploy Setup Guide

This is a quick reference for deploying ToolsFree on Dokploy with volume mounting.

## Prerequisites
- Dokploy installed and running
- External MySQL/PostgreSQL database
- Git repository with this codebase

## Deployment Steps

### 1. Connect Repository
- In Dokploy, create a new application
- Connect your Git repository
- Set branch: `main` or `master`

### 2. Build Configuration
- **Dockerfile Path**: `Dockerfile`
- **Build Context**: `.` (root)
- **Port**: `80`

### 3. Environment Variables
Set these in Dokploy's environment variables section:

```env
APP_NAME=ToolsFree
APP_ENV=production
APP_KEY=base64:your-key-here
APP_DEBUG=false
APP_URL=https://yourdomain.com

DB_CONNECTION=mysql
DB_HOST=your-db-host
DB_PORT=3306
DB_DATABASE=toolsfree
DB_USERNAME=your-username
DB_PASSWORD=your-password

CACHE_DRIVER=file
SESSION_DRIVER=file
```

### 4. Mount Volumes (IMPORTANT)

In Dokploy's **Volumes** section, add:

**Volume 1:**
- Path: `/var/www/html/storage`
- Volume: `toolsfree-storage` (or use named volume)

**Volume 2:**
- Path: `/var/www/html/bootstrap/cache`
- Volume: `toolsfree-bootstrap-cache` (or use named volume)

### 5. Deploy

Click **Deploy** and wait for the build to complete.

### 6. Post-Deployment

After first deployment, run these commands in Dokploy's terminal:

```bash
php artisan key:generate --force
php artisan migrate --force
php artisan storage:link
php artisan config:cache
php artisan route:cache
php artisan view:cache
```

## Volume Benefits

With volumes mounted:
- ✅ Logs persist across deployments
- ✅ Cache files survive container restarts
- ✅ Session data is maintained
- ✅ Uploaded files (if added) are preserved
- ✅ No data loss on updates

## Troubleshooting

**Permission errors?**
- The entrypoint script handles this automatically
- If issues persist, check volume mount paths in Dokploy

**Storage empty?**
- Verify volumes are mounted in Dokploy
- Check volume paths match exactly: `/var/www/html/storage` and `/var/www/html/bootstrap/cache`

**Can't write to storage?**
- Ensure volumes are mounted with `rw` (read-write) mode
- Check Dokploy volume configuration

## Quick Commands

```bash
# View logs
tail -f /var/www/html/storage/logs/laravel.log

# Clear cache
php artisan cache:clear
php artisan config:clear

# Check storage permissions
ls -la /var/www/html/storage
```

