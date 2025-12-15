# Docker Deployment Guide for Dokploy

This Laravel 10 application is configured to run on Dokploy using a single Dockerfile with Nginx and PHP-FPM.

## Prerequisites

- Dokploy installed and configured
- External MySQL/PostgreSQL database (configured separately)
- Git repository with this codebase

## Setup Instructions

### 1. Environment Configuration

In Dokploy, set these environment variables:

```env
APP_NAME=ToolsFree
APP_ENV=production
APP_KEY=base64:your-generated-key-here
APP_DEBUG=false
APP_URL=https://yourdomain.com

DB_CONNECTION=mysql
DB_HOST=your_external_db_host
DB_PORT=3306
DB_DATABASE=toolsfree
DB_USERNAME=your_username
DB_PASSWORD=your_password

CACHE_DRIVER=file
SESSION_DRIVER=file
QUEUE_CONNECTION=sync

MAIL_MAILER=smtp
MAIL_HOST=your-smtp-host
MAIL_PORT=587
MAIL_USERNAME=your-email
MAIL_PASSWORD=your-password
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS=noreply@yourdomain.com
MAIL_FROM_NAME="${APP_NAME}"
```

### 2. Configure Persistent Volumes in Dokploy

**IMPORTANT**: Dokploy supports native volume mounting. Configure these volumes to persist your storage data:

#### Volume Mount Configuration

In Dokploy's deployment settings, add these two volume mounts:

| Container Path | Volume Name/Path | Description |
|---------------|------------------|-------------|
| `/var/www/html/storage` | `toolsfree-storage` | Laravel storage (uploads, logs, cache, sessions) |
| `/var/www/html/bootstrap/cache` | `toolsfree-bootstrap-cache` | Compiled views and config cache |

#### Steps to Add Volumes in Dokploy:

1. **Navigate to Your Application**
   - Open your application in Dokploy dashboard
   - Go to **Settings** or **Configuration**

2. **Add Volume Mounts**
   - Find **"Volumes"** or **"Mounts"** section
   - Click **"Add Volume"** or **"Add Mount"**
   
3. **Configure First Volume (Storage)**
   - **Volume Name**: `toolsfree-storage` (or any name)
   - **Mount Path**: `/var/www/html/storage`
   - **Type**: Named Volume (recommended) or Host Path
   - **Mode**: `rw` (read-write)
   
4. **Configure Second Volume (Bootstrap Cache)**
   - **Volume Name**: `toolsfree-bootstrap-cache` (or any name)
   - **Mount Path**: `/var/www/html/bootstrap/cache`
   - **Type**: Named Volume (recommended) or Host Path
   - **Mode**: `rw` (read-write)

5. **Save and Redeploy**
   - Save the volume configuration
   - Redeploy your application for changes to take effect

**Note**: The entrypoint script automatically handles permissions when volumes are mounted, so you don't need to manually set permissions.

### 3. Deploy on Dokploy

1. **Connect Repository**: In Dokploy, connect your Git repository
2. **Build Settings**: 
   - Dockerfile path: `Dockerfile` (root directory)
   - Build context: `.` (root directory)
3. **Port Configuration**: 
   - Expose port: `80`
4. **Volumes**: Configure as described above
5. **Deploy**: Click deploy and Dokploy will build and run the container

### 3. Post-Deployment Commands

After the first deployment, you may need to run these commands in Dokploy's terminal/exec:

```bash
# Generate application key (if not set in env)
php artisan key:generate

# Run migrations
php artisan migrate --force

# Cache configuration
php artisan config:cache
php artisan route:cache
php artisan view:cache

# Create storage link
php artisan storage:link

# Set permissions (if needed)
chown -R nginx:nginx /var/www/html/storage
chown -R nginx:nginx /var/www/html/bootstrap/cache
chmod -R 775 /var/www/html/storage
chmod -R 775 /var/www/html/bootstrap/cache
```

## Dockerfile Details

The Dockerfile creates a single container with:
- **Nginx**: Web server (port 80)
- **PHP 8.2 FPM**: Application runtime
- **Supervisor**: Manages both Nginx and PHP-FPM processes
- **Composer**: Installs dependencies during build

## Database Connection

Since MySQL is not included, make sure your `.env` or Dokploy environment variables point to your external database container/service.

## Maintenance

### View Logs
In Dokploy, use the logs viewer or exec into the container:
```bash
docker exec -it <container-name> sh
tail -f /var/log/nginx/error.log
tail -f /var/log/php-fpm.log
```

### Clear Cache
```bash
php artisan cache:clear
php artisan config:clear
php artisan route:clear
php artisan view:clear
```

### Update Application
1. Push changes to your Git repository
2. Dokploy will automatically rebuild and redeploy (if auto-deploy is enabled)
3. Or manually trigger a new deployment in Dokploy

## Persistent Storage

### Why Volumes Are Important

Without volumes, all storage data will be lost when the container is recreated:
- Uploaded files (if you add file uploads later)
- Application logs
- Session data
- Cache files
- Compiled views

### Volume Paths

The following directories should be persisted:
- `/var/www/html/storage` - Contains:
  - `storage/app` - Uploaded files
  - `storage/framework/cache` - Cache files
  - `storage/framework/sessions` - Session files
  - `storage/framework/views` - Compiled Blade views
  - `storage/logs` - Application logs

- `/var/www/html/bootstrap/cache` - Contains:
  - Compiled config cache
  - Route cache
  - Service provider cache

### Verifying Volumes

After deployment, verify volumes are mounted correctly:
```bash
# Exec into container
docker exec -it <container-name> sh

# Check if storage is writable
ls -la /var/www/html/storage
touch /var/www/html/storage/test.txt
rm /var/www/html/storage/test.txt
```

## Notes

- The container runs both Nginx and PHP-FPM managed by Supervisor
- Static assets are cached for 1 year
- PHP-FPM is configured with opcache enabled
- All Laravel optimizations should be run in production
- Make sure your external database is accessible from the Dokploy network
- **Always configure volumes before first deployment** to avoid data loss
